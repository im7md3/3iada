<section>
    @include('doctor.interfaces.add_product')
    <div class="main-container mb-4 d-flex flex-column flex-md-row align-items-start  justify-content-center">
        <div class="right-side w-75 ms-3 mb-4 mb-md-0">
            <div class="info-box d-flex flex-column">
                <div class="alert alert-info w-fit mx-auto" role="alert">
                    {{ __('Invoice will be obtained by reception or accountant') }}
                </div>

                @if ($patient && $patient->group)
                    <div class="alert alert-warning">
                        هذا المريض ينتمي إلى المجموعة (<strong>{{ $patient->group->name }}</strong>) و المجموعة لها نسبة
                        خصم
                        (<strong>{{ $patient->group->rate }} %</strong>)
                    </div>
                @endif

                @can('read_products')
                    <p>{{ __('You can choose services or search by number') }}</p>
                    <div class="inp-container w-100 mb-3">
                        <label for="" class="small-label">{{ __('category') }}</label>
                        <select wire:model="selected_department_id" class="main-select w-100">
                            <option value="">{{ __('Choose department') }}</option>
                            @foreach ($departments ?? [] as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="inp-container ms-0 ms-md-2 w-100">
                        <label for="" class="small-label">{{ __('admin.Date') }}</label>
                        <input type="date" id="" class="form-control w-100" wire:model="date" />
                    </div>

                    <div class="inp-container w-100 mb-3">
                        <label for="" class="small-label">{{ __('service') }}</label>
                        <select wire:model="product_id" class="main-select w-100" wire:change='add_product'>
                            <option value="">{{ __('Choose the service') }}</option>
                            @foreach (\App\Models\Product::query()->where('department_id', $selected_department_id)->get() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex align-items-end gap-2 mb-3">
                        <div class="inp-container w-100">
                            <label for="" class="small-label">{{ __('Service number search') }}</label>
                            <input type="number" wire:model='product_id' class="form-control" wire:keyup='add_product'>
                        </div>
                        <div class="inp-container d-flex w-100 gap-2">
                            <a target="_blank" href="{{ route('front.products.index') }}"
                                class="btn btn-sm btn-primary">{{ __('products') }}</a>
                            <a data-bs-toggle="modal" data-bs-target="#add_product"
                                class="btn btn-sm btn-success">{{ __('admin.Add product') }}</a>
                        </div>
                    </div>
                @endcan
                {{-- <div class="inp-container d-flex align-items-center mb-3 w-100">
                    <label for="split" class="small-label ms-2 form-check-label">{{ __('admin.split bill') }}</label>
                    <input type="checkbox" wire:model="split" id="split" class="form-check-input mt-0">
                </div>
                <div class="inp-container d-flex flex-column w-100 {{ $split ? '' : 'd-none' }}">
                    <label for="split" class="small-label mb-2">{{ __('admin.splits number') }}</label>
                    <input type="number" wire:model="split_number" id="" wire:keyup='computeForAll'
                        class="w-100 form-control">
                </div> --}}
            </div>
        </div>
        <div class="left-side w-50 sw-100">
            <div class="output-box d-flex flex- align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.amount') }} : </span>
                <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="amount"
                    disabled />
            </div>
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('Discount Offers') }} :</span>
                <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="offers_discount"
                    disabled />
            </div>

            @if ($patient && $patient->group)
                <div class="output-box d-flex align-items-center justify-content-end mb-2">
                    <label for="" class="small-label">{{ __('group') }}</label>
                    <input type="text" value="{{ $patient ? $patient->group->name : '' }}" id=""
                        class="form-control w-50" />
                </div>
                <div class="output-box d-flex align-items-center justify-content-end mb-2">
                    <span class="a_word ms-2"> {{ __('admin.discount') }}:</span>
                    <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="discount"
                        wire:keyup="calculateNet" disabled />
                </div>
            @else
                @can('discount_invoices')
                    <div class="output-box d-flex align-items-center justify-content-end mb-2">
                        <span class="a_word ms-2"> {{ __('admin.discount') }} :</span>
                        <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="discount"
                           />
                    </div>
                @endcan
            @endif

            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2 space-noWrap"> {{ __('Amount after discount of offers') }} :</span>
                <input type="text" placeholder="0" class="text-center form-control w-50"
                    wire:model="amount_after_offers_discount" disabled />
            </div>



            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2"> {{ __('admin.tax') }} : </span>
                <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="tax" disabled />
            </div>
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                <span class="a_word ms-2 space-noWrap"> {{ __('admin.Total with tax') }} : </span>
                <input type="text" placeholder="0" class="text-center form-control w-50" wire:model="total"
                    disabled />
            </div>




            <div class="output-box d-flex align-items-center justify-content-end mb-2 {{ $split ? '' : 'd-none' }}">
                <span class="a_word ms-2"> {{ __('admin.total after split') }} : </span>
                <input type="text" placeholder="0" class="text-center form-control w-50"
                    wire:model="total_after_split" />
            </div>


        </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table main-table">
            <thead>
                <tr>
                    <th>{{ __('admin.department') }}</th>
                    <th>{{ __('admin.product') }}</th>
                    <th>{{ __('admin.price') }}</th>
                    <th>{{ __('admin.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $key => $item)
                    <tr>
                        <td>{{ __($item['department']) }}</td>
                        <td>{{ $item['product_name'] }}</td>
                         <td><input type="number" wire:model="items.{{ $key }}.price" class="form-control" id=""
                                    wire:keyup='changeItemTotal({{ $key }})'></td>
{{--                        <td>{{ $item['price'] }}</td>--}}
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
    <div class="The-text-area w-100">
        <textarea wire:model.defer="notes" id="" class="form-control w-100 p-2"
            placeholder="{{ __('admin.notes') }}"></textarea>
    </div>

    @if (!$selected_appointment->invoice)
        <div class="submitBtn-holder text-center mt-3">
            <button class="btn btn-success w-25" data-bs-toggle="modal" data-bs-target="#exampleModal">
                {{ __('admin.Save') }}
            </button>
        </div>

        @include('front.appointment.endSessionModal')
    @endif
</section>
