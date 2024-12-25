<div class="form">
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">
                {{ $cost_center->name }}
            </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label class="form-label">بحث بالوصف</label>
                        <input type="text" wire:model="search" class="form-control" placeholder="@lang('admin.search')">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label class="form-label">بحث برقم القيد</label>
                        <input type="text" wire:model="voucher_id" class="form-control" placeholder="رقم القيد">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label class="form-label">@lang('admin.from')</label>
                        <input type="date" wire:model="from" class="form-control">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label class="form-label">@lang('admin.to')</label>
                        <input type="date" wire:model="to" class="form-control">
                    </div>
                </div>
            </div>

            @if ($voucher_accounts->count() > 0)
                <table class="table table-bordered text-center mt-3">
                    <thead class="table-light">
                        <th>#</th>
                        <th>@lang('admin.date')</th>
                        <th width="30%">@lang('admin.description')</th>
                        <th>رقم القيد</th>
                        <th>@lang('admin.debit')</th>
                        <th>@lang('admin.credit')</th>
                        <th>@lang('admin.balance')</th>
                    </thead>
                    <tbody>
                        @php
                            $balance = 0;
                            $debitTotal = 0;
                            $creditTotal = 0;
                        @endphp
                        @foreach ($voucher_accounts as $index => $item)
                            @php
                                $balance += $item->debit - $item->credit;
                                $debitTotal += $item->debit;
                                $creditTotal += $item->credit;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->voucher?->date }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <strong>
                                        <a target="_blank"
                                            href="{{ route('vouchers.show', $item->voucher->id) }}">{{ $item->voucher?->id }}</a>
                                    </strong>
                                </td>
                                <td>{{ number_format($item->debit, 2) }}</td>
                                <td>{{ number_format($item->credit, 2) }}</td>
                                <td>{{ number_format($balance, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="table-light" colspan="4"><strong>الإجمالي</strong></th>
                            <th>{{ number_format($debitTotal, 2) }}</th>
                            <th>{{ number_format($creditTotal, 2) }}</th>
                            <th>{{ number_format($balance, 2) }}</th>

                        </tr>
                    </tfoot>
                </table>
            @else
                <div class="alert alert-danger"> لا يوجد بيانات</div>
            @endif
        </div>
    </div>
</div>
