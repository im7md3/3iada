<section class="main-section home">
    {{-- @dump($this->items) --}}
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.Add invoice') }}</h4>
        <div class="alert alert-info">
            يجب دفع المبلغ فقط في وسيلة الدفع و سيتم حساب الضريبة تلقائيا في المطلوب دفعة
        </div>
        <div class="addNvoice-content bg-white p-4 shadow">
            <div class="tip">
                <!-- <p class="tip-text text-danger mb-3">{{ __('There is a 15% tax on the non-Saudi invoice') }}</p> -->
                <p class="tip-text text-danger mb-3">{{ __('Tax is only effective for non-Saudis') }}</p>
                <div class="main-container d-flex flex-column flex-md-row align-items-start justify-content-center">
                    <div class="right-side w-75 ms-3  mb-md-0">
                        <div class="info-box d-flex flex-column flex-md-row mb-3">

                            <div class="inp-container ms-0 ms-md-2  w-100">
                                <label for="patient_key" class="small-label">{{ __('admin.Patient file number or ID
                                    number') }}</label>
                                <input type="text" {{ $emergency ? 'disabled' : '' }} wire:model="patient_key"
                                    id="patient_key" class="form-control w-100" wire:keyup='get_patient' />
                            </div>
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="patient_name" class="small-label">{{ __('admin.patient') }}</label>
                                <input type="text" value="{{ $patient ? $patient->name : '' }}" readonly
                                    id="patient_name" class="form-control w-100" />
                            </div>
                            @can('show_phone_patients')
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="patient_phone" class="small-label">{{ __('admin.phone') }}</label>
                                <input type="tel" value="{{ $patient ? $patient->phone : '' }}" readonly
                                    id="patient_phone" class="form-control w-100" />
                            </div>
                            @endcan
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="date" class="small-label">{{ __('admin.Date') }}</label>
                                <input type="date" id="date" class="form-control w-100" wire:model="date" />
                            </div>
                        </div>
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="status" class="small-label">{{ __('admin.Status') }}</label>
                                <select wire:model="status" id="status" class="main-select w-100">
                                    <option value="">{{ __('admin.Status') }}</option>
                                    {{-- <option value="pending">{{ __('admin.pending') }}</option> --}}
                                    <option value="Paid">{{ __('admin.Paid') }}</option>
                                    <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                                    {{-- <option value="tmara">{{ __('Tamara') }}</option>
                                    <option value="tab">{{ __('Tabby') }}</option> --}}
                                    <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                                    {{-- <option value="cancelled">{{ __('admin.Cancelled') }}</option> --}}
                                    {{-- <option value="يue">{{ __('admin.Overdue') }}</option> --}}
                                </select>
                            </div>
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="department_id" class="small-label">{{ __('admin.Clinic') }}</label>
                                <select wire:model="department_id" id="department_id" class="main-select w-100">
                                    <option value="">
                                        {{ __('admin.Choose Clinic') }}
                                    </option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="dr_id" class="small-label">{{ __('admin.dr') }}</label>
                                <select wire:model="dr_id" id="dr_id" class="main-select w-100">
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

                            {{-- <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Period') }}</label>
                                <select name="" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.Period') }}</option>
                                    <option value="">{{ __('admin.morning') }}</option>
                                    <option value="">{{ __('admin.evening') }}</option>
                                </select>
                            </div> --}}
                        </div>
                        <!-- <p></p> -->
                        <div
                            class="info-box d-flex align-items-end justify-content-center gap-3 flex-column flex-md-row">
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="product_id1" class="small-label">{{ __('admin.product') }}</label>
                                <select wire:model="product_id" id="product_id1" class="main-select w-100"
                                    wire:change='add_product'>
                                    <option value="">{{ __('admin.product') }}</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="product_id2" class="small-label">{{ __('admin.product') }}</label>
                                <input type="number" wire:model='product_id' id="product_id2" class="form-control"
                                    wire:keyup='add_product'
                                    placeholder="{{ __('You can choose services or search by number') }}">
                            </div>

                            <div class="inp-container w-100">
                                <a target="_blank" href="{{ route('front.products.index') }}"
                                    class="btn btn-sm btn-primary px-4">{{ __('products') }}</a>
                            </div>
                        </div>
                        {{-- <div class="mt-3">
                            <div class="d-flex gap-2 mb-2">
                                <div class="inp-container d-flex align-items-end w-130px" style="margin-bottom: 10px;">
                                    <label for="split" class="small-label ms-2 form-check-label  text-danger">{{
                                        __('admin.split bill') }}</label>
                                    <input style="margin-bottom: 2px;" type="checkbox" wire:model="split" id="split"
                                        class="form-check-input mt-0">
                                </div>
                                <div class="inp-container d-flex flex-column w-100px {{ $split ? '' : 'd-none' }}">
                                    <label for="split" class="small-label mb-2">{{ __('admin.splits number') }}</label>
                                    <input type="number" wire:model="split_number" id="" wire:keyup='computeForAll'
                                        class="w-100 form-control">
                                </div>
                            </div> -->

                        </div> --}}

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

                    </div>
                    <div class="left-side w-25 sw-100">
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
                            <input type="text" value="{{ $patient ? $patient->group?->name : '' }}" readonly id=""
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
                                wire:model="discount" />
                        </div>
                        @endcan
                        @endif

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2 space-noWrap"> {{ __('Amount after discount of offers') }}
                                :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount_after_offers_discount" />
                        </div>


                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2 space-noWrap"> {{ __('admin.Total with tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="total" />
                        </div>
                        <div
                            class="output-box d-flex align-items-center justify-content-end mb-2 {{ $split ? '' : 'd-none' }}">
                            <span class="a_word ms-2"> {{ __('admin.total after split') }} : </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="total_after_split" />
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
                                wire:model="visa" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2">ماستركارد </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="mastercard" />
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
                <div class="table-responsive ">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.department') }}</th>
                                <th>{{ __('admin.product') }}</th>
                                <th>{{ __('admin.patient_group_discount') }}</th>
                                <th>{{ __('admin.qty') }}</th>
                                <th>{{ __('admin.price') }}</th>
                                <th>{{ __('admin.price after discount') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                            <tr wire:key="{{$key}}">
                                <td>{{ __($item['department']) }}</td>
                                <td>{{ $item['product_name'] }}</td>
                                <td>{{ $item['patient_group_discount_id'] ? $item['discount'] : 0 }}</td>
                                {{-- {{ $item['quantity'] }} --}}
                                <td><input type="number" class="form-control" wire:model='items.{{ $key }}.quantity'
                                        wire:keyup='changeItemTotal({{ $key }})' id="items.{{ $key }}.quantity"></td>

                                <td>
                                    <input type="number" class="form-control" wire:model='items.{{ $key }}.price'
                                        wire:keyup='changeItemTotal({{ $key }})' id="items.{{ $key }}.price">
                                </td>

                                <td>
                                    {{ (int) $item['price'] * (int) $item['quantity'] - (int) $item['discount'] }}
                                </td>

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
                    <button wire:click='submit' class="btn btn-success px-5">
                        {{ __('admin.Save') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>