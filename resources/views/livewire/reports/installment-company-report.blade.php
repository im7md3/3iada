<section class="ClidocReport main-section pt-5">
    <div class="container">
        <div class="Cli&doc-report-content bg-white p-4 rounded-2 shadow">
            <div class="d-flex mb-3">
                <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </a>
            </div>
            <h4 class="main-heading"> {{ __('Al-Taqqasit company report') }}</h4>
            <div class="left-holder d-flex justify-content-end m-sm-0">
                <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('admin.print') }}</span>
                </button>
                <button class="btn btn-sm btn-outline-info" wire:click='export()'>
                    <i class="fa-solid fa-file-excel"></i>
                    <span>{{ __('admin.Export') }} Excel</span>
                </button>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="company" class="report-name mt-3 mb-2">{{ __('admin.company') }}</label>
                        <select class="form-control" wire:model="company" id="company">
                            <option value="">اختر</option>
                            <option value="tamara">تمارا</option>
                            <option value="tabby">تابي</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>
            </div>
        </div>
        <div id="prt-content">
            <x-header-invoice></x-header-invoice>
            @if (count($invoices) > 0)
                <div class="table-responsive">
                    <table class="table main-table"id="data-table">
                        <thead>
                            <tr>
                                <th>رقم الفاتورة</th>
                                <th>الشركة</th>
                                <th>التاريخ</th>
                                <th>المريض</th>
                                <th>الموظف</th>
                                <th>المبلغ</th>
                                <th>النسبة</th>
                                <th>المبلغ بعد خصم النسبة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->company }}</td>
                                    <td>{{ $invoice->date ? $invoice->date : $invoice->created_at->format('Y-m-d') }}
                                    </td>
                                    <td>{{ $invoice->patient?->name ?? 'لا يوجد' }}</td>
                                    <td>{{ $invoice->employee?->name }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ $invoice->company_ratio }}</td>
                                    <td>{{ $invoice->company_total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>{{ __('admin.Sorry, there are no results') }}</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td>{{ __('admin.Sum') }}</td>
                                <td colspan="4">-</td>
                                <td>{{ $invoices->sum('total') }}</td>
                                <td>{{ $invoices->sum('company_ratio') }}</td>
                                <td>{{ $invoices->sum('company_total') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
