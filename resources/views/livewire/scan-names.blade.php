<section class="main-section users">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('Scan names') }}</h4>
        <div class="section-content bg-white shadow rounded-3 p-4">
            @include('front.scan_names.add_or_update')
            <div class="d-flex align-items-center flex-wrap justify-content-end mb-2">
                <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                    {{ __('admin.Add') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th class="text-center">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scan_names as $scan_name)
                            <tr>
                                <td>{{ $scan_name->id }}</td>
                                <td>{{ $scan_name->name }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                                            class="btn btn-sm btn-info text-white ms-1"
                                            wire:click='edit({{ $scan_name }})'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete_agent{{ $scan_name->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            @include('front.scan_names.delete')
                        @endforeach
                    </tbody>
                </table>
                {{ $scan_names->links() }}
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->

    </div>
</section>
