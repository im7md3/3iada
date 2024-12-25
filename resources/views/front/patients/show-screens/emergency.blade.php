<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('phone') }}</th>
                <th>{{ __('Age type') }}</th>
                <th>{{ __('Detection status') }}</th>
                <th>{{ __('Time') }}</th>
                <th>{{ __('Detection time') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Technician') }}</th>
                <th class="text-center not-print">{{ __('managers') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->emergenies as $e)

            <tr>
                <td>{{ $e->patient->phone }}</td>
                {{-- <td>{{ $e->patient->age }}</td> --}}
                @if (in_array(setting()->age_or_gender, ['age', 'all']))
                <th>{{ __($e->patient->age_type) }}</th>
                @endif
                <td>
                    @if($e->status=='pending')
                    <span class="badge bg-warning">{{ __('pending') }}</span>
                    @else
                    <span class="badge bg-success">{{ __('Detected') }}</span>
                    @endif
                </td>
                <td>{{ $e->time }}</td>
                <td>{{ $e->time }}</td>
                <td>{{ $e->date }}</td>
                <td>{{ $e->tec?->name }}</td>
                <td class="not-print">
                    <div class="d-flex align-items-center justify-content-center gap-1">
                        <button class="btn btn-sm btn-primary py-1" data-bs-toggle="modal" data-bs-target="#table_agent{{ $e->id }}">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#print_agent{{ $e->id }}">
                            <i class="fa-solid fa-print"></i>
                        </button>
                        {{-- <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit_agent">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>  --}}
                        {{-- <button class="btn btn-sm btn-danger py-1" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $e->id }}">
                        <i class="fa-solid fa-trash-can"></i>
                        </button> --}}
                        <!-- Modal Show -->
                        <div class="modal fade" id="table_agent{{ $e->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Show vital signs') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            @if($e->marks)
                                            @foreach ($e->marks as $key=>$mark)
                                            <div class="col-md-4">
                                                <label for="{{ $mark }}" class="small-label mb-1">{{ $key }}</label>
                                                <input readonly type="text" id="{{ $mark }}" class="form-control" value="{{ $mark }}">
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Print -->
                        <div class="modal fade" id="print_agent{{ $e->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">طباعة بيانات المريض</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body print-emergency" id="prt-content">
                                        <div class="holder-logo text-center d-none d-block-print">
                                            <img src="{{ asset('img/logo-icon.png') }}" alt="logo" class="mb-1" width="25">
                                            <p class="mb-1 fs-6px">رقم الانتظار: 9#</p>
                                            <p class="mb-0 fs-5px">الموظف: خالد علي السيد</p>
                                            <hr class="my-0">
                                        </div>
                                        <table class="table table-hover mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center">بيانات المريض</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex align-items">
                                            <table class="table table-hover mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th>اسم المريض</th>
                                                        <td>{{ $e->patient->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>رقم الجوال</th>
                                                        <td>{{ $e->patient->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>تاريخ الكشف</th>
                                                        <td>
                                                            {{ $e->date }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-hover mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th>العمر</th>
                                                        @if (in_array(setting()->age_or_gender, ['age', 'all']))
                                                        <th>{{ __($e->patient->age_type) }}</th>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th>حالة الكشف</th>
                                                        <td>
                                                            @if($e->status=='pending')
                                                            <span class="badge bg-warning">{{ __('pending') }}</span>
                                                            @else
                                                            <span class="badge bg-success">{{ __('Detected') }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>الوقت</th>
                                                        <td>{{ $e->time }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <table class="table table-hover mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center">العلامات الحرارية</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex align-items">
                                            <table class="table table-hover mb-0">
                                                @php
                                                $marks =$e->marks;
                                                if ($marks){
                                                $first_chunk =array_slice($marks,0,4,true);
                                                $second_chunk =array_slice($marks,4,7,true);
                                                }
                                                @endphp
                                                <tbody>
                                                    @if(isset($second_chunk))
                                                    @foreach($second_chunk as $key =>$mark)
                                                    <tr>
                                                        <th>{{$key }}</th>
                                                        <td>{{$mark}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <table class="table table-hover mb-0">
                                                @if(isset($first_chunk))
                                                @foreach($first_chunk as $key =>$mark)
                                                <tr>
                                                    <th>{{$key }}</th>
                                                    <td>{{$mark}}</td>
                                                </tr>
                                                @endforeach
                                                @endif

                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between ">
                                        <span>
                                            فني الطوارئ / {{$e->tec?->name}}
                                        </span>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                            <button type="submit" data-target="{{ $e->id }}" class="btn btn-sm btn-warning px-3" id="btn-prt-content"><i class="fa-solid fa-print"></i> {{ __('print') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        {{-- <div class="modal fade" id="edit_agent" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Edit patient') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="breathing" class="small-label mb-1">{{ __('breathing') }}</label>
                                <input type="text" name="breathing" id="breathing" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="pregnancy" class="small-label mb-1">{{ __('pregnancy') }}</label>
                                <input type="text" id="pregnancy" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="sugar" class="small-label mb-1">{{ __('sugar') }}</label>
                                <input type="text" id="sugar" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="heart" class="small-label mb-1">{{ __('heart') }}</label>
                                <input type="text" id="heart" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="height" class="small-label mb-1">{{ __('height') }}</label>
                                <input type="text" id="height" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="pressure" class="small-label mb-1">{{ __('pressure') }}</label>
                                <input type="text" id="pressure" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="weight" class="small-label mb-1">{{ __('weight') }}</label>
                                <input type="text" id="weight" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="heat" class="small-label mb-1">{{ __('heat') }}</label>
                                <input type="text" id="heat" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button" class="btn btn-sm btn-success px-3" data-bs-dismiss="modal">{{ __('Save') }}</button>
                    </div>
</div>
</div>
</div> --}}
<!-- Modal Delete -->
{{-- <div class="modal fade" id="delete_agent{{ $e->id }}" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="small-heading">
                هل أنت متأكد من عملية الحذف؟
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">تراجع</button>
            <button class="btn btn-sm btn-success px-3" data-bs-dismiss="modal" wire:click="delete({{ $e->id }})">نعم</button>
        </div>
    </div>
</div>
</div> --}}
</div>
</td>
</tr>
@endforeach

</tbody>
</table>

</div>
<script>
    // print
    if (document.getElementById("prt-content")) {
        var btnPrtContent = document.getElementById("btn-prt-content");
        btnPrtContent.addEventListener("click", printDiv);

        function printDiv() {
            var prtContent = document.getElementById("prt-content");
            newWin = window.open("");
            newWin.document.head.replaceWith(document.head.cloneNode(true));
            newWin.document.body.appendChild(prtContent.cloneNode(true));
            setTimeout(() => {
                newWin.print();
                newWin.close();
            }, 600);
        }
    }
</script>