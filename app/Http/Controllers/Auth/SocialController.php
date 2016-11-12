<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;
use Laravel\Socialite\Two\InvalidStateException;
use Socialite;

class SocialController extends Controller
{

    /**
     * Guard for social
     * @var string
     */
    protected $guard = 'member';

    /**
     * Default Auth Model
     * @var User
     */
    protected $model;

    /**
     * Inject Default Model
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($driver)
    {
        try {
            $social = Socialite::driver($driver);
        } catch (InvalidArgumentException $e) {
            abort(400, $e->getMessage());
        }

        $social->setHttpClient(
            new Client([
                'curl' => [
                    CURLOPT_CAINFO => base_path('resources/assets/pem/cacert.pem'),
                ],
            ])
        );

        return $social->redirect();

    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
            try {
                $localUser = $this->model->where('provider', $driver)->where('email', $user->getEmail())->firstOrFail();
                $auth      = Auth::guard($this->guard)->login($localUser);
                return redirect('/');

            } catch (ModelNotFoundException $e) {
                $this->model->name     = $user->getName();
                $this->model->email    = $user->getEmail();
                $this->model->photo    = $user->getAvatar();
                $this->model->provider = $driver;
                $this->model->role_id  = config('utils.default_role');
                try {
                    $this->model->save();
                    return redirect('/');
                } catch (QueryException $e) {
                    abort(400, $e->getMessage());
                }
            }
        } catch (InvalidStateException $e) {
            abort(400, $e->getMessage());
        } catch (ClientException $e) {
            abort(400, $e->getMessage());
        }

    }
}
