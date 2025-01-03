<section class="table-responsive">
    @php
    $diagnoses = $patient->diagnoses()->paginate(10);
    @endphp
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
            @foreach ($diagnoses as $diagnose)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $diagnose->dr->name }}</td>
                <td>{{ $diagnose->time }}</td>
                <td>{{ $diagnose->day }}</td>
                <td>{{ __($diagnose->period) }}</td>
                <td>{{ $diagnose->department->name }}</td>
                <td>
                    <button class="preview-btn btn btn-sm btn-purple" data-bs-toggle="modal" data-bs-target="#show{{ $diagnose->id }}">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    @include('front.diagnoses.show')
                    <a href="" class="btn btn-sm btn-info text-white">
                        <!-- {{ __('admin.Edit') }} -->
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $diagnoses->links() }}
</section>
