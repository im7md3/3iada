<div class="d-flex gap-2 mb-2 justify-content-end">
    <button wire:click="$set('screen','edit_report')" class="btn btn-sm btn-success btn-sm">@lang('Add a report')</button>
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
                        <a wire:click="editReport({{$report->id}})"  class="btn btn-sm btn-info text-white">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button wire:click='showReport({{$report->id}})' class="btn btn-sm btn-purple">
                            <i class="fa fa-eye"></i>
                        </button>
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
