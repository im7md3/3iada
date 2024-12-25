<div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


                <div class="modal-body">
                    <div class="alert alert-info">في حالة عدم اختيار قسم رئيسي تكون الفئة رئيسية</div>
                    <div class="collectData-box mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.name') }}</label>
                        <input type="text" wire:model.defer="name" id="" class="w-100 form-control">
                    </div>

                    <div class="collectData-box">
                        <label for="" class="small-label mb-1">القسم الرئيسي</label>
                        <select wire:model.defer="parent" id="" class="w-100 main-select">
                            <option value="">القسم الرئيسي</option>
                            @foreach ($main_cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                    <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='save'>{{ __('admin.Save') }}</button>
                </div>

        </div>

    </div>
</div>
