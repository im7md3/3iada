<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Medical number') }}</th>
                <th>{{ __('admin.name') }}</th>
                <th>{{ __('admin.Civil number') }}</th>
                <th>{{ __('Created Date') }}</th>
                <th>{{ __('admin.Country') }}</th>
                <th>{{ __('group') }}</th>
                <th>{{ __('admin.Gender') }}</th>
                <th>{{ __('Date of birth AD') }}</th>
                {{-- <th>{{ __('admin.Hijri date of birth') }}</th> --}}
                <th>{{ __('admin.Age') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $patient->id }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->civil }}</td>
                <td>{{ $patient->created_at->format('Y-m-d') }}</td>
                <td>{{ $patient->country->name ?? null }}</td>

                <td>{{ $patient->group->name ?? null }}</td>
                <td>{{ __($patient->gender) }}</td>
                <td>{{ $patient->birthdate }}</td>
                {{-- <td>{{ $patient->birthdate? Carbon::parse($patient->birthdate)->toHijri()->isoFormat('DD-MMMM-YYYY'): '' }}
                </td> --}}
                <td>{{ $patient->age }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.phone') }}</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $patient->phone }}</td>
            </tr>
        </tbody>
    </table>
</div>