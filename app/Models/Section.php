<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory, Translatable;
    protected $fillable = ['name', 'description'];
    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name', 'description'];
}
