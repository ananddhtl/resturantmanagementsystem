<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function reservation()
    {
        return $this->hasOne(TableReservation::class)->where('is_complete', 0);
    }
}
