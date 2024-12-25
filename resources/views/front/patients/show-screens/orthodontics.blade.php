<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Date') }}</th>
                <th>{{ __('admin.dr') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->orthodontics()->paginate(10) as $item)
                <tr>
                    <td>{{ $item->appoint?->appointment_date }}</td>
                    <td>{{ $item->dr?->name }}</td>
                    <td>
                        <button class="preview-btn btn btn-sm btn-purple" data-bs-toggle="modal"
                            data-bs-target="#show{{ $item->id }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <a href="{{ route('front.orthodontics.show_prescription', $item->id) }}"
                            class="btn btn-sm btn-primary"><i class="fa-solid fa-file-waveform"></i></a>
                        <a class="preview-btn btn btn-sm btn-success"
                            href="{{ route('front.patients.orthodontics.visits', $item->id) }}">{{ __('Visits') }}</a>
                    </td>
                </tr>
                <div class="modal fade" id="show{{ $item->id }}" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('Preview of the patient orthodontics') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label
                                            class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Chief complain') }}:</label>
                                        <textarea readonly class="w-100 form-control">{{ $item->main_complaint }}</textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label
                                            class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Sign and symptom') }}:</label>
                                        <textarea readonly class="w-100 form-control">{{ $item->signs_and_symptoms }}</textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label
                                            class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Diagnosis') }}:</label>
                                        <textarea readonly class="w-100 form-control">{{ $item->diagnoses }}</textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label
                                            class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Treatment plan') }}
                                            :</label>
                                        <textarea readonly class="w-100 form-control">{{ $item->treatment_plan }}</textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label
                                            class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('Treatment done') }}
                                            :</label>
                                        <textarea readonly class="w-100 form-control" id="action-taken">{{ $item->treatment_done }}</textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label
                                            class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{ __('visit remark') }}
                                            :</label>
                                        <textarea readonly class="w-100 form-control" id="action-taken">{{ $item->visit_notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary px-3"
                                    data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    {{ $patient->orthodontics()->paginate(10)->links() }}
</div>
