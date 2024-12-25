<div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="collect-box d-flex flex-column mb-2">
                    <label for="name" class="small-label mb-1">{{ __('admin.statement') }}</label>
                    <input type="text" wire:model.defer="name" id="name" class="w-100 form-control">
                </div>
                <div class="collect-box d-flex flex-column mb-2">
                    <label for="amount" class="small-label mb-1">{{ __('admin.amount') }}</label>
                    <input type="text" wire:model.defer="amount" id="amount" class="w-100 form-control">
                </div>

                <div class="collect-box d-flex flex-column mb-2">
                    <label for="main_cat" class="small-label mb-1">{{ __('admin.Main category') }}</label>
                    <select wire:model="main_cat" id="main_cat" class="main-select w-100">
                        <option value="">{{ __('admin.Main category') }}</option>
                        @foreach ($main_cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="collect-box d-flex flex-column mb-2">
                    <label for="category_id" class="small-label mb-1">{{ __('admin.Subcategory') }}</label>
                    <select wire:model.defer="category_id" id="category_id" class="main-select w-100">
                        <option value="">{{ __('admin.Subcategory') }}</option>
                        @foreach ($sub_cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="collect-box d-flex flex-column mb-2">
                    <label for="notes" class="small-label">{{ __('admin.notes') }}</label>
                    <textarea wire:model.defer="notes" id="notes" class="w-100 form-control"></textarea>
                </div>


                <div class="d-flex flex-column mb-2">
                    <label for="tax" class="small-label mb-1">{{ __('admin.Taxes included') }}</label>
                    <input type="checkbox" wire:model="include_tax" id="tax" class="form-check-input ">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                    wire:click='save'>{{ __('admin.Save') }}</button>
            </div>

        </div>

    </div>
</div>
