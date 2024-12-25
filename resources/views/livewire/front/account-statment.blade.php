<section class="main-section">
    <div class="container">
        <div class="bg-white p-3 rounded-2 shadow">
            <div class="d-flex mb-3">
                    <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </div>
                <h4 class="main-heading">{{ __('Account statement') }}</h4>
            <div class="btn-holder d-flex align-items-center justify-content-end mb-2">
                <button class="btn btn-sm btn-info">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>تصدير Excel</span>
                </button>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Account type') }}</label>
                        <select wire:model='filter_account' id="" class="main-select w-100">
                            @foreach ($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Account number') }}</label>
                        <input type="number" name="" id="" class="form-control">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Account name') }}</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('From the date of') }}</label>
                        <input type="date" name="" id="" class="form-control" wire:model='filter_start_date'>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('To date') }}</label>
                        <input type="date" name="" id="" class="form-control" wire:model='filter_end_date'>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Previous balance') }}</label>
                        <input type="number" name="" id="" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Seller') }}</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>{{ __('Seller') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Account') }}</th>
                            <th>{{ __('Cost Center') }}</th>
                            <th>{{ __('Statement') }}</th>
                            <th>
                                {{ __('debtor') }}
                            </th>
                            <th>
                                {{ __('creditor') }}
                            </th>
                            {{-- <th>{{ __('Balance') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $item)
                        <tr>

                            {{-- <td>قيد يومية</td> --}}
                            <td>{{ $item->user?->name ?? '--' }}</td>
                            <td>{{ $item->voucher?->date ?? '--' }}</td>
                            <td>{{ $item->account?->name ?? '--' }}</td>
                            <td>{{ $item->costCenter?->name ?? '--' }}</td>
                            <td>
                                {{ $item->description }}
                            </td>
                            <td>
                                {{ $item->debit }}
                            </td>
                            <td>
                                {{ $item->credit }}

                            </td>
                            {{-- <td></td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
