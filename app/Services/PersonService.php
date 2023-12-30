<?php

namespace App\Services;

use App\Person;

class PersonService
{
    public function createUser(array $data)
    {

        return Person::create($data);
    }
}