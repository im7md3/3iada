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
                @foreach ($invoices as $invoice)
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
                @endforeach
            </tbody>
        </table>
    </div>
@endif
