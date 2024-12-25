<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Patient') }}</th>
                <th>{{ __('admin.dr') }}</th>
                <th>{{ __('admin.Hour') }}</th>
                <th>{{ __('admin.Day') }}</th>
                <th>{{ __('admin.Period') }}</th>
                <th>{{ __('admin.Clinic') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orthodontics as $orthodontic)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $orthodontic->dr->name }}</td>
                <td>{{ $orthodontic->appoint->appointment_time }}</td>
                <td>{{ $orthodontic->appoint->appointment_date }}</td>
                <td>{{ __($orthodontic->appoint->appointment_duration) }}</td>
                <td>{{ $orthodontic->appoint?->clinic?->name }}</td>
                <td>
                    <button class="preview-btn btn btn-sm btn-purple mx-1" data-bs-toggle="modal" data-bs-target="#show{{ $orthodontic->id }}">
                        <i class="fa-solid fa-eye"></i>
                    </button>

                </td>
            </tr>
            @include('front.diagnoses.orthodontic',['diagnose' => $orthodontic])
            @endforeach

        </tbody>
    </table>
    {{ $orthodontics->links() }}
</div>
