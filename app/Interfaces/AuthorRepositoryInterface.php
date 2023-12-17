<?php

namespace App\Interfaces;

interface AuthorRepositoryInterface
{
    public function index($request);

    // public function search($query);

    public function find($author);

    public function create(array $data);

    public function update($author, array $data, $isImage);
    
    public function delete($author);
}