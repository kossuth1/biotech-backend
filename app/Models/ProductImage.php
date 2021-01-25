<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            Storage::delete("public/products/$image->filename");
        });
    }

    public function getImageUrlAttribute()
    {
        return "/images/products/$this->filename";
    }
}
