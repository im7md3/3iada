<section class="main-section ">
    <div class="container">
        <h4 class="main-heading mb-4">الوقت الاضافي</h4>

        <div class="section-content p-4 shadow bg-white">
            <button class="btn btn-primary mb-3"
                wire:click="$set('screen','salaries')">{{ __('admin.Salaries') }}</button>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.Month') }}</th>
                            <th>{{ __('admin.employee') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('amount') }}</th>
                            <th>{{ __('admin.reason') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_overtimes as $overtime)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td scope="row">{{ __('admin.Month') }} {{ now()->format('m') }}</td>
                                <td>{{ $overtime->user->name }}</td>
                                <td>{{ $overtime->date }}</td>
                                <td>{{ $overtime->amount }}</td>
                                <td>{{ $overtime->reason }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $all_overtimes->links() }}
            </div>

        </div>
    </div>
</section>
