<div class="modal fade" id="edit{{ $request->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">اسم الأشعة</label>
                            <input type="text" disabled wire:model="scan_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">شرح الطبيب</label>
                            <textarea disabled wire:model="dr_content" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">وصف نتيجة الأشعة</label>
                            <textarea wire:model="scan_content" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                   {{--  <div class="col-md-6">
                        <div class="form-group">
                            <label for="">تاريخ الفحص</label>
                            <input type="date" wire:model="scanned_at" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">تاريخ التسليم</label>
                            <input type="date" wire:model="delivered_at" class="form-control">
                        </div>
                    </div> --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">إرفاق ملف</label>
                            <input type="file" wire:model="file" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                    wire:click='submit'>{{ __('admin.Yes') }}</button>
            </div>

        </div>

    </div>
</div>
