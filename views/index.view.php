<?php require 'partials/header.php' ?>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Aside Menu -->
        <?php require 'partials/aside.php' ?>
        <!-- / Aside Menu -->
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <?php require 'partials/nav.php' ?>
            <!-- / Navbar -->
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <?php if ($_SESSION['user']['role'] === 'admin') : ?>
                            <?php require BASE_PATH.'Http/controllers/Dashboard/admin_dashboard.php' ?>
                        <?php elseif ($_SESSION['user']['role'] === 'project_manager') : ?>
                            <?php require BASE_PATH.'Http/controllers/Dashboard/manager_dashboard.php' ?>
                        <?php elseif ($_SESSION['user']['role'] === 'user') : ?>
                            <?php require BASE_PATH.'Http/controllers/Dashboard/user_dashboard.php' ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- / Content -->
                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made by <b>Papiii</b>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->
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
<?php require 'partials/scripts.php' ?>
<?php require 'partials/footer.php' ?>
