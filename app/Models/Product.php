<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            foreach ($product->images as $image) {
                $image->delete();
            }

            $product->tags()->delete();
        });
    }


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
        return date('Y-m-d H:i', strtotime($value));
    }

    public function getPublicToAttribute($value)
    {
        return date('Y-m-d H:i', strtotime($value));
    }
}
