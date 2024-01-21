<?php 

namespace App\Repositories;

use App\Models\Author;
use App\Helper\UploadHelper;
use App\Interfaces\AuthorRepositoryInterface;
use App\Http\Resources\Author\AuthorsResource;
use App\Http\Resources\Author\AuthorDetailResource;
 
class AuthorRepository implements AuthorRepositoryInterface {
    protected $model;

    public function __construct(Author $model) {
        $this->model = $model;
    }

    public function index($request) {
        $authors = $this->model->orderBy('created_at', 'desc');

        if($request->search){
            $authors->where('name', 'like', '%'. $request->search .'%');
        }

        $authors = $authors->paginate(8);

        return AuthorsResource::collection($authors);
    }

    // public function search($query)
    // {
    //     $authors = $this->model->where('name', 'like', "%$query%")->get();

    //     return AuthorsResource::collection($authors);
    // }

    public function find($author) {
        return new AuthorDetailResource($author);
    }

    public function create(array $data) {
        if(!empty($data['image'])){
            $data['image'] = UploadHelper::uploadImage($data['image']);
        }
 
        $author = $this->model->create($data); 
        return new AuthorDetailResource($author);
    } 

    public function update($author, $data, $isImage) {
        if($isImage && $author->image){
            // ရှိပြီးသားကို ဖျက် => အသစ်ပါတာနဲ့ update
            $data['image'] = UploadHelper::updateImage($data['image'], $author->image);
        }elseif($isImage && !$author->image){
            // ဘားမှ မရှိထားဘူး , အသစ်ပါတာထည့်
            $data['image'] = UploadHelper::uploadImage($data['image']);
        }elseif(!$isImage && $author->image){
            // ရှိပြီးသားကို ဖျက်, null ထည့်
            UploadHelper::deleteImage($author->image);
            $data['image'] = null;
        }else{
            // null ထည့်
            $data['image'] = null;
        }
        
        $author->update($data);
        return new AuthorDetailResource($author);
    }

    public function delete($author) {
        UploadHelper::deleteImage($author->image);
        $author->delete();
    }
}