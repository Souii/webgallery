<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Services\GalleryService;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;

class ImageController extends Controller
{
    private $gallery;
    private $categoryRepository;
    private $imageRepository;

    public function __construct(
        GalleryService $gallery,
        CategoryRepository $categoryRepository,
        ImageRepository $imageRepository
    ) {
        $this->gallery = $gallery;
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        $data = [
            'title' => old('title'),
            'description' => old('description'),
            'category' => old('category'),
            'tags' => old('tags')
        ];

        return view('admin.images.create', compact('categories', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AddImageRequest  $request
     * @return \Illuminate\Http\Response
     */
     public function store(AddImageRequest $request)
     {
         $data = [
             'file' => $request->file('image'),
             'category' => $request->category,
             'title' => $request->title,
             'description' => $request->description,
             'tags' => $request->tags
         ];

         $this->gallery->addImage($data);

         $request->session()
         ->flash('success', 'The picture has been added to the gallery.');

         return redirect()->route('dashboard');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($image)
    {
        $categories = $this->categoryRepository->getAll();
        $image = $this->imageRepository->find($image);

        $data = [
            'id' => $image->id,
            'title' => $image->title,
            'description' => $image->description,
            'category' => $image->category->id,
            'tags' => $image->tags->implode('name', ', ')
        ];

        return view(
            'admin.images.edit',
            compact('categories', 'data')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, $image)
    {
        $data = [
            'category' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags
        ];

        $this->gallery->updateMetadata($image, $data);

        $request->session()
        ->flash('success', 'The image has been updated.');

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($image)
     {
         $this->gallery->deleteImage($image);
     }
}
