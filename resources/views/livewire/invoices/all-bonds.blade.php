<section class="bills-section main-section pt-4">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.bonds') }} </h4>
        <div class="bills-content bg-white p-4 rounded-2 shadow">
            <div class="row mb-3">
                <div class="col-12 col-md-2">
                    <div class="info-data">
                        <label for="duration-from" class="billData-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="info-data">
                        <label for="duration-to" class="billData-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Invoice no.') }}</th>
                            <th>{{ __('employee') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.dr') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.amount paid') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                            <th>الاجمالي مع الضريبة</th>
                            <th>{{ __('admin.rest') }}</th>
                            <th>طريقة الدفع</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bonds as $bond)
                            <tr>
                                <td>
                                    <a href="{{ route('front.invoices.show', $bond->invoice?->id ?? 'test') }}" title="عرض"
                                        class="btn btn-sm btn-purple">
                                        {{ $bond->invoice?->id }}
                                    </a>
                                </td>
                                <td>{{ $bond->user->name }}</td>
                                <td>{{ $bond->invoice?->patient?->name }}</td>
                                <td>{{ $bond->invoice?->dr ? $bond->invoice?->dr->name : 'لا يوجد' }}</td>
                                <td>{{ $bond->created_at->format('Y-m-d') }}</td>
                                <td>{{ $bond->amount }}</td>
                                <td>{{ $bond->tax }}</td>
                                <td>{{ $bond->tax + $bond->amount }}</td>
                                <td>{{ $bond->rest }}</td>
                                <td>{{ __($bond->payment_method) }}</td>
                                <td>{{ __($bond->status) }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                    {{$bonds->links()}}
                </table>
            </div>
        </div>
    </div>
</section>
