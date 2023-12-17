<?php 

namespace App\Interfaces;

interface FileRepositoryInterface
{
    public function index($request);

    // public function scrollBook($request);
    
    public function upload(array $data);

    public function find($file);

    public function update($file, $data, $isImg);

    public function download($file);

    public function delete($file);
}