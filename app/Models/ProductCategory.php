<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_id'];

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
