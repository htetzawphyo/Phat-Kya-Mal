<?php

namespace App\Http\Resources\File;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author_id' => $this->author_id,
            'name' => $this->name,
            'about' => $this->about,
            'author_name' => optional($this->author)->name ?? 'Unknown author',
            'file' => $this->file ? asset('storage/file/' . $this->file) : null,
            'image' => $this->image ? asset('storage/image/' . $this->image) : null,
            'download_count' => $this->downloadStatistic->download_count
        ];
    }
}
