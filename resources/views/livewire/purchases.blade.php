<section class="main-section users">
    <!-- @if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-warning">{{ $error }}</div>
@endforeach
@endif -->
    <x-alert></x-alert>
    @include('front.purchases.add_or_update')
    <div class="container">
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex mb-3">
                <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </a>
            </div>
            <h4 class="main-heading">{{ __('admin.Purchases') }}</h4>
            <div class="d-flex align-items-center flex-wrap gap-1 justify-content-end mb-3">
                <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update"
                    wire:click='resetForm'>
                    {{ __('admin.Add a purchase invoice') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </button>
                <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                    <i class="fa-solid fa-print"></i>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="prt-content">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.statement') }}</th>
                            <th>المورد</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.Taxes included') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('Tax rate') }}</th>
                            <th>{{ __('admin.total') }}</th>
                            <th class="text-center not-print">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->id }}</td>
                                <td>{{ $purchase->name }}</td>
                                <td>{{ $purchase->supplier?->name ?? 'لايوجد' }}</td>
                                <td>{{ $purchase->date ? $purchase->date : $purchase->created_at->format('Y-m-d') }}</td>
                                <td>{{ $purchase->tax ? __('Yes') : __('No') }}</td>
                                <td>{{ $purchase->amount - $purchase->tax_value }}</td>
                                <td>{{ $purchase->tax ? $purchase->tax_value : '-' }}</td>
                                <td>{{ $purchase->amount }}</td>
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                                            class="btn btn-sm btn-info text-white ms-1"
                                            wire:click='edit({{ $purchase }})'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete_agent{{ $purchase->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('front.purchases.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->

    </div>
</section>
