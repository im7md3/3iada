<section class="casher-invoice py-5">
    @if(setting()->active_water_mark)
    <p class="text-mark">{{ setting()->water_mark_string }}</p>
    @endif
    <div class="container">
        <div class="invoice-content bg-white p-3 rounded-3 shadow-sm">
            <div class="logo-holder m-auto text-center rounded-3 mb-2">
                <img class="the_image mx-auto rounded-3" src="{{ display_file(setting()->logo) }}" alt="logo"
                    width="150">
            </div>
            <div class="tax number text-center mb-1">
                {{ setting()->site_name }}
            </div>
            <p class=" text-center mb-1">
                {{__("admin.Simplified tax invoice")}} - {{ $invoice->id }}
            </p>
            <hr class="w-75 mx-auto mt-2 mb-3">
            <div class="mb-2">
                <b>{{__("admin.address")}}: </b> {{ setting()->address }}
            </div>
            <div class="mb-1">
                <b>{{__("admin.phone")}}:</b> {{ setting()->phone }}
            </div>
            <div class=" text-center mb-1">
                <b>{{__("admin.Tax number")}}: </b> {{ setting()->tax_no }}
            </div>
            <div class="the_date d-flex align-items-center justify-content-evenly mb-1">

                <div class="date-holder mb-1">
                    {{ $invoice->date ? $invoice->date : $invoice->created_at->format('Y-m-d') }}
                </div>
            </div>
            <div class="mb-1"> <b>{{__("admin.customer name")}}:</b> {{ $invoice->patient?->name }}</div>
            <div class="mb-1"> <b>{{__("admin.File number")}}:</b> {{ $invoice->patient?->id }}</div>
            <div class="mb-2"> <b>{{__("admin.Physician")}}:</b> {{ $invoice->dr?->name }}</div>

            <table class="table w-100 main-table text-center rounded-3 w-100">
                <thead class="border-0">
                    <tr>
                        <th class="">
                            <div>النوع</div>
                            <div>Type</div>
                        </th>
                        <th>
                            <div>عدد</div>
                            <div>Number</div>
                        </th>
                        <th>
                            <div>الخصم</div>
                            <div>Discount</div>
                        </th>
                        <th>
                            <div>الاجمالي</div>
                            <div>Total</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->products as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->discount }}</td>
                        <td>{{ $item->sub_total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table w-100 main-table text-center rounded-3 w-100 border-0">
                <thead class="border-0">
                    <tr>
                        <th class="">
                            <div class="dd d-flex align-items-end gap-1">
                                <div class="nn">
                                    <b> الأجمالي:<br> Total: </b>
                                </div>
                                <div>{{ $invoice->total }}</div>
                            </div>
                        </th>
                        <th class="">
                            <div class="dd d-flex align-items-end gap-1">
                                <div class="nn">
                                    <b> الخصم:<br> Disc: </b>
                                </div>
                                <div>{{ $invoice->discount + $invoice->offers_discount }}</div>
                            </div>
                        </th>
                        <th>
                            <div class="dd d-flex align-items-end gap-1">
                                <div class="nn">
                                    <b> المجموع قبل الخصم والضريبة:<br> Total before deduction and tax: </b>
                                </div>
                                <div>{{ $invoice->amount - $invoice->discount }}</div>
                            </div>
                        </th>
                        <th>
                            <div class="dd d-flex align-items-end gap-1">
                                <div class="nn">
                                    <b> ضريبة القيمة المضافة:<br> value added tax: </b>
                                </div>
                                <div>{{ $invoice->tax }}</div>
                            </div>
                        </th>
                        <th>
                            <div class="dd d-flex align-items-end gap-1">
                                <div class="nn">
                                    <b> المجموع شامل الضريبة:<br> Total including tax: </b>
                                </div>
                                <div>{{ $invoice->total }}</div>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
            <h5 class="wel text-end text-primary my-3">
                {{__("admin.thanks for your visit")}}
            </h5>
            <div class="d-flex flex-column align-items-start gap-2">
                <div class="d-flex parent-boxes-info  flex-column gap-2">
                    @if ($invoice->installment_company)
                    <div class="box-info-border">
                        <b>دفع تمارا / Tamara</b>
                        {{ $invoice->total }}
                    </div>
                    @else
                    <div class="box-info-border">
                        <b>دفع نقدا / Cash</b>
                        {{ $invoice->cash }}
                    </div>
                    <div class="box-info-border">
                        <b>دفع شبكة / Card</b>
                        {{ $invoice->card }}
                    </div>
                    <div class="box-info-border">
                        <b>دفع تحويل بنكي / Bank</b>
                        {{ $invoice->bank }}
                    </div>
                    @endif
                    <div class="box-info-border">
                        <b> المتبقي / rest</b>
                        {{ $invoice->rest }}
                    </div>
                    <div class="box-info-border">
                        <b> {{ __('Seller') }} / the seller</b>
                        {{ $invoice->employee?->name }}
                    </div>
                    @if(setting()->marketers_status)
                    <div class="box-info-border">
                        <b> المسوق / the Marketer</b>
                        {{ $invoice->marketer?->name ?? 'لا يوجد' }}
                    </div>
                    @endif
                </div>
                <div class="bar_code_holder text-center">
                    {!! $qrCode !!}
                </div>
            </div>
        </div>
    </div>
</section>