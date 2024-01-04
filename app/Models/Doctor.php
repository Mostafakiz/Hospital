<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['name', 'appointments'];
    public $fillable = ['email', 'email_verified_at', 'password', 'phone', 'price', 'name', 'appointments', 'section_id'];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
