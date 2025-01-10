<?php require base_path('views/partials/header.php') ?>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Aside Menu -->
        <?php require base_path('views/partials/aside.php') ?>
        <!-- / Aside Menu -->
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <?php require base_path('views/partials/nav.php') ?>
            <!-- / Navbar -->
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card">
                        <h5 class="card-header">Register new user</h5>
                        <div class="card-body">
                            <form id="formAuthentication" class="mb-3" action="/user/register" method="POST">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="first_name"
                                        name="first_name"
                                        placeholder="Enter your first name"
                                        required
                                        value="<?= Core\Session::old('first_name') ?>"
                                        autofocus />
                                    <?php if (isset($errors['first_name'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['first_name'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="middle_name" class="form-label">Middle name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="middle_name"
                                        name="middle_name"
                                        placeholder="Enter your middle name (optional)"
                                        value="<?= Core\Session::old('middle_name') ?>"
                                        autofocus />
                                    <?php if (isset($errors['middle_name'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['middle_name'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="last_name"
                                        name="last_name"
                                        placeholder="Enter your last name"
                                        value="<?= Core\Session::old('last_name') ?>"
                                        autofocus />
                                    <?php if (isset($errors['last_name'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['last_name'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role" default="user">
                                        <option value="user">User</option>
                                        <option value="project_manager">Project Manager</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= Core\Session::old('email') ?>" />
                                    <?php if (isset($errors['email'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['email'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="password"
                                            id="password"
                                            class="form-control"
                                            name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    <?php if (isset($errors['password'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['password'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="confirm_password">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="password"
                                            id="confirm_password"
                                            class="form-control"
                                            name="confirm_password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    <?php if (isset($errors['confirm_password'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['confirm_password'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="text-end mt-4">
                                    <a class=" btn btn-sm btn-secondary p-2" href="/user">Cancel</a>
                                    <button type="submit" class=" btn btn-sm btn-primary p-2">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
                <?php require base_path('views/partials/page-footer.php') ?>
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
<?php require base_path('views/partials/scripts.php') ?>
<?php require base_path('views/partials/footer.php') ?>
