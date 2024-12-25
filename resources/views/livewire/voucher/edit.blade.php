<section id="app" class="main-section">
    <div class="container">
        <h4 class="main-heading mb-4">
            {{ $voucher->id }} تعديل سند قيد
        </h4>
        <div class="p-3 shadow rounded-3 bg-white">
            <x-message-admin />
            <form action="" method="POST">
                <div class="row g-3 mb-3">
                    {{-- <div class="col-12 col-md-3">
                        <input wire:model="voucher_description" type="text" class="form-control" placeholder="الشرح البيان" name="" id="">
                    </div> --}}
                    <div class="col-12 col-md-3">
                        <input wire:model.defer="date" type="date" class="form-control" name="" id="">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-inp">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">مسلسل</th>
                                <th scope="col">التحكم</th>
                                <th scope="col">الحساب</th>
                                <th scope="col">مركز التكلفة</th>
                                <th scope="col">البائع</th>
                                <th scope="col">{{ __('debtor') }}</th>
                                <th scope="col">{{ __('creditor') }}</th>
                                <th scope="col">الشرح</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($accounts)
                            @foreach ($accounts as $key => $account)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-holder d-flex gap-1 justify-content-center">
                                        <button class="btn btn-sm btn-success xs-btn-icon " type="button" wire:click="addRow">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        @if ($key > 0)
                                        <button class="btn btn-sm btn-danger xs-btn-icon" type="button" wire:click="removeRow({{ $key }})">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    {{-- <select wire:model="accounts.{{ $key }}.parent_account_id" id="" class="main-select w-100 mb-2" wire:change="getAccounts({{ $key }},$event.target.value)">
                                    <option value="">اختر الحساب الفرعي</option>
                                    @foreach ($parent_accounts as $acc)
                                    <option value="{{ $acc->id }}">{{ $acc->name }}</option>
                                    @endforeach
                                    </select> --}}


                                    {{-- @dd($accounts) --}}
                                    {{-- <input type="text" class="form-control" wire:model='accounts.{{ $key }}.search'> --}}
                                    <div wire:ignore style="width:200px">
                                        <select data-pharaonic="select2" data-component-id="{{ $this->id }}" id="select{{ $key }}" wire:model="accounts.{{ $key }}.account_id">
                                            @foreach ($all_accounts as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <select wire:model="accounts.{{ $key }}.account_id" id="" class="main-select w-100">
                                    <option value="">{{ __('Choose account') }}</option>

                                    @foreach ($all_accounts as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    </select> --}}
                                </td>
                                <td>
                                    <div wire:ignore style="width:200px">
                                        <select data-pharaonic="select2" data-component-id="{{ $this->id }}" id="center{{ $key }}" wire:model="accounts.{{ $key }}.cost_center_id">
                                            @foreach ($cost_centers as $center)
                                            <option value="{{ $center->id }}">{{ $center->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div wire:ignore style="width:200px">
                                        <select data-pharaonic="select2" data-clear data-component-id="{{ $this->id }}" id="" wire:model="accounts.{{ $key }}.user_id">
                                            <option value="">اختر موظف</option>
                                            @foreach ($users as $id => $username)
                                            <option value="{{ $id }}">{{ $username }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input required wire:model="accounts.{{ $key }}.debit" type="text" class="form-control" wire:keyup='computeAll' id="" {{ $accounts[$key]['credit'] ? 'readonly' : '' }}>
                                </td>
                                <td>
                                    <input required wire:model="accounts.{{ $key }}.credit" type="text" class="form-control" wire:keyup='computeAll' id="" {{ $accounts[$key]['debit'] ? 'readonly' : '' }}>
                                </td>
                                <td>
                                    <input required wire:model="accounts.{{ $key }}.description" type="text" class="form-control" id="">
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">الإجمالي</td>
                                <td class="bg-light-green">{{ $totalDebit + $debit }}</td>
                                <td class="bg-light-green"> {{ $totalCredit + $credit }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="holder-btn text-center">
                    <button type="button" wire:click='submit' class="btn btn-sm btn-primary px-3">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@push('js')
<x:pharaonic-select2::scripts />
@endpush
