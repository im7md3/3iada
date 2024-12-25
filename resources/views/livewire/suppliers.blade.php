    <div class="container py-4">
        <h1 class="mb-4">الموردين</h1>

        <div class="card">
            <div class="card-body">
                @if($screen !== 'index')
                    <h3 class="card-title mb-4">اضافة مورد</h3>
                    <form wire:submit.prevent="submit">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" wire:model="name" id="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input type="text" wire:model="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="building_no" class="form-label">رقم المبني</label>
                                <input type="text" wire:model="building_no" id="building_no" class="form-control @error('building_no') is-invalid @enderror">
                                @error('building_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city_id" class="form-label">المدينة</label>
                                <select wire:model="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror">
                                    <option value="">Select a city</option>
                                    @foreach(App\Models\City::get() as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tax_no" class="form-label">الرقم الضريبي</label>
                                <input type="text" wire:model="tax_no" id="tax_no" class="form-control @error('tax_no') is-invalid @enderror">
                                @error('tax_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ $obj ? 'تعديل' : 'اضافة' }} مورد
                            </button>
                            <button type="button" wire:click="cancelCreate" class="btn btn-secondary ms-2">
                                Cancel
                            </button>
                        </div>
                    </form>
                @else
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="card-title">قائمة الموردين</h3>
                        <button wire:click="$set('screen','create')" class="btn btn-primary">
                            اضافة مورد
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الهاتف</th>
                                <th>المدينة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->city->name }}</td>
                                    <td>
                                        <button wire:click="edit({{ $supplier->id }})" class="btn btn-sm btn-outline-primary me-2">تعديل</button>
                                        <button wire:click="deleteConfirm({{ $supplier->id }})" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $suppliers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('swal:confirm', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                   @this.call('delete',event.detail.id)
                }
            });
        });
    </script>
@endpush
