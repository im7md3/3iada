<section class="p-3">
    <div wire:ignore style="width:100%">
        <select data-pharaonic="select2" data-component-id="{{ $this->id }}" id="select"
            wire:model="prescription_id">
            @foreach ($all_prescriptions as $prescription)
                <option value="{{ $prescription->id }}">{{ $prescription->name }}</option>
            @endforeach
        </select>
    </div>

    @if (count($prescriptions) > 0)
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم العلمي</th>
                        <th>القوة</th>
                        <th>{{ __('Notes') }}</th>
                        <th>{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prescriptions as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['strength'] }}</td>
                            <td><input type="text" name="prescriptions.{{ $index }}.notes"
                                    class="form-control">
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button class="btn btn-sm btn-danger" type="button"
                                        wire:click="removePrescription({{ $index }})">
                                        <i class="fas fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="btn-holder text-center">
            <button class="btn btn-success w-25" wire:click="savePrescription">
                {{ __('admin.Save') }}
            </button>
        </div>
    @endif
</section>
