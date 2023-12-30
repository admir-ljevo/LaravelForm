<?php

namespace App\Livewire;

use Livewire\Component;

class FormWizard extends Component
{
    public $step = 1;
    public $formData = [
        'first_name' => '',
        'last_name' => '',
        'address' => '',
        'city' => '',
        'country' => '',
        'dob_month' => '',
        'dob_day' => '',
        'dob_year' => '',
        'date_of_birth'=> '',
        'married' => '',
        'marriage_date_month' => '',
        'marriage_date_day' => '',
        'marriage_date_year' => '',
        'marriage_country' => '',
        'widowed' => '',
        'previously_married' => '',
    ];

    protected $rules = [
        'formData.first_name' => 'required',
        'formData.last_name' => 'required',
        'formData.address' => 'required',
        'formData.city' => 'required',
        'formData.country' => 'required',
        'formData.dob_month' => 'required',
        'formData.dob_day' => 'required',
        'formData.dob_year' => 'required',
        'formData.married' => 'required',
        'formData.marriage_date_month' => 'required_if:formData.married,Yes',
        'formData.marriage_date_day' => 'required_if:formData.married,Yes',
        'formData.marriage_date_year' => 'required_if:formData.married,Yes',
        'formData.marriage_country' => 'required_if:formData.married,Yes',
        'formData.widowed' => 'required_if:formData.married,No',
        'formData.previously_married' => 'required_if:formData.married,No',
    ];

    public function render()
    {
        return view('livewire.form-wizard');
    }

    public function next()
    {
        $this->validate();
        $this->step++;
    }

    public function previous()
    {
        $this->step--;
    }

    public function submitForm()
    {
        $this->validate();

        // Save the form data to the database or perform other actions as needed

        // Show the result page
        $this->step = 3;
    }
}
