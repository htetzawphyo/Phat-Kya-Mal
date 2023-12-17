<?php

namespace App\Models;

use App\Models\Author;
use App\Models\DownloadStatistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'name',
        'about',
        'file',
        'image'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function downloadStatistic()
    {
        return $this->hasOne(DownloadStatistic::class, 'book_id', 'id')->withDefault([
            'download_count' => 0,
        ]);
    }
}
