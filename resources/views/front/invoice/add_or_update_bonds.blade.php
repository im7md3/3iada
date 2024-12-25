<div class="modal fade" id="add_or_update_bonds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <div class="collectData-box mb-2">
                    <label for="invoice_id" class="small-label mb-1">{{ __('admin.Invoice no.') }}</label>
                    <input readonly type="text" wire:model.defer="invoice_id" id="invoice_id"
                        class="w-100 form-control">
                </div>
                <div class="collectData-box mb-2">
                    <label for="patient" class="small-label mb-1">{{ __('admin.patient') }}</label>
                    <input type="text" readonly wire:model="patient" id="patient" class="w-100 form-control">
                </div>
                <div class="collectData-box mb-2">
                    <label for="invoice_rest" class="small-label mb-1">{{ __('admin.rest') }}</label>
                    <input type="text" readonly wire:model="invoice_rest" id="invoice_rest"
                        class="w-100 form-control">
                </div>
                <div class="collectData-box mb-2">
                    <label for="amount" class="small-label mb-1">{{ __('admin.amount') }}</label>
                    <input type="text" wire:model="amount" id="amount" class="w-100 form-control">
                </div>
                <div class="collectData-box mb-2">
                    <label for="tax" class="small-label mb-1">{{ __('admin.tax') }}</label>
                    <input type="text" disabled wire:model="tax" id="tax" class="w-100 form-control">
                </div>

                <div class="collectData-box mb-2">
                    <label for="payment_method" class="small-label mb-1">طريقة الدفع/الارجاع</label>
                    <select wire:model="payment_method" id="payment_method" class="w-100 form-control">
                        <option value="">اختر طريقة الدفع</option>
                        <option value="cash">نقدا</option>
                        <option value="card">شبكة</option>
                        @if (setting()->active_tamara)
                            <option value="tmara">{{ __('Tamara') }}</option>
                        @endif
                        @if (setting()->active_tabby)
                            <option value="tab">{{ __('Tabby') }}</option>
                        @endif
                        <option value="bank">{{ __('Bank transfer') }}</option>
                    </select>
                </div>
                <div class="collectData-box mb-2">
                    <label for="status" class="small-label mb-1">{{ __('Status') }}</label>
                    <select wire:model="status" id="status" class="w-100 form-control">
                        <option value="creditor">{{ __('creditor') }}</option>
                        <option value="debtor">{{ __('debtor') }}</option>
                    </select>
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
