<div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{ $patientGroup ?  __('Edit') :  __('Add') }} {{ __('group') }}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="inp_holder mb-3">
                    <label for="name" class="small-label mb-1">{{ __('admin.name') }}</label>
                    <select wire:model.defer='product_id' class="form-control" id="">
                        <option value="">أختر الخدمة</option>
                        @forelse ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @empty
                        <option disabled value="">لا يوجد خدمات</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="modal-body">
                <div class="inp_holder mb-3">
                    <label for="rate" class="small-label mb-1">{{ __('admin.rate') }}</label>
                    <input type="text" wire:model.defer="rate" id="rate" class="w-100 form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='save'>{{ __('admin.Save') }}</button>
            </div>

        </div>

    </div>
</div>
