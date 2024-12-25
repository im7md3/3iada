<section class="main-section users">
    <x-alert></x-alert>
    @include('front.patient_groups.discounts.add_or_update')
    <div class="container">
        <div class="d-flex mb-3 align-items-center gap-3">
            <a href="{{ route('front.patient_groups.index') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading mb-0">{{ __('Patient group Discounts : :group',['group'=>$patientGroup?->name]) }}</h4>
        </div>
        <div class="alert alert-info">
            {{ __('The main group discount is applied automatically if there are no discounts for services in the group allocated and vice versa') }}
        </div>
        <div class="section-content bg-white shadow rounded-3 p-4">
            <div class="d-flex align-items-center flex-wrap justify-content-end mb-2">

                @can('create_patient_group_discounts')
                <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update" wire:click='resetForm'>
                    {{ __('admin.Add') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </button>
                @endcan
                <button class="btn btn-sm btn-outline-warning me-2" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('admin.print') }}</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="prt-content">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Product name') }}</th>
                            <th>{{ __('admin.rate') }}</th>
                            {{-- <th>{{ __('admin.count') }}</th> --}}
                            <th class="text-center not-print">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $discount)
                        <tr>
                            <td>{{ $discount->id }}</td>
                            <td>{{ $discount->product?->name }}</td>
                            <td>{{ $discount->rate }} %</td>
                            {{-- <td>{{ $patient_group->patients->count() }}</td> --}}
                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    @can('update_patient_group_discounts')
                                    <button data-bs-toggle="modal" data-bs-target="#add_or_update" class="btn btn-sm btn-info text-white ms-1" wire:click='edit({{ $discount }})'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    @endcan
                                    @can('delete_patient_group_discounts')
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $discount->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @include('front.patient_groups.discounts.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $discounts->links() }}
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->

    </div>
</section>
