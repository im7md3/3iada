<div class="row g-3">
    <div class="col-12 col-md-3 ">
        <div class="profile-bar">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills list-option" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link {{ $screen == 'general' ? 'active' : '' }}" type="button" aria-selected="true" wire:click='$set("screen","general")'>
                        <div class="name">
                            <i class="fa-solid fa-gear"></i>
                            {{ __('admin.Settings') }}
                        </div>
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class="nav-link {{ $screen == 'appointments' ? 'active' : '' }}" type="button" aria-selected="true" wire:click='$set("screen","appointments")'>
                        <div class="name">
                            <i class="fas fa-clock"></i>
                            مواعيد العمل
                        </div>
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class="nav-link {{ $screen == 'program' ? 'active' : '' }}" type="button" aria-selected="true" wire:click='$set("screen","program")'>
                        <div class="name">
                            <i class="fa-solid fa-tablet-screen-button"></i>
                            خيارات البرنامج
                        </div>
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class="nav-link {{ $screen == 'company' ? 'active' : '' }}" type="button" aria-selected="true" wire:click='$set("screen","company")'>
                        <div class="name">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            شركات التقصيد
                        </div>
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class="nav-link {{ $screen == 'sms' ? 'active' : '' }}" type="button" aria-selected="true" wire:click='$set("screen","sms")'>
                        <div class="name">
                            <i class="fas fa-comment"></i>
                            اعدادت الـsms
                        </div>
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class="nav-link {{ $screen == 'whatsapp' ? 'active' : '' }}" type="button" aria-selected="true" wire:click='$set("screen","whatsapp")'>
                        <div class="name">
                            <i class="fa-brands fa-whatsapp"></i>
                            اعدادت Whatsapp
                        </div>
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-9 ">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="content_view">
                <div class="content_header">
                    <div class="title fs-11px">
                        <i class="fa-solid fa-gear fs-12px main-red-color"></i>
                        {{ __('admin.Settings') }}
                    </div>
                </div>

                @include('livewire.admin.settings.screens.' . $screen)

            </div>
        </div>
    </div>
    <div class="col-12 text-center mt-5">

        <a href="{{ route('backup-database') }}" class="btn btn-primary">{{ __('Export website databases') }}</a>
    </div>
</div>