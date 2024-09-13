@extends('layouts.wallets')

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
                                <h5>Secure Wallet Create</h5>
                            </div>

                            <!-- Default Icons Wizard -->
                            <div class="col-12 mb-6">
                                <div id="wizard-validation" class="bs-stepper wizard-icons wizard-icons-example mt-2">
                                    <div class="bs-stepper-header">
                                        <div class="step" data-target="#step1">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bxs-user-circle' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Select Customer</span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </div>
                                        <div class="step" data-target="#step2">
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
                                        <div class="step" data-target="#step3">
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
                                        <div class="step" data-target="#step4">
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
                                        <div class="step" data-target="#step5">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bx-info-circle' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Review & Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <form id="createWalletForm">
                                            <!-- Account Details -->
                                            <div id="step1" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Select Customer</h6>
                                                    <small>select a customer from the dropdown first</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6">
                                                        <label for="customerSelector" class="form-label">Select Customer</label>
                                                        <select id="customerSelector" class="select2 form-select form-select-lg" data-allow-clear="true" autofocus="">
                                                            <option value="0">Select a customer....</option>
                                                            @foreach($customers as $customer)
                                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="cus_name">Name</label>
                                                        <input type="text" id="cus_name" name="name" class="form-control" placeholder="john doe" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="cus_email">Email</label>
                                                        <input type="email" id="cus_email" name="email" class="form-control" placeholder="john.doe@email.com"/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="cus_tel_no">Phone Number</label>
                                                        <input type="text" id="cus_tel_no" name="tel_no" class="form-control" placeholder="phone Number" />
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
                                            <!-- Personal Info -->
                                            <div id="step2" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">protected your Accounts</h6>
                                                    <small>enter your authentication details here.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div id="group-container">
                                                        <div class="group-a">
                                                            <div data-repeater-item="" style="">
                                                                <div class="row">
                                                                    <div class="mb-6 col-lg-6 col-xl-4 col-12 mb-0">
                                                                        <label class="form-label" for="url-0">URL</label>
                                                                        <input type="text" id="url-1" name="url-1" class="form-control" placeholder="https://weburl.com">
                                                                    </div>
                                                                    <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                                                                        <label class="form-label" for="username-0">Username</label>
                                                                        <input type="text" id="username-1" name="username-1" class="form-control" placeholder="username">
                                                                    </div>
                                                                    <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                                                                        <div class="form-password-toggle">
                                                                            <label class="form-label" for="basic-default-password32">Password</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <input type="password" class="form-control" id="password-1" name="password-1" placeholder="password" aria-describedby="basic-default-password">
                                                                                <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-6 col-lg-12 col-xl-2 col-12 d-flex align-items-end mb-0">
                                                                        <button class="btn btn-label-danger" data-repeater-delete="">
                                                                            <i class="bx bx-x me-1"></i>
                                                                            <span class="align-middle">Delete</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <hr class="mt-0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 mt-0 text-end">
                                                        <button class="btn btn-primary" id="add-new-group"><i class="bx bx-plus me-1"></i><span class="align-middle">Add New</span></button>
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
                                            <!-- Address -->
                                            <div id="step3" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Full Editor</h6>
                                                    <small>enter your own details here</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div id="full-editor">
                                                        <p>Use this editor to add your custom notes</p>
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
                                            <div id="step4" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Additional Note</h6>
                                                    <small>enter your additional message or note here.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-12">
                                                        <textarea id="extra_note" name="note" rows="6" class="form-control"></textarea>
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
                                            <div id="step5" class="content">

                                                <p class="fw-medium mb-2">Select Customer</p>
                                                <ul class="list-unstyled">
                                                    <li>Customer ID: <span id="preview_cus_id"></span></li>
                                                    <li>Name: <span id="preview_name"></span></li>
                                                    <li>Email: <span id="preview_email"></span></li>
                                                    <li>Phone Number: <span id="preview_tel_no"></span></li>
                                                </ul>
                                                <hr>
                                                <p class="fw-medium mb-2">Authentication Details</p>
                                                <ul class="list-unstyled">
                                                    <div class="row">
                                                        <div id="url_preview" class="mb-6 col-lg-6 col-xl-4 col-12 mb-0">
                                                        </div>
                                                        <div id="username_preview" class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                                                        </div>
                                                        <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                                                            <div id="password_preview" class="form-password-toggle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                                <hr>
                                                <p class="fw-medium mb-2">Editor Note</p>
                                                <div id="richEditorContent"></div>
                                                <hr>
                                                <p class="fw-medium mb-2">Additional Note</p>
                                                <p id="extraNote"></p>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <button type="button" class="btn btn-primary btn-prev">
                                                        <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <button class="btn btn-success btn-submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Default Icons Wizard -->
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
