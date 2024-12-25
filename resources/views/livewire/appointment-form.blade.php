<div>
    {{-- allert if session success --}}
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <x-alert></x-alert>
    @include('front.unpaidInvoicePop')
    <div class="alert alert-info">
        المواعيد التي تظهر هي المواعيد المتاحة فقط
    </div>
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="bg-white p-3 rounded-2 shadow">
                <div class="row g-3">
                    <div class="col-md-4 ">
                        <label for="" class="small-label mb-2">{{ __('Search by medical number or patient number') }}</label>
                        <input type="text" wire:model="patient_key" wire:keyup.debounce.300ms='get_patient' class="form-control">
                    </div>
                    <div class="col-md-4 ">
                        <label for="patient_id" class="small-label mb-2">{{ __('Patient name') }}</label>
                        <input type="text" value="{{ $patient ? $patient->name : '' }}" readonly id="" class="form-control w-100" />
                    </div>

                    <div class="col-md-4 ">
                        <label for="" class="small-label">{{ __('admin.phone') }}</label>
                        <input type="tel" value="{{ $patient ? $patient->phone : '' }}" name="phone" readonly id="" class="form-control w-100" />
                    </div>
                    <div class="col-md-4">
                        <label for="clinic_id" class="small-label mb-2">{{ __('admin.clinic') }}</label>
                        <select wire:model="clinic_id" id="clinic_id" class="main-select w-100">
                            <option>{{ __('Choose a clinic') }}</option>
                            @foreach (\App\Models\Department::where('appointmentstatus', 1)->get() as $clinic)
                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-4">
                        <label for="doctor_id" class="small-label mb-2">{{ __('admin.doctor') }}</label>
                        <select wire:model="doctor_id" id="doctor_id" class="main-select w-100">
                            <option>{{ __('Choose a doctor') }}</option>
                            @if ($clinic_id)
                            @foreach (\App\Models\User::doctors()->whereHas('departments',function($q) use ( $clinic_id){
                            $q->where('departments.id',$clinic_id);
                            })->get() as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>

                    <div class="col-md-4 ">
                        <label for="appointment_status">{{ __('admin.appointment_status') }}</label>
                        <select wire:model="appointment_status" id="appointment_status" class="form-control">
                            <option value="">{{ __('Choose') }}</option>
                            <option value="pending">
                                {{ __('admin.pending') }}</option>
                            <option value="confirmed">
                                {{ __('admin.confirmed') }}</option>
                            <option value="cancelled">
                                {{ __('admin.cancelled') }}</option>
                            <option value="transferred">
                                {{ __('admin.transferred') }}</option>
                            <option value="examined">
                                {{ __('admin.examined') }}</option>
                        </select>
                        @error('appointment_status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-4 ">
                        <label for="appointment_time" class="small-label mb-2">{{ __('Period') }}</label>
                        <select wire:model="appointment_duration" id="" class="form-control">
                            <option value="">{{ __('admin.Period') }}</option>
                            <option value="morning">{{ __('admin.morning') }}</option>
                            @if (setting()->evening_status == 1)
                            <option value="evening">{{ __('admin.evening') }}</option>
                            @endif
                        </select>

                    </div>

                    <div class="col-md-4 d-flex flex-column justify-content-end">
                        <label for="appointment_date" class="small-label mb-2">{{ __('admin.appointment_date') }}</label>
                        <input type="date" wire:model="appointment_date" id="appointment_date" class="form-control">

                    </div>
                    {{--<div class="col-md-4 ">
                        <label for="appointment_time" class="small-label mb-2">{{ __('admin.appointment_time') }}</label>
                    <select wire:model="appointment_time" id="" class="form-control">
                        <option value="">{{ __('admin.appointment_time') }}</option>
                        @foreach ($times as $time)
                        @if (!in_array($time, $reservedTimes))
                        <option value="{{ $time }}">{{ date('G:iA', strtotime($time)) }}</option>
                        @endif
                        @endforeach
                        <!-- <input type="time" wire:model="appointment_time" id="appointment_time" class="form-control"> -->
                    </select>
                </div> --}}
                <div class="col-md-4 d-flex flex-column justify-content-center">
                    <label for="appointment_date" class="small-label mb-2">
                        {{ __('Is the appointment reviewed?') }}
                        <input type="checkbox" wire:model.defer="review" id="review" class="">
                    </label>

                </div>

                <div class="col-4 d-flex justify-content-center col-md-12">
                    <button type="submit" wire:click="save" class="btn btn-sm btn-success w-50">{{ __('admin.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="bg-white p-3 rounded-2 shadow">

            <h3 class="small-heading">
                {{ __('admin.appointment_time') }}
            </h3>
            <div class="btns-check">
                {{-- @dump($reservedTimes)  --}}
                @if($appointment_duration && $appointment_date)
                @foreach ($times as $time)
                @if (!$loop->last)
                @if (!isReserved($time, $reservedTimes))
                <input type="radio" wire:model="appointment_time" name="appointment_time" value="{{ $time }}" id="appointment_time_{{$time}}">
                <label for="appointment_time_{{$time}}" class="btn-item">
                    {{ setting()->h12_sys ? date('g:iA', strtotime($time)) : date('G:iA', strtotime($time)) }}
                </label>
                @endif
                @endif

                @endforeach
                @else
                <div class="alert alert-info w-100 text-center">
                    يجب تحديد تاريخ اليوم و الفترة
                </div>
                @endif
            </div>
        </div>
        @if(setting()->end_time_status)
        <div class="bg-white p-3 rounded-2 shadow mt-3">
            <h3 class="small-heading">
                {{ __('admin.appointment_time_end') }}
            </h3>
            <div class="btns-check">
                @if($appointment_time)
                @foreach ($times as $time)
                @if(isAfterStartTime($time,$appointment_time))
                @if (!isEndReserved($time, $reservedTimes))
                <input type="radio" wire:model.defer="appointment_time_end" name="appointment_time_end" value="{{ $time }}" id="appointment_time_end{{$time}}">
                <label for="appointment_time_end{{$time}}" class="btn-item">
                    {{ setting()->h12_sys ? date('g:iA', strtotime($time)) : date('G:iA', strtotime($time)) }}
                </label>
                @endif
                @endif
                @endforeach
                @else
                <div class="alert alert-info w-100 text-center">
                    يجب تحديد وقت بداية الموعد
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>
{{-- Because she competes with no one, no one can compete with her. --}}


@push('js')
<script>
    window.livewire.on('unpaid', () => {
        var myModal = new bootstrap.Modal(document.getElementById("unpaid_invoice"), {});
        myModal.show();
    });

</script>
@endpush

@push('js')
<script>
    window.livewire.on('partiallyPaid', () => {
        var myModal = new bootstrap.Modal(document.getElementById("partiallyPaid_invoice"), {});
        myModal.show();
    });

</script>
@endpush

</div>
