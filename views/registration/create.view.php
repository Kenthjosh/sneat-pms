<?php require base_path('views/session-partials/header.php') ?>
<!-- Content -->
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card -->
            <div class="card">
                <div class="card-body">
                    <?php require base_path('views/session-partials/register-partials/register-logo.php') ?>
                    <!-- Register Form -->
                    <?php require base_path('views/session-partials/register-partials/register-form.php') ?>
                    <!--  Login redirect -->
                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="/login">
                            <span>Log in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
</div>
<!-- / Content -->
<?php require base_path('views/session-partials/footer.php') ?>
