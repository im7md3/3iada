<section class="invoice-section">
    <!-- add item button -->
    <div class="print-invoice invoice-in-print invoice-content-print">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2 ">
                <div class="d-flex justify-content-center text-white gap-1">
                    <a class="btn btn-danger not-print" href="javascript:generateHTML2PDF()" style="backgorund-color:#F00200;">
                        <i class="fa-solid fa-file-pdf"></i>
                    </a>
                    <a href="javascript:print()" class="btn btn-warning not-print">
                        <i class="fa-solid fa-print"></i>
                    </a>
                </div>
            </div>
            <div id="html2pdf">
                <h6 class="title-info mt-0 mb-0 text-center">
                    تقرير طبي
                </h6>
                <span></span>

                <div class="row g-4 mb-3 np mt-3  rounded " style='border-radius: 10px;border: 2px solid #ddd;'>
                    <div class="col-12 col-lg-5">
                        <div class="client-info">
                            <p class="title mb-2 text-end">{{ setting()->site_name }}</p>
                            <div class="d-flex un-flex flex-column flex-lg-row align-items-center justify-content-start justify-content-md-between gp">
                                <div class="">
                                    <p class="mb-0">
                                        <span class=""> {{setting()->address}} </span>
                                    </p>
                                    <p class="mb-0">
                                        <span class=""> {{setting()->phone}} </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2">
                        <div class="logo">
                            <img src="{{ display_file(setting()->logo) }}" alt="" class="logo-img" />
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 text-start">
                        <div class="client-info" dir="ltr">
                            <!-- <p class="title text-start mb-2">{{ setting()->site_name }}</p> -->
                            <div class="d-flex un-flex flex-column flex-lg-row align-items-center justify-content-start justify-content-md-between gp">
                                <div class="w-100">
                                    <p class="mb-0">
                                        <!-- <span class=""> {{setting()->site_name}} </span> -->
                                    </p>
                                    <p class="mb-0">
                                        <!-- <span class=""> {{setting()->phone}} </span> -->

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap mb-3">
                    <span class="d-flex align-items-center gap-1 flex-wrap">
                        <b>الجهة/</b>
                        {{$report->recipient}}
                    </span>
                    <span class="d-flex align-items-center gap-1 flex-wrap">
                        <b>تفاصيل التقرير/</b>
                        {{$report->details}}
                    </span>
                    <span class="d-flex align-items-center gap-1 flex-wrap" dir="ltr">
                        {{$report->created_at->format('Y-m-d')}}
                    </span>
                </div>
                <div class="mt-3 table-responsive">
                    <table class="table mb-0 table-bordered main-table">
                        <thead>
                            <tr>
                                <th class="dark-th">
                                    ID /
                                    الرقم
                                </th>
                                <th class="dark-th">
                                    Patient N /
                                    اسم المريض
                                </th>
                                <th class="dark-th">
                                    ID Number /
                                    الهوية
                                </th>
                                <th class="dark-th">
                                    Phone /
                                    الجوال
                                </th>
                                <th class="dark-th">
                                    type /
                                    الجنس
                                </th>

                                <th class="dark-th">
                                    Age /
                                    العمر
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="dark-td">{{$patient->id}}</td>
                                <td class="dark-td">{{$patient->first_name}}</td>
                                <td class="dark-td">{{$patient->civil}}</td>
                                <td class="dark-td">{{$patient->phone}}</td>
                                <td class="dark-td">{{$patient->gender}}</td>
                                <td class="dark-td">{{$patient->age}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="border p-3 rounded my-3 d-flex flex-column g-3">
                    <!-- <div class="item">
                        <h6 class="mt-3 mb-1">
                            تفاصيل التقرير:
                        </h6>
                        <p class="mb-0">
                            {{$report->details}}
                        </p>
                    </div> -->
                    <div class="item" dir="ltr">
                        <h6 class="mt-3 mb-1">
                            @lang('Report details')
                        </h6>
                        <p class="mb-0">
                            {{$report->details_en}}
                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap mb-3">
                    <span class="d-flex align-items-center gap-1 flex-wrap">
                        <b>@lang('Name specialist doctor')</b>
                        {{$report->creator->name}}
                    </span>
                    <span class="d-flex align-items-center gap-1 flex-wrap" dir="ltr">
                        <b>@lang('Specialist Name')</b>
                        {{$report->creator->name}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        function generateHTML2PDF() {
            var element = document.getElementById('html2pdf');

            html2canvas(element, {
                scale: 3
            }).then(function(canvas) {
                var imgData = canvas.toDataURL('image/jpeg');
                var pdf = new jsPDF();

                // Set the width and height of the PDF page to match the element's dimensions
                var imgWidth = pdf.internal.pageSize.getWidth();
                var imgHeight = (canvas.height * imgWidth) / canvas.width;

                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                pdf.save('invoice.pdf');
            });
        }
    </script>
    @endpush
</section>