<div class="btn-holder not-print">
    <button class="btn btn-sm btn-warning px-3" onclick="window.print()">
        {{ __('print') }}
        <i class="fa-solid fa-print"></i>
    </button>
</div>
<x-header-invoice></x-header-invoice>
<section class="select-teeth">
    <div class="toothArray content">
        <img class="img-teeth" src="{{ asset('img/num.png') }}" alt="" />
        @foreach (getToothNumbers() as $tooth)
        <button class="btn-select" data-bs-toggle="modal" wire:click='setTooth({{ $tooth }})'
            data-bs-target="#modal-select">
        </button>
        @endforeach
    </div>
</section>
<div class="row g-3">
    <div class="table-responsive">
        <table class="table table-bordered small-print-table">
            <thead>
                <tr>
                    <th class="text-nowrap">{{ __('Teeth number') }}</th>
                    <th>{{ __('Note') }}</th>
                    <th>{{ __('products') }}</th>
                    <th class="text-nowrap">{{ __('Processed') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('amount') }}</th>
                    <th>{{ __('tax') }}</th>
                    <th>{{ __('total') }}</th>
                    <th class="not-print">{{ __('actions') }}</th>
                </tr>
            </thead>
            <tbody>

                @php
                $total_tax = 0;
                @endphp
                @foreach ($patient->treatment_plans ?? [] as $item)
                @php
                if (setting()->tax_enabled and $patient->country_id != 1) {
                $tax = $item->amount * (setting()->tax_rate / 100);
                $total_tax += $tax;
                }
                @endphp
                <tr>
                    <td>{{ $item->tooth }}</td>
                    <td class="text-nowrap">{{ $item->note }}</td>
                    <td>
                        <div class="d-flex align-items-center flex-wrap gap-1">
                            @foreach ($item->products as $product)
                            <span class="badge bg-secondary">{{ $product->name }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        @if ($item->is_treated)
                        <span class="badge bg-success">{{ __('Yes') }}</span>
                        @else
                        <span class="badge bg-danger">لا</span>
                        @endif
                    </td>
                    <td class="text-nowrap">{{ $item->created_at->format('Y-m-d') }}</td>
                    <td class="text-nowrap">{{ $item->amount }}</td>
                    <td class="text-nowrap">{{ $tax }}</td>
                    <td class="text-nowrap">{{ $item->amount + $tax }}</td>

                    <td class="not-print">
                        <div class="d-flex align-items-center gap-1">
                            <a wire:click='editTooth({{ $item->id }})' data-bs-toggle="modal"
                                data-bs-target="#modal-select" class="btn btn-sm btn-info py-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a wire:click='deleteTooth({{ $item->id }})' class="btn btn-sm btn-danger py-1">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>{{ __('total') }}</td>
                    <td colspan="6"></td>
                    <td>{{ $patient->treatment_plans->sum('amount') + $total_tax }}</td>
                    <td class="not-print"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!------------------------------ Modal ------------------------------>
<div class="modal fade" id="modal-select" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="small-label">اسم الخطة</label>
                    <input class="form-control" type="text" wire:model="plan_name" />

                    {{-- <textarea wire:model.defer='treatment_plan_note' class="form-control" rows="4"></textarea> --}}
                </div>
                <div class="mb-2">
                    <label for="" class="small-label">{{ __('Add a note') }}</label>
                    <textarea wire:model.defer='treatment_plan_note' class="form-control" rows="4"></textarea>
                </div>
                <div class="alert alert-info">
                    برجاء ادخال رقم المنتج و الضغط على إدخال (ENTER)
                </div>
                <div class="d-flex align-items-end gap-2 mb-3">
                    <div class="inp-container w-100">
                        <label for="" class="small-label">{{ __('Service number search') }}</label>
                        <input type="number" wire:model.lazy='product_id' class="form-control"
                            wire:keyup='addTreatmentPlanProduct'>
                    </div>
                    <div class="inp-container d-flex w-100 gap-2">
                        <a target="_blank" href="{{ route('front.products.index') }}" class="btn btn-sm btn-primary">{{
                            __('products') }}</a>
                    </div>
                </div>
                @if ($TreatmentPlanProducts)
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
                            @foreach ($TreatmentPlanProducts as $key => $item)
                            <tr>
                                <td>{{ __($item->department->name) }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="deleteTreatmentPlanProduct({{ $item->id }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <div class="form-check w-fit">
                    <input class="form-check-input" type="checkbox" wire:model="is_treated" value="1" id="is_treated">
                    <label class="small-label" for="is_treated">
                        {{ __('Processed') }}
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back')
                    }}</button>
                <button class="btn btn-sm  btn-success" wire:click='addTreatmentPlan' data-bs-dismiss="modal">{{
                    __('admin.Yes') }}</button>
            </div>
        </div>
    </div>
</div>