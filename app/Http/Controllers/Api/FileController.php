<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\File;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Models\DownloadStatistic;
use App\Http\Controllers\Controller;
use App\Http\Resources\File\FileResource;
use App\Interfaces\FileRepositoryInterface;
use App\Http\Requests\File\FileUpdateRequest;
use App\Http\Requests\File\FileUploadRequest;
use Illuminate\Http\Response;

class FileController extends Controller
{
    protected $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository) {
        $this->fileRepository = $fileRepository;
    }

    public function index(Request $request)
    {
        try{
            $files = $this->fileRepository->index($request);

            return ResponseHelper::success($files);
        }catch(Exception $e){
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function booksOfAuthor($authorId)
    {
        try{
            $files = $this->fileRepository->booksOfAuthor($authorId);
            
            return ResponseHelper::success($files);
        }catch(Exception $e){
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function mostDownloadedBooks()
    {
        try{
            $book_id = DownloadStatistic::with('file')->orderBy('download_count', 'desc')->take(8)->pluck('book_id');
            $books = File::with('DownloadStatistic')->whereIn('id', $book_id)->get();
            
            return FileResource::collection($books);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    // public function scrollBook(Request $request) 
    // {
    //     try{
    //         $books = $this->fileRepository->scrollBook($request);

    //         return ResponseHelper::success($books);
    //     }catch(Exception $e){
    //         return ResponseHelper::serverError([], $e->getMessage());
    //     }
    // }

    public function upload(FileUploadRequest $request)
    {
        try{
            $fileResult = $this->fileRepository->upload($request->all());

            return ResponseHelper::created($fileResult, 'Successfully uploaded.');
        }catch (Exception $e){
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function show(File $file)
    {
        try{
            $fileResult = $this->fileRepository->find($file);
            // return $fileResult;
            return ResponseHelper::success($fileResult);
        }catch (Exception $e){
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function update(FileUpdateRequest $request, File $file)
    {
        try{
            // $isPdf = $request->hasFile('file');
            $isImg = $request->hasFile('image');
            $fileResult = $this->fileRepository->update($file, $request->all(), $isImg);

            return ResponseHelper::created($fileResult, 'Successfully updated.');
        }catch (Exception $e){
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function download(File $file)
    {
        try{
            $fileResult = $this->fileRepository->download($file);

            return $fileResult;
            // return ResponseHelper::success($fileResult, 'Successfully downloaded.');
        }catch (Exception $e){
            return $e->getMessage();
            // return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function destroy(File $file)
    {
        try{
            $this->fileRepository->delete($file);

            return ResponseHelper::noContent();
        }catch (Exception $e) {
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR());
            // return ResponseHelper::serverError([], $e->getMessage());
        }
    }
}
