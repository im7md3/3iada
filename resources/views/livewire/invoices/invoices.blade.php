<section class="bills-section main-section pt-4">
    <x-alert></x-alert>
    <div class="container-fluid">
        <h4 class="main-heading mb-4">{{ __('admin.invoices') }}</h4>
        <div class="bills-content bg-white p-4 rounded-2 shadow">
            <div class="bills-option&btn d-flex align-items-center flex-wrap gap-2 justify-content-end mb-1">
                <div class="control-option d-flex flex-wrap align-items-center justify-content-center">
                    <div class="print-btn btn btn-sm btn-warning " id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </div>

                    @can('create_invoices')
                    <a href="{{ route('front.invoices.create') }}" class="btn-main-sm me-1">
                        {{ __('admin.Add invoice') }}
                        <i class="icon fa-solid fa-plus me-1"></i>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="top-area mb-3">
                <div class="row g-2">
                    <div class="col-12 col-md-2">
                        <div class="info-data">
                            <label for="duration-from" class="billData-name mt-3 mb-2">{{ __('admin.name') }}</label>
                            <input type="text" class="form-control" wire:model="filter_name" id="duration-from" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="info-data">
                            <label for="duration-from" class="billData-name mt-3 mb-2">{{ __('Invoice no.') }}</label>
                            <input type="text" class="form-control" wire:model="filter_id" id="duration-from" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="info-data">
                            <label for="duration-from" class="billData-name mt-3 mb-2">{{ __('admin.from') }}</label>
                            <input type="date" class="form-control" wire:model="from" id="duration-from" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="info-data">
                            <label for="duration-to" class="billData-name mt-3 mb-2">{{ __('admin.to') }}</label>
                            <input type="date" class="form-control" wire:model="to" id="duration-to" />
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="info-data">
                            <label for="doctor-name" class="billData-name mt-3 mb-2">{{ __('admin.dr') }}</label>
                            <select class="main-select w-100 doctor-name" id="doctor-name" wire:model="dr">
                                <option value="">{{ __('admin.All doctors') }}</option>
                                @foreach ($doctors as $dr)
                                <option value="{{ __($dr->id) }}">{{ $dr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="info-data">
                            <label for="employee_id" class="billData-name mt-3 mb-2">{{ __('Employees') }}</label>
                            <select wire:model="employee_id" class="main-select w-100 doctor-name" id="employee_id">
                                <option value="">{{ __('Select an Employee') }}</option>
                                @foreach ($receptions as $reception)
                                <option value="{{ $reception->id }}">{{ $reception->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="info-data">
                            <label for="bill-state1" class="billData-name mt-3 mb-2">{{ __('admin.Status') }}</label>
                            <select class="main-select w-100 bill-state" id="bill-state1" wire:model="status">
                                <option value="">{{ __('admin.All') }}</option>
                                <option value="Paid">{{ __('admin.Paid') }}</option>
                                <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                                <option value="retrieved">{{ __('admin.retrieved') }}</option>
                                <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="info-data">
                            <label for="bill-state2" class="billData-name mt-3 mb-2">{{ __('section') }}</label>
                            <select class="main-select w-100 bill-state" id="bill-state2" wire:model="department_id">
                                <option value="">{{ __('admin.All') }}</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="prt-content">
                <div class="d-block-print  d-none">
                    <div class="d-flex justify-content-between   p-3 my-3  rounded  "
                        style='border-radius: 10px;border: 2px solid #ddd;'>
                        <div class="client-info">
                            <p class="title mb-2 text-end">{{ setting()->site_name }}</p>
                            <div
                                class="d-flex un-flex flex-column flex-lg-row align-items-center justify-content-start justify-content-md-between gp">
                                <div class="">
                                    <p class="mb-0">
                                        <span class=""> {{ setting()->address }} </span>
                                    </p>
                                    <p class="mb-0">
                                        <span class=""> {{ setting()->phone }} </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="logo">
                            <img src="{{ display_file(setting()->logo) }}" alt="" width="100" class="logo-img" />
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table main-table lg-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.Invoice no.') }}</th>
                                <th>{{ __('admin.department') }}</th>
                                <th>{{ __('admin.Medical number') }}</th>
                                <th>{{ __('admin.patient') }}</th>
                                <th>{{ __('admin.dr') }}</th>
                                <th>{{ __('admin.employee') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.amount') }}</th>
                                <th>خصم العروض</th>
                                <th>خصم يدوي</th>
                                <th>إجمالي الخصم</th>
                                <th>{{ __('admin.tax') }}</th>
                                <th>{{ __('admin.Total with tax') }}</th>
                                <th>{{ __('admin.paid') }}</th>
                                <th>{{ __('rest') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>اخر زيارة</th>
                                @if(setting()->marketers_status)
                                <th>المسوق</th>
                                @endif

                                <th class="not-print">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->department?->name }}</td>
                                <td>{{ $invoice->patient?->id }}</td>
                                <td>{{ $invoice->patient?->name ?? 'لا يوجد' }}</td>
                                <td>{{ $invoice->dr ? $invoice->dr?->name : 'لا يوجد' }}</td>
                                <td>{{ $invoice->employee?->name }}</td>
                                <td>{{ $invoice->date ? $invoice->date : $invoice->created_at->format('Y-m-d') }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>{{ $invoice->offers_discount }}</td>
                                <td>{{ $invoice->discount }}</td>
                                <td>{{ $invoice->discount + $invoice->offers_discount }}</td>
                                <td>{{ $invoice->tax }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>{{ $invoice->paid }}</td>
                                <td>{{ $invoice->rest }}</td>
                                <td>
                                    {{ __($invoice->status) }}
                                    @if ($invoice->status == 'Paid')
                                    @if ($invoice->cash > 0)
                                    - {{ __('admin.cash') }}
                                    @endif
                                    @if ($invoice->card > 0)
                                    - {{ __('admin.card') }}
                                    @endif
                                    @if ($invoice->bank > 0)
                                    - {{ __('Bank transfer') }}
                                    @endif
                                    @if ($invoice->tamara > 0)
                                    - تمارا
                                    @endif
                                    @if ($invoice->tabby > 0)
                                    - تابي
                                    @endif
                                    @endif
                                </td>
                                <th>{{ $invoice->latest()->first()?->created_at->format('Y-m-d H:i') }}</th>
                                @if(setting()->marketers_status)
                                <td>{{ $invoice->marketer?->name ?? '--' }}</td>
                                @endif
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <!--btn  Modal repeat-->
                                        <a href="{{ route('front.invoices.show', $invoice) }}" title="عرض"
                                            class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        @can('retrieve_invoices')
                                        <button data-bs-toggle="modal" title="استرجاع"
                                            class="btn btn-sm btn-info text-white"
                                            data-bs-target="#retrieved{{ $invoice->id }}">
                                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                        </button>
                                        @endcan

                                        @if ($invoice->rest > 0 || $invoice->bonds->count() > 0)
                                        <a href="{{ route('front.invoices.bonds', $invoice) }}" title="سندات"
                                            class="btn btn-sm btn-warning  text-white">
                                            <i class="fa-solid fa-file-contract"></i>
                                        </a>
                                        @endif

                                        @can('update_invoices')
                                        <a href="{{ route('front.invoices.edit', $invoice) }}" title="تعديل"
                                            class="btn btn-sm btn-primary text-white">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @endcan
                                        @can('delete_invoices')
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" title="حذف"
                                            data-bs-target="#delete_agent{{ $invoice->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @include('front.invoice.delete')
                            @include('front.invoice.retrieved')
                            @endforeach

                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</section>