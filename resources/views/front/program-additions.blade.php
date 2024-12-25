@extends('front.layouts.front')
@section('title')
{{ __('Program additions') }}
@endsection
@section('content')
<section id="app" class="main-section section-guide">
    <div class="container">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0"> {{ __('Program additions') }}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div v-if="additions.length >= 1" class="accordion mt-3" id="accordionExample">
                    <div v-for="item in additions" :key="item.id" class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                :data-bs-target="'#collapse-'+item.id" aria-expanded="false">
                                @{{item.title}}
                            </button>
                        </h2>
                        <div :id="'collapse-'+item.id" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="box-head-page mb-3">
                                    <div class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="main-content ">
                                                <div class="main-info">
                                                    <h5 class="title">
                                                        @{{item.title}}
                                                    </h5>

                                                    <h4 v-if="item.type === 'paid'" class="text-success fs-14px  mb-0">
                                                        @{{item.price}}
                                                        ر.س
                                                    </h4>
                                                    <h4 v-else class="text-success fs-14px mb-0">
                                                        {{__('Free')}}
                                                    </h4>
                                                    <a href="https://wa.me/+966506499275" target="_blank" class="btn btn-outline-primary fs-12px">أطلب الاضافة</a>
                                                </div>
                                                <p class="des mb-2 mt-4" v-html="item.content">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div v-if="item.youtube_url" class="img-holder" data-fancybox="" :data-caption="item.title"
                                                :data-src="item.youtube_url">
                                                    <iframe :src="`https://www.youtube.com/embed/${item.youtube_url.split('v=')[1]}?controls=0&disablekb=1`"></iframe>
                                            </div>
                                            <div v-else class="img-holder" data-fancybox="" :data-caption="item.title"
                                                :data-src="item.image_link">
                                                <img :src="item.image_link"
                                                    alt="program Addition Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div v-else-if="loading" class="spinner-border text-info m-auto d-block" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div v-else class="alert alert-warning" role="alert">
                {{__("There is no content")}}
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="{{ asset('js/vue.js') }}"></script>
<script>
    const {
        createApp,
        ref,
        onMounted
    } = Vue

    createApp({
        setup() {
            // Url Api
            const urlApi = "{{env("HOST_CONST")}}/api";

            //Fetch Data Additions
            const additions = ref([])
            const loading = ref(true)
            onMounted(async () => {
                try {
                    const response = await fetch(`${urlApi}/clinics`);
                    const data = await response.json();
                    additions.value = data.data;
                    loading.value = false;
                } catch (error) {
                    console.log(error);
                }
            });
            return {
                additions,
                loading
            };
        }
    }).mount('#app');
</script>

@endsection
