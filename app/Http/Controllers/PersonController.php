<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PersonService;

class PersonController extends Controller
{
    protected $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function create()
    {
        return view('form-wizard-step1'); 
    }

    public function store(CreateUserRequest $request)
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }
}
