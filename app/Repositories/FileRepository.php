<?php

namespace App\Repositories;

use App\Models\File;
use App\Helper\UploadHelper;
use App\Http\Resources\File\FileResource;
use App\Interfaces\FileRepositoryInterface;

class FileRepository implements FileRepositoryInterface {
    protected $model;

    public function __construct(File $model) {
        $this->model = $model;
    }

    public function index($request)
    {
        $files = $this->model->with('author')->orderBy('created_at', 'desc');

        if($request->search){
            $files->where('name', 'like', '%'. $request->search .'%');
        }
        
        if($request->author_id){
            $files->where('author_id', $request->author_id);
        }

        $books = $files->paginate(8);

        return FileResource::collection($books);
    }

    public function booksOfAuthor($authorId)
    {
        $files = $this->model->with('author')->whereAuthorId($authorId)->orderBy('created_at', 'desc')->get();

        return FileResource::collection($files);
    }

    // public function scrollBook($request)
    // {
    //     $perPage = $request->get('per_page', 2);
    //     $page = $request->get('page', 1);

    //     $books = $this->model->with('author')->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);

    //     return FileResource::collection($books);
    // }

    public function upload(array $data)
    {
        if(!empty($data['file'])){
            $data['file'] = UploadHelper::uploadPdf($data['file']);
        }
        if(!empty($data['image'])){
            $data['image'] = UploadHelper::uploadImage($data['image']);
        }

        $file = $this->model->create($data);
        return new FileResource($file);
    }

    public function find($file) {
        return new FileResource($file);
    }

    public function update($file, $data, $isImg) {
        if(!empty($data['file'])){
            $data['file'] = UploadHelper::updatePdf($data['file'], $file->file);
        }
        if($isImg && $file->image){
            $data['image'] = UploadHelper::updateImage($data['image'], $file->image);
        }elseif($isImg && !$file->image){
            $data['image'] = UploadHelper::uploadImage($data['image']);
        }elseif(!$isImg && $file->image){
            // UploadHelper::deleteImage($file->image);
            $data['image'] = $file->image;
        }else{
            $data['image'] = null;
        }

        $file->update($data);
        return new FileResource($file);
    }

    public function download($file)
    {
        $filePath = storage_path('app/public/file/' . $file->file);
        
        // Read the file contents
        $fileContents = file_get_contents($filePath);

        // Increment download count
        $file->downloadStatistic->download_count++;
        $file->downloadStatistic->save();

        // Return the file contents as the response
        return response($fileContents)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $file->name . '"');
    }

    public function delete($file)
    {
        UploadHelper::deleteImage($file->image);
        UploadHelper::deletePdf($file->file);

        $file->delete();
    }
}