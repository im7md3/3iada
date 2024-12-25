<div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
  wire:ignore.self>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <div class="modal-body">
        <div class="d-flex flex-column mb-2">
          <label for="name" class="small-label mb-1">{{ __('admin.statement') }}</label>
          <input type="text" wire:model.defer="name" id="name" class="w-100 form-control">
        </div>

        <div class="d-flex flex-column mb-2">
          <label for="name" class="small-label mb-1">المورد</label>
            <select class="form-select" wire:model="supplier_id">
                <option>اختر المورد</option>
                @foreach(\App\Models\Supplier::get() as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex flex-column mb-2">
          <label for="amount" class="small-label mb-1">{{ __('admin.amount') }}</label>
          <input type="text" wire:model.defer="amount" id="amount" class="w-100 form-control">
        </div>

        <div class="d-flex flex-column mb-2">
          <label for="date" class="small-label mb-1">{{ __('admin.Date') }}</label>
          <input type="date" wire:model.defer="date" id="date" class="w-100 form-control">
        </div>

        <div class="d-flex flex-column mb-2">
          <label for="tax" class="small-label mb-1">{{ __('admin.Taxes included') }}</label>
          <input type="checkbox" wire:model="tax" id="tax" class="form-check-input ">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
        <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
          wire:click='save'>{{ __('admin.Save') }}</button>
      </div>

    </div>

  </div>
</div>
