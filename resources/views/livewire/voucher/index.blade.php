@section('title')
سندات القيض
@endsection
<section class="main-section">
  <div class="container">
    <div class="p-3 shadow rounded-3 bg-white">
      <div class="d-flex mb-3">
        <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
          <i class="fas fa-angle-right"></i>
        </a>
      </div>
      <h4 class="main-heading mb-4">
        سندات القيد
      </h4>
      <x-message-admin />
      <div class="d-flex align-items-center justify-content-end mb-2">
        <a href="{{ route('front.vouchers.create') }}" class="btn-main-sm">
          <i class="fas fa-plus"></i> اضافة سند قيد
        </a>
      </div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3 mb-3">
        <div class="col-12">
          <div class="info-data">
            <label for="search" class="small-label">بحث</label>
            <input type="text" class="form-control" wire:model="search" id="search" />
          </div>
        </div>
        <div class="col">
          <div class="info-data">
            <label for="voucher_no" class="small-label">رقم السند</label>
            <input type="text" class="form-control" wire:model="voucher_no" id="voucher_no" />
          </div>
        </div>
        <div class="col">
          <div class="info-data">
            <label for="duration-from" class="small-label">{{ __('admin.from') }}</label>
            <input type="date" class="form-control" wire:model="from" id="duration-from" />
          </div>
        </div>
        <div class="col">
          <div class="info-data">
            <label for="duration-to" class="small-label">{{ __('admin.to') }}</label>
            <input type="date" class="form-control" wire:model="to" id="duration-to" />
          </div>
        </div>
        <div class="col">
          <div class="info-data">
            <label for="employee_id" class="small-label">{{ __('Employees') }}</label>
            <select wire:model="employee_id" class="main-select w-100 doctor-name" id="employee_id">
              <option value="">{{ __('Select an Employee') }}</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table main-table">
          <thead>
            <tr>
              <th>#</th>
              {{-- <th>الأسم</th> --}}
              <th>{{ __('debtor') }}</th>
              <th>{{ __('creditor') }}</th>
              <th>التاريخ</th>
              <th>الموظف</th>
              <th>العمليات</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_vouchers as $voucher)
            <tr>
              <td>{{ $voucher->voucher_no }}</td>
              {{-- <td>{{ $voucher->description }}</td> --}}
              <td>{{ $voucher->debit }}</td>
              <td>{{ $voucher->credit }}</td>
              <td>{{ $voucher->date }}</td>
              <td>{{ $voucher->employee?->name }}</td>
              <td>
                <a href="{{ route('front.vouchers.show', $voucher) }}" class="btn btn-sm btn-purple"><i></i>
                  <i class="fa-solid fa-eye"></i>
                </a>
                <a href="{{ route('front.vouchers.edit', $voucher) }}" class="btn btn-sm btn-info"><i></i>
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>

                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                  data-bs-target="#delete_agent{{ $voucher->id }}"><i></i>
                  <i class="fas fa-trash-alt"></i>
                </button>

                @include('livewire.voucher.delete')
                <!-- /.modal -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $all_vouchers->links() }}
      </div>
      <!-- end table-responsive -->
    </div>
  </div>
</section>
