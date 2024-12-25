<div class="bg-white p-3 rounded-2 shadow">
    @can('read_appointments')
    <div class="btn_holder text-start">
        <a class="btn btn-primary btn-sm" href="{{ route('doctor.appointments_info') }}">
            {{ __('Appointments Data') }}
            <i class="i-item fa-solid fa-calendar-days"></i>
        </a>
    </div>
    @endcan
    @if ($screen == 'index')
    <div class="row g-2 mb-3">
        <div class="col-12 col-lg-3">
            <label for="appoint-date" class="small-label mb-2">{{ __('Date') }}</label>
            <input type="date" class="form-control" wire:model="date" id="appoint-date" />
        </div>

        <div class="col-12 col-lg-3">
            <label for="duration" class="small-label mb-2">{{ __('Period') }} </label>
            <select class="main-select w-100 duration" wire:model="period" id="duration">
                <option value="">{{ __('Choose the period') }}</option>
                <option value="<=">{{ __('Morning time') }}</option>
                @if (setting()->evening_status)
                <option value=">=">{{ __('Evening time') }}</option>
                @endif
            </select>
        </div>

        <div class="col-12 col-md-3">
            <label for="appointment_status" class="small-label mb-2">{{ __('admin.appointment_status') }}
            </label>
            <select class="main-select w-100 duration" id="appointment_status" wire:model='appointment_status'>
                <option value="">{{ __('admin.appointment_status') }}</option>
                <option value="confirmed">{{ __('admin.confirmed') }}</option>
                <option value="pending">{{ __('admin.pending') }}</option>
                <option value="transferred">{{ __('admin.transferred') }}</option>
                <option value="examined">{{ __('admin.examined') }}</option>
                <option value="cancelled">{{ __('admin.cancelled') }}</option>
            </select>
        </div>

        <div class="col-12 col-lg-3 d-flex align-items-end">
            <div class="btn-holder w-100 mt-4 mt-lg-0">
                <button wire:click="resetData" class="sec-btn-gre w-50 lw-100">{{ __('All Appointments') }}</button>
            </div>
        </div>

        <div class="col-12 col-lg-3 d-flex align-items-end">
            <button wire:click="$set('screen','create')" class="btn-main-sm ms-1 w-100">
                {{ __('admin.Book a new appointment') }}
            </button>
            <button id="btn-prt-content" class="print-btn btn btn-sm space-noWrap btn-outline-warning w-75">
                {{ __('print') }}
                <i class="fa-solid fa-print"></i>
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table main-table" id="prt-content">
            <thead>
                <th>{{ __('admin.department') }}</th>
                <th>{{ __('admin.doctor') }}</th>
                <th>{{ __('admin.patient') }}</th>
                <th>{{ __('admin.patient_file') }}</th>
                <th>{{ __('admin.appointment_status') }}</th>
                <th>{{ __('admin.appointment_time') }}</th>
                <th>{{ __('admin.appointment_date') }}</th>
                <th>{{ __('admin.review') }}</th>

                {{-- <th>{{ __('admin.notes') }}</th> --}}
                <th class="not-print">{{ __('actions') }}</th>
            </thead>
            <tbody>
                @forelse($appoints as $appointment)
                <tr class="{{ $appointment->review == 1 ? 'table-active' : '' }}">
                    <td>{{ $appointment->clinic->name ?? 'لم يحدد' }}</td>
                    <td>{{ $appointment->doctor->name ?? 'لم يحدد' }}</td>
                    <td>{{ $appointment->patient->name ?? 'لم يحدد' }}</td>
                    <td>{{ $appointment->patient->id ?? 'لم يحدد' }}</td>
                    <td>{{ __('admin.' . $appointment->appointment_status) }}</td>
                    <td>{{ $appointment->appointment_time ?? 'لم يحدد' }}</td>
                    <td>{{ $appointment->appointment_date ?? 'لم يحدد' }}</td>
                    {{-- <td>{{ $appointment->notes ?? 'لم يحدد' }}</td> --}}
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
                        <button class="btn btn-sm btn-secondary" data-bs-target="#notes{{ $appointment->id }}" data-bs-toggle="modal" wire:click='setNoteValue({{ $appointment->id }})'>
                            <i class="fa fa-lines-leaning"></i>
                        </button>
                        <div class="modal fade" id="notes{{ $appointment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" wire:ignore.self="" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{ __('Notes') }}
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{-- <div class="col-md-4 d-flex flex-column justify-content-end"> --}}
                                            <textarea wire:model.defer='note' id="" class="form-control" cols="10" rows="5"></textarea>
                                            {{-- </div> --}}
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                                        <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click="saveNote({{ $appointment->id }})">{{ __('Yes') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('presence_patients')
                        @if (!$appointment->attended_at and $appointment->appointment_status != 'cancelled')
                        <button class="btn btn-sm btn-success" wire:click="presence({{ $appointment }})">{{ __('admin.Presence') }}</button>
                        <button class="btn btn-sm closeBtn-Color text-white" wire:click="notPresence({{ $appointment }})">{{ __('admin.Did not attend') }}</button>
                        @endif
                        @endcan
                        @if ($appointment->patient)
                        <a class="btn btn-sm btn-purple" target="_blank" href="{{ route('doctor.patients.show', $appointment->patient->id) }}"><i class="fa-solid fa-eye"></i></a>
                        @endif
                        <button data-bs-toggle="modal" data-bs-target="#add_or_update" class="btn btn-sm btn-info" wire:click='edit({{ $appointment }})'>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        @if ($appointment->appointment_status == 'pending')
                        <button class="btn btn-sm btn-danger" wire:click="cancel({{ $appointment->id }})">{{ __('Cancel') }}</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">{{ __('admin.no_appointments') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @else
    @include('doctor.appointments.create_or_edit')
    @endif
</div>
