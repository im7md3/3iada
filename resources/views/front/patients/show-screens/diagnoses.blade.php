<ul class="nav nav-pills main-nav-tap mb-3 not-print" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-one-tab" data-bs-toggle="pill" data-bs-target="#pills-one"
                type="button"
                role="tab" aria-controls="pills-one" aria-selected="true">{{ __('Dental diagnosis') }}</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-two-tab" data-bs-toggle="pill" data-bs-target="#pills-two" type="button"
                role="tab" aria-controls="pills-two" aria-selected="true">
            {{ __('Diagnosis of patient orthodontic') }}
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-three-tab" data-bs-toggle="pill" data-bs-target="#pills-three" type="button"
                role="tab" aria-controls="pills-three" aria-selected="false">{{ __('Vision examination') }}</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active py-2" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab"
         tabindex="0">
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
                @foreach ($diagnoses as $diagnose)
                    <tr>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $diagnose->dr->name }}</td>
                        <td>{{ $diagnose->time }}</td>
                        <td>{{ $diagnose->day }}</td>
                        <td>{{ __($diagnose->period) }}</td>
                        <td>{{ $diagnose->department->name }}</td>
                        <td>
                            @can('recipe_diagnoses')
                                <a href="{{ route('front.diagnoses.show_prescription', $diagnose->id) }}"
                                   class="btn btn-sm btn-primary"><i class="fa-solid fa-file-waveform"></i></a>
                            @endcan

                            <button class="preview-btn btn btn-sm btn-purple mx-1" data-bs-toggle="modal"
                                    data-bs-target="#show{{ $diagnose->id }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                        </td>
                    </tr>
                    @include('front.diagnoses.show')
                @endforeach

                </tbody>
            </table>
            {{ $diagnoses->links() }}
        </div>
    </div>
    <div class="tab-pane fade py-2" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab" tabindex="0">
        @include('front.patients.show-screens.orthodontics')
    </div>
    <div class="tab-pane fade py-2" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab" tabindex="0">
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                <tr>
                    <th>{{ __('the Doctor') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($visions as $vision)
                <tr>
                        <td>{{$vision->dr->name}}</td>
                        <td>{{$vision->created_at?->format('Y-m-d')}}</td>
                        <td>
                            <a href="{{ route('front.vision-examination',$vision->id) }}" target="_blank"
                               class="btn btn-sm btn-purple">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                        <td>

                            <button  data-bs-toggle="modal" data-bs-target="#exampleModal{{$vision->id}}" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
{{--Modal --}}
                    <div class="modal fade" id="exampleModal{{$vision->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{__("admin.Are you sure you want to delete this ?")}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__("admin.cancel")}}</button>
                                    <button type="button" class="btn btn-primary" wire:click="delete_vision({{$vision->id}})">{{__('admin.Delete')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal --}}

                        @empty
                            <td colspan="4">No data here</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    window.addEventListener('deleteVision', () => {

        $('#pills-three-tab').click();
    })
</script>

