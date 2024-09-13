@extends('layouts.wizard-update')

@section('content')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layouts.navigation')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('layouts.header_nav')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @include('components.toaster')
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">


                        <!-- Default -->
                        <div class="row">
                            <div class="col-12">
                                <h5>Custom Card Update</h5>
                            </div>

                            <!-- Default Icons Wizard -->
                            <div class="col-12 mb-6">
                                <div id="wizard-validation" class="bs-stepper wizard-icons wizard-icons-example mt-2">
                                    <div class="bs-stepper-header">
                                        <div class="step" data-target="#step1">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bx-link'></i>
                                                </span>
                                                <span class="bs-stepper-label">Custome Link</span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </div>
                                        <div class="step" data-target="#step2">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bx-info-circle' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Review & Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <form id="customCardUpdateForm">
                                            <!-- Personal Info -->
                                            <div id="step1" class="content step-check">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Custom URL</h6>
                                                    <small>Enter Your url here.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="url">URL</label>
                                                        <input type="text" id="url" value="{{$customCard->url}}" name="url" class="form-control" placeholder="url" />
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-label-secondary btn-prev" disabled>
                                                            <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-next" id="personalInfoNext">
                                                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                                                            <i class="bx bx-right-arrow-alt bx-sm me-sm-n2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Review -->
                                            <div id="step2" class="content">
                                                <p class="fw-medium mb-2">Custom URL</p>
                                                <ul class="list-unstyled">
                                                    <li>URL: <span id="preview_url"></span></li>
                                                </ul>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <button type="button" class="btn btn-primary btn-prev">
                                                        <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <input id="card_id" name="card_id" value="{{$customCard->id}}" hidden="">
                                                    <button class="btn btn-success btn-submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Default Icons Wizard -->
                            @if($customCard->status)
                                <div class="col-12 mb-6">
                                    <div class="card">
                                        <h5 class="card-header">Disable Custom Card</h5>
                                        <div class="card-body">
                                            <div class="mb-6 col-12 mb-0">
                                                <div class="alert alert-warning">
                                                    <h5 class="alert-heading mb-1">Are you sure you want to disable your Custom Card?</h5>
                                                    <p class="mb-0">Once you disable your Custom Card, you can re-enable it later. Please be certain.</p>
                                                </div>
                                            </div>
                                            <form id="formAccountDeactivation" class="fv-plugins-bootstrap5 fv-plugins-framework customCardStatusUpdateForm">
                                                <div class="form-check my-8 ms-2">
                                                    <input class="form-check-input customCardStatus" type="checkbox" name="accountDeactivation" id="accountDeactivation">
                                                    <label class="form-check-label" for="accountDeactivation">I confirm my Custom Card deactivation</label>
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <input type="text" value="{{$customCard->id}}" name="card_id" hidden>
                                                <input type="text" value="deactivate" id="update_type" hidden>
                                                <button type="submit" class="btn btn-danger update-account-status">Deactivate Custom Card</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 mb-6">
                                    <div class="card">
                                        <h5 class="card-header">Enable Custom Card</h5>
                                        <div class="card-body">
                                            <div class="mb-6 col-12 mb-0">
                                                <div class="alert alert-warning">
                                                    <h5 class="alert-heading mb-1">Are you sure you want to enable this Custom Card?</h5>
                                                    <p class="mb-0">Once you enable your Custom Card, you can disable it later. Please be certain.</p>
                                                </div>
                                            </div>
                                            <form id="formAccountActivation" class="fv-plugins-bootstrap5 fv-plugins-framework customCardStatusUpdateForm">
                                                <div class="form-check my-8 ms-2">
                                                    <input class="form-check-input customCardStatus" type="checkbox" name="accountActivation" id="accountActivation">
                                                    <label class="form-check-label" for="accountActivation">I confirm my Custom Card activation</label>
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <input type="text" value="{{$customCard->id}}" name="card_id" hidden>
                                                <input type="text" value="activate" id="update_type" hidden>
                                                <button type="submit" class="btn btn-success update-account-status">Activate Custom Card</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/master_ui/js/custom-card/custom-card.js')}}"></script>
@endsection
