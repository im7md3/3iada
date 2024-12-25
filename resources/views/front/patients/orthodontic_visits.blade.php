@extends('front.layouts.front')
@section('title')
    {{ __('Orthodontics Visits') }}
@endsection

@section('content')
    <section class="main-section users">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class="main-heading mb-0">{{ __('Orthodontics Visits') }}</h4>
                <a href="#" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-left"></i>
                </a>
            </div>
            <div class="section-content bg-white rounded-3 shadow p-4">
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.diagnoses') }}</th>
                                <th>{{ __('admin.evaluation') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                          {{--  @foreach ($orthodontic as $item) --}}
                                <tr>
                                    <td>{{ $orthodontic->created_at?->format('Y-m-d') }}</td>
                                    <td>{{ $orthodontic->diagnoses }}</td>
                                    <td>{{ $orthodontic->visit_notes }}</td>
                                </tr>
                         {{--   @endforeach   --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
