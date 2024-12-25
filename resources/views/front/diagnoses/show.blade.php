<div class="modal fade" id="show{{ $diagnose->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class="col-12 col-md-6">
                        <label for="Chief_complain"
                               class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Chief complain') }}
                            :</label>
                        <textarea readonly class="w-100 form-control"
                                  id="Chief_complain">{{ $diagnose->chief_complain }}</textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="sign_and_symptom"
                               class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Sign and symptom') }}
                            :</label>
                        <textarea readonly class="w-100 form-control"
                                  id="sign_and_symptom">{{ $diagnose->sign_and_symptom }}</textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="taken"
                               class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('diagnoses') }}
                            :</label>
                        <textarea readonly class="w-100 form-control" id="taken">{{ $diagnose->taken }}</textarea>
                    </div>
                    {{-- <div class="col-12 col-md-6">
                                  <label for="treatment_plan" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Treatment plan') }} :</label>
                    <textarea readonly class="w-100 form-control" id="treatment_plan">{{ $diagnose->treatment_plan }}</textarea>
                  </div> --}}
                    <div class="col-12 col-md-6">
                        <label for="treatment"
                               class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Treatment done') }}
                            :</label>
                        <textarea readonly class="w-100 form-control"
                                  id="treatment">{{ $diagnose->treatment }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="other"
                               class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('admin.other') }}
                            :</label>
                        <textarea readonly class="w-100 form-control" id="other">{{ $diagnose->other }}</textarea>
                    </div>
                    @if ($diagnose->tooth)
                        <div class="col-12">
                            <section class="num-teeth">
                                <div class="toothArray content ">
                                    <img class="img-teeth" src="{{ asset('img/num.png') }}" alt=""/>
                                    @for ($i = 18; $i >= 11; $i--)
                                        <input disabled type="checkbox"
                                               {{in_array($i,$diagnose->tooth) ? 'checked' : ''}} id=""
                                               value="{{ $i }}">
                                    @endfor

                                    @for ($i = 21; $i <= 28; $i++)
                                        <input disabled type="checkbox"
                                               {{in_array($i,$diagnose->tooth) ? 'checked' : ''}} id=""
                                               value="{{ $i }}">
                                    @endfor

                                    @for ($i = 38; $i >= 31; $i--)
                                        <input disabled type="checkbox"
                                               {{in_array($i,$diagnose->tooth) ? 'checked' : ''}} id=""
                                               value="{{ $i }}">
                                    @endfor

                                    @for ($i = 41; $i <= 48; $i++)
                                        <input disabled type="checkbox"
                                               {{in_array($i,$diagnose->tooth) ? 'checked' : ''}} id=""
                                               value="{{ $i }}">
                                @endfor

                            </section>
                        </div>
                    @endif



                    @if ($diagnose->body)

                        <div class="d-flex align-items-center justify-content-center">
                            <div class="content-section p-3">
                                <div class="header mb-3">
                                    <div class="row">
                                        <div class="col-6 px-0">
                                            <div class="right-side text-start">
                                                <img src="{{ asset('img/human/right_side.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-6 px-0">
                                            <div class="left-side">
                                                <img src="{{ asset('img/human/left_side.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <div class="body-front text-start">
                                                <img src="{{ asset('img/human/body-back.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <div class="body-back">
                                                <img src="{{ asset('img/human/body-front.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="line">
                                <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">


                                    @for ($i = 1; $i < 8; $i++)
                                        <div class="inp_holder text-center">
                                            <input type="text"
                                                   value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                   disabled
                                                   class="inp-blue form-control">
                                        </div>
                                    @endfor

                                </div>
                                <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                    @for ($i = 8; $i < 15; $i++)
                                        <div class="inp_holder text-center">
                                            <input type="text" disabled
                                                   value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                   class="inp-blue form-control">
                                        </div>
                                    @endfor
                                </div>
                                <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                    @for ($i = 15; $i < 22; $i++)
                                        <div class="inp_holder text-center">
                                            <input type="text" disabled
                                                   value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                   class="inp-blue form-control">
                                        </div>
                                    @endfor
                                </div>
                                <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                    @for ($i = 22; $i < 29; $i++)
                                        <div class="inp_holder text-center">
                                            <input type="text" disabled
                                                   value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                   class="inp-blue form-control">
                                        </div>
                                    @endfor
                                </div>

                                <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                    @for ($i = 29; $i < 36; $i++)
                                        <div class="inp_holder text-center">
                                            <input type="text" disabled
                                                   value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                   class="inp-blue form-control">
                                        </div>
                                    @endfor
                                </div>

                                <div class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                    @for ($i = 36; $i < 39; $i++)
                                        <div class="inp_holder text-center">
                                            <input type="text" disabled
                                                   value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                   class="inp-blue form-control">
                                        </div>
                                    @endfor
                                </div>

                            </div>
                        </div>

                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                        data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                {{--  <button class="btn btn-sm   btn-success" data-bs-dismiss="modal" wire:click='save_file'>أرسال</button> --}}
            </div>

        </div>

    </div>
</div>
