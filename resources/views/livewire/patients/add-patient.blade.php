<section class="addPatient-section py-5">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading ">{{ __('admin.Add patient') }}</h4>
    </div>

    @push('css')
    <link rel="stylesheet" href="{{ asset('admin-assets/css/datepicker.css') }}" />
    @endpush

    <div class="container pt-0 p-3 bg-white vh-min-100 rounded-3 shadow">
        <div class="addPatient-content p-4">
            <h4 class="section-title p-3 rounded-3 mb-4 text-center">
                {{ __('admin.Personal information about the patient') }}
            </h4>
            <form class="Patient-form-data">
                <div class="row mb-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <label>
                                {{ __('admin.Civil number (10 digits)') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="Patient-id" class="form-control Patient-id" wire:model.lazy="civil" placeholder="{{ __('admin.Civil number (10 digits)') }}" />
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <label>
                                {{ __('admin.name') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="Patient-name" class="form-control Patient-name" wire:model.lazy="first_name" placeholder="{{ __('admin.name') }}" />
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <label>
                                {{ __('admin.Country') }} <span class="text-danger">*</span>
                            </label>
                            <select class="main-select w-100 national" id="country_id" wire:model.lazy="country_id">
                                <option value="">{{ __('admin.Country') }}</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <input type="tel" id="Patient-phone" class="form-control text-end Patient-phone" wire:model.lazy="phone" placeholder="{{ __('admin.phone') }}" />
                        </div>
                    </div>
                    @if (in_array(setting()->age_or_gender, ['sex', 'all']))
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <select class="gender main-select w-100" id="gender" wire:model.lazy="gender">
                                <option value="">{{ __('admin.Gender') }}</option>
                                <option value="male">{{ __('admin.male') }}</option>
                                <option value="female">{{ __('admin.female') }}</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    @if (in_array(setting()->age_or_gender, ['age', 'all']))
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <select class="age_type main-select w-100" id="age_type" wire:model.lazy="age_type">
                                <option value="">{{ __('admin.age_type') }}</option>
                                <option value="adult">{{ __('admin.adult') }}</option>
                                <option value="baby">{{ __('admin.baby') }}</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <select class="main-select w-100" wire:model.defer="city_id">
                                <option value=""> {{ __('admin.Choose the city') }}</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <input type="number" id="age" wire:model="age" readonly class="age form-control" placeholder="{{ __('admin.Age') }}" />
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <input type="file" wire:model.defer="image" id="image" class="form-control" />
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <label for="birh-date">{{ __('Date of birth AD') }}</label>
                            <input type="date" class="birh-date form-control" id="birh-date" wire:model="birthdate" placeholder="{{ __('Date of birth AD') }}" />
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3" wire:ignore style="position: relative">
                            <label for="hijri-date">{{ __('admin.Hijri date of birth') }}</label>
                            <input type="text" class="birh-date form-control" id="hijri-date" value="{{ $birthdate ? Carbon::parse($birthdate)->toHijri()->isoFormat('DD-MMMM-YYYY') : '' }}" placeholder="{{ __('admin.Hijri date of birth') }}" />
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-4"></div>
                    <div class="col-md-6">
                        <div class="fild-control mb-3">
                            <label for="patient_group_id" class="small-label fs-11px">
                                {{ __('You can add the previous collection of admin') }}
                                <br>
                                {{ __('And it is especially for patients who have special needs, for example, students of schools / universities') }}
                            </label>
                            <select id="patient_group_id" class="main-select w-100" wire:model.defer="patient_group_id">
                                <option value=""> {{ __('select group') }}</option>
                                @foreach ($patient_groups as $patient_group)
                                <option value="{{ $patient_group->id }}">{{ $patient_group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 col-lg-2">
                        <div class="fild-control mb-3">
                            <label for="is_pregnant">
                                {{ __('Is the patient pregnant?') }}</label>
                            <input type="checkbox" wire:model="is_pregnant" id="is_pregnant" class="" />
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="fild-control ">
                            <label for="insurance">{{ __('admin.Is the patient insured?') }}</label>
                            <input type="checkbox" wire:model="insurance" id="insurance" class="" />
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="fild-control mb-3">
                            <label for="pressure">{{ __('High or low blood pressure?') }}</label>
                            <input type="checkbox" wire:model="pressure" id="pressure" class="" />
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="fild-control mb-3">
                            <label for="sugar">{{ __('admin.Diabetes or does a family member suffer from it?') }}</label>
                            <input type="checkbox" wire:model="sugar" id="sugar" class="" />
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="fild-control mb-3 {{ $insurance ? '' : 'd-none' }}">
                            <select class="form-control national" id="national" wire:model.lazy="insurance_id">
                                <option value="">{{ __('admin.insurance') }}</option>
                                @foreach ($insurances as $insurance)
                                <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="medical-information">
                        <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                            {{ __('admin.Medical information about the patient') }}
                        </button>
                        <div class="data-content" wire:ignore.self>
                            <div wire:ignore.self>
                                <p> {{ __('admin.Are you allergic to penicillin or other medicines?') }} </p>
                                <div class="radioarea d-flex">
                                    <label for="penicillin1" class="radio-inline ms-2">
                                        <input type="radio" wire:model="penicillin" id="penicillin1" value="1" />
                                        <span>{{ __('Yes') }}</span>
                                    </label>
                                    <label for="penicillin2" class="radio-inline">
                                        <input type="radio" wire:model="penicillin" id="penicillin2" value="0" />
                                        <span>{{ __('No') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <p> {{ __('admin.Have you ever had problems during and after dental treatment?') }}</p>
                                <div class="radioarea d-flex">
                                    <label for='teeth_problem1' class="radio-inline ms-2">
                                        <input type="radio" wire:model="teeth_problems" id="teeth_problem1" value="1" />
                                        <span>{{ __('Yes') }}</span>
                                    </label>
                                    <label for='teeth_problems2' class="radio-inline">
                                        <input type="radio" wire:model="teeth_problems" id="teeth_problems2" value="0" />
                                        <span>{{ __('No') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <p> {{ __('admin.Are you currently taking medication?') }}</p>
                                <div class="radioarea d-flex">
                                    <label for='drugs1' class="radio-inline ms-2">
                                        <input type="radio" wire:model="drugs" id="drugs1" value="1" />
                                        <span>{{ __('Yes') }}</span>
                                    </label>
                                    <label for='drugs2' class="radio-inline">
                                        <input type="radio" wire:model="drugs" id="drugs2" value="0" />
                                        <span>{{ __('No') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                            {{ __('admin.Notes on the health record') }}
                        </button>
                        <div class="data-content">
                            <div class="pt-0">
                                <textarea class="addnote form-control" wire:model.defer="notes_health_record" placeholder="{{ __('admin.Notes on the health record') }}" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                            {{ __('admin.the purpose from the visit') }}
                        </button>
                        <div class="data-content">
                            <div class="pt-0">
                                <textarea class="addnote form-control" wire:model.defer="goal_of_visit" placeholder="{{ __('purpose of the visit') }}" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                            {{ __('admin.Have you ever had or currently suffer from?') }}
                        </button>
                        <div class="data-content" wire:ignore.self>
                            <div wire:ignore.self>
                                <div>
                                    <p>{{ __('admin.heart disease?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label for='heart1' class="radio-inline ms-2">
                                            <input type="radio" wire:model="heart" id="heart1" value="1" />
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label for='heart2' class="radio-inline">
                                            <input type="radio" wire:model="heart" id="heart2" value="0" />
                                            <span>{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <p>{{ __('admin.Rheumatic fever?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label for='fever1' class="radio-inline ms-2">
                                            <input type="radio" wire:model="fever" id="fever1" value="1" />
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label for='fever2' class="radio-inline">
                                            <input type="radio" wire:model="fever" id="fever2" value="0" />
                                            <span>{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>{{ __('admin.Anemia and other blood diseases?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label for="anemia1" class="radio-inline ms-2">
                                            <input type="radio" wire:model="anemia" id="anemia1" value="1" />
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label for="anemia2" class="radio-inline">
                                            <input type="radio" wire:model="anemia" id="anemia2" value="0" />
                                            <span>{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>{{ __('admin.Thyroid disease?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label for='thyroid_glands1' class="radio-inline ms-2">
                                            <input type="radio" wire:model="thyroid_glands" id="thyroid_glands1" value="1" />
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label for='thyroid_glands2' class="radio-inline">
                                            <input type="radio" wire:model="thyroid_glands" id="thyroid_glands2" value="0" />
                                            <span>{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>
                                        {{ __('admin.Bile - hepatitis or any other liver disease?') }}
                                    </p>
                                    <div class="radioarea d-flex">
                                        <label for="liver1" class="radio-inline ms-2">
                                            <input type="radio" wire:model="liver" id="liver1" value="1" />
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label for="liver2" class="radio-inline">
                                            <input type="radio" wire:model="liver" id="liver2" value="0" />
                                            <span>{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <p>{{ __('admin.Asthma - tuberculosis - or trouble breathing?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label for="tb1" class="radio-inline ms-2">
                                            <input type="radio" wire:model="tb" id="tb1" value="1" />
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label for="tb2" class="radio-inline">
                                            <input type="radio" wire:model="tb" id="tb2" value="0" />
                                            <span>{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>{{ __('admin.Kidney disease?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label for="kidneys1" class="radio-inline ms-2">
                                            <input type="radio" wire:model="kidneys" id="kidneys1" value="1" />
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label for="kidneys2" class="radio-inline">
                                            <input type="radio" wire:model="kidneys" id="kidneys2" value="0" />
                                            <span>{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>{{ __('admin.Cramping, conflict, or fainting?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label for="convulsion1" class="radio-inline ms-2">
                                            <input type="radio" wire:model="convulsion" id="convulsion1" value="1" />
                                            <span>{{ __('Yes') }}</span>
                                        </label>
                                        <label for="convulsion2" class="radio-inline">
                                            <input type="radio" wire:model="convulsion" id="convulsion2" value="0" />
                                            <span>{{ __('No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <div class="py-0">
                                        <label class="mb-2">{{ __('admin.other diseases') }}</label>
                                        <textarea class="addnote form-control" wire:model.defer="other_diseases" placeholder="{{ __('admin.other diseases') }}" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-flex align-items-center justify-content-center mt-2">
                        <button class="send-data btn btn-primary" wire:click.prevent='save'>{{ __('save the data') }}</button>
                    </div>
            </form>
        </div>
    </div>

</section>


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="{{ asset('admin-assets/js/datepicker.js') }}"></script>
<script>
    $(function() {
        $("#hijri-date").hijriDatePicker();
    });

</script>
@endpush
