<section class="p-3 medical-describe" id="prt-content">
    <!-- Start Print prescription -->
    {{-- <main class="section-prescription">--}}
    {{-- <div class="header-section">--}}
    {{-- <h2 class="title">--}}
    {{-- {{setting()->site_name}}--}}
    {{-- <br>--}}
    {{-- </h2>--}}
    {{-- <img src="{{ display_file(setting()->logo) }}" alt="" class="logo">--}}
    {{-- <h2 class="title">--}}
    {{-- {{setting()->site_name}}--}}
    {{-- <br>--}}
    {{-- Clinics--}}
    {{-- </h2>--}}
    {{-- </div>--}}
    {{-- <div class="content d-flex flex-column justify-content-between">--}}
    {{-- <div>--}}
    {{-- <h3 class="title-print">وصفة طبية</h3>--}}
    {{-- <img src="{{ display_file(setting()->logo) }}" alt="" class="logo">--}}
    {{-- <div class="row g-3">--}}
    {{-- <div class="col-md-4 d-flex gap-2 flex-column">--}}
    {{-- <div class="d-flex align-items-center gap-1">--}}
    {{-- <b>--}}
    {{-- اسم المريض:--}}
    {{-- </b>--}}
    {{-- {{ $patient?->name }}--}}
    {{-- </div>--}}
    {{-- <div class="d-flex align-items-center gap-1">--}}
    {{-- <b>--}}
    {{-- عمر المريض:--}}
    {{-- </b>--}}
    {{-- {{ $patient?->age }}--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <div class="col-md-4 d-flex gap-2 flex-column">--}}
    {{-- <div class="d-flex align-items-center gap-1">--}}
    {{-- <b>--}}
    {{-- جنس المريض:--}}
    {{-- </b>--}}
    {{-- {{ $patient?->gender }}--}}
    {{-- </div>--}}
    {{-- <div class="d-flex align-items-center gap-1">--}}
    {{-- <b>--}}
    {{-- الجنسية:--}}
    {{-- </b>--}}
    {{-- {{ $patient->country?->name }}--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <div class="col-md-4 d-flex gap-2 flex-column">--}}
    {{-- <div class="d-flex align-items-center gap-1">--}}
    {{-- <b>--}}
    {{-- رقم الملف:--}}
    {{-- </b>--}}
    {{-- {{ $patient->id }}--}}
    {{-- </div>--}}
    {{-- <div class="d-flex align-items-center gap-1">--}}
    {{-- <b>--}}
    {{-- التاريخ:--}}
    {{-- </b>--}}
    {{-- {{ today()->format('Y-m-d') }}--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <div class="col-md-6">--}}
    {{-- <div class="d-flex align-items-center gap-2">--}}
    {{-- <b> التشخيص:</b>--}}
    {{-- <p id="text-print" class="mb-0">{{$last_diagnose?->taken}}</p>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <div class="col-12">--}}
    {{-- <div class="table-responsive">--}}
    {{-- <table class="table main-table m-0">--}}
    {{-- <thead>--}}
    {{-- <tr>--}}
    {{-- <th>اسم العقار</th>--}}
    {{-- <th>الجرعة</th>--}}
    {{-- <th>التكرار/ المعدل</th>--}}
    {{-- <th>المدة</th>--}}
    {{-- <th></th>--}}
    {{-- </tr>--}}
    {{-- </thead>--}}
    {{-- <tbody>--}}
    {{-- @foreach ($describeItems as $key => $item)--}}
    {{-- <tr>--}}
    {{-- <td>--}}
    {{-- <input type="text" wire:model.defer='describeItems.{{ $key }}.drug_name'--}}
    {{-- id="" class="form-control">--}}
    {{-- </td>--}}
    {{-- <td>--}}
    {{-- <input type="text" wire:model.defer='describeItems.{{ $key }}.dosage' id=""--}}
    {{-- class="form-control">--}}
    {{-- </td>--}}
    {{-- <td>--}}
    {{-- <input type="text" wire:model.defer='describeItems.{{ $key }}.rate' id=""--}}
    {{-- class="form-control">--}}
    {{-- </td>--}}
    {{-- <td>--}}
    {{-- <input type="text" wire:model.defer='describeItems.{{ $key }}.duration'--}}
    {{-- id="" class="form-control">--}}
    {{-- </td>--}}
    {{-- <td class="not-print">--}}
    {{-- <div--}}
    {{-- class="btn_holder d-flex align-items-center justify-content-center gap-2">--}}
    {{-- <button wire:click='removeDescribeItem({{ $key }})'--}}
    {{-- class="btn btn-sm btn-danger text-white">--}}
    {{-- <i class="fa fa-trash"></i>--}}
    {{-- </button>--}}
    {{-- </div>--}}
    {{-- </td>--}}
    {{-- </tr>--}}
    {{-- @endforeach--}}

    {{-- </tbody>--}}
    {{-- </table>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <div class=" d-flex gap-2 flex-column align-items-end">--}}
    {{-- <div class="d-flex align-items-center gap-1">--}}
    {{-- <b>--}}
    {{-- أسم الطبيب:--}}
    {{-- </b>--}}
    {{-- {{ doctor()->name }}--}}
    {{-- </div>--}}
    {{-- <div class="d-flex flex-column gap-1">--}}
    {{-- <b>--}}
    {{-- توقيع الطبيب:--}}
    {{-- </b>--}}
    {{-- <img src="{{ doctor()->seal ? display_file(doctor()->seal) : '' }}" alt="" class="h-auto"--}}
    {{-- style="width:95px;">--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <footer class="footer-section">--}}
    {{-- <div class="items">--}}
    {{-- <span class="item">--}}
    {{-- س.ت:2031110635 - تلفون: 5300002 - 013--}}
    {{-- </span>--}}
    {{-- <span class="item">--}}
    {{-- الاحساء - المبرز--}}
    {{-- </span>--}}
    {{-- <span class="item">--}}
    {{-- الراشدية - شارع المدينة المنورة--}}
    {{-- </span>--}}
    {{-- </div>--}}
    {{-- <div class="items text-center">--}}
    {{-- <h6 class="item m-0 d-flex align-items-center gap-1">--}}
    {{-- prosmile.clinics--}}
    {{-- <i class="fab fa-instagram"></i>--}}
    {{-- </h6>--}}
    {{-- </div>--}}
    {{-- <div class="items" dir="ltr">--}}
    {{-- <span class="item">--}}
    {{-- C.R:2031110635 - Tel: 5300002 - 013--}}
    {{-- </span>--}}
    {{-- <span class="item">--}}
    {{-- Al-Ahsa - Mubarraz - Al-Rashedia--}}
    {{-- </span>--}}
    {{-- <span class="item">--}}
    {{-- Al-Madina Al-Mnuawwara--}}
    {{-- </span>--}}
    {{-- </div>--}}
    {{-- </footer>--}}
    {{-- </main>--}}
    <!-- End Print prescription -->
    <!-- Start Content prescription-->
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
            {{-- @dump($diagnosis) --}}
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> التشخيص</label>
            <textarea wire:model.defer='diagnosis.taken' id="content-text" class="form-control"></textarea>
        </div>
        {{-- <div class="col-md-6">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> الوصفة</label>
            <textarea wire:model.defer='describe' class="form-control"></textarea>
        </div> --}}
        {{-- @if(doctor()->seal)
        <div class="col-md-12">
            <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> ختم الطبيب</label>
            <img src="{{ display_file(doctor()->seal) }}" width="150px" alt="">
    </div>
    @endif --}}
    <div class="col-12">
        <div class="table-responsive">
            <table class="table main-table m-0">
                <thead>
                    <tr>
                        <th>اسم العقار</th>
                        <th>الجرعة</th>
                        <th>التكرار/ المعدل</th>
                        <th>المدة</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($describeItems as $key => $item)
                    <tr>
                        <td>
                            <input type="text" wire:model.defer='describeItems.{{ $key }}.drug_name' id="" class="form-control">
                        </td>
                        <td>
                            <input type="text" wire:model.defer='describeItems.{{ $key }}.dosage' id="" class="form-control">
                        </td>
                        <td>
                            <input type="text" wire:model.defer='describeItems.{{ $key }}.rate' id="" class="form-control">
                        </td>
                        <td>
                            <input type="text" wire:model.defer='describeItems.{{ $key }}.duration' id="" class="form-control">
                        </td>
                        <td class="not-print">
                            <div class="btn_holder d-flex align-items-center justify-content-center gap-2">
                                <button wire:click='removeDescribeItem({{ $key }})' class="btn btn-sm btn-danger text-white">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <button wire:click='addDescribeItem' class="btn-success btn mt-2 not-print">
                <i class="fas fa-plus"></i>
                اضافة
            </button>
        </div>
    </div>
    <div class="col-md-6">
        <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> أسم الطبيب</label>
        <input type="text" readonly value="{{ doctor()->name }}" id="" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color"> توقيع
            الطبيب</label>

        <img src="{{ doctor()->seal ? display_file(doctor()->seal) : '' }}" alt="" class="h-auto" style="width:95px;">
    </div>
    </div>
    <div class="form-group d-flex justify-content-center gap-2 my-3 not-print">
        <button class="btn btn-success mt-3 w-25" wire:click="saveDescribeItems">
            {{ __('Save')}}
        </button>
        <button class="btn btn-warning mt-3 w-25" wire:click="printWithSave">
            <i class="fa-solid fa-print"></i>
        </button>
    </div>
    <!-- End Content prescription-->
    <script>
        // Toggle text
        // var contentText = document.getElementById("content-text");
        // var textPrint = document.getElementById("text-print");
        // contentText.addEventListener("input", toggleText);
        //
        // function toggleText() {
        //     textPrint.textContent = this.value;
        // };

        // print
        // var btnPrtContent = document.getElementById("btn-prt-content");
        // btnPrtContent.addEventListener("click", printDiv);
        document.addEventListener('print', printDiv);

        function printDiv() {
            var prtContent = document.getElementById("prt-content");
            var printWin = window.open("");
            printWin.document.head.replaceWith(document.head.cloneNode(true));
            printWin.document.body.appendChild(prtContent.cloneNode(true));
            setTimeout(() => {
                printWin.print();
                printWin.close();
            }, 900);
        };
    </script>
</section>