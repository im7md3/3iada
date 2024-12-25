@extends('front.layouts.front')
@section('content')
<section class="main-section">
    <div class="container">
        <div class="bg-white p-3 rounded-2 shadow">
            <div class="print-emergency" id='prt-content-id'>
                <div class="holder-logo text-center d-none d-block-print">
                    <img src="{{ asset('img/logo-icon.png') }}" alt="logo" class="mb-1" width="80">
                    <p class="mb-1 fs-6">رقم الانتظار: 9#</p>
                    <p class="mb-0 fs-6">الموظف: خالد علي السيد</p>
                    <hr class="my-0">
                </div>
                <table class="table table-hover mb-0">
                    <tbody>
                        <tr>
                            <th class="text-center">بيانات المريض</th>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex align-items">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <th>اسم المريض</th>
                                <td>--</td>
                            </tr>
                            <tr>
                                <th>رقم الجوال</th>
                                <td>--</td>
                            </tr>
                            <tr>
                                <th>تاريخ الكشف</th>
                                <td>
                                    --
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <th>العمر</th>
                                <td>--</td>
                            </tr>
                            <tr>
                                <th>حالة الكشف</th>
                                <td>
                                    <span class="badge bg-warning">{{ __('pending') }}</span>
                                    <span class="badge bg-success">{{ __('Detected') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>الوقت</th>
                                <td>--</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="table table-hover mb-0">
                    <tbody>
                        <tr>
                            <th class="text-center">العلامات الحرارية</th>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex align-items">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <th>--</th>
                                <td>--</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover mb-0">
                        <tr>
                            <th>--</th>
                            <td>--</td>
                        </tr>
                    </table>
                </div>
            </div>
            <style>
                @media print {

                    .print-emergency table tr td,
                    th {
                        font-size: 14px !important;
                        padding: 4px !important;
                    }
                }
            </style>
        </div>
    </div>
</section>
<script>
    if (document.getElementById("prt-content-id")) {
        url = "{{route('front.emergencies')}}"
        function printDiv() {
            const prtContent = document.getElementById("prt-content-id");
            newWin = window.open("");
            newWin.document.head.replaceWith(document.head.cloneNode(true));
            newWin.document.body.appendChild(prtContent.cloneNode(true));
            setTimeout(() => {
                newWin.print();
                newWin.close();
                window.location = url;
            }, 600);
        }
        printDiv()
    }
</script>
@endsection
