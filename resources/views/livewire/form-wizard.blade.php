<div>
    @if($step === 1)
        @livewire('form-wizard-step1')
    @else
        @livewire('form-wizard-result')
    @endif
</div>
