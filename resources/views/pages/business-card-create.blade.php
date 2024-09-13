@extends('layouts.wizard')

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
                                <h5>Business Card Create</h5>
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
                                                    <i class='bx bxs-id-card' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Business Card Info</span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </div>
                                        <div class="step" data-target="#step3">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bxs-user-detail' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Extra Details</span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </div>
                                        <div class="step" data-target="#step4">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bx-link-alt' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Social Links</span>
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
                                        <form id="businessCardCreateForm">
                                            <!-- Account Details -->
                                            <div id="step1" class="content step-check">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Select Customer</h6>
                                                    <small>select a customer from the dropdown first</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6">
                                                        <label for="customerSelector" class="form-label">Select Customer</label>
                                                        <select id="customerSelector" class="select2 form-select form-select-lg" data-allow-clear="true" autofocus="">
                                                            <option value="0">select customer</option>
                                                            @foreach($customers as $customer)
                                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="cus_name">Name</label>
                                                        <input type="text" id="cus_name" name="cus_name" class="form-control" placeholder="johndoe" />
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="cus_email">Email</label>
                                                        <input type="email" id="cus_email" name="cus_email" class="form-control" placeholder="john.doe@email.com"/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="cus_tel_no">Phone Number</label>
                                                        <input type="text" id="cus_tel_no" name="cus_tel_no" class="form-control" placeholder="phone Number" />
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
                                            <div id="step2" class="content step-check">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Business Card Details</h6>
                                                    <small>fill in all fields to create the business card.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="name">Name for Card</label>
                                                        <input type="text" id="name" name="name" class="form-control" placeholder="name" />
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="tel_no">Phone Number</label>
                                                        <input type="text" id="tel_no" name="tel_no" class="form-control" placeholder="phone Number" />
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="email"/>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="address">Address</label>
                                                        <input type="text" id="address" name="address" class="form-control" placeholder="address" />
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="company_name">Company Name</label>
                                                        <input type="text" id="company_name" name="company_name" class="form-control" placeholder="company name" />
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="designation">Designation</label>
                                                        <input type="text" id="designation" name="designation" class="form-control" placeholder="designation" />
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-primary btn-prev">
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
                                            <!-- Address -->
                                            <div id="step3" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Profile Pictures</h6>
                                                    <small>add your profile picture and bio for the business card.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4">
                                                            <img src="../assets/master_ui/img/avatars/1.png" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                                            <div class="button-wrapper">
                                                                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                                                    <span class="d-none d-sm-block">Upload new photo</span>
                                                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                                                    <input type="file" id="upload" name="businessCardAvatar" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                                                </label>
                                                                <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                                                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Reset</span>
                                                                </button>
                                                                <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="card-bio" class="form-label">Bio</label>
                                                        <textarea class="form-control" id="bio" name="bio" rows="4"></textarea>
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
                                                    <h6 class="mb-0">Social Links</h6>
                                                    <small>Please add your social links; it will enhance your business card.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="web-link">Website link</label>
                                                        <input type="text" id="web-link" name="webLink" class="form-control" placeholder="https://website.com" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="Portfolio">Portfolio url</label>
                                                        <input type="text" id="Portfolio" name="portfolio" class="form-control" placeholder="https://portfolio.com" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="twitter">Twitter</label>
                                                        <input type="text" id="twitter" name="twitter" class="form-control" placeholder="https://twitter.com" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="facebook">Facebook</label>
                                                        <input type="text" id="facebook" name="facebook" class="form-control" placeholder="https://facebook.com" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="linkedin">Linkedin</label>
                                                        <input type="text" id="linkedin" name="linkedin" class="form-control" placeholder="https://linkedin.com" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="instagram">Instagram</label>
                                                        <input type="text" id="instagram" name="instagram" class="form-control" placeholder="https://instagram.com" />
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
                                                <p class="fw-medium mb-2">Business Card Info</p>
                                                <ul class="list-unstyled">
                                                    <li>Name: <span id="preview_business_card_name"></span></li>
                                                    <li>Phone Number: <span id="preview_card_tel_no"></span></li>
                                                    <li>Email: <span id="preview_business_card_email"></span></li>
                                                    <li>Address: <span id="preview_address"></span></li>
                                                    <li>Company Name: <span id="preview_company_name"></span></li>
                                                    <li>Designation: <span id="preview_designation"></span></li>
                                                </ul>
                                                <hr>
                                                <p class="fw-medium mb-2">Extra Details</p>
                                                <ul class="list-unstyled">
                                                    <li>Photo: <img class="d-block my-3 rounded-circle" id="imagePreview" src="#" alt="Image Preview" style="display:none; width:75px; height:75px;"></li>
                                                    <li>Bio: <span id="preview_bio"></span></li>
                                                </ul>
                                                <hr>
                                                <p class="fw-medium mb-2">Social Links</p>
                                                <ul class="list-unstyled">
                                                    <li>Website Link: <span id="preview_website_link"></span></li>
                                                    <li>Portfolio Link: <span id="preview_portfolio_link"></span></li>
                                                    <li>Twitter: <span id="preview_twitter_link"></span></li>
                                                    <li>Facebook: <span id="preview_facebook_link"></span></li>
                                                    <li>LinkedIn: <span id="preview_linkedin_link"></span></li>
                                                    <li>Instagram: <span id="preview_instagram_link"></span></li>
                                                </ul>
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
