<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon; 
use App\Models\Person;
class FormWizardStep1 extends Component
{
    public $step = 1;

    protected $listeners = ['updateStep' => 'updateStep'];

    public function updateStep($newStep)
    {
        $this->step = $newStep;
    }

    public $countries = ['Country1', 'Country2', 'Country3']; // Replace with your country list
    public $formData = [
        'first_name' => '',
        'last_name' => '',
        'address' => '',
        'city' => '',
        'country' => '',
        'dob_month' => '',
        'dob_day' => '',
        'dob_year' => '',
        'date_of_birth' =>'',
        'married' => 'no', // Initialize the "married" key
        'marriage_month' => '', // Initialize the "marriage_month" key
        'marriage_day' => '', // Initialize the "marriage_day" key
        'marriage_year' => '', // Initialize the "marriage_year" key
        'marriage_country' => '', // Initialize the "marriage_country" key
        'widowed' => '', // Initialize the "widowed" key
        'previous_marriage' => '',
        'date_of_marriage'=> '' // Initialize the "previous_marriage" key
        // Add other form data keys as needed
    ];
    public $months = [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ];


    public $days;
    public $years;
    public $selectedYear;
    public $day;
    public $month;

    public function mount()
    {
        $this->days = range(1, 31);
        $this->years = range(date('Y'), 1900);
        $this->formData['married'] = 'no';

        if ($this->formData['married'] === 'yes') {
            $this->formData['marriage_year'] = 2023; 
            $this->formData['marriage_day'] = 1; 
            $this->formData['marriage_month'] = '01'; 
        }

    }


    public function isMarriageBefore18()
    {
        $dob = Carbon::createFromDate(
            $this->formData['dob_year'],
            $this->getMonthNumber($this->formData['dob_month']),
            $this->formData['dob_day']
        );
    
        $marriageDate = Carbon::createFromDate(
            $this->formData['marriage_year'],
            $this->getMonthNumber($this->formData['marriage_month']),
            $this->formData['marriage_day']
        );
    
        $ageAtMarriage = $dob->diffInYears($marriageDate);
    
        return $ageAtMarriage < 18;
    }
    
    private function getMonthNumber($monthName)
    {
        $months = [
            'January' => '01',
            'February' => '02',
            'March' => '03',
            'April' => '04',
            'May' => '05',
            'June' => '06',
            'July' => '07',
            'August' => '08',
            'September' => '09',
            'October' => '10',
            'November' => '11',
            'December' => '12',
        ];
    
        return $months[$monthName] ?? null;
    }

    public function updateMarried($value)
    {
        $this->formData['married'] = $value;
        
    }
    public function render()
    {    \Log::info('Mount - Married: ' . $this->formData['married']);

        return view('livewire.form-wizard-step1');
    }
    public function next(){
    $this->validate(); 
    $this->step++;
}

public function isSubmitButtonDisabled()
{
    if ($this->formData['married'] === 'yes') {
        return (
            $this->formData['marriage_month'] === '' ||
            $this->formData['marriage_year'] === '' ||
            $this->formData['marriage_day'] === '' ||
            $this->formData['marriage_country'] === '' ||
            $this->isMarriageBefore18()
        );
    } elseif ($this->formData['married'] === 'no') {
        return (
            $this->formData['widowed'] === null ||
            !in_array($this->formData['widowed'], ['yes', 'no']) ||
            $this->formData['previous_marriage'] === null ||
            !in_array($this->formData['previous_marriage'], ['yes', 'no'])
        );
    }

    return false;
}


public function previous()
{
    $this->step--;
}
public function submit(){
    \DB::beginTransaction();

    try {
        $this->formData['date_of_birth'] = $this->getDateOfBirthProperty();
        $this->formData['date_of_marriage']  = $this->getDateOfMarriageProperty();       
        $person = Person::create($this->formData);

        \DB::commit();
    } catch (\Exception $e) {
        \DB::rollBack();
        throw $e;
    }

    $this->step=3;
}
public $rules = [
    'formData.first_name' => 'required',
    'formData.last_name' => 'required',
    'formData.address' => 'required',
    'formData.city' => 'required',
    'formData.country' => 'required',
    'formData.dob_month' => 'required',
    'formData.dob_day' => 'required',
    'formData.dob_year' => 'required',
];

public function getDateOfBirthProperty()
{
    $dobYear = $this->formData['dob_year'];
    $dobMonth = $this->formData['dob_month'];
    $dobDay = $this->formData['dob_day'];

    if ($dobYear && $dobMonth && $dobDay) {
        $formattedDateOfBirth = "{$dobYear}-{$dobMonth}-{$dobDay}";

        return date('Y-m-d', strtotime($formattedDateOfBirth));
    }

    return null;
}

public function getDateOfMarriageProperty(){
    $marriageYear = $this->formData['marriage_year'];
    $marriageMonth = $this->formData['marriage_month'];
    $marriageDay = $this->formData['marriage_day'];

    if($marriageDay && $marriageMonth && $marriageYear){
        $formattedDateOfMarriage = "{$marriageYear}-{$marriageMonth}-{$marriageDay}";
        return date('Y-m-d', strtotime($formattedDateOfMarriage));
    }
    return null;
}

}
