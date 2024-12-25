@extends('front.layouts.front')
@section('title')
    {{ __('admin.Notifications') }}
@endsection
@section('content')
    <section class="main-section notice">
        @php
            $notifications = App\Models\Notification::whereNull('user_id')
                ->orWhere('user_id', auth()->user()->id)
                ->orderBy('seen')
                ->paginate(10);
        @endphp
        <div class="container">
            <div class="d-flex align-items-center gap-4 mb-3 justify-content-between">
                <h4 class="main-heading mb-0">{{ __('admin.Notifications') }}</h4>

                @if ($notifications->count() > 0)
                    <button class="btn btn-danger" data-bs-target="#deleteAll" data-bs-toggle="modal">حذف
                        الكل</button>
                    <div class="modal fade" id="deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('front.notifications.destroyAll') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <h4>هل تريد حذف جميع الاشعارات ؟</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">اغلاق</button>
                                        <button type="submit" class="btn btn-primary">تاكيد</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="bg-white p-3 rounded-2 shadow">
                @foreach ($notifications as $notification)
                    {{ $notification->markAsSeen() }}
                    <div class="p-3 border-bottom  align-items-start d-flex justify-content-between gap-2">
                        <a href="{{ $notification->link }}">
                            @if (Carbon::now()->diffInMinutes(Carbon::parse($notification->seen_at)) < 1)
                                <span class="text-danger new">
                                    جديد </span>
                            @endif
                            <span class="text-main-color"> {{ $notification->title }}:</span>
                            {{ $notification->body }}
                        </a>
                        <button class="btn btn-danger btn-sm" data-bs-target="#delete{{ $notification->id }}"
                            data-bs-toggle="modal">
                            <i class="fas fa-trash-can"></i>
                        </button>
                    </div>

                    <div class="modal fade" id="delete{{ $notification->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('front.notifications.destroy', $notification->id) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <h4>هل تريد حذف الاشعار ؟</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">اغلاق</button>
                                        <button type="submit" class="btn btn-primary">تاكيد</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                @endforeach
                <div class="mt-3">
                    {{ $notifications->links() }}
                </div>


            </div>
        </div>
    </section>
@endsection
