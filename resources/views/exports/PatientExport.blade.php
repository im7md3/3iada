<table class="table main-table" id="data-table">
    <thead>
        <tr>
            <th>{{ __('admin.Invoice no.') }}</th>
            <th>{{ __('admin.patient') }}</th>
            <th>{{ __('admin.dr') }}</th>
            <th>{{ __('admin.department') }}</th>
            <th>{{ __('admin.Date') }}</th>
            <th>{{ __('admin.amount') }}</th>
            <th>{{ __('admin.tax') }}</th>
            <th>{{ __('admin.Total') }}</th>
            <th>{{__("admin.Status")}}</th>
            <th>{{ __('admin.Total with tax') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
        <tr>
            <td>{{ $invoice->id }}</td>
            <td>{{ $invoice->patient->name }}</td>
            <td>{{ $invoice->dr ? $invoice->dr->name : 'لا يوجد' }}</td>
            <td>{{ $invoice->department ? $invoice->department->name : 'لا يوجد' }}</td>
            <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
            <td>{{ $invoice->amount }}</td>
            <td>{{ $invoice->tax }}</td>
            <td>{{ $invoice->total }}</td>
            <td>{{ __($invoice->status) }}</td>
            <td>{{ $invoice->total + $invoice->tax }}</td>
        </tr>
        @endforeach

        <tr>
            <td>{{ __('admin.Sum') }}</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>{{ $invoices->sum('amount') }}</td>
            <td>{{ $invoices->sum('tax') }}</td>
            <td>{{ $invoices->sum('total') }}</td>
            <td>-</td>
            <td>{{ $invoices->sum('total') + $invoices->sum('tax') }}</td>
        </tr>

    </tbody>
</table>