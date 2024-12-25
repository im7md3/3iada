@if(setting()->new_invoice_form)
@include('livewire.invoices.form2')
@else
@include('livewire.invoices.form1')
@endif
<a class="btn btn-info  mx-auto d-block w-fit not-print mb-3" href="javascript:print()">{{ __('print')}}</a>