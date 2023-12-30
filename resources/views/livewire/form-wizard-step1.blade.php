<div>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <p>Current step: {{ $step }}</p>

    @if($step === 1)
        <h1>Page 1</h1>

        <form wire:submit.prevent="next">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input wire:model="formData.first_name" type="text" id="first_name">
                @error('formData.first_name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input wire:model="formData.last_name" type="text" id="last_name">
                @error('formData.last_name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input wire:model="formData.address" type="text" id="address">
                @error('formData.address') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input wire:model="formData.city" type="text" id="city">
                @error('formData.city') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <select wire:model="formData.country" id="country">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
                @error('formData.country') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Date of Birth</label>
                <div class="dob-fields">
                    <select wire:model="formData.dob_month">
                        <option value="">Month</option>
                        @foreach ($months as $key => $month)
                            <option value="{{ $key }}">{{ $month }}</option>
                        @endforeach
                    </select>

                    <select wire:model="formData.dob_day">
                        <option value="">Day</option>
                        @foreach ($days as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>

                    <select wire:model="formData.dob_year">
                        <option value="">Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                @error('formData.dob_month') <span class="error">{{ $message }}</span> @enderror
                @error('formData.dob_day') <span class="error">{{ $message }}</span> @enderror
                @error('formData.dob_year') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit">Next</button>
        </form>
        @elseif($step === 2)
        <h1>Page 2</h1>

<form wire:submit.prevent="submit">
    <div class="form-group">
        <label>Are you married?</label>
        <div>
            <label>
                <input 
                    type="radio" 
                    name="married" 
                    value="yes" 
                    wire:click="updateMarried('yes')"
                    @if($formData['married'] === 'yes') checked @endif

                > Yes
            </label>
            <label>
                <input 
                    type="radio" 
                    name="married" 
                    value="no" 
                    wire:click="updateMarried('no')"
                    @if($formData['married'] === 'no') checked @endif

                > No
            </label>
        </div>
        @error('formData.married') <span class="error">{{ $message }}</span> @enderror
    </div>

    @if($formData['married'] === 'yes')
        <div class="form-group">
            <label>Date of Marriage</label>
            <div class="dob-fields">
                <select wire:model="formData.marriage_month" wire:change="updateMarried('yes')">
                    <option value="">Month</option>
                    @foreach ($months as $key => $month)
                        <option value="{{ $key }}">{{ $month }}</option>
                    @endforeach
                </select>

                <select wire:model="formData.marriage_day" wire:change="updateMarried('yes')">
                    <option value="">Day</option>
                    @foreach ($days as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach
                </select>
                <select wire:model="formData.marriage_year" name="marriage_year" wire:change="updateMarried('yes')">
    <option value="">Year</option>
    @foreach ($years as $year)
        <option value="{{ $year }}">{{ $year }}</option>
    @endforeach
</select>



            </div>
            @error('formData.marriage_month') <span class="error">{{ $message }}</span> @enderror
            @error('formData.marriage_day') <span class="error">{{ $message }}</span> @enderror
            @error('formData.marriage_year') <span class="error">{{ $message }}</span> @enderror
          
        </div>
      
        <div class="form-group">
            <label>Country of Marriage</label>
            <select wire:model="formData.marriage_country"  wire:change="updateMarried('yes')">
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
            @error('formData.marriage_country') <span class="error">{{ $message }}</span> @enderror
        </div>

        @if($this->isMarriageBefore18())
            <div class="error">You are not eligible to apply because your marriage occurred before your 18th birthday.</div>
        @endif
    @else
        <div class="form-group">
            <label>Are you widowed?</label>
            <div>
                <label>
                    <input wire:model="formData.widowed" type="radio" value="yes" wire:change="updateMarried('no')" > Yes
                </label>
                <label>
                    <input wire:model="formData.widowed" type="radio" value="no" wire:change="updateMarried('no')" > No
                </label>
            </div>
            @error('formData.widowed') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Have you ever been married in the past?</label>
            <div>
                <label>
                    <input wire:model="formData.previous_marriage" type="radio" value="yes" wire:change="updateMarried('no')" > Yes
                </label>
                <label>
                    <input wire:model="formData.previous_marriage" type="radio" value="no"wire:change="updateMarried('no')" > No
                </label>
            </div>
            @error('formData.previous_marriage') <span class="error">{{ $message }}</span> @enderror
        </div>
    @endif
    @if($this->isSubmitButtonDisabled())
    <div class="error">*All fields are required.</div>
 @endif
    <button wire:click="previous" type="button">Previous</button>
    <button type="submit" @if($this->isSubmitButtonDisabled()) disabled @endif>Submit</button>


</form>
    @endif

    @if($step === 3)
    @livewire('form-wizard-result', ['formData' => $formData])
@endif


</div>
