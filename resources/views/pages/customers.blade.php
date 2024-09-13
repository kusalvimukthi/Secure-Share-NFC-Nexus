@extends('layouts.master')

@section('content')
    @include('components.toaster')
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
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Customer Tables</h4>

                        <!-- Responsive Table -->
                        <div class="card">
                            <div class="card-datatable table-responsive text-nowrap">
                                @component('components.data-tables', [
                                    'tableId' => 'customers-table',
                                    'columns' => [
//                                        ['title' => '', 'data' => null],
                                        ['title' => '', 'data' => null],
                                        ['title' => 'ID', 'data' => 'id'],
                                        ['title' => 'Email', 'data' => 'email'],
                                        ['title' => 'NIC Number', 'data' => 'nic'],
                                        ['title' => 'Status', 'data' => 'status'],
                                        ['title' => 'Action', 'data' => 'action'],
                                    ]
                                ])
                                @endcomponent
                            </div>
                        </div>
                        <!--/ Responsive Table -->
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
