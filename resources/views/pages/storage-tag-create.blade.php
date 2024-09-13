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
                                <h5>Storage Tag Create</h5>
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
                                                   <i class='bx bxs-book-content'></i>
                                                </span>
                                                <span class="bs-stepper-label">Storage Details</span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </div>
                                        <div class="step" data-target="#step3">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bxs-info-circle' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Review & Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <form id="storageCardCreateForm">
                                            <!-- Account Details -->
                                            <div id="step1" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Account Details</h6>
                                                    <small>Enter Your Account Details.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6">
                                                        <label for="customerSelector" class="form-label">Select Customer ID :</label>
                                                        <select id="customerSelector" class="select2 form-select form-select-lg" data-allow-clear="true" autofocus="">
                                                            <option value="0">select customer</option>
                                                            @foreach($customers as $customer)
                                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="cus_name">Name</label>
                                                        <input type="text" id="cus_name" name="cus_name" class="form-control" placeholder="johndoe" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="cus_email">Email</label>
                                                        <input type="email" id="cus_email" class="form-control" placeholder="john.doe@email.com"/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="cus_tel_no">Phone Number</label>
                                                        <input type="text" id="cus_tel_no" class="form-control" placeholder="phone Number" />
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-label-secondary btn-prev" disabled>
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
                                            <div id="step2" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Item Image</h6>
                                                    <small>upload your item img.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4">
                                                            <img src="../assets/master_ui/img/avatars/1.png" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                                            <div class="button-wrapper">
                                                                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                                                    <span class="d-none d-sm-block">Upload new photo</span>
                                                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                                                    <input type="file" id="upload" name="storageAvatar" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                                                </label>
                                                                <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                                                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Reset</span>
                                                                </button>
                                                                <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label for="pdetails" class="form-label">Product Details</label>
                                                        <textarea class="form-control" id="pdetails" name="product_details" rows="4"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row g-6 pt-4">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="product">Product Name</label>
                                                        <input type="text" id="product" name="product_name" class="form-control"/>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="pweight">Product Weight</label>
                                                        <input type="text" id="pweight" name="product_weight" class="form-control"/>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="mnfdate">Manufacture date</label>
                                                        <input type="date" id="mnfdate" name="manufactured_date" class="form-control"/>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="exdate">expir date</label>
                                                        <input type="date" id="exdate" name="expiration_date" class="form-control"/>
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
                                            <!-- Social Links -->
                                            <!-- Review -->
                                            <div id="step3" class="content">
                                                <p class="fw-medium mb-2">Select Customer</p>
                                                <ul class="list-unstyled">
                                                    <li>Customer ID: <span id="preview_cus_id"></span></li>
                                                    <li>Name: <span id="preview_name"></span></li>
                                                    <li>Email: <span id="preview_email"></span></li>
                                                    <li>Phone Number: <span id="preview_tel_no"></span></li>
                                                </ul>
                                                <hr>
                                                <p class="fw-medium mb-2">Storage Tag Details</p>
                                                <ul class="list-unstyled">
                                                    <li>Photo: <img class="d-block my-3 rounded-circle" id="imagePreview" src="#" alt="Image Preview" style="display:none; width:75px; height:75px;"></li>
                                                    <li>Product Name: <span id="product_name_preview"></span></li>
                                                    <li>Product Weight: <span id="product_weight_preview"></span></li>
                                                    <li>Product Details: <span id="product_details_preview"></span></li>
                                                    <li>manufacture date: <span id="storage_manufactured_date_preview"></span></li>
                                                    <li>Ex date: <span id="expiration_date_preview"></span></li>
                                                </ul>
                                                <hr>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <button type="button" class="btn btn-primary btn-prev">
                                                        <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-success btn-submit">Submit</button>
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
