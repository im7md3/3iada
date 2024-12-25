<section class="p-3">
    @if (doctor()->is_orthodontics)
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <label for=""
                       class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Chief complain') }}</label>
                <textarea class="form-control" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
                          wire:model.defer="main_complaint" id="" rows="4"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for=""
                       class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Signs and symptoms') }}</label>
                <textarea class="form-control" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
                          wire:model.defer="signs_and_symptoms" id="" rows="4"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for=""
                       class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Diagnosis') }}</label>
                <textarea class="form-control" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
                          wire:model.defer="diagnoses" id="" rows="4"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for=""
                       class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Treatment plan') }}</label>
                <textarea class="form-control" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
                          wire:model.defer="treatment_plan" id="" rows="4"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for=""
                       class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Treatment done') }}</label>
                <textarea class="form-control" dir="ltr" wire:model.defer="treatment_done" id="" rows="4"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for=""
                       class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('visit remark') }}</label>
                <textarea class="form-control" dir="ltr" wire:model.defer="visit_notes" id="" rows="4"></textarea>
            </div>

        </div>


        {{-- period select morning or evening --}}
        <section class="form-group d-flex justify-content-center my-3">
            <button class="btn btn-success mt-3 w-25" wire:click="saveOrthodontic">
                {{ __('Save') }}
            </button>
        </section>
    @else
        <div class="row g-3">
            <section class="col-md-6 {{ setting()->complaint ? '' : 'd-none' }}">
                <label for="exampleFormControlTextarea1"
                       class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">الشكوى</label>
                <textarea class="form-control" rows="3" wire:model.defer="diagnosis.complaint"></textarea>
            </section>
            <section class="col-md-6 {{ setting()->complaint ? '' : 'd-none' }}">
                <label for="exampleFormControlTextarea1"
                       class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">الكشف السريري</label>
                <textarea class="form-control" rows="3" wire:model.defer="diagnosis.clinical_examination"></textarea>
            </section>
            <section class="col-md-6">
                <label for="exampleFormControlTextarea1"
                       class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Chief complain') }}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          wire:model.defer="diagnosis.chief_complain"></textarea>
            </section>
            <section class="col-md-6">
                <label for="exampleFormControlTextarea1"
                       class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Sign and symptom') }}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          wire:model.defer="diagnosis.sign_and_symptom"></textarea>
            </section>
            <section class="col-md-6">
                <label for="exampleFormControlTextarea1"
                       class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Other') }}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          wire:model.defer="diagnosis.other"></textarea>
            </section>
            <section class="col-md-6">
                <label for="exampleFormControlTextarea1"
                       class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Diagnose') }}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          wire:model.defer="diagnosis.taken"></textarea>
            </section>
            {{-- treatment --}}
            <section class="col-md-6">
                <label for="exampleFormControlTextarea1"
                       class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Action taken') }}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          wire:model.defer="diagnosis.treatment"></textarea>
            </section>
            <section class="col-md-6">
                <label for="exampleFormControlTextarea1"
                       class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Vital Signs') }}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          wire:model.defer="diagnosis.vital"></textarea>
            </section>
        </div>
        {{-- tooth --}}
        @can ('show_teeth_model_diagnoses')
            <section class="num-teeth">
                <div class="toothArray content ">
                    <img class="img-teeth" src="{{ asset('img/num.png') }}" alt=""/>
                    @for ($i = 18; $i >= 11; $i--)
                        <input type="checkbox" wire:model.defer="diagnosis.tooth" id="" value="{{ $i }}">
                    @endfor

                    @for ($i = 21; $i <= 28; $i++)
                        <input type="checkbox" wire:model.defer="diagnosis.tooth" id="" value="{{ $i }}">
                    @endfor

                    @for ($i = 38; $i >= 31; $i--)
                        <input type="checkbox" wire:model.defer="diagnosis.tooth" id="" value="{{ $i }}">
                    @endfor

                    @for ($i = 41; $i <= 48; $i++) <input type="checkbox" wire:model.defer="diagnosis.tooth" id=""
                                                          value="{{ $i }}">
                @endfor

            </section>
        @endcan
        @if (doctor()->is_dermatologist)
            {{-- @dump($body_points) --}}
            <div class="d-flex align-items-center justify-content-center">
                <div class="content-section p-3 body-point">
                    <div class="header mb-3">
                        <div class="row">
                            <div class="col-6 px-0">
                                <div class="right-side text-start">
                                    <img src="{{ asset('img/human/right_side.png') }}" alt="">
                                    @foreach ([2, 4, 6, 8, 10] as $point)
                                        <input type="checkbox" wire:model='diagnosis.body.{{ $point }}'
                                               class="check-body">
                                        {{-- wire:change='addBodyPoint({{ $point }})' --}}
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-6 px-0">
                                <div class="left-side">
                                    <img src="{{ asset('img/human/left_side.png') }}" alt="">
                                    @foreach ([1, 3, 5, 7, 9] as $point)
                                        <input type="checkbox" wire:model='diagnosis.body.{{ $point }}'
                                               class="check-body">
                                        {{-- wire:change='addBodyPoint({{ $point }})' --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-6 ">
                                <div class="body-back text-start">
                                    <img src="{{ asset('img/human/body-back.png') }}" alt="">
                                    @for ($point = 26; $point < 39; $point++)
                                        <input type="checkbox" wire:model='diagnosis.body.{{ $point }}'
                                               class="check-body">
                                        {{-- wire:change='addBodyPoint({{ $point }})' --}}
                                    @endfor

                                </div>

                            </div>
                            <div class="col-6 ">
                                <div class="body-front">
                                    <img src="{{ asset('img/human/body-front.png') }}" alt="">
                                    @for ($point = 11; $point < 26; $point++)
                                        <input type="checkbox" wire:model='diagnosis.body.{{ $point }}'
                                               class="check-body">
                                        {{-- wire:change='addBodyPoint({{ $point }})' --}}
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @can('read_pregnancy')

            @if(setting()->pregnancy_follow)
                @if(doctor()->is_pregnancy)
                    @if($patient->gender != 'female')
                        <div class="alert alert-danger mt-3">
                            يجب ان يكون المريض أنثي حتي تستطيع اضافة بيانات الحمل
                        </div>
                    @else
                        <section class="p-3">
                            <section class="main-data">
                                <h6 class="">
                                    البيانات الاساسية:-
                                </h6>
                                <section class="table-responsive mt-4">
                                    <table class="table main-table m-0">
                                        <thead>
                                        <tr>
                                            <th style="width: 20%;">عدد الابناء</th>
                                            <th>اخر ولادة</th>
                                            <th>مرض مزمن / سكر</th>
                                            <th>مرض مزمن / ضغط</th>
                                            <th>امراض اخري</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="inp-holder">
                                                    <input type="number" class="form-control" wire:model='children'
                                                           placeholder="ضع عدد الابناء" min='0'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="inp-holder">
                                                    <select wire:model='last_childbirth' class="form-select fs-12px">
                                                        <option>اختر نوع الولادة</option>
                                                        <option value="normal">طبيعي</option>
                                                        <option value="surgery">عملية</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="inp-holder">
                                                    <select wire:model='diabetes' class="form-select fs-12px">
                                                        <option>اختر من الاجابات</option>
                                                        <option value="1">نعم</option>
                                                        <option value="0">لا</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="inp-holder">
                                                    <select wire:model='pressure' class="form-select fs-12px">
                                                        <option>اختر من الاجابات</option>
                                                        <option value="1">نعم</option>
                                                        <option value="0">لا</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="inp-holder">
                                                    <textarea wire:model.defer='other_diseases' class="form-control"
                                                              rows="2"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </section>
                            </section>
                            <section class="">
                                <h6 class="py-3">
                                    متابعة الحمل:-
                                </h6>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <section class="form-group ">
                                                    <label for="exampleFormControlTextarea1" class="mb-2">اخر دورة
                                                        شهرية</label>
                                                    <input type="date" wire:model='last_menstrual_period'
                                                           class="form-control">
                                                </section>
                                            </div>
                                            <div class="col-12 col-md-6 ">
                                                <section class="form-group ">
                                                    <label for="exampleFormControlTextarea1"
                                                           class="mb-2">الاسبوع</label>
                                                    <input type="number" wire:model='week' class="form-control"
                                                           placeholder="عدد الاسابيع" min='0'>
                                                </section>
                                            </div>
                                            <div class="col-12 col-md-6 ">
                                                <section class="form-group ">
                                                    <label for="exampleFormControlTextarea1" class="mb-2">جنس
                                                        المولود</label>
                                                    <select wire:model='child_gender' class="form-select fs-12px">
                                                        <option>اختر نوع الجنس</option>
                                                        <option value="female">بنت</option>
                                                        <option value="male">ولد</option>
                                                        <option value="twin">توأم</option>
                                                    </select>
                                                </section>
                                            </div>
                                            <div class="col-12 col-md-6 ">
                                                <section class="form-group ">
                                                    <label for="exampleFormControlTextarea1" class="mb-2">المولود
                                                        المتوقع للولاده</label>
                                                    <input wire:model='date_of_birth' type="date" class="form-control">
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="border p-3 rounded">
                                            <div class="month">
                                                <h3 class="small-heading">
                                                    الشهر
                                                </h3>

                                                <div class="btns-check">
                                                    @foreach (pregnancy() as $key => $item)
                                                        @if($key)
                                                            <input type="radio" wire:model='month' id="{{ $key }}"
                                                                   value="{{ $key }}">
                                                            <label for="{{ $key }}" class="btn-item">
                                                                {{ $item }}
                                                            </label>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center my-3 gap-2">
                                            <button wire:click='savePregnancy'
                                                    class="btn btn-sm btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- <section class="visitors">
               <h6 class="py-3">
                   زيارات المتابعة:-
               </h6>
               <div class="row g-4">
                   <div class="col-12 col-md-6">
                       <section class="form-group ">
                           <label for="exampleFormControlTextarea1" class="mb-2">التاريخ</label>
                           <input type="date" class="form-control">
                       </section>
                   </div>
                   <div class="col-12 col-md-6">
                       <section class="form-group ">
                           <label for="exampleFormControlTextarea1" class="mb-2">الموعد القادم</label>
                           <input type="date" class="form-control">
                       </section>
                   </div>
                   <div class="col-12 col-md-6">
                       <label for="" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">التشخيص</label>
                       <textarea class="form-control" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" wire:model.defer="main_complaint" id="" rows="4"></textarea>
                   </div>
                   <div class="col-12 col-md-6">
                       <label for="" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">العلاج</label>
                       <textarea class="form-control" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" wire:model.defer="signs_and_symptoms" id="" rows="4"></textarea>
                   </div>
                   <div class="col-12 ">
                       <label for="" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">ملاحظات المريض</label>
                       <textarea class="form-control" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" wire:model.defer="signs_and_symptoms" id="" rows="4"></textarea>
                   </div>
               </div>
           </section> -->

                        </section>
                        <div class="alert alert-info">
                            اذا كانت المتابعة لمولود جديد يمكنك انهاء المتابعة القديمة قبل الاضافة
                        </div>
                        <section class="table-responsive mt-4">
                            <table class="table main-table m-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تاريخ الموعد</th>
                                    <th>الاسبوع</th>
                                    <th>الشهر</th>
                                    <th>الملاحظات</th>
                                    <th>اضافة ملاحظة</th>
                                    <th>عمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($pregnancyCategory)
                                    @foreach ($pregnancyCategory->pregnancies()->where('is_compeleted',0)->get() as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->appointment->created_at }}</td>
                                            <td>{{ $item->week }}</td>
                                            <td>{{ pregnancy()[$item->month] }}</td>
                                            <td> {{ $item->notes }}</td>
                                            <td>
                         <textarea class="form-control" wire:model='pregnanciesNote' id="" cols="5" rows="2">
                         </textarea>
                                            </td>
                                            <td>
                                                <button wire:click='savePregnanciesNote({{ $item->id }})'
                                                        class="btn btn-primary btn-sm">حفظ الملاحظات
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </section>
                        @if($patient->pregnancySession()->where('is_compeleted', 0)->first())
                            <div class="d-flex justify-content-center my-3 gap-2">
                                <button wire:click='endPregnancySession' class="btn btn-sm btn-danger">انهاء مراجعة
                                    الحمل
                                </button>
                            </div>
                        @endif

                    @endif
                @endif
            @endif
        @endcan
        {{-- period select morning or evening --}}
        <section class="form-group d-flex justify-content-center my-3">
            <button class="btn btn-success mt-3 w-25" wire:click="saveDiagnose">
                {{ __('Save') }}
            </button>
        </section>
    @endif
</section>
