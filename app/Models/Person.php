<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'address', 'city', 'country',
        'date_of_birth', 'married', 'date_of_marriage', 'marriage_country',
        'widowed', 'previous_marriage',
    ];

    protected $dates = ['date_of_birth', 'date_of_marriage'];
}
