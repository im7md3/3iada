<section class="main-section users">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __("$screen Requests") }}</h4>
        <div class="section-content bg-white shadow rounded-3 p-4">


            <div class="d-flex align-items-center flex-wrap justify-content-end mb-2 gap-2">


                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('Status') }}</label>
                        <select wire:model="status" class="form-control" id="status">
                            <option value="">{{ __('All') }}</option>
                            <option value="pending">{{ __('pending') }}</option>
                            <option value="done">{{ __('done') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Show appointments') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            {{-- <th>{{ __('admin.name') }}</th> --}}
                            <th>{{ __('admin.dr') }}</th>
                            <th>{{ __('Technical') }}</th>
                            <th>{{ __('file') }}</th>
                            <th>{{ __('Status') }}</th>
                            {{-- <th class="text-center">{{ __('admin.managers') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->appointment_id }}</td>
                            <td>{{ $item->patient?->name }}</td>
                            <td>{{ $item->appointment?->doctor?->name }}</td>
                            <td>{{ $item->technical?->name}}</td>
                            <td>
                                @if($item->file)
                                <a href="{{ display_file($item->file) }}">تنزيل الملف</a>
                                @else
                                --
                                @endif
                            </td>
                            <td><span class="badge bg-{{ $item->status == 'pending' ? 'warning' : 'success' }}">{{ __($item->status) }}</span></td>

                            {{-- <td>
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button data-bs-toggle="modal" data-bs-target="#add_or_update" class="btn btn-sm btn-info text-white ms-1" wire:click='edit({{ $scan_name }})'>
                            <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $scan_name->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>

            </div>
            </td> --}}
            </tr>
            {{-- @include('front.scan_names.delete')  --}}
            @endforeach
            </tbody>
            </table>
            {{-- {{ $data->links() }}--}}
        </div>
    </div>
    <!-- All Modal -->
    <!-- Modal repeat -->

    </div>
</section>
