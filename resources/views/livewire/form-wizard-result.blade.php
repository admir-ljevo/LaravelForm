
<div class="result-container">
    <h1>Form Submission Result</h1>

    <div class="result-details-container">
        <h2>Personal Information</h2>

        <div class="result-details">
            <div class="personal-info">
                <p><strong>First Name:</strong> {{ $formData['first_name'] }}</p>
                <p><strong>Last Name:</strong> {{ $formData['last_name'] }}</p>
                <p><strong>Address:</strong> {{ $formData['address'] }}</p>
                <p><strong>City:</strong> {{ $formData['city'] }}</p>
                <p><strong>Country:</strong> {{ $formData['country'] }}</p>
                <p><strong>Date of Birth:</strong> {{ $formData['dob_month'] }}/{{ $formData['dob_day'] }}/{{ $formData['dob_year'] }}</p>
            </div>

            <h2>Marital Information</h2>

            <div class=".marital-info">
                <p><strong>Married:</strong> {{ $formData['married'] }}</p>
                <p><strong>Widowed:</strong> {{ $formData['widowed'] }}</p>
                <p><strong>Married in the past:</strong> {{ $formData['previous_marriage'] }}</p>
                <p><strong>Country of marriage:</strong> {{ $formData['marriage_country'] }}</p>
                <p><strong>Date of marriage:</strong> {{ $formData['marriage_month'] }}/{{ $formData['marriage_day'] }}/{{ $formData['marriage_year'] }}</p>
            </div>
        </div>
       
        @livewireScripts
    </div>
</div>
