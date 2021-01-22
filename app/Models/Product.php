<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use App\Models\ProductImage;
use App\Models\ProductTag;

class Product extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['public_from', 'public_to', 'price'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function getPublicFromAttribute($value)
    {
        return date('Y-m-d\TH:i', strtotime($value));
    }

    public function getPublicToAttribute($value)
    {
        return date('Y-m-d\TH:i', strtotime($value));
    }
}
