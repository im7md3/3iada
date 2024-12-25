<ul class="nav nav-pills main-nav-tap mb-4" style="flex-wrap: wrap !important;">
    <li class="nav-item">
        <button wire:click='$set("patientFilesType","dentist")' type="button" class="nav-link {{ $patientFilesType == 'dentist' ? 'active' : '' }}">
            الاسنان
        </button>
    </li>
    <li class="nav-item">
        <button wire:click='$set("patientFilesType","dermatologist")' type="button" class="nav-link {{ $patientFilesType == 'dermatologist' ? 'active' : '' }}">
            الجلدية
        </button>
    </li>
</ul>



@if($patientFilesType == 'dentist')
<section class="select-teeth">
    <div class="toothArray content ">
        <img class="img-teeth" src="{{ asset('img/num.png') }}" alt="" />
        @foreach (getToothNumbers() as $tooth)
        <button class="btn-select" data-bs-toggle="modal" data-bs-target="#modal-select">
        </button>
        @endforeach
    </div>
</section>
<div class="row g-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-nowrap">{{ __('Teeth number') }}</th>
                <th>{{ __('Note') }}</th>
                <th>{{ __('products') }}</th>
                <th class="text-nowrap">{{ __('Processed') }}</th>
                <th>{{ __('total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->treatment_plans ?? [] as $item)
            <tr>
                <td>{{ $item->tooth }}</td>
                <td class="text-nowrap">{{ $item->note }}</td>
                <td>
                    <div class="d-flex align-items-center flex-wrap gap-1">
                        @foreach ($item->products as $product)
                        <span class="badge bg-secondary">{{ $product->name }}</span>
                        @endforeach
                    </div>
                </td>
                <td>
                    @if ($item->is_treated)
                    <span class="badge bg-success">{{ __('Yes') }}</span>
                    @else
                    <span class="badge bg-danger">لا</span>
                    @endif
                </td>
                <td class="text-nowrap">{{ $item->amount }}</td>
            </tr>
            @endforeach
            <tr>
                <td>{{ __('total') }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $patient->treatment_plans->sum('amount') }}</td>
            </tr>
        </tbody>
    </table>

</div>
@elseif($patientFilesType == 'dermatologist')
<section class="select-teeth">
    <div class="d-flex align-items-center justify-content-center">
        <div class="content-section p-3 body-point">
            <div class="header mb-3">
                <div class="row">
                    <div class="col-6 px-0">
                        <div class="right-side text-start">
                            <img src="{{ asset('img/human/right_side.png') }}" alt="">
                            @foreach ([2,4,6,8,10] as $point)
                            <input type="checkbox" wire:model='body.{{ $point }}' class="check-body">
                            {{-- wire:change='addBodyPoint({{ $point }})' --}}
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 px-0">
                        <div class="left-side">
                            <img src="{{ asset('img/human/left_side.png') }}" alt="">
                            @foreach ([1,3,5,7,9] as $point)
                            <input type="checkbox" wire:model='body.{{ $point }}' class="check-body">
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
                            @for ($point = 26;$point < 39;$point++) <input type="checkbox" wire:model='body.{{ $point }}' class="check-body">
                                {{-- wire:change='addBodyPoint({{ $point }})' --}}
                                @endfor

                        </div>

                    </div>
                    <div class="col-6 ">
                        <div class="body-front">
                            <img src="{{ asset('img/human/body-front.png') }}" alt="">
                            @for ($point = 11;$point < 26;$point++) <input type="checkbox" wire:model='body.{{ $point }}' class="check-body">
                                {{-- wire:change='addBodyPoint({{ $point }})' --}}
                                @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
