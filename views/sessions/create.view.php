<?php require base_path('views/session-partials/header.php') ?>
<!-- Content -->
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <?php require base_path('views/session-partials/login-partials/login-logo.php') ?>
                    <!-- /Logo -->
                    <h4 class="mb-2">Welcome User! 👋</h4>
                    <?php require base_path('views/session-partials/login-partials/login-form.php') ?>
                    <!-- /Register -->
                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="/register">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php require base_path('views/session-partials/footer.php') ?>
