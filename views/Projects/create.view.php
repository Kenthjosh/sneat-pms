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
                        <h5 class="card-header">Add new project</h5>
                        <div class="card-body">
                            <form action="/project/store" method="POST">
                                <input type="hidden" name="creator_uuid" value="<?= $_SESSION['user']['uuid'] ?>">
                                <div class="mb-4">
                                    <label for="project_name" class="form-label">Project name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="project_name"
                                        name="project_name"
                                        placeholder="Project name here..." />
                                    <?php if (isset($errors['project_name'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['project_name'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-4">
                                    <label for="project_desc" class="form-label">Project description</label>
                                    <textarea class="form-control" id="project_desc" name="project_desc" rows="5" placeholder="Project description here..."></textarea>
                                    <?php if (isset($errors['project_desc'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['project_desc'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="text-end">
                                    <a class=" btn btn-sm btn-secondary p-2" href="/project">Cancel</a>
                                    <button type="submit" class=" btn btn-sm btn-warning p-2">Submit</button>
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
