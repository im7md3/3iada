<section class="main-section">

    <div class="container">
        <div class="p-3 shadow rounded-3 bg-white">
            <div class="d-flex align-items-center gap-3 mb-3">
                <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </a>
                <h4 class="main-heading mb-0">
                    @lang('Trial Balance')
                </h4>
            </div>
            <x-message-admin />

            <div class="d-flex align-items-end justify-content-between mb-2">
                <div class="d-flex gap-2">
                    <div class="box-info">
                        <label for="duration-from" class="small-label">{{ __('Year') }}</label>
                        <select wire:model='date' id="date" class="main-select w-100">
                            @for ($i = 0; $i < 15; $i++)
                                @php
                                    $current = Carbon\Carbon::now()->subYears(5)->format('Y') + $i;
                                @endphp
                                <option value="{{ $current }}">
                                    {{ $current }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="box-info">
                        <label for="duration-to" class="small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-to" />
                    </div>
                    <div class="box-info">
                        <label for="duration-to" class="small-label">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-warning" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" wire:click='resetFromTo'>{{ __('Reset') }}</button>
                </div>
            </div>


            <div class="table-responsive" id="prt-content">
                <table class="table main-table" dir="rtl">
                    <thead>
                        <tr>
                            <th rowspan="2" class="border pb-4">رقم الحساب</th>
                            <th rowspan="2" class="border pb-4">اسم الحساب</th>
                            <th colspan="2" class="border">الرصيد الافتتاحي</th>
                            <th colspan="2" class="border">الحركة السنوية</th>
                            <th rowspan="2" class="border pb-4">الرصيد</th>
                        </tr>
                        <tr>
                            <th class="border">
                                مدين
                            </th>
                            <th class="border">
                                دائن
                            </th>
                            <th class="border">
                                مدين
                            </th>
                            <th class="border">
                                دائن
                            </th>
                        </tr>

                    </thead>
                    <tbody>
                        @php
                            $to = \Carbon\Carbon::parse($to)->endOfDay();

                            function applyDateFilter($query, $from, $to)
                            {
                                if ($from && $to) {
                                    $query->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                                } elseif ($from) {
                                    $query->where('created_at', '>=', $from);
                                } elseif ($to) {
                                    $query->where('created_at', '<=', $to);
                                }
                                return $query;
                            }

                            function renderNestedAccounts($assets, $from, $to)
                            {
                                foreach ($assets as $asset) {
                                    $open_debit = applyDateFilter($asset->vouchersAccounts()->where('voucher_id', 1)->get(), $from, $to)->sum('debit');
                                    $open_credit = applyDateFilter($asset->vouchersAccounts()->where('voucher_id', 1)->get(), $from, $to)->sum('credit');
                                    $debit = applyDateFilter($asset->vouchersAccounts(), $from, $to)->sum('debit');
                                    $credit = applyDateFilter($asset->vouchersAccounts(), $from, $to)->sum('credit');
                                    $balance = $debit - $credit;

                                    echo '<tr>';
                                    echo '<td class="border">' . $asset->id . '</td>';
                                    echo '<td class="border">' . $asset->name . '</td>';
                                    echo '<td class="border">' . $open_debit . '</td>';
                                    echo '<td class="border">' . $open_credit . '</td>';
                                    echo '<td class="border">' . $debit . '</td>';
                                    echo '<td class="border">' . $credit . '</td>';
                                    echo '<td class="border">' . $balance . '</td>';
                                    echo '</tr>';

                                    if ($asset->subAssets->isNotEmpty()) {
                                        renderNestedAccounts($asset->subAssets, $from, $to);
                                    }
                                }
                            }
                        @endphp

                        @foreach ($accounts as $account)
                            @php
                                $adjustedTo = $to ? \Carbon\Carbon::parse($to)->endOfDay() : null;
                                $opening_debit = applyDateFilter($account->vouchersAccounts()->where('voucher_id', 1)->get(), $from, $to)->sum('debit');
                                $opening_credit = applyDateFilter($account->vouchersAccounts()->where('voucher_id', 1)->get(), $from, $to)->sum('credit');
                                $total_debit = applyDateFilter($account->vouchersAccounts(), $from, $to)->sum('debit');
                                $total_credit = applyDateFilter($account->vouchersAccounts(), $from, $to)->sum('credit');
                                $balance = $total_debit - $total_credit;
                            @endphp
                            <tr>
                                <td class="border">{{ $account->id }}</td>
                                <td class="border">{{ $account->name }}</td>
                                <td class="border">{{ $opening_debit }}</td>
                                <td class="border">{{ $opening_credit }}</td>
                                <td class="border">{{ $total_debit }}</td>
                                <td class="border">{{ $total_credit }}</td>
                                <td class="border">{{ $balance }}</td>
                            </tr>

                            @if ($account->subAssets->isNotEmpty())
                                @php
                                    renderNestedAccounts($account->subAssets, $from, $adjustedTo);
                                @endphp
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
