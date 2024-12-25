@extends('front.layouts.front')
@section('title')
{{ __('User Manual') }}
@endsection
@section('content')
<section class="main-section section-guide">
  <div class="container">
    <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
      <h4 class="main-heading mb-0">{{ __('User Manual') }}</h4>
    </div>
    <div class="bg-white shadow p-4 rounded-3">
      <div class="mb-2">
        ✨ البرنامج الطبي المتخصص لإدارة العيادات الطبية✨
        <br>
        💡يساعد البرنامج جميع الأطباء والممرضين في تنظيم مواعيد المرضى وتسجيل تفاصيل المرضى، وتتبع تاريخ العلاج، وإصدار
        تقارير طبية. 💯
        <br>
        ✔️ يمكنكم الحصول على المزيد من المعلومات والتفاصيل حول البرنامج وكيفية الاشتراك عبر زيارة موقعنا على الإنترنت
        <br>
        <a href="www.const-tech.org">www.const-tech.org🌐</a>
        <br>
        أو الاتصال بنا على الرقم 0506499275📞
        <br>
        اجعل إدارة عيادتك أسهل وأكثر كفاءة مع هذا البرنامج الطبي المميز!
      </div>
      <div class="alert alert-info mb-0" role="alert">
        يمكنكم مشاهدة شروحات البرنامج والمميزات من <a href="https://www.const-tech.org/videos" class="alert-link"
          style="text-decoration: underline;" target="_blank">هنا</a>
      </div>
    </div>
  </div>
</section>
@endsection
