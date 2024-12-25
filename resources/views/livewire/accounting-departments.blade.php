<section class="main-section">
    <div class="container">
        <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
            <i class="fas fa-angle-right"></i>
        </a>
        <h4 class="main-heading">{{ __('accounting management') }}</h4>
        <div class="bg-white shadow p-4 rounded-3">            
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('service')</th>
                            <th>@lang('Account')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $key => $accountId)
                            <tr>
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>
                                    {{ $key == 'unpaid' ? __('Deferred to the patient') : __('admin.' . $key) }}
                                </td>
                                <td>
                                    <select wire:change='submit' wire:model='departments.{{ $key }}'
                                        id="" class="main-select w-100">
                                        <option value="">@lang('Choose account')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
