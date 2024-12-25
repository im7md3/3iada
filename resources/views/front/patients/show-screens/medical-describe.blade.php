@if ($discribeScreen == 'index')
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
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicalAppoints as $appointment)
            @if ($appointment->describes->count() > 0)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ __($appointment->appointment_duration) }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->appointment_time }}</td>
                <td>{{ $appointment->clinic->name }}</td>
                <td>{{ $appointment->doctor->name }}</td>
                <td>
                    <button class="preview-btn btn btn-sm btn-purple mx-1" wire:click='showDescribe({{ $appointment->id }})'>
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" wire:click='deleteDescribes({{ $appointment->id }})'><i class="fa fa-trash"></i></button>
                </td>

            </tr>
            @endif
            @endforeach

        </tbody>
    </table>
    {{-- {{ $appoints->links() }} --}}
</div>
@else
<button class="btn btn-danger" type="button" wire:click='$set("discribeScreen","index")'><i class="fa fa-arrow-right"></i></button>
@if ($appointment->describes()->count() > 0)
<section class="p-3 medical-describe" id="prt-content">
<div class="row g-3">
        <div class="col-12 d-none print-block">
            <div class="box-invoice">
                <div class="row align-items-center">
                    <div class="col-md-4 p-3">
                        <p>
                            <b> اسم العيادة: </b> {{ setting()->site_name }}
                        </p>
                        <p>
                            <b> العنوان: </b>{{ setting()->address }}
                        </p>
                        <p><b> جوال: </b>{{ setting()->phone }}</p>
                    </div>
                    <div class="text-center col-md-4 p-3 d-flex align-items-center justify-content-center">
                        <img width="110" src="http://crgo.const-tech.biz/uploads/settings/1694331704logo.png" alt="">
                    </div>
                    <div class="col-md-4 p-3">
                        <h6><b>بيانات المريض:-</b></h6>
                        <p><b>الرقم الطبي: {{ $patient?->id }}</b></p>
                        <p><b>الاسم : </b>{{ $patient?->name }} </p>
                        <p>
                            <b>رقم الجوال: {{ $patient?->phone }}</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">اسم المريض</label>
            <input type="text" readonly value="{{ $patient?->name }}" id="" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> عمر المريض</label>
            <input type="text" readonly value="{{ $patient?->age }}" id="" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> جنس المريض</label>
            <input type="text" readonly value="{{ __($patient->gender) }}" id="" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> الجنسية</label>
            <input type="text" readonly value="{{ $patient->country?->name }}" id="" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> رقم الملف</label>
            <input type="number" readonly value="{{ $patient->id }}" id="" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> التاريخ</label>
            <input type="date" readonly value="{{ today()->format('Y-m-d') }}" id="" class="form-control">
        </div>
        <div class="col-md-12">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> التشخيص</label>
            <textarea id="content-text" disabled class="form-control">{{ $appointment->diagnos?->taken }}</textarea>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table main-table m-0">
                    <thead>
                        <tr>
                            <th>اسم العقار</th>
                            <th>الجرعة</th>
                            <th>التكرار/ المعدل</th>
                            <th>المدة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointment->describes as $item)
                        <tr>
                            <td>
                                <input type="text" readonly value="{{ $item->drug_name }}" id="" class="form-control">
                            </td>
                            <td>
                                <input type="text" readonly value="{{ $item->dosage }}" id="" class="form-control">
                            </td>
                            <td>
                                <input type="text" readonly value="{{ $item->rate }}" id="" class="form-control">
                            </td>
                            <td>
                                <input type="text" readonly value="{{ $item->duration }}" id="" class="form-control">
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> أسم الطبيب</label>
            <input type="text" disabled value="{{ $appointment->doctor?->name }}" id="" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> توقيع
                الطبيب</label>
            <img src="{{ $appointment->doctor ? display_file($appointment->doctor->seal) : '' }}" alt="" class="h-auto" style="width:95px;">
        </div>
    </div>
    <div class="form-group d-flex justify-content-center gap-2 my-3 not-print">
        <button class="btn btn-sm px-4 btn-warning mt-3" id="btn-prt-content">
            طباعة
            <i class="fa-solid fa-print"></i>
        </button>
    </div>
    <script>
        // print
        var btnPrtContent = document.getElementById("btn-prt-content");
        btnPrtContent.addEventListener("click", printDiv);

        function printDiv() {
            var prtContent = document.getElementById("prt-content");
            var printWin = window.open("");
            printWin.document.head.replaceWith(document.head.cloneNode(true));
            printWin.document.body.appendChild(prtContent.cloneNode(true));
            setTimeout(() => {
                printWin.print();
                printWin.close();
            }, 600);
        }

    </script>
</section>
@else
<div class="alert alert-info mb-3 mt-3">
    {{ __('No Medical Describe on this appointment') }}
</div>
@endif
@endif
