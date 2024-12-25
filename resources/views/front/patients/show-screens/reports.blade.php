<div class="d-flex gap-2 mb-2 justify-content-end">
    <button wire:click="$set('screen','edit_report')"
            class="btn btn-sm btn-success btn-sm">@lang('Add a report')</button>
</div>
<div class="table-responsive">
    <table class="table main-table">
        <thead>
        <tr>
            <th>@lang('Number')</th>
            <th>@lang('Send To') </th>
            <th>@lang('Date')</th>
            <th>@lang('Report preparer')</th>
            <th>{{ __('admin.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($reports as $report)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$report->recipient}}</td>
                <td>{{$report->created_at->format('Y-m-d')}}</td>
                <td>{{$report->creator->name}}</td>
                <td>
                    <div class="d-flex align-items-center gap-1 justify-content-center">
                        @can('update_reports')
                            <a wire:click="editReport({{$report->id}})" class="btn btn-sm btn-info text-white">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        @endcan
                        <button wire:click='showReport({{$report->id}})' class="btn btn-sm btn-purple">
                            <i class="fa fa-eye"></i>
                        </button>
                        @can('delete_reports')
                            <button data-bs-target="#delete{{$report->id}}" data-bs-toggle='modal' class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>

                                <div class="modal fade" id="delete{{$report->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('Delete')</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @lang('Are you sure to delete?')
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('close')</button>
                                                <button type="button" wire:click="deleteReport({{$report->id}})" class="btn btn-primary" data-bs-dismiss="modal">@lang('Delete')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endcan

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">@lang('There are no patient reports')</td>
            </tr>

        @endforelse
        </tbody>
    </table>
</div>
