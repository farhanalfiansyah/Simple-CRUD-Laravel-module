<?php

namespace Modules\Account\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'address',
        'place_of_birth',
        'date_of_birth',
        'photo',
        'ktp'
    ];
}
