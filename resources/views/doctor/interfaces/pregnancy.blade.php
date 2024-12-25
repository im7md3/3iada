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
                                <input type="number" class="form-control" placeholder="ضع عدد الابناء" min='0'>
                            </div>
                        </td>
                        <td>
                            <div class="inp-holder">
                                <select class="form-select fs-12px">
                                    <option>اختر نوع الولادة</option>
                                    <option value="1">طبيعي</option>
                                    <option value="2">عملية</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="inp-holder">
                                <select class="form-select fs-12px">
                                    <option>اختر من الاجابات</option>
                                    <option value="1">نعم</option>
                                    <option value="2">لا</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="inp-holder">
                                <select class="form-select fs-12px">
                                    <option>اختر من الاجابات</option>
                                    <option value="1">نعم</option>
                                    <option value="2">لا</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="inp-holder">
                                <textarea class="form-control" rows="2"></textarea>
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
                            <label for="exampleFormControlTextarea1" class="mb-2">اخر دورة شهرية</label>
                            <input type="date" class="form-control">
                        </section>
                    </div>
                    <div class="col-12 col-md-6 ">
                        <section class="form-group ">
                            <label for="exampleFormControlTextarea1" class="mb-2">الاسبوع</label>
                            <input type="number" class="form-control" placeholder="عدد الاسابيع" min='0'>
                        </section>
                    </div>
                    <div class="col-12 col-md-6 ">
                        <section class="form-group ">
                            <label for="exampleFormControlTextarea1" class="mb-2">جنس المولود</label>
                            <select class="form-select fs-12px">
                                <option>اختر نوع الجنس</option>
                                <option value="1">بنت</option>
                                <option value="1">ولد</option>
                                <option value="2">توأم</option>
                            </select>
                        </section>
                    </div>
                    <div class="col-12 col-md-6 ">
                        <section class="form-group ">
                            <label for="exampleFormControlTextarea1" class="mb-2">المولود المتوقع للولاده</label>
                            <input type="date" class="form-control">
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
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                الاول
                            </label>
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                الثاني
                            </label>
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                الثالث
                            </label>
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                الرابع
                            </label>
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                الخامس
                            </label>
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                السادس
                            </label>
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                السابع
                            </label>
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                الثامن
                            </label>
                            <input type="radio" name="appointment_time" value="" id="">
                            <label for="" class="btn-item">
                                التاسع
                            </label>
                        </div>
                    </div>
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
    <div class="d-flex justify-content-center my-3">
        <button class="btn btn-sm btn-primary" wire:click='scan_request'>{{ __('Save') }}</button>
    </div>
</section>
