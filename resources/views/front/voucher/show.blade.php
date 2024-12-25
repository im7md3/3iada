@extends('front.layouts.front')
@section('title')
{{ $show->description }}
@endsection
@section('content')
<section class="main-section">
  <div class="container">
    <h4 class="main-heading mb-4">
      عرض سند قيد
    </h4>
    <div class="p-3 shadow rounded-3 bg-white">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3" id="prt-content">
        <div class="col">
          <label class="small-label" for="description">{{ __('Statement') }}</label>
          <input disabled type="text" class="form-control" id="description" name="description"
            value="{{ old('description', $show->description) }}">
        </div>
        <div class="col">
          <label class="small-label" for="date">التاريخ</label>
          <input disabled type="text" class="form-control" id="date" name="date" value="{{ old('date', $show->date) }}">
        </div>
        @foreach ($show->accounts as $account)
        <div class="col">
          <label class="small-label" for="account">الحساب</label>
          <input disabled type="text" class="form-control" id="account" name="account"
            value="{{ old('account', $account->account?->name) }}">
        </div>
        <div class="col">
          <label class="small-label" for="debit">{{ __('debtor') }}</label>
          <input disabled type="text" class="form-control" id="debit" name="debit"
            value="{{ old('debit', $account->debit) }}">
        </div>
        <div class="col">
          <label class="small-label" for="credit">{{ __('creditor') }}</label>
          <input disabled type="text" class="form-control" id="credit" name="credit"
            value="{{ old('credit', $account->credit) }}">
        </div>
        <div class="col">
          <label class="small-label" for="description">الشرح</label>
          <input disabled type="text" class="form-control" id="description" name="description"
            value="{{ old('description', $account->description) }}">
        </div>
        @endforeach
      </div>
      <hr>
      <h6 class="my-3">الحسابات</h6>
      <div class="row row-cols-1 row-cols-sm-2 g-3 mb-4">
        <div class="col">
          <label class="small-label" for="total">مجموع مدين</label>
          <input disabled type="text" class="form-control" id="total" name="total"
            value="{{ old('total', $show->debit) }}">
        </div>
        <div class="col">
          <label class="small-label" for="total">مجموع دائن</label>
          <input disabled type="text" class="form-control" id="total" name="total"
            value="{{ old('total', $show->credit) }}">
        </div>
      </div>
      <div class="text-center">

        <button type="button" class="btn btn-sm btn-warning" id="btn-prt-content">طباعة <i class="fas fa-print"></i></button>
      </div>
    </div>
  </div>
</section>
@endsection
