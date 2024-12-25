<section class="row row-gap-24 g-2">
  <div class="col-12">
  <div class="alert alert-warning mb-1" role="alert">
    {{ __('You can add a patient review appointment') }}
  </div>
  @if($selected_appointment->child()->count()>0)
  <div class="alert alert-success mb-0" role="alert">
    {{ __('Have already added a review date.') }}
  </div>
  @ifelse
  </div>

  <div class="col-12">
    <div class="form-group">
      <label for="appointment_time" class="small-label mb-2">{{ __('Period') }}</label>
      <select wire:model="review_duration" id="" class="form-control">
        <option value="">{{ __('admin.Period') }}</option>
        <option value="morning">{{ __('admin.morning') }}</option>
        @if(setting()->evening_status)
        <option value="evening">{{ __('admin.evening') }}</option>
        @endif
      </select>
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <label for="appointment_date" class="small-label mb-2">{{ __('Review date') }}</label>
      <input type="date" wire:model.defer="review_date" id="review_date" class="form-control">
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <label for="appointment_time" class="small-label mb-2">{{ __('admin.appointment_time') }}</label>
      <select wire:model.defer="review_time" id="" class="form-control">
        <option value="">{{ __('admin.appointment_time') }}</option>
        @foreach ($times as $time)
        @if (!in_array($time, $reservedTimes))
        <option value="{{ $time }}">{{ date('G:iA', strtotime($time)) }}</option>
        @endif
        @endforeach
      </select>
    </div>
  </div>
  
  <div class="col-12 d-flex justify-content-end">
    <button wire:click='review' class="btn btn-sm trans-btn w-25">
    {{ __('Confirm') }}
    </button>
  </div>
  @endif
</section>
