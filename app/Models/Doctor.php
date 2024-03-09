<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Doctor extends Model
{
    use HasFactory;

    protected  $guarded = ['id'];

//    protected  function photo(): Attribute
//    {
//        return  Attribute::make(
//            get: fn($photo) => $photo && !Str::contains($photo, 'storage') ? asset('/storage/doctors/'.$photo) : null
//        );
//    }
}
