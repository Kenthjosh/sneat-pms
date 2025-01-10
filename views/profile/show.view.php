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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-6">
                                <div class="card-body pt-4">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="first_name"
                                            name="first_name"
                                            readonly
                                            required
                                            value="<?= $user['first_name'] ?? '' ?>"
                                            autofocus />
                                    </div>
                                    <div class="mb-3">
                                        <label for="middle_name" class="form-label">Middle name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="middle_name"
                                            name="middle_name"
                                            readonly
                                            value="<?= $user['middle_name'] ?? '' ?>"
                                            autofocus />
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="last_name"
                                            name="last_name"
                                            readonly
                                            value="<?= $user['last_name'] ?? '' ?>"
                                            autofocus />
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Role</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="last_name"
                                            name="last_name"
                                            readonly
                                            value="<?= convertToTitleCase($user['roles']) ?>"
                                            autofocus />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" readonly value="<?= $user['email'] ?? '' ?>" />
                                    </div>
                                    <div class="d-flex space-between">
                                        <a class=" btn btn-sm btn-secondary p-2 m-1" href="/"><i class='bx bx-arrow-back'></i> Back</a>
                                        <a class=" btn btn-sm btn-warning p-2 m-1" href="/profile/edit?id=<?= $user['UUID'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    </div>
                                </div>
                                <!-- /Account -->
                            </div>
                        </div>
                    </div>
                </div>
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
