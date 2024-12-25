<ul class="nav nav-pills main-nav-tap mb-4" style="flex-wrap: wrap !important;">
    <li class="nav-item" wire:click="$set('screen_file','medical_files')">
        <a href="#" class="nav-link {{ $screen_file == 'medical_files' ? 'active' : '' }}">
            {{ __('medical files') }} ({{ $patient->medical_files->count() }})
        </a>
    </li>
    <li class="nav-item" wire:click="$set('screen_file','sick_leave')">
        <a href="#" class="nav-link {{ $screen_file == 'sick_leave' ? 'active' : '' }}">
            {{ __('Sick holidays') }} ({{ $patient->sick_leave_files->count() }})
        </a>
    </li>
    <li class="nav-item" wire:click="$set('screen_file','prescription')">
        <a href="#" class="nav-link {{ $screen_file == 'prescription' ? 'active' : '' }}">
            {{ __('Prescription') }} ({{ $patient->prescription_files->count() }})
        </a>
    </li>
</ul>

<div class=" main-tab-content">
    @include('front.patients.show-screens.patient_files.' . $screen_file)
</div>

