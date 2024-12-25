<div class="d-flex gap-2 mb-2">
    <button class="btn btn-sm btn-success btn-sm" wire:click='$set("invoice_status","")'>{{ __('admin.All') }}
        {{ $patient->invoices()->count() }}</button>
    <button class="btn btn-sm text-white btn-info btn-sm" wire:click='$set("invoice_status","paid")'>{{ __('admin.Paid') }}
        {{ $patient->invoices()->where('status', 'paid')->count() }}</button>
    <button class="btn btn-sm btn-danger btn-sm" wire:click='$set("invoice_status","unpaid")'>{{ __('admin.Unpaid') }}
        {{ $patient->invoices()->where('status', 'unpaid')->count() }}</button>
</div>
<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Invoice no.') }}</th>
                <th>{{ __('admin.patient') }}</th>
                <th>{{ __('admin.dr') }}</th>
                <th>{{ __('admin.Accountant') }}</th>
                <th>{{ __('admin.Date') }}</th>
                <th>{{ __('admin.Total') }}</th>
                <th>{{ __('rest') }}</th>
                <th>{{__("admin.Status")}}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $invoice->dr ? $invoice->dr->name : '' }}</td>
                <td>{{ $invoice->employee?->name }}</td>
                <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                <td>{{ $invoice->total }}</td>
                <td>{{ $invoice->rest }}</td>
                <td>{{ __($invoice->status) }}</td>
                <td>
                    @can('update_invoices')
                    <a href="{{ route('front.invoices.edit', $invoice) }}" class="btn btn-sm btn-info text-white">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    @endcan
                    <a target="_blank" href="{{ route('front.invoices.show', $invoice) }}" class="btn btn-sm btn-purple">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $invoices->links() }}
</div>

<h6>السندات</h6>
<div class="table-responsive">
    <table class="table main-table" id="prt-content">
        <thead>
        <tr>
            <th>{{ __('admin.Invoice no.') }}</th>
            <th>{{ __('employee') }}</th>
            <th>{{ __('admin.patient') }}</th>
            <th>{{ __('admin.dr') }}</th>
            <th>{{ __('admin.Date') }}</th>
            <th>{{ __('admin.amount paid') }}</th>
            <th>{{ __('admin.tax') }}</th>
            <th>{{ __('admin.rest') }}</th>
            <th>طريقة الدفع</th>
            <th>الحالة</th>
            <th class="not-print">{{ __('admin.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @php($bonds =\App\Models\InvoiceBond::whereRelation('invoice','patient_id',$patient->id)->paginate(10))
        @foreach ( $bonds as $bond)
            <tr>
                <td>{{ $bond->invoice->id }}</td>
                <td>{{ $bond->user->name }}</td>
                <td>{{ $bond->invoice->patient->name }}</td>
                <td>{{ $bond->invoice->dr ? $bond->invoice->dr->name : 'لا يوجد' }}</td>
                <td>{{ $bond->created_at->format('Y-m-d') }}</td>
                <td>{{ $bond->amount }}</td>
                <td>{{ $bond->tax }}</td>
                <td>{{ $bond->rest }}</td>
                <td>{{ __($bond->payment_method) }}</td>
                <td>{{ __($bond->status) }}</td>
                <td class="not-print">
                    <div class="d-flex align-items-center justify-content-center gap-1">
                        <a href="{{route('front.showBonds',$bond)}}" title="مشاهدة سند" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-print"></i>
                        </a>
                        <button data-bs-toggle="modal" data-bs-target="#add_or_update_bonds" class="btn btn-sm btn-info text-white" wire:click='edit({{ $bond->id }})'>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        @can('discount_invoices')
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" title="حذف" data-bs-target="#deleteBond{{ $bond->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        @endcan
                    </div>
                </td>
            </tr>
            @include('front.invoice.deleteBond')
        @endforeach

        </tbody>
        {{$bonds->links()}}
    </table>
</div>
