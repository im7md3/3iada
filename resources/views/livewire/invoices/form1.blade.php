<section class="container-fluid">
    <div class="res-table">
        @if (setting()->active_water_mark)
        <p class="text-mark">{{ setting()->water_mark_string }}</p>
        @endif
        <div class="d-flex justify-content-between  align-items-center my-3">
            <div dir="ltr" class="main-head m-0">
                <img width="300" src="{{ display_file(setting()->logo) }}">
                <div class="head">
                    <h2 class="ar">{{ setting()->site_name }}</h2>
                    {{-- <h1><span>test</span></h1> --}}
                </div>
            </div>
            <h5 class="title-style-font">
                فاتورة ضربية مبسطة
            </h5>
        </div>
        <table>
            <tr>
                <td colspan="6">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>أسم المريض</strong>:
                        </span>
                        {{ $invoice->patient->name }}
                        <span dir="ltr" class="lef"><strong>patient Name</strong>:-</span>
                    </div>
                </td>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>حالة الفاتورة</strong>:
                        </span>
                        {{ __($invoice->status) }}
                        <span dir="ltr" class="lef"><strong>Invoice Status</strong>:-</span>
                    </div>
                </td>
                <td colspan="1">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>{{ __('admin.File number') }}</strong></span>
                        <span class="cen">{{ $invoice->patient?->id }}</span>
                        <span dir="ltr" class="lef"><strong>File.No</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>أسم الطبيب</strong></span>
                        <span>{{ $invoice->dr?->name }}</span>
                        <span dir="ltr" class="lef"><strong>Dr.Name</strong></span>
                    </div>
                </td>
                <td colspan="4">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>{{ __('Clinic') }}</strong></span>
                        <span>{{ $invoice->department?->name }}</span>
                        <span dir="ltr" class="lef"><strong>Clinic</strong></span>
                    </div>
                </td>
                <td colspan="3">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>رقم الفاتورة</strong></span>
                        <span class="cen">{{ $invoice->id }}</span>
                        <span dir="ltr" class="lef"><strong>Invoice. No.</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>شركة التأمين</strong></span>
                        <span class="cen">{{ $invoice->patient->insurance->name ?? null }}</span>
                        <span dir="ltr" class="lef"><strong>co.Name</strong></span>
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

            <tr style="background-color: #e4e4e4;">
                <th colspan="3">أسم الخدمة<br />Service Name</th>
                <th>السعر<br />price</th>
                <th>العدد<br />Count</th>
                <th>الإجمالي<br />Total</th>
                <th>#الخصم<br />#Discount</th>
                <th>تحمل التأمين<br />Insurance</th>
                <th colspan="1">%الضريبة<br />%VAT</th>
            </tr>
            @foreach ($invoice->products as $item)
            <tr>
                <td colspan="3" dir="ltr">
                    {{ $item->product_name }}
                </td>
                <td>{{ $item->price }}</td>
                <td>1</td>
                <td>{{ $item->sub_total }}</td>
                <td>{{ $item->discount }}</td>
                <td>0.00</td>
                <td colspan="1">{{ $item->tax }}</td>
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
                        <span class="rig"><strong>{{ __('Date') }}</strong></span>
                        <span dir="ltr">{{ $invoice->date ? $invoice->date : $invoice->created_at->format('Y-m-d')
                            }}</span>
                        <span dir="ltr" class="lef"><strong>ِDate</strong></span>
                    </div>
                </td>
                <td rowspan="2" colspan="2">
                    <span class="rig"><strong>ملاحظة</strong></span>
                    <span dir="ltr" class="lef"><strong>{{ $invoice->notes }}</strong></span>
                </td>
                <td rowspan="5">{!! $qrCode !!}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig pir-r"><strong>أجمالي الخصم</strong></span>
                        <span class="cen">{{ $invoice->discount + $invoice->offers_discount }}</span>
                        <span dir="ltr pir-l" class="lef"><strong>Discount</strong></span>
                    </div>
                </td>
                <td rowspan="2">
                    <strong>المدفوع-Paid</strong><br />{{ $invoice->status == 'Unpaid' ? 0 :
                    ($invoice->installment_company ? $invoice->total : $invoice->paid) }}
                </td>
                @if ($invoice->installment_company)
                <td rowspan="2" colspan="4"><strong>تمارا-Tmara</strong><br />{{ $invoice->total }}</td>
                @elseif($invoice->tamara > 0)
                <td rowspan="2" colspan="2"><strong>تمارا-Tmara</strong><br />{{ $invoice->tamara }}</td>
                @elseif($invoice->tabby > 0)
                <td rowspan="2" colspan="2"><strong>تابي-Tab</strong><br />{{ $invoice->tabby }}</td>
                @elseif($invoice->visa > 0)
                <td rowspan="2" colspan="2"><strong>فيزا-Visa</strong><br />{{ $invoice->visa }}</td>
                @elseif($invoice->mastercard > 0)
                <td rowspan="2" colspan="2"><strong>ماستر كارد-Mastercard</strong><br />{{ $invoice->mastercard }}</td>
                @else
                <td rowspan="2">
                    <strong>نقدي-Cash</strong><br />{{ $invoice->status == 'Unpaid' ? 0 : $invoice->cash }}
                </td>
                <td rowspan="2">
                    <strong>شبكة-Atm</strong><br />{{ $invoice->status == 'Unpaid' ? 0 : $invoice->card }}
                </td>
                <td rowspan="2"><strong>تحويل بنكى-Bank
                        transfer</strong><br />{{ $invoice->status == 'Unpaid' ? 0 : $invoice->bank }}</td>
                @endif

            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>التوقيع</strong></span>
                        <span dir="ltr" class="lef"><strong>Sign.</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig pir-r"><strong>قيمة الضريبة المضافة</strong></span>
                        <span class="cen pir-l">{{ $invoice->tax }}</span>
                        <span dir="ltr" class="lef"><strong>VAT</strong></span>
                    </div>
                </td>
                <td rowspan="2" colspan="2">
                    <strong>تحمل التأمين .Ins</strong><br />0.00
                </td>
                <td rowspan="2" colspan="2">
                    <strong>المتبقي-Remain</strong><br />{{ $invoice->rest }}
                </td>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>هويةالمريض</strong></span>
                        <span>{{ $invoice->patient->civil }}</span>
                        <span dir="ltr" class="lef"><strong>Id</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig pir-r"><strong>المبلغ شامل الضريبة</strong></span>
                        <span class="cen">{{ $invoice->total }}</span>
                        <span dir="ltr pir-l" class="lef"><strong>Total</strong></span>
                    </div>
                </td>
                <td colspan="2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="rig"><strong>{{ __('employee') }}</strong></span>
                        {{ $invoice->employee?->name }}
                        <span dir="ltr" class="lef"><strong>User</strong></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="{{ setting()->marketers_status ? 7 : 9 }}">
                    {{ __('admin.address') }}:{{ setting()->address }}
                    {{ __('admin.build_num') }}:{{ setting()->build_num }}
                    {{ __('admin.unit_num') }}:{{ setting()->unit_num }}
                    {{ __('admin.postal_code') }}:{{ setting()->postal_code }}
                    {{ __('admin.Additional number') }}:{{ setting()->extra_number }}
                </td>
                @if(setting()->marketers_status)
                <td colspan="2">
                    المسوق : {{ $invoice->marketer?->name ?? 'لا يوجد' }}
                </td>
                @endif
            </tr>
        </table>
        <div dir="ltr" class="text mb-3">
            <span>شكرا لزيارتكم</span>
        </div>

    </div>
</section>