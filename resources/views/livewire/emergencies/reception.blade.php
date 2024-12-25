<section class="main-section">
    <div class="dr-main-section">
        <x-alert></x-alert>
        <div class="container-fluid px-5">
            <h4 class="main-heading mb-4">{{ __('Emergency reception') }}</h4>
            <div class="getHeightContainer bg-white p-3 rounded-2 shadow">
                <div class="row">
                    <div class="col-lg-3 ps-0">
                        <p class="mb-2">المرضى :</p>
                        <ul class="list-unstyled main-nav-tap mb-3">
                            <li class="nav-item">
                                <a href="#" class="nav-link active cursor-auto">
                                    الطوارئ
                                </a>
                            </li>
                        </ul>
                        <div class=" main-tab-content">
                            <ul class=" d-flex flex-wrap gap-2">
                                @foreach ($emergencies as $e)

                                <li class="right-b color-gr" wire:click='selectEmergency({{ $e }})'>
                                    <a href="#">
                                        {{ $e->patient->name }}</a>
                                </li>
                                @endforeach
                                <hr>
                            </ul>
                        </div>
                    </div>
                    @if($emergency)
                    <div class="col-lg-9 mt-3 mt-lg-0">
                        <div class="d-flex mb-1 align-items-center">
                            <p class="mb-0">
                                أسم المريض :
                                {{ $patient->name }}
                            </p>
                        </div>
                        <ul class="nav nav-pills main-nav-tap mb-3" id="pills-tab" style="flex-wrap: wrap !important;">
                            <li class="nav-item">
                                <button class="nav-link active" id="pills-diagnosis-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-diagnosis" aria-selected="true">
                                    {{ __('Vital Signs') }}
                                </button>
                            </li>
                        </ul>
                        <div class="main-tab-content tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-diagnosis">
                                <div
                                    class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3 mb-3">
                                    @foreach ($marks as $key=>$mark)
                                    <div class="col">
                                        <div class="inp-holder">
                                            <label for="" class="small-label">{{ $mark->name }}</label>
                                            @if($mark->name=="الحمل")
                                            <select class="form-control" wire:model.defer="emergencyMarks.{{ $mark->name }}" id="">
                                                <option value="">اختر حالة الحمل</option>
                                                <option value="نعم">نعم</option>
                                                <option value="لا">لا</option>
                                            </select>
                                            @else
                                            <input type="number" wire:model.defer="emergencyMarks.{{ $mark->name }}" id=""
                                                class="form-control">
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-12">
                                        <label for="" class="small-label">الملاحظات</label>
                                        <textarea wire:model.defer="notes" id="" rows="5"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <button type="submit" class="btn btn-sm btn-success px-4"
                                                wire:click="saveMarks">
                                                حفظ
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                إنهاء الجلسة
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
