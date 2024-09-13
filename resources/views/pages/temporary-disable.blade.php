@extends('layouts.main')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl container-p-y">
            <div class="misc-wrapper">
                <h2 class="mb-2 mx-2">This Card is Temporarily Unavailable 🚧</h2>
                <p class="mb-6 mx-2">
                    The owner of this smart business card has temporarily disabled it. Please check back later or reach out to them directly for more information.
                </p>
                <div class="mt-6">
                    <img src="../assets/master_ui/img/illustrations/girl-doing-yoga-light.png" alt="girl-doing-yoga-light" width="500" class="img-fluid" data-app-light-img="illustrations/girl-doing-yoga-light.png" data-app-dark-img="illustrations/girl-doing-yoga-dark.png">
                </div>
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">© Copyright
                    <script>
                        document.write(new Date().getFullYear());
                    </script>.<a href="https://secureshare.novatechlane.net/login" target="_blank" class="footer-link fw-bolder"> Secure Share NFC Nexus</a>
                </div>
                <div>
                    <a href="#" class="footer-link me-4" target="_blank">Privacy Policy</a>
                    <a href="#" target="_blank" class="footer-link me-4">Documentation</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
