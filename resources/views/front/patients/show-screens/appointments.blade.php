<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('admin.Period') }}</th>
                <th>{{ __('admin.Day') }}</th>
                <th>{{ __('admin.Hour') }}</th>
                <th>{{ __('admin.Clinic') }}</th>
                <th>{{ __('admin.dr') }}</th>
                <th>{{ __('admin.Attendance status') }}</th>
                <th>{{ __('admin.Attended/not Attend') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appoints as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ __($appointment->appointment_duration) }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->appointment_time }}</td>
                <td>{{ $appointment->clinic->name }}</td>
                <td>{{ $appointment->doctor->name }}</td>
                <td>{{ __($appointment->appointment_status) }}</td>
                <td>
                    @if (!$appointment->attended_at and $appointment->appointment_status != 'cancelled')
                    <button class="btn btn-sm btn-success" wire:click="presence({{ $appointment }})">{{
                        __('admin.Presence') }}</button>
                    <button class="btn btn-sm closeBtn-Color text-white" wire:click="notPresence({{ $appointment }})">{{
                        __('admin.Did not attend') }}</button>
                    @endif
                    <a href="{{ route('front.patient.appointment',$appointment->id) }}"
                        class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $appoints->links() }}
</div>