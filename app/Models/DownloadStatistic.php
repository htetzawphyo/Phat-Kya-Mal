<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DownloadStatistic extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'download_count'];

    public function file()
    {
        return $this->belongsTo(File::class, 'book_id', 'id'); 
    }
}
