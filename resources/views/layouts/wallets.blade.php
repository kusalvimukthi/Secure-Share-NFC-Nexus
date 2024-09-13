<!DOCTYPE html>
<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/master_ui/"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Secure Share NFC Nexus</title>
    <meta name="description" content=""/>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/img/favicon/favicon.ico')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/fonts/boxicons.css')}}">

    <!-- Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/css/core.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/css/theme-default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/css/demo.css')}}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/libs/typeahead-js/typeahead.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/libs/bs-stepper/bs-stepper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/libs/bootstrap-select/bootstrap-select.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/libs/select2/select2.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/libs/quill/typography.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/libs/quill/katex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/master_ui/vendor/libs/quill/editor.css')}}">




    <!-- Helpers -->
    <script src="{{asset('assets/master_ui/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/master_ui/js/config.js')}}"></script>
</head>

<body>
<!-- Content -->

@yield('content')

<!-- / Content -->


<!-- Core JS -->
<!-- build:js assets/master_ui/vendor/js/core.js -->
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/jquery/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/popper/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/hammer/hammer.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/js/menu.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/select2/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/@form-validation/popular.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/@form-validation/auto-focus.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/quill/katex.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/vendor/libs/quill/quill.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/master_ui/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/js/form-wizard-icons.js')}}"></script>

<!-- Page JS -->
<script type="text/javascript" src="{{asset('assets/master_ui/js/jquery-ui.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('assets/master_ui/js/jquery.validate.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('assets/master_ui/js/jquery-validation-init.js')}}"></script>--}}

<script type="text/javascript" src="{{asset('assets/master_ui/js/wallets/wallets-card.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/js/forms-editor.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/js/auth/logout.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/js/ui-toasts.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/js/global.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/js/form-wizard-icons.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/js/secure-wallet-validation.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/master_ui/js/wallet/wallet.js')}}"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
