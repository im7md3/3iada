<div class="modal fade" id="add_or_update" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="inp_holder mb-3">
          <label for="name" class="small-label mb-1">{{ __('admin.name') }}</label>
          <input type="text" wire:model.defer="name" id="name" class="w-100 form-control">
        </div>

        <div class="row">
          <div class="col-12">
            <div class="alert alert-primary d-flex align-items-center" role="alert">
              {{ __('In case the section is specific to the radiation or laboratory can be determined from here')}}
            </div>
          </div>
          <div class="col-12">
            <div class="cot d-flex gap-2">
              <div class="inp_holder mb-3">
                <input id='is_lab' type="checkbox" wire:model="is_lab" />
                <label for="is_lab" class="small-label mb-1">{{ __('lab')}}</label>
                {{-- {{ var_export($appointmentstatus) }} --}}
              </div>
              <div class="inp_holder mb-3">
                <input id="is_scan" type="checkbox" wire:model="is_scan" />
                <label for="is_scan" class="small-label mb-1">{{ __("scan")}}</label>
                {{-- {{ var_export($appointmentstatus) }} --}}
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="alert alert-primary d-flex align-items-center" role="alert">
              {{ __('You can activate the transfer service and appointments')}}
            </div>
          </div>
          <div class="col-12">

            <div class="con d-flex gap-2">
              <div class="inp_holder mb-3">
                <input id="transferstatus" type="checkbox" wire:model="transferstatus"
                  {{ $transferstatus == true ? 'checked':'' }} />
                <label for="transferstatus" class="small-label mb-1">{{ __('admin.Transferable patients') }}</label>
                {{-- {{ var_export($transferstatus) }} --}}
              </div>
              <div class="inp_holder mb-3">
                <input id="appointmentstatus" type="checkbox" wire:model="appointmentstatus"
                  {{ $appointmentstatus == true ? 'checked':'' }} />
                <label for="appointmentstatus" class="small-label mb-1">{{ __('Appointment Status') }}</label>
                {{-- {{ var_export($appointmentstatus) }} --}}
              </div>
            </div>
          </div>
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
