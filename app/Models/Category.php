<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];

    protected $table='category';
    public function peticione()
    {
        return $this->hasMany('App\Models\Peticione')->withTimestamps();
    }
}
