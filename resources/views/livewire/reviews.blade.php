<div class="main-section" wire:poll.30000ms>
    <div class="container-fluid">
        <x-alert></x-alert>

        <h4 class="main-heading mb-4">
            @if ($transferred)
            {{ __('admin.Transferred patients') }}
            @else
            {{-- {{ __('admin.Appointments') }} --}}
            @lang('Reviews')
            @endif
        </h4>
        @if ($transferred)
        <div class="alert alert-warning" role="alert">
            <p class="mb-0">
                {{ __('You can delete all the transformed patients end of work or adjust the scan from the control
                settings of the machine scan') }}
            </p>
        </div>
        @endif
        <div class="appoints-content bg-white p-4 rounded-2 shadow mb-5">
            <div class="d-flex align-items-center justify-content-between mb-2">


                <div class="btn-holder d-flex gap-1">
                    <a href="{{ route('front.appointments.index') }}" class="btn btn-sm trans-btn">{{ __('All Appointments') }}</a>
                    <button id="btn-prt-content" class="btn btn-sm btn-warning">
                        <i class="fa fa-print"></i>
                    </button>
                </div>

                <div>{{ __('admin.no_review_count') . ' : ' . $appoints_no_review }}</div>
                <div>{{ __('admin.review_need_count') . ' : ' . $appoints_for_review }}</div>

                @can('read_appointments')
                <div class="d-flex align-items-center justify-content-end flex-wrap gap-2">

                    @if (!$transferred)
                    @can('create_appointments')
                    <a href="{{ route('front.appointments.create') }}" class="btn-main-sm">
                        {{ __('admin.Book a new appointment') }}</a>
                    <a href="{{ route('front.guests.create') }}" class="btn-main-sm">
                        {{ __('admin.New Guest') }}</a>
                    @endcan
                    @endif
                    <a class="btn btn-primary btn-sm" href="{{ route('front.appointments_info') }}">
                        {{ __('Appointments Data') }}
                        <i class="i-item fa-solid fa-calendar-days"></i>
                    </a>
                </div>
                @endcan
            </div>
            <div class="d-flex gap-3 flex-wrap g-3 mb-4">
                @if (!$transferred)
                <div class="flex-1">
                    <div class="box-info w-100">
                        <label for="appoint-date" class="small-label">{{ __('admin.Date') }}</label>
                        <input type="date" class="form-control w-100" id="appoint-date" wire:model='date' />
                    </div>
                </div>
                @endif
                <div class="flex-1">
                    <div class="box-info">
                        <label for="linic-type" class="small-label">{{ __('admin.Clinic') }}
                        </label>
                        <select class="main-select w-100 Clinic type" id="linic-type" wire:model='department'>
                            <option value="">{{ __('admin.Choose Clinic') }}</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="box-info">
                        <label for="the-doctor" class="small-label">{{ __('admin.dr') }}</label>
                        <select class="main-select w-100 the-doctor" id="the-doctor" wire:model='dr'>
                            <option value="">{{ __('admin.Choose the doctor') }}</option>
                            @foreach ($doctors as $dr)
                            <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="box-info position-relative">
                        <label for="the-doctor" class="small-label">{{ __('admin.Search by File number or mobile number') }}</label>
                        <input wire:model="search" class="form-control">
                        <small class="text-danger text-nowrap fs-10px position-absolute" style="bottom: -18px;">{{
                            __('When you search the file number please add distance after the number') }}</small>
                    </div>
                </div>

                <div class="flex-1">
                    <div class="box-info">
                        <label class="small-label">{{ __('admin.review_type') }}</label>
                        <select class="main-select w-100" wire:model='review_type'>
                            <option value="reset" selected>{{ __('admin.choose_review_type') }}</option>
                            <option value=1>{{ __('admin.review_need') }}</option>
                            <option value=0>{{ __('admin.no_review') }}</option>
                        </select>
                    </div>
                </div>

                @if (!$transferred)
                <div class="flex-1">
                    <div class="box-info">
                        <label for="duration1" class="small-label">{{ __('admin.Period') }}
                        </label>
                        <select class="main-select w-100 duration" id="duration1" wire:model='period'>
                            <option value="">{{ __('admin.Period') }}</option>
                            <option value="morning">{{ __('admin.morning') }}</option>
                            <option value="evening">{{ __('admin.evening') }}</option>
                        </select>
                    </div>
                </div>
                @endif

                <div class="flex-1">
                    <div class="box-info">
                        <label for="duration2" class="small-label">{{ __('admin.appointment_status') }}
                        </label>
                        <select class="main-select w-100 duration" id="duration2" wire:model='appointment_status'>
                            <option value="">{{ __('admin.appointment_status') }}</option>
                            <option value="confirmed">{{ __('admin.confirmed') }}</option>
                            <option value="pending">{{ __('admin.pending') }}</option>
                            <option value="transferred">{{ __('admin.transferred') }}</option>
                            <option value="examined">{{ __('admin.examined') }}</option>
                            <option value="cancelled">{{ __('admin.cancelled') }}</option>
                            <option value="review">{{ __('admin.review') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="prt-content" class="table main-table">
                    <thead>
                        {{-- <th>{{__('admin.tax')}}</th> --}}
                        <th>{{ __('admin.medical_number') }}</th>
                        <th>{{ __('admin.patient') }}</th>
                        <th>{{ __('admin.patient_file') }}</th>
                        @can('show_phone_patients')
                        <th>{{ __('admin.mobile') }}</th>
                        @endcan
                        <th>{{ __('admin.nationality') }}</th>
                        <th>{{ __('admin.doctor') }}</th>
                        <th>{{ __('admin.clinic') }}</th>
                        <th>{{ __('admin.appointment_status') }}</th>
                        <th>{{ __('admin.appointment_time') }}</th>
                        <th>{{ __('admin.appointment_date') }}</th>
                        <th>{{ __('admin.review') }}</th>
                        <th class="not-print">{{ __('actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse($appoints as $appointment)
                        <tr class="{{ $appointment->review == 1 ? 'table-active' : '' }}">
                            {{-- <td>{{$appointment->appointment_number ?? "لم يحدد"}}</td> --}}
                            <td>{{ $appointment->patient->id ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->patient->name ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->patient->id ?? 'لم يحدد' }}</td>
                            @can('show_phone_patients')
                            <td>{{ $appointment->patient->phone ?? 'لم يحدد' }}</td>
                            @endcan
                            <td>{{ $appointment->patient->country->name ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->doctor->name ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->clinic->name ?? 'لم يحدد' }}</td>
                            <td>{{ __($appointment->appointment_status) }}</td>
                            <td>{{ $appointment->appointment_time ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->appointment_date ?? 'لم يحدد' }}</td>
                            @if ($appointment->review)
                            {{-- <td><a href="{{ $appointment->reviewParent?->id ? route('front.appointments.edit', $appointment->reviewParent?->id) : '' }}">#{{
                                    $appointment->reviewParent?->id }}</a>
                            </td> --}}
                            <td>
                                <i class="fa fa-check text-success fs-6"></i>
                            </td>
                            @else
                            <td>--</td>
                            @endif
                            <td class="not-print d-flex align-items-center gap-1">
                                {{-- <button class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="{{ __('Notes') }}"
                                data-bs-target="#notes{{ $appointment->id }}" data-bs-toggle="modal"
                                wire:click='setNoteValue({{ $appointment->id }})'>
                                <i class="fa fa-lines-leaning"></i>
                                </button> --}}

                                <button data-bs-toggle="modal" title="{{ __('Notes') }}" class="btn btn-sm btn-info text-white" data-bs-target="#notes{{ $appointment->id }}" wire:click='setNoteValue({{ $appointment->id }})'>
                                    <i class="fa fa-lines-leaning"></i>
                                </button>

                                <div class="modal fade" id="notes{{ $appointment->id }}" wire:ignore.self="" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                {{ __('Notes') }}
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <textarea wire:model.defer='note' id="" class="form-control" cols="10" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                                                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click="saveNote({{ $appointment->id }})">{{ __('Yes')
                                                    }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @can('transfer_patients')
                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('Transfer of the patient') }}" wire:click="transfer({{ $appointment->patient }})" class="btn btn-sm btn-primary py-1">
                                    <i class="fa fa-repeat"></i>
                                </button>
                                @endcan
                                <a target="_blank" href="https://wa.me/+966{{ $appointment->patient->phone }}">
                                    <img src="{{ asset('img/whatsapp.png') }}" alt="whatsapp icon" width="33">
                                </a>
                                <form id="delete-{{ $appointment->id }}-form" method="POST" action="{{ route('front.appointments.destroy', $appointment) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @can('presence_patients')
                                @if ($appointment->appointment_status == 'pending')
                                {{-- <form id="confirm-{{ $appointment->id }}-form" method="POST"
                                action="{{ route('front.appointments.update', $appointment) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="appointment_status" value="confirmed">
                                </form> --}}
                                <form id="cancel-{{ $appointment->id }}-form" method="POST" action="{{ route('front.appointments.update', $appointment) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="appointment_status" value="cancelled">
                                </form>
                                @endif
                                @if (!$appointment->attended_at and $appointment->appointment_status != 'cancelled')
                                <button class="btn btn-sm btn-success" wire:click="presence({{ $appointment }})">{{
                                    __('admin.Presence') }}</button>

                                <button class="btn btn-sm closeBtn-Color text-white" wire:click="notPresence({{ $appointment }})">{{ __('admin.Did not attend')
                                    }}</button>
                                @endif
                                @endcan

                                {{-- <button class="btn btn-sm btn-warning" id="example" onclick="print_current_page()">
                                    <i class="fa fa-print"></i>
                                </button> --}}
                                @can('update_appointments')
                                <a href="{{ route('front.appointments.edit', $appointment) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('Edit') }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-pen-to-square"></i>
                                </a>
                                @endcan
                                @can('delete_appointments')
                                <button class="btn btn-sm btn-danger" data-bs-title="{{ __('Delete') }}" data-bs-toggle="tooltip" data-bs-placement="top" form="delete-{{ $appointment->id }}-form">
                                    <i class="fa fa-trash-can"></i>
                                </button>
                                @endcan
                                @if (setting('message_active') && setting('taqnyat_status') && setting('taqnyat_key') && setting('taqnyat_sender'))
                                <button class="btn btn-dark btn-sm d-flex gap-2" wire:click='reminder({{ $appointment->id }})'>@lang('Reminder') <i class="fa fa-mobile"></i></button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">{{ __('admin.no_appointments') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $appoints->links() }}

            </div>
        </div>
        @include('front.patients.transfer')
        @push('js')
        <script>
            window.livewire.on('trans_modal', function() {
                var myModal = new bootstrap.Modal(document.getElementById("trans"), {});
                myModal.show();
            })
        </script>
        @endpush
    </div>
</div>