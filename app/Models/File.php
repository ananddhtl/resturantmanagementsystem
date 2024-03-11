<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['file_title', 'file_name'];

    public function getUrlAttribute()
    {
        if ($this->file_name) {
            return asset('uploads/' . $this->file_name);
        }
        return null;
    }

    public function users()
    {
        return $this->hasMany(User::class, 'image_id');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'image_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'image_id');
    }
}
