<?php

namespace App\Http\Controllers;

use App\Entities\Galleries;
use App\Http\Requests\CreateGalleryImagesRequest;
use App\Http\Requests\UpdateGalleryImagesRequest;
use App\Repositories\GalleryImagesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class GalleryImagesController extends AppBaseController
{
    /** @var  GalleryImagesRepository */
    private $galleryImagesRepository;

    public function __construct(GalleryImagesRepository $galleryImagesRepo)
    {
        $this->galleryImagesRepository = $galleryImagesRepo;
    }

    /**
     * Display a listing of the GalleryImages.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->galleryImagesRepository->pushCriteria(new RequestCriteria($request));
        $galleryImages = $this->galleryImagesRepository->all();
        return view('admin.gallery_images.index')
            ->with('galleryImages', $galleryImages);
    }

    /**
     * Show the form for creating a new GalleryImages.
     *
     * @return Response
     */
    public function create()
    {
        $galleries = Galleries::all();
        return view('admin.gallery_images.create')->with('galleries',$galleries);
    }

    /**
     * Store a newly created GalleryImages in storage.
     *
     * @param CreateGalleryImagesRequest $request
     *
     * @return Response
     */
    public function store(CreateGalleryImagesRequest $request)
    {
        $input = $request->all();
        $file = $request->file('image_name');
        $fileName = time().'-'.$file->getClientOriginalName();
        $input['image_name'] = $fileName;
        $galleryImages = $this->galleryImagesRepository->create($input);
        if($galleryImages){
            $pathUpload = public_path('uploads/gallery/'.$input['gallery_id']);
            if(!is_dir($pathUpload)){
                mkdir($pathUpload);
            }
            $file->move($pathUpload,$fileName);
        }
        Flash::success('Gallery Images saved successfully.');

        return redirect(route('admin.galleryImages.index'));
    }

    /**
     * Display the specified GalleryImages.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $galleryImages = $this->galleryImagesRepository->findWithoutFail($id);

        if (empty($galleryImages)) {
            Flash::error('Gallery Images not found');

            return redirect(route('admin.galleryImages.index'));
        }

        return view('admin.gallery_images.show')->with('galleryImages', $galleryImages);
    }

    /**
     * Show the form for editing the specified GalleryImages.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $galleryImages = $this->galleryImagesRepository->findWithoutFail($id);
        $galleries = Galleries::all();
        if (empty($galleryImages)) {
            Flash::error('Gallery Images not found');

            return redirect(route('admin.galleryImages.index'));
        }

        return view('admin.gallery_images.edit')->with('galleryImages', $galleryImages)->with('galleries', $galleries);
    }

    /**
     * Update the specified GalleryImages in storage.
     *
     * @param  int              $id
     * @param UpdateGalleryImagesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGalleryImagesRequest $request)
    {
        $input = $request->all();
        $file = $request->file('image_name');
        $fileName = time().'-'.$file->getClientOriginalName();
        $input['image_name'] = $fileName;
        $galleryImages = $this->galleryImagesRepository->findWithoutFail($id);

        if (empty($galleryImages)) {
            Flash::error('Gallery Images not found');

            return redirect(route('admin.galleryImages.index'));
        }

        $galleryImages = $this->galleryImagesRepository->update($input, $id);
        if($galleryImages){
            $pathUpload = public_path('uploads/gallery/'.$input['gallery_id']);
            if(!is_dir($pathUpload)){
                mkdir($pathUpload);
            }
            $file->move($pathUpload,$fileName);
        }

        Flash::success('Gallery Images updated successfully.');

        return redirect(route('admin.galleryImages.index'));
    }

    /**
     * Remove the specified GalleryImages from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $galleryImages = $this->galleryImagesRepository->findWithoutFail($id);

        if (empty($galleryImages)) {
            Flash::error('Gallery Images not found');

            return redirect(route('admin.galleryImages.index'));
        }

        $this->galleryImagesRepository->delete($id);

        Flash::success('Gallery Images deleted successfully.');

        return redirect(route('admin.galleryImages.index'));
    }
}
