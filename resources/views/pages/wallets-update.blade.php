@extends('layouts.wallets-update')

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
                                <h5>Secure Wallet Update</h5>
                            </div>

                            <!-- Default Icons Wizard -->
                            @if (Auth::user()->hasRole('customer'))
                            <div class="col-12 mb-6">
                                <div id="wizard-validation" class="bs-stepper wizard-icons wizard-icons-example mt-2">
                                    <div class="bs-stepper-header">
                                        <div class="step" data-target="#step1">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bxs-lock-alt' ></i>
                                                </span>
                                                <span class="bs-stepper-label">password Info</span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </div>
                                        <div class="step" data-target="#step2">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bxs-edit-alt' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Editor panel</span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </div>
                                        <div class="step" data-target="#step3">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bxs-notepad' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Extra Note</span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </div>
                                        <div class="step" data-target="#step4">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bx-info-circle' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Review & Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <form id="updateWalletForm">
                                            <!-- Personal Info -->
                                            <div id="step1" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Protected your Accounts</h6>
                                                    <small>enter your authentication details here.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div id="group-container">
                                                        @foreach($credentials as $index => $cred)
                                                        <div class="group-a">
                                                            <div data-repeater-item="" style="" >
                                                                <div class="row">
                                                                        <div class="mb-6 col-lg-6 col-xl-4 col-12 mb-0">
                                                                            <label class="form-label" for="url-0">URL</label>
                                                                            <input type="text" id="url-{{++$index}}" name="url-{{$index}}" class="form-control" value="{{$cred->url}}" placeholder="https://weburl.com">
                                                                        </div>
                                                                        <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                                                                            <label class="form-label" for="username-0">Username</label>
                                                                            <input type="text" id="username-{{$index}}" name="username-{{$index}}" value="{{$cred->username}}" class="form-control" placeholder="username">
                                                                        </div>
                                                                        <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                                                                            <div class="form-password-tog">
                                                                                <label class="form-label" for="basic-default-password32">Password</label>
                                                                                <div class="input-group input-group-merge">
                                                                                    <input type="password" class="form-control" id="password-{{$index}}" name="password-{{$index}}" value="{{$cred->password}}" placeholder="password" aria-describedby="basic-default-password">
                                                                                    <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <div class="mb-6 col-lg-12 col-xl-2 col-12 d-flex align-items-end mb-0">
                                                                        <button class="btn btn-label-danger" data-repeater-delete="" type="button">
                                                                            <i class="bx bx-x me-1"></i>
                                                                            <span class="align-middle">Delete</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <hr class="mt-0">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="mb-5 mt-0 text-end">
                                                        <button class="btn btn-primary" id="add-new-group"><i class="bx bx-plus me-1"></i><span class="align-middle">Add New</span></button>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-label-secondary btn-prev" disabled>
                                                            <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-next" id="firstNext">
                                                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                                                            <i class="bx bx-right-arrow-alt bx-sm me-sm-n2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Address -->
                                            <div id="step2" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Full Editor</h6>
                                                    <small>enter your own details here</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div id="full-editor">
                                                        {!! $wallet->editor_data !!}
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-primary btn-prev">
                                                            <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-next">
                                                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                                                            <i class="bx bx-right-arrow-alt bx-sm me-sm-n2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Social Links -->
                                            <div id="step3" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Additional Note</h6>
                                                    <small>enter your additional message or note here.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-12">
                                                        <textarea id="extra_note" name="note" rows="6" class="form-control">{{$wallet->note}}</textarea>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-primary btn-prev">
                                                            <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-next" id="lastStep">
                                                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                                                            <i class="bx bx-right-arrow-alt bx-sm me-sm-n2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Review -->
                                            <div id="step4" class="content">
                                                <p class="fw-medium mb-2">Accounts Details</p>
                                                <ul class="list-unstyled">
                                                    <div class="row">
                                                        <div id="url_preview" class="mb-6 col-lg-6 col-xl-4 col-12 mb-0">
                                                        </div>
                                                        <div id="username_preview" class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                                                        </div>
                                                        <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                                                            <div id="password_preview" class="form-password-tog">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                                <hr>
                                                <p class="fw-medium mb-2">Editor Note</p>
                                                <div id="richEditorContent"></div>
                                                <hr>
                                                <p class="fw-medium mb-2">Extra Note</p>
                                                <p id="extraNote"></p>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <button type="button" class="btn btn-primary btn-prev">
                                                        <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <input id="wallet_id" name="wallet_id" value="{{$wallet->id}}" hidden="">
                                                    <button class="btn btn-success btn-submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- /Default Icons Wizard -->
                            @if($wallet->status)
                                <div class="col-12 mb-6">
                                    <div class="card">
                                        <h5 class="card-header">Disable Wallet</h5>
                                        <div class="card-body">
                                            <div class="mb-6 col-12 mb-0">
                                                <div class="alert alert-warning">
                                                    <h5 class="alert-heading mb-1">Are you sure you want to disable your wallet?</h5>
                                                    <p class="mb-0">Once you disable your wallet, you can re-enable it later. Please be certain.</p>
                                                </div>
                                            </div>
                                            <form id="formAccountDeactivation" class="fv-plugins-bootstrap5 fv-plugins-framework walletCardStatusUpdateForm">
                                                <div class="form-check my-8 ms-2">
                                                    <input class="form-check-input walletCardStatus" type="checkbox" name="accountDeactivation" id="accountDeactivation">
                                                    <label class="form-check-label" for="accountActivation">I confirm my wallet deactivation</label>
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <input type="text" value="{{$wallet->id}}" name="card_id" hidden>
                                                <input type="text" value="deactivate" id="update_type" hidden>
                                                <button type="submit" class="btn btn-danger update-account-status">Deactivate Wallet</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 mb-6">
                                    <div class="card">
                                        <h5 class="card-header">Enable Wallet</h5>
                                        <div class="card-body">
                                            <div class="mb-6 col-12 mb-0">
                                                <div class="alert alert-warning">
                                                    <h5 class="alert-heading mb-1">Are you sure you want to enable this wallet?</h5>
                                                    <p class="mb-0">Once you enable your wallet, you can disable it later. Please be certain.</p>
                                                </div>
                                            </div>
                                            <form id="formAccountActivation" class="fv-plugins-bootstrap5 fv-plugins-framework walletCardStatusUpdateForm">
                                                <div class="form-check my-8 ms-2">
                                                    <input class="form-check-input walletCardStatus" type="checkbox" name="accountActivation" id="accountActivation">
                                                    <label class="form-check-label" for="accountActivation">I confirm my wallet activation</label>
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <input type="text" value="{{$wallet->id}}" name="card_id" hidden>
                                                <input type="text" value="activate" id="update_type" hidden>
                                                <button type="submit" class="btn btn-success update-account-status">Activate Wallet</button>
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
    <script type="text/javascript" src="{{asset('assets/master_ui/js/wallet/wallet.js')}}"></script>
@endsection