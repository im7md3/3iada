<section class="main-section home">
    <div class="container">
        <h4 class="main-heading">{{ __('Doctors') }}</h4>
        <h4 class="small-heading mb-3">{{ __('Doctors Details') }}</h4>
        <div class="row mb-5">
            <div class="col-md-4 d-flex gap-3">
                <input type="date" name="from" wire:model="from" class="form-control" id="from">
                <input type="date" name="to" wire:model="to" class="form-control" id="to">
            </div>
        </div>
        <div class="row g-3 mb-4 boxes-info">
            @foreach ($users as $doctor)
            @php
            $query = $doctor->appointments()->where(function($q) use ($from,$to){
            if($from && $to){
            $q->whereBetween('appointment_date',[$from,$to]);
            }elseif($from){
            $q->whereDate('appointment_date', $from);
            }else{
            $q->whereDate('appointment_date', date('Y-m-d'));
            }
            });

            @endphp
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center ">
                        <h4 class="text-info">الطبيب</h4>
                        <h5>{{ $doctor->name }}</h5>
                        <h6><span class="text-danger">القسم : </span>{{ $doctor->department?->name }}</h6>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p><strong class="text-primary">مواعيد اليوم : </strong> {{ $query->where('appointment_status', 'confirmed')->count() }} </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong class="text-warning">صالة الإنتظار : </strong> {{ $query->where('appointment_status', 'confirmed')->count() }} </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong class="text-gray">مواعيد المراجعة : </strong> {{ $query->where('review',1)->count() }} </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong class="text-danger">تم الكشف : </strong> {{ $query->where('appointment_status', 'examined')->count() }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
