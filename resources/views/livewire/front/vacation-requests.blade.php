<section class="main-section py-5">
    @if($screen == 'create')
    <div class=" container">
        {{-- appointments table @dd($user) --}}
        <h4 class="main-heading mb-3">{{__("admin.Vacation Requests")}}</h4>

        <div class="bg-white p-4 rounded-2 shadow">
            {{-- <form action="{{ route('front.profile.vacation.store') }}" method="post" enctype="multipart/form-data"> --}}
            {{-- @csrf --}}
            <x-message-admin></x-message-admin>
            <div class="row g-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="" class="small-label mb-2">{{__("admin.Date of request")}}</label>
                    <input type="date" value="" wire:model.defer="date" class="form-control">
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="" class="small-label">{{__("admin.the photo")}} </label>
                    <input type="file" class="form-control modal-title" wire:model.defer='attachment' accept="image/jpeg,image/jpg,image/png">
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="" class="small-label">{{__("admin.Date of request")}}</label>
                    <select wire:model="duration" id="duration" class="form-control w-100">
                        {{-- <option value="0">{{__("admin.Date of request")}} </option> --}}

                        <option value="day">{{__("admin.Full time")}}</option>
                        <option value="part">{{__("admin.Part of the time")}}</option>

                    </select>
                </div>
                @if($duration == 'part')
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="" class="small-label mb-2">{{__("admin.hourly time")}}</label>
                    <input type="number" wire:model.defer="duration_time" class="form-control">
                </div>
                @endif
                <div class="col-12 col-md-12 m-0">
                    <hr class="m-0 border-0 bg-transparent">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="" class="small-label">{{__("admin.The reason for asking permission")}}</label>
                    <textarea wire:model.defer="reason" class="form-control" id="" rows="5"></textarea>
                </div>
                <div class="col-12 col-md-12 m-0">
                    <hr class="m-0 border-0 bg-transparent">
                </div>
                <div class="col-12 col-md-12">
                    <button wire:click="submit" type="button" class="btn btn-sm btn-success px-4">{{ __('send') }}</button>
                </div>
            </div>
            {{-- </form> --}}

        </div>
    </div>
    @else
    <div class="container">
        <h4 class="main-heading mb-3">{{__("admin.Vacation Requests")}}</h4>
        <div class="bg-white p-4 rounded-2 shadow">
            <div class="d-flex justify-content-end mb-3">
                <button wire:click='$set("screen","create")' class="btn-main-sm">{{__("admin.Add")}}</button>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{__("admin.Required working time")}}</th>
                            <th>{{ __('admin.reason') }}</th>
                            <th>{{__("admin.Status")}}</th>
                            <th>{{ __('admin.status_reason') }}</th>
                            <th>{{ __('admin.file') }}</th>
                            <th>{{ __('admin.created in') }}</th>
                            <th>{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacations as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->date->format('Y/m/d') }}</td>
                            <td>@lang('vacations.' . $item->duration) {{ $item->duration == 'part' ? (' - ' . $item->duration_time . ' ساعات') : ''  }}</td>
                            <td>{{ $item->reason }}</td>
                            <td>@lang('vacations.' .$item->status)</td>
                            <td>{{ $item->status_reason ?? '--' }}</td>
                            <td>
                                @if($item->attachment)
                                <img src="{{ display_file($item->attachment) }}" style="width: 150px" alt="">
                                @else
                                --
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_order">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</section>
<!-- Modal -->
<div class="modal fade" id="delete_order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Delete order') }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{ __('Are you sure to delete?') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        <button type="button" class="btn btn-danger" wire:click='delete({{ $item }})'>{{ __('Delete') }}</button>
      </div>
    </div>
  </div>
</div>
