<section class=" main-section pt-4">
    <div class="container">
        <div class="d-flex mb-3">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <div class="d-flex align-items-center">
            <h4 class="main-heading mb-4">{{ __('Prescriptions')}}</h4>
        </div>
        <div class=" bg-white p-3 rounded-2 shadow">
            <div class="left-holder d-flex justify-content-end m-sm-0">
                <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('admin.print') }}</span>
                </button>
                <button class="btn btn-sm btn-outline-info" wire:click='export'>
                    <i class="fa-solid fa-file-excel"></i>
                    <span>{{ __('admin.Export') }} Excel</span>
                </button>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" id="duration-from" wire:model='from' />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model='to' id="duration-to" />
                    </div>
                </div>
            </div>
            <div id="prt-content">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table" id="data-table">
                        <thead>
                            <tr>
                                <th>{{ __('Patient') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('section') }}</th>
                                <th>{{ __('the Doctor') }}</th>
                                <th>{{ __('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prescriptions as $item)
                            <tr>
                                <td>{{ $item->diagnose?->patient?->name ?? '--' }}</td>
                                <td>{{ $item->created_at->format('Y-m-d')}}</td>
                                <td>{{ $item->created_at->format('h:i A')}}</td>
                                <td>{{$item->diagnose?->department?->name ?? '--'}}</td>
                                <td>{{$item->diagnose?->dr?->name ?? '--'}}</td>
                                <td class="not-print d-flex align-items-center justify-content-center gap-1">
                                    <a class="btn btn-sm btn-purple" href="{{ route('front.diagnoses.show_prescription',$item->id) }}"><i class="fa-solid fa-eye"></i></a>
                                    {{-- <button class="btn btn-sm btn-info">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-can"></i>
                                    </button> --}}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
