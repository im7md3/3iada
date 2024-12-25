@extends('front.layouts.front')
@section('title')
{{ __('admin.SMS_settings') }}
@endsection
@section('content')

<section class="patinet-report main-section pt-5">
    <div class="container">
        <div class="alert alert-warning" role="alert">
            {{ __('You can request to subscribe to SMS messages by communicating with us, as they are linked to appointments, canceling appointments, sending direct messages, or making advertisements through messages') }}
            <br> @lang('You can request to activate the communication service directly via call or WhatsApp') <a href="https://wa.me/0506499275" target="_blank" class="text-primary text-decoration-underline ">0506499275 <i class="fa-brands fa-whatsapp"></i></a>
        </div>
        <div class="alert alert-info" role="alert">
            {{ __('Sending messages to a specific clinic based on patients receiving service bills') }}
        </div>
        <div class="d-flex mb-3 align-items-center">
            <a href="{{ route('front.home') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading mb-0 me-2">{{ __('admin.SMS_settings') }}</h4>
        </div>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row ">
                <div class="left-holder d-flex justify-content-end m-sm-0 gap-2">
                    <a class="btn btn-sm btn-outline-info" href="{{ url('/admin/massage') }}">
                        {{ __('Settings message') }}
                    </a>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span>?</span>

                    </button>
                </div>
            </div>
            <form action="{{ route('front.message.send') }}" method="POST">
                @csrf
                <div class="row my-4 ">
                    <div class="col-12 col-md-6">
                        <div class="fild-control mb-3">
                            <select name="lib_id" class="main-select w-100" id="lib_id">
                                <option value="">{{ __('Select from the message library') }}</option>
                                @foreach($smsLibrary as $lib)
                                <option data-message="{{ $lib->content }}" value="{{ $lib->id }}"> {{ $lib->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="fild-control mb-3">
                            <select name="department_id" class="main-select w-100" id="department_id">
                                <option value="">{{ __('Clinic') }}</option>
                                <option value="custom">{{ __("Send to one patient") }}</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}"> {{ $department->name }} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="fild-control mb-3">
                            <select name="gender" class="main-select w-100" id="gender">
                                <option value="all">{{ __('All') }}</option>
                                <option value="male">{{ __('male') }}</option>
                                <option value="female">{{ __('female') }}</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-12 col-md-6" id="phoneDiv">
                        <div class="fild-control mb-3">
                            <input type="number" id="my-input" class="form-control" name="phone" placeholder="{{ __('Phone number') }}" />
                            <small class="text-danger fs-10px">{{ __('Required only in case of customized selection from customers') }}</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" id="phoneClients">
                        <div class="fild-control mb-3">
                            <select class="gender main-select w-100" id="clients" name="patient_id">
                                <option value="">{{ __('Client') }}</option>
                                <option value="custom">{{ __('Custom') }}</option>
                                @foreach ($patients as $patient)
                                <option value="{{ $patient->phone }}">{{ $patient->name }} - {{ $patient->phone }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="fild-control mb-3">
                            <textarea id="message" name="message" cols="" rows="4" class="form-control" placeholder="{{ __('Message') }}"></textarea>
                        </div>
                    </div>
                    {{-- <div class="col-12 ">
                        <div class="fild-control mb-3 d-flex align-items-center gap-1">
                            <input type="checkbox" name="" id="">
                            <label for="">
                                {{__('Activate sending a new appointment')}}
                    </label>
                </div>
        </div>
        <div class="col-12 ">
            <div class="fild-control mb-3 d-flex align-items-center gap-1">
                <input type="checkbox" name="" id="">
                <label for="">
                    {{__('Activate an appointment 24 hours in advance')}}
                </label>
            </div>
        </div>
        <div class="col-12 ">
            <div class="fild-control mb-3 d-flex align-items-center gap-1">
                <input type="checkbox" name="" id="">
                <label for="">
                    {{__('Activate sending an appointment cancellation message')}}
                </label>
            </div>
        </div> --}}
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">{{ __('send') }}</button>
        </div>
    </div>
    </form>
    <!-- <hr> -->
    <!-- <div class="table-responsive mt-3">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('password') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td colspan="12">{{ __('admin.Sorry, there are no results') }}</td>
                            </tr>


                    </tbody>
                </table>
            </div> -->
    </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('How To connect to Taqnyat') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <ul class=" list-unstyled">
                        <li>1- {{ __('Go to the messaging platform and log in') }} <a href="https://portal.taqnyat.sa/">portal.taqnyat.sa</a></li>
                        <li>2- {{ __('To get the key go to the developers') }} > {{ __('Applications.. Copy the key from any app you want to use') }}</li>
                        <li>3- {{ __('For photos on the sender name go to the user image up left') }} > {{ __('Settings') }} > {{ __('Manage the sender name Copy the sender name exactly as it is') }}</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    document.getElementById("phoneDiv").style.display = "none";
    document.getElementById("phoneClients").style.display = "none";
    document.getElementById('department_id').addEventListener('change', function() {
        var sel = document.getElementById("department_id");
        var value = sel.options[sel.selectedIndex].value;
        if (value == 'custom') {
            document.getElementById("phoneDiv").style.display = "block";
            document.getElementById("phoneClients").style.display = "block";
        } else {
            document.getElementById("phoneDiv").style.display = "none";
            document.getElementById("phoneClients").style.display = "none";
        }

    });
    document.getElementById('lib_id').addEventListener('change', function() {
        var sel = document.getElementById("lib_id");
        if (sel.options[sel.selectedIndex].value != '') {
            var data = sel.options[sel.selectedIndex].dataset;
            var value = sel.options[sel.selectedIndex].dataset.message;
            if (value) {
                document.getElementById("message").value = value;
                document.getElementById("message").readOnly = true;
            }
        } else {
            document.getElementById("message").readOnly = false;
            document.getElementById("message").value = '';
        }

    });
</script>
@endpush