<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleriesRequest;
use App\Http\Requests\UpdateGalleriesRequest;
use App\Repositories\GalleriesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class GalleriesController extends AppBaseController
{
    /** @var  GalleriesRepository */
    private $galleriesRepository;

    public function __construct(GalleriesRepository $galleriesRepo)
    {
        $this->galleriesRepository = $galleriesRepo;
    }

    /**
     * Display a listing of the Galleries.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->galleriesRepository->pushCriteria(new RequestCriteria($request));
        $galleries = $this->galleriesRepository->all();

        return view('admin.galleries.index')
            ->with('galleries', $galleries);
    }

    /**
     * Show the form for creating a new Galleries.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created Galleries in storage.
     *
     * @param CreateGalleriesRequest $request
     *
     * @return Response
     */
    public function store(CreateGalleriesRequest $request)
    {
        $input = $request->all();

        $galleries = $this->galleriesRepository->create($input);

        Flash::success('Galleries saved successfully.');

        return redirect(route('admin.galleries.index'));
    }

    /**
     * Display the specified Galleries.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $galleries = $this->galleriesRepository->findWithoutFail($id);

        if (empty($galleries)) {
            Flash::error('Galleries not found');

            return redirect(route('admin.galleries.index'));
        }

        return view('admin.galleries.show')->with('galleries', $galleries);
    }

    /**
     * Show the form for editing the specified Galleries.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $galleries = $this->galleriesRepository->findWithoutFail($id);

        if (empty($galleries)) {
            Flash::error('Galleries not found');

            return redirect(route('admin.galleries.index'));
        }

        return view('admin.galleries.edit')->with('galleries', $galleries);
    }

    /**
     * Update the specified Galleries in storage.
     *
     * @param  int              $id
     * @param UpdateGalleriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGalleriesRequest $request)
    {
        $galleries = $this->galleriesRepository->findWithoutFail($id);

        if (empty($galleries)) {
            Flash::error('Galleries not found');

            return redirect(route('admin.galleries.index'));
        }

        $galleries = $this->galleriesRepository->update($request->all(), $id);

        Flash::success('Galleries updated successfully.');

        return redirect(route('admin.galleries.index'));
    }

    /**
     * Remove the specified Galleries from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $galleries = $this->galleriesRepository->findWithoutFail($id);

        if (empty($galleries)) {
            Flash::error('Galleries not found');

            return redirect(route('admin.galleries.index'));
        }

        $this->galleriesRepository->delete($id);

        Flash::success('Galleries deleted successfully.');

        return redirect(route('admin.galleries.index'));
    }
}
