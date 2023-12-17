<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Interfaces\AuthorRepositoryInterface;
use App\Http\Requests\Author\AuthorCreateRequest;
use App\Http\Requests\Author\AuthorUpdateRequest;
use App\Http\Resources\Author\AuthorDetailResource;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository) {
        $this->authorRepository = $authorRepository;
    }

    public function index(Request $request)
    {
        try{
            $authors = $this->authorRepository->index($request);
            
            return ResponseHelper::success($authors, 'Success');
        }catch (Exception $e){
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    // public function search(Request $request)
    // {
    //     try{
    //         $authors = $this->authorRepository->search($request->search);
    
    //         return ResponseHelper::created($authors, 'Success');
    //     }catch (Exception $e){
    //         return ResponseHelper::serverError([], $e->getMessage());
    //     }
    // }

    public function store(AuthorCreateRequest $request)
    {
        DB::beginTransaction();
        try{
            $author = $this->authorRepository->create($request->all());

            DB::commit();
            return ResponseHelper::created($author, 'Successfully created author.');
        }catch (Exception $e){
            DB::rollback();
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function show(Author $author)
    {
        try{
            $author = $this->authorRepository->find($author);

            return ResponseHelper::success(new AuthorDetailResource($author));
        }catch (Exception $e){
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function update(AuthorUpdateRequest $request, Author $author)
    {
        try{
            $isImage = $request->hasFile('image');
            $author = $this->authorRepository->update($author, $request->all(), $isImage);
            
            return ResponseHelper::created($author, 'Sucesfully updated author.');
        }catch (Exception $e){
            return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function destroy(Author $author)
    {
        try{
            $this->authorRepository->delete($author);
    
            return ResponseHelper::noContent([], 'Successfully deleted.');
        }catch (Exception $e){
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR());
            // return ResponseHelper::serverError([], $e->getMessage());
        }
    }
}
