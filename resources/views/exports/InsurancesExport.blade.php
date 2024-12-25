<table class="table main-table">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('admin.patient') }}</th>
            <th>{{ __('admin.Date') }}</th>
            <th>{{ __('admin.insurance') }}</th>
            <th>{{ __('admin.Invoice no.') }}</th>
            <th>{{ __('admin.total') }}</th>
            <th>{{ __('admin.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $invoice->patient?->name }}</td>
                <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                <td>{{ $invoice->patient?->insurance?->name }}</td>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->total }}</td>
                <td>
                    <a target="_blank" href="{{ route('front.invoices.show', $invoice) }}"
                        class="btn btn-sm btn-purple">
                        <i class="fa fa-eye"></i>
                    </a>

                    @can('delete_invoices')
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete_agent{{ $invoice->id }}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                        @include('front.invoice.delete')
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>