<section class="main-section home">

    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.Add invoice') }}</h4>
        <div class="alert alert-info">
            يجب دفع المبلغ فقط في وسيلة الدفع و سيتم حساب الضريبة تلقائيا في المطلوب دفعة
        </div>
        <div class="addNvoice-content bg-white p-4 shadow">
            <div class="tip">
                <!-- <p class="tip-text text-danger mb-3"> هناك نسبة {{ setting()->tax_rate }}% ضريبة علي الفاتورة </p> -->
                <p class="tip-text text-danger mb-3">{{ __('Tax is only effective for non-Saudis') }}</p>
                <div class="main-container d-flex flex-column flex-md-row align-items-start justify-content-center">
                    <div class="right-side w-75 ms-3 mb-4 mb-md-0">
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Patient file number or ID number')
                                    }}</label>
                                <input type="text" wire:model="patient_key" class="form-control w-100"
                                    wire:keyup='get_patient' />
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.patient') }}</label>
                                <input type="text" value="{{ $patient->name }}" readonly id=""
                                    class="form-control w-100" />
                            </div>
                            @can('show_phone_patients')
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.phone') }}</label>
                                <input type="tel" value="{{ $patient->phone }}" readonly id=""
                                    class="form-control w-100" />
                            </div>
                            @endcan
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Date') }}</label>
                                <input type="date" id="" class="form-control w-100" wire:model="date" />
                            </div>
                        </div>
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Status') }}</label>
                                <select wire:model="status" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.Status') }}</option>
                                    {{-- <option value="pending">{{ __('admin.pending') }}</option> --}}
                                    <option value="Paid">{{ __('admin.Paid') }}</option>
                                    <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                                    {{-- <option value="tmara">{{ __('Tamara') }}</option>
                                    <option value="tab">{{ __('Tabby') }}</option> --}}
                                    <option value="retrieved">{{ __('admin.retrieved') }}</option>
                                    <option value="Partially retrieved">{{ __('admin.Partially retrieved') }}</option>
                                    <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                                    {{-- <option value="cancelled">{{ __('admin.Cancelled') }}</option> --}}
                                    {{-- <option value="يue">{{ __('admin.Overdue') }}</option> --}}
                                </select>
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Clinic') }}</label>
                                <select wire:model="department_id" id="" class="main-select w-100">
                                    <option value="">
                                        {{ __('admin.Choose Clinic') }}
                                    </option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.dr') }}</label>
                                <select wire:model="dr_id" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.dr') }}</option>
                                    @foreach ($doctors as $dr)
                                    <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if(setting()->marketers_status)
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="marketer_id" class="small-label">المسوق</label>
                                <select wire:model="marketer_id" id="marketer_id" class="main-select w-100">
                                    <option value="">المسوقين</option>
                                    @foreach ($marketers as $marketer)
                                    <option value="{{ $marketer->id }}">{{ $marketer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            {{-- <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Period') }}</label>
                                <select name="" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.Period') }}</option>
                                    <option value="">{{ __('admin.morning') }}</option>
                                    <option value="">{{ __('admin.evening') }}</option>
                                </select>
                            </div> --}}
                        </div>
                        <div class="info-box d-flex flex-column flex-md-row">
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                                <select wire:model="product_id" id="" class="main-select w-100"
                                    wire:change='add_product'>
                                    <option value="">{{ __('admin.product') }}</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                                <input type="number" wire:model='product_id' class="form-control"
                                    wire:keyup='add_product'
                                    placeholder="{{ __('You can choose services or search by number') }}">
                            </div>
                            <div class="inp-container ms-2 w-100 d-flex align-items-end">
                                <a target="_blank" href="{{ route('front.products.index') }}"
                                    class="btn btn-sm btn-primary">{{ __('admin.Therapeutic services') }}</a>
                            </div>
                        </div>


                        {{-- @if ($patient && $patient->group)
                        <div class="alert alert-warning mt-3">
                            هذا المريض ينتمي إلى المجموعة (<strong>{{ $patient->group->name }}</strong>) و المجموعة
                            لها نسبة خصم
                            (<strong>{{ $patient->group->rate }} %</strong>)
                        </div>
                        @endif --}}
                        @if ($patient && $patient->group)
                        <div class="alert alert-warning mt-3">
                            @if ($patient->group->discounts)
                            يوجد نسبة خصم علي خدمات محددة تبدأ من
                            {{ $patient->group->discounts()->min('rate') }} % و تصل الي :
                            {{ $patient->group->discounts()->max('rate') }} %
                            @else
                            هذا المريض ينتمي إلى المجموعة (<strong>{{ $patient->group->name }}</strong>) و
                            المجموعة
                            لها نسبة خصم
                            (<strong>{{ $patient->group->rate }} %</strong>)
                            @endif
                        </div>
                        @endif


                        <div class="table-responsive mt-4">

                            <table class="table main-table">
                                <thead>
                                    <tr>
                                        <th class="bg-light text-center text-black fs-6" colspan="7">
                                            إضافة زيارة جديدة<button type="button" class="btn btn-success btn-sm me-3"
                                                wire:click="addDay"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('admin.Day') }}</th>
                                        <th>{{ __('admin.Date') }}</th>
                                        <th>موعد الجلسة</th>
                                        <th>{{ __('admin.session_duration') }}</th>
                                        <th>موعد مراجعة</th>
                                        <th class="not-print">{{ __('admin.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($days as $index => $day)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><input disabled type="text" class="form-control"
                                                wire:model="days.{{ $index }}.day">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control"
                                                wire:model="days.{{ $index }}.appointment_date"
                                                wire:change="getTimes({{ $index }},$event.target.value)">
                                        </td>
                                        <td>
                                            <select {{ $days[$index]['appointment_date'] ? '' : 'disabled' }}
                                                wire:model="days.{{ $index }}.appointment_time" id=""
                                                class="main-select w-100">
                                                <option value="">{{ __('admin.appointment_time') }}</option>
                                                @foreach ($days[$index]['times'] as $time)
                                                @if (!in_array($time, $reservedTimes))
                                                <option value="{{ $time }}">
                                                    {{ date('G:iA', strtotime($time)) }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control"
                                                wire:model="days.{{ $index }}.session_time">
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="reviewed"
                                                    wire:model="days.{{ $index }}.review">
                                                <label class="form-check-label small-label text-nowrap" for="reviewed">
                                                    {{ __('Is the appointment reviewed?') }}
                                                </label>
                                            </div>
                                        </td>
                                        <td class="not-print">
                                            <button wire:click="removeDay({{ $index }})"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="left-side w-25">
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.amount') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('Discount Offers') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="offers_discount" />
                        </div>

                        @if ($patient && $patient->group)
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <label for="" class="small-label">{{ __('group') }}</label>
                            <input type="text" value="{{ $patient ? $patient->group->name : '' }}" readonly id=""
                                class="form-control w-50" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.discount') }}:</span>
                            <input type="text" readonly placeholder="0" class="text-center form-control w-50"
                                wire:model="discount" wire:keyup="calculateNet" />
                        </div>
                        @else
                        @can('discount_invoices')
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.discount') }}:</span>
                            <input type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="discount" wire:keyup="calculateNet" />
                        </div>
                        @endcan
                        @endif

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('Amount after discount of offers') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount_after_offers_discount" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Total with tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="total" />
                        </div>


                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.cash') }}</span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="cash" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.card') }} : </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="card" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2">{{ __('Bank transfer') }} : </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="bank" />
                        </div>
                        @if (setting()->payment_gateways)
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2">فيزا </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model.lazy="visa" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2">ماستركارد </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model.lazy="mastercard" />
                        </div>
                        @endif
                        @if (setting()->active_tamara)
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2">تمارا : </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="tamara" />
                        </div>
                        @endif
                        @if (setting()->active_tabby)
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2">تابي : </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="tabby" />
                        </div>
                        @endif
                        @if (setting()->show_invoice_tax)
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.paid without tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="paid_without_tax" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.paid tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="paid_tax" />
                        </div>
                        @endif



                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.rest') }} : </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="rest" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Need to pay') }} : </span>
                            <input readonly type="text" placeholder="0"
                                class="text-center form-control w-50 bg-primary text-white" wire:model="need_to_pay" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <button class="btn btn-dark btn-sm w-50" wire:click='manualCalculate'>
                                {{ __('Updating Numbers') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.department') }}</th>
                                <th>{{ __('admin.product') }}</th>
                                <th>{{ __('admin.qty') }}</th>
                                <th>{{ __('admin.price') }}</th>
                                <th>{{ __('admin.total') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                            <tr>
                                <td>{{ __($item['department']) }}</td>
                                <td>{{ $item['product_name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>
                                    <input type="number" class="form-control" wire:model='items.{{ $key }}.price'
                                        wire:keyup='changeItemTotal({{ $key }})' id="items.{{ $key }}.price">
                                </td>
                                <td>{{ $item['price'] * $item['quantity'] }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button class="btn btn-sm btn-danger" wire:click="delete_item({{ $key }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="Thetext-area w-100">
                    <textarea wire:model.defer="notes" id="" class="form-control w-100 p-2"
                        placeholder="{{ __('admin.notes') }}"></textarea>
                </div>
                <div class="submitBtn-holder text-center mt-3">
                    <button wire:click='submit' class="btn btn-success">
                        {{ __('admin.Save') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>