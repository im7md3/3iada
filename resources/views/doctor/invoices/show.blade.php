@extends('doctor.layouts.index')
@push('css')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    section {
        text-align: center;
        padding: 0 50px;
    }

    .main-head {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        margin-top: 30px;
        gap: 20px;
    }

    .main-head h1 {
        font-size: 27px;
        font-weight: normal;
    }

    .main-head h1.ar {
        font-size: 39px;
    }

    .main-head h1 span {
        font-weight: bold;
    }

    .main-head img {
        width: 64px;
    }

    table {
        margin: auto;
        width: 100%;
    }

    table tr td {
        padding: 5px 5px;
        position: relative;
    }

    table tr td .rig {
        float: right;
    }

    table tr td .lef {
        float: left;
        margin-right: 5px;
    }


    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    table tr td.hidd-1 {
        border-left-color: transparent;
    }

    table tr td.hidd-2 {
        border-left-color: transparent;
    }

    .text {
        display: flex;
        justify-content: space-evenly;
        margin-top: 10px;
    }

    .print {
        text-decoration: none;
        color: white;
        background-color: #2fc2df;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        margin: 20px auto 0;
        display: block;
        width: fit-content;
    }

    @media print {
        table {
            width: 100%;
        }

        table tr td div {
            display: flex;
            float: unset;
            justify-content: space-between;
        }

        section {
            padding: 0;
        }

        body {
            font-size: 6px;
        }

        table tr td .pir-r {
            margin-left: 25px;
        }

        table tr td .pir-l {
            margin-right: 25px;
        }

        .print {
            display: none;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    }

</style>
@endpush
@section('title')
{{ __('admin.Show invoice') }}
@endsection
@section('content')
<div class="res-table">
    <section>
        <div dir="ltr" class="main-head">
            <img width="300" src="{{ display_file(setting()->logo) }}">
            <div class="head">
                <h1 class="ar">{{ setting()->site_name }}</h1>
                {{-- <h1><span>test</span></h1> --}}
            </div>
        </div>
        <table>
            <tr>
                <td colspan="6">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>أسم المريض</strong>:-</span>
                        {{$invoice->patient->name}}
                        <span dir="ltr" class="lef"><strong>patient Name</strong>:-</span>
                    </div>
                </td>
                <td colspan="3">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>{{__("admin.File number")}}</strong></span>
                        <span class="cen">{{$invoice->patient->id}}</span>
                        <span dir="ltr" class="lef"><strong>File.No</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>أسم الطبيب</strong></span>
                        <span>{{$invoice->dr?->name}}</span>
                        <span dir="ltr" class="lef"><strong>Dr.Name</strong></span>
                    </div>
                </td>
                <td colspan="4">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>{{ __('Clinic')}}</strong></span>
                        <span>{{$invoice->department->name}}</span>
                        <span dir="ltr" class="lef"><strong>Clinic</strong></span>
                    </div>
                </td>
                <td colspan="3">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>رقم الفاتورة</strong></span>
                        <span class="cen">{{$invoice->id}}</span>
                        <span dir="ltr" class="lef"><strong>Invoice. No.</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>شركة التأمين</strong></span>
                        <span class="cen">{{$invoice->patient->insurance?->name}}</span>
                        <span dir="ltr" class="lef"><strong>Co.Name</strong></span>
                    </div>
                </td>
                <td colspan="4">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>الرقم الضريبي</strong></span>
                        <span class="cen">{{ setting()->tax_no }}</span>
                        <span class="lef" dir="ltr"><strong>Tax No.</strong></span>
                    </div>
                </td>
            </tr>

            <tr>
                <th class="text-center" colspan="3">أسم الخدمة<br />Service Name</th>
                <th class="text-center">السعر<br />price</th>
                <th class="text-center">العدد<br />Count</th>
                <th class="text-center">الإجمالي<br />Total</th>
                <th class="text-center">الخصم<br />Discount</th>
                <th class="text-center">تحمل التأمين<br />Insurance</th>
                <th class="text-center" colspan="1">%الضريبة<br />%VAT</th>
            </tr>
            @foreach ($invoice->products as $item)

            <tr>
                <td class="p-1 text-center" colspan="3" dir="ltr">
                    {{ $item->product_name}}
                </td>
                <td class="p-1 text-center">1</td>
                <td class="p-1 text-center">{{ $item->price}}</td>
                <td class="p-1 text-center">{{ $item->sub_total }}</td>
                <td class="p-1 text-center">{{ $item->discount }}</td>
                <td class="p-1 text-center">0.00</td>
                <td class="p-1 text-center" colspan="1">{{ $item->tax }}</td>
            </tr>
            @endforeach

            <tr height="60px">
                <td class="hidd-1" colspan="2"></td>
                <td class="hidd-2" colspan="3"></td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig pir-r"><strong>المبلغ قبل الضريبة</strong></span>
                        <span class="cen">{{ $invoice->amount }}</span>
                        <span dir="ltr pir-l" class="lef"><strong>ِAmount</strong></span>
                    </div>
                </td>
                <td colspan="4">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>{{ __('Date')}}</strong></span>
                        <span dir="ltr">{{ $invoice->created_at->format('Y-m-d') }}</span>
                        <span dir="ltr" class="lef"><strong>Date</strong></span>
                    </div>
                </td>
                <td rowspan="2" colspan="2">
                    <span class="rig"><strong>ملاحظة</strong></span>
                    <span dir="ltr" class="lef"><strong>{{ $invoice->notes }}</strong></span>
                </td>
                <td rowspan="5">-</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig pir-r"><strong>أجمالي الخصم</strong></span>
                        <span class="cen">{{ $invoice->discount }}</span>
                        <span dir="ltr pir-l" class="lef"><strong>Discount</strong></span>
                    </div>
                </td>
                <td rowspan="2">
                    <strong>المدفوع-Paid</strong><br />{{ $invoice->cash + $invoice->card}}
                </td>
                <td rowspan="2" colspan="2">
                    <strong>نقدي-Cash</strong><br />{{ $invoice->cash}}
                </td>
                <td rowspan="2"><strong>صراف-Atm</strong><br />{{ $invoice->card}}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig pir-r"><strong>الصافي قبل الضريبة</strong></span>
                        <span class="cen pir-l">{{ $invoice->amount - $invoice->discount}}</span>
                        <span dir="ltr" class="lef"><strong>Net</strong></span>
                    </div>
                </td>
                <td colspan="2">
                    <span class="rig"><strong>التوقيع</strong></span>
                    <span></span>
                    <span dir="ltr" class="lef"><strong>Sign</strong></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig pir-r"><strong>قيمة الضريبة المضافة</strong></span>
                        <span class="cen pir-l">{{ $invoice->tax}}</span>
                        <span dir="ltr" class="lef"><strong>VAT</strong></span>
                    </div>
                </td>
                <td rowspan="2" colspan="2">
                    <strong>تحمل التأمين .Ins</strong><br />0.00
                </td>
                <td rowspan="2" colspan="2">
                    <strong>المتبقي-Remain</strong><br />{{ $invoice->rest}}
                </td>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>هويةالمريض</strong></span>
                        <span>{{ $invoice->patient->civil}}</span>
                        <span dir="ltr" class="lef"><strong>Id</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig pir-r"><strong>المبلغ بعد الضريبة</strong></span>
                        <span class="cen">{{ $invoice->total}}</span>
                        <span dir="ltr pir-l" class="lef"><strong>Total</strong></span>
                    </div>
                </td>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>{{ __('employee')}}</strong></span>
                        {{ $invoice->employee?->name}}
                        <span dir="ltr" class="lef"><strong>User</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <div class="d-flex align-items-center justify-content-center">
                        {{__("admin.address")}}: {{ setting()->address }}

                        {{__("admin.build_num")}}: {{ setting()->build_num }}

                        {{__("admin.unit_num")}}: {{ setting()->unit_num }}

                        {{__("admin.postal_code")}}: {{ setting()->postal_code }}

                        {{__("admin.Additional number")}}: {{ setting()->extra_number }}
                    </div>
                </td>
            </tr>
        </table>
        <div dir="ltr" class="text">
            <span>-</span>
            <span>1/1</span>
            <span>-</span>
            <span>-</span>
            <span>-</span>
        </div>
        <a class="btn btn-info mx-auto d-block w-fit not-print mb-3" href="javascript:print()">{{ __('print')}}</a>
    </section>
</div>
@endsection
