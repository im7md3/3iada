<section class="p-3">
    <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2">{{ __('Radiation Name') }}</label>
        <select wire:model.defer="scan_name_id" class="form-control">
            <option value="">{{ __('Select Radiation Name') }}</option>
            @foreach ($scan_names as $scan_name)
                <option value="{{ $scan_name->id }}">{{ $scan_name->name }}</option>
            @endforeach
        </select>
    </section>
    <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2">{{ __('Doctor disclosure') }}</label>
        <textarea class="form-control" rows="3" wire:model.defer="dr_content"></textarea>
    </section>

    <button class="btn btn-sm btn-primary" wire:click='scan_request'>{{ __('Save') }}</button>

    <section class="table-responsive mt-4">
        <table class="table main-table m-0">
            <thead>
                <tr>
                    <th>{{ __('Radiation Name') }}</th>
                    <th>{{ __('Radiation date') }}</th>
                    <th>{{ __('Date of receipt') }}</th>
                    <th class="text-center not-print">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patient->scanRequests as $scan)
                    <tr>
                        <td>{{ $scan->scan_name?->name }}</td>
                        <td>{{ $scan->created_at->format('Y-m-d') }}</td>
                        <td>{{ $scan->delivered_at }}</td>
                        <td>
                            <div class="btn_holder d-flex align-items-center justify-content-center gap-2">
                                @if ($scan->file)
                                    <a target="_blank" href="{{ display_file($scan->file) }}"
                                        class="btn btn-sm btn-info text-white">
                                        تحميل الأشعة
                                    </a>
                                @endif

                                <button class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#delete_file{{ $scan->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Delete File -->
                    <div class="modal fade" id="delete_file{{ $scan->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>


                                <div class="modal-body">
                                    {{ __('admin.are sure of the deleting process?') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-primary"
                                        data-bs-dismiss="modal">{{ __('admin.No') }}</button>
                                    <button class="btn btn-sm  btn-danger" data-bs-dismiss="modal"
                                        wire:click='delete_file({{ $scan }})'>{{ __('admin.Yes') }}</button>
                                </div>

                            </div>

                        </div>
                    </div>
                @empty
                @endforelse
            </tbody>
        </table>
    </section>
</section>
