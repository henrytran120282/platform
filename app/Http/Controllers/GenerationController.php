<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGenerationRequest;
use App\Http\Requests\UpdateGenerationRequest;
use App\Repositories\GenerationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class GenerationController extends AppBaseController
{
    /** @var  GenerationRepository */
    private $generationRepository;

    public function __construct(GenerationRepository $generationRepo)
    {
        $this->generationRepository = $generationRepo;
    }

    /**
     * Display a listing of the Generation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->generationRepository->pushCriteria(new RequestCriteria($request));
        $generations = $this->generationRepository->all();

        return view('admin.generations.index')
            ->with('generations', $generations);
    }

    /**
     * Show the form for creating a new Generation.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.generations.create');
    }

    /**
     * Store a newly created Generation in storage.
     *
     * @param CreateGenerationRequest $request
     *
     * @return Response
     */
    public function store(CreateGenerationRequest $request)
    {
        $input = $request->all();

        $generation = $this->generationRepository->create($input);

        Flash::success('Generation saved successfully.');

        return redirect(route('admin.generations.index'));
    }

    /**
     * Display the specified Generation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $generation = $this->generationRepository->findWithoutFail($id);

        if (empty($generation)) {
            Flash::error('Generation not found');

            return redirect(route('admin.generations.index'));
        }

        return view('admin.generations.show')->with('generation', $generation);
    }

    /**
     * Show the form for editing the specified Generation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $generation = $this->generationRepository->findWithoutFail($id);

        if (empty($generation)) {
            Flash::error('Generation not found');

            return redirect(route('admin.generations.index'));
        }

        return view('admin.generations.edit')->with('generation', $generation);
    }

    /**
     * Update the specified Generation in storage.
     *
     * @param  int              $id
     * @param UpdateGenerationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGenerationRequest $request)
    {
        $generation = $this->generationRepository->findWithoutFail($id);

        if (empty($generation)) {
            Flash::error('Generation not found');

            return redirect(route('admin.generations.index'));
        }

        $generation = $this->generationRepository->update($request->all(), $id);

        Flash::success('Generation updated successfully.');

        return redirect(route('admin.generations.index'));
    }

    /**
     * Remove the specified Generation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $generation = $this->generationRepository->findWithoutFail($id);

        if (empty($generation)) {
            Flash::error('Generation not found');

            return redirect(route('admin.generations.index'));
        }

        $this->generationRepository->delete($id);

        Flash::success('Generation deleted successfully.');

        return redirect(route('admin.generations.index'));
    }
}
