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
                                <h5>Storage Tag Update</h5>
                            </div>

                            <!-- Default Icons Wizard -->
                            <div class="col-12 mb-6">
                                <div id="wizard-validation" class="bs-stepper wizard-icons wizard-icons-example mt-2">
                                    <div class="bs-stepper-header">
                                        <div class="step" data-target="#step1">
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
                                        <div class="step" data-target="#step2">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-icon">
                                                    <i class='bx bxs-info-circle' ></i>
                                                </span>
                                                <span class="bs-stepper-label">Review & Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <form id="storageCardUpdateForm">
                                            <!-- Address -->
                                            <div id="step1" class="content">
                                                <div class="content-header mb-4">
                                                    <h6 class="mb-0">Item Image</h6>
                                                    <small>upload your item img.</small>
                                                </div>
                                                <div class="row g-6">
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4">
                                                            <img src="@if($storageTag->avatar) {{$storageTag->avatar}} @else ../assets/master_ui/img/avatars/1.png @endif" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
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
                                                        <textarea class="form-control" id="pdetails" name="product_details" rows="4">{{$storageTag->product_details}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row g-6 pt-4">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="product">Product Name</label>
                                                        <input type="text" id="product" name="product_name" class="form-control" value="{{$storageTag->product_name}}"/>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="pweight">Product Weight</label>
                                                        <input type="text" id="pweight" name="product_weight" value="{{$storageTag->product_weight}}" class="form-control"/>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="mnfdate">Manufacture date</label>
                                                        <input type="date" id="mnfdate" name="manufactured_date" class="form-control" value="{{$storageTag->manufactured_date}}"/>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="form-label" for="exdate">Expiration date</label>
                                                        <input type="date" id="exdate" name="expiration_date" class="form-control" value="{{$storageTag->expiration_date}}"/>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-label-secondary btn-prev" disabled>
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
                                            <div id="step2" class="content">
                                                <p class="fw-medium mb-2">Storage Tag Details</p>
                                                <ul class="list-unstyled">
                                                    <li>Photo: <img class="d-block my-3 rounded-circle" id="imagePreview" src="{{$storageTag->avatar}}" alt="Image Preview" style="display:none; width:75px; height:75px;"></li>
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
                                                    <input id="storage_tag_id" name="storage_tag_id" value="{{$storageTag->id}}" hidden="">
                                                    <button type="submit" class="btn btn-success btn-submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Default Icons Wizard -->
                            @if($storageTag->status)
                                <div class="col-12 mb-6">
                                    <div class="card">
                                        <h5 class="card-header">Disable Storage Tag</h5>
                                        <div class="card-body">
                                            <div class="mb-6 col-12 mb-0">
                                                <div class="alert alert-warning">
                                                    <h5 class="alert-heading mb-1">Are you sure you want to disable your Storage Tag?</h5>
                                                    <p class="mb-0">Once you disable your Storage Tag, you can re-enable it later. Please be certain.</p>
                                                </div>
                                            </div>
                                            <form id="formAccountDeactivation" class="fv-plugins-bootstrap5 fv-plugins-framework storageCardStatusUpdateForm">
                                                <div class="form-check my-8 ms-2">
                                                    <input class="form-check-input storageCardStatus" type="checkbox" name="accountDeactivation" id="accountDeactivation">
                                                    <label class="form-check-label" for="accountDeactivation">I confirm my Storage Tag deactivation</label>
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <input type="text" value="{{$storageTag->id}}" name="card_id" hidden>
                                                <input type="text" value="deactivate" id="update_type" hidden>
                                                <button type="submit" class="btn btn-danger update-account-status">Deactivate Storage Tag</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 mb-6">
                                    <div class="card">
                                        <h5 class="card-header">Enable Storage Tag</h5>
                                        <div class="card-body">
                                            <div class="mb-6 col-12 mb-0">
                                                <div class="alert alert-warning">
                                                    <h5 class="alert-heading mb-1">Are you sure you want to enable this Storage Tag?</h5>
                                                    <p class="mb-0">Once you enable your Storage Tag, you can disable it later. Please be certain.</p>
                                                </div>
                                            </div>
                                            <form id="formAccountActivation" class="fv-plugins-bootstrap5 fv-plugins-framework storageCardStatusUpdateForm">
                                                <div class="form-check my-8 ms-2">
                                                    <input class="form-check-input storageCardStatus" type="checkbox" name="accountActivation" id="accountActivation">
                                                    <label class="form-check-label" for="accountActivation">I confirm my Storage Tag activation</label>
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <input type="text" value="{{$storageTag->id}}" name="card_id" hidden>
                                                <input type="text" value="activate" id="update_type" hidden>
                                                <button type="submit" class="btn btn-success update-account-status">Activate Storage Tag</button>
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
    <script type="text/javascript" src="{{asset('assets/master_ui/js/storage-tag/storage-tag.js')}}"></script>
@endsection
