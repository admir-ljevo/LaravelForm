<?php

namespace App\Livewire;

use Livewire\Component;

class FormWizardResult extends Component
{
    public $formData;
    public $step =3;
    public function mount($formData)
    {
        $this->formData = $formData;
    }

    public function render()
    {
        return view('livewire.form-wizard-result');
    }
   
    public function previous()
    {
    }
   
}
