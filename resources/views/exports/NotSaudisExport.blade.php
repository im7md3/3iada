<table class="table main-table"id="data-table">
    <thead>
        <tr>
            <th>{{ __('admin.Date') }}</th>
            <th>{{ __('admin.Invoice no.') }}</th>
            <th>{{ __('admin.dr') }}</th>
            <th>{{ __('admin.patient') }}</th>
            <th>{{ __('admin.amount') }}</th>
            <th>{{ __('admin.tax') }}</th>
            <th>{{ __('admin.Total') }}</th>
            <th>{{ __('admin.paid') }}</th>
            <th>{{ __('admin.rest') }}</th>
            <th>{{__("admin.Status")}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->dr?->name }}</td>
                <td>{{ $invoice->patient?->name }}</td>
                <td>{{ $invoice->amount }}</td>
                <td>{{ $invoice->tax }}</td>
                <td>{{ $invoice->total }}</td>
                <td>{{ $invoice->paid }}</td>
                <td>{{ $invoice->rest }}</td>
                <td>{{ __($invoice->status) }}</td>
            </tr>
        @endforeach
        <tr>
            <td>{{ __('admin.Sum') }}</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>{{ $invoices->sum('amount') }}</td>
            <td>{{ $invoices->sum('tax') }}</td>
            <td>{{ $invoices->sum('total') }}</td>
            <td>{{ $invoices->Where('status','Paid')->sum('paid') + $invoices->Where('status','Partially Paid')->sum('paid') }}</td>
            <td>{{ $invoices->sum('rest') }}</td>
        </tr>
    </tbody>
</table>