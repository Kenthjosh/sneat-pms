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
                        <div class="card-body">
                            <form action="" method="POST">
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="uuid" value="<?= $_GET['id'] ?>">
                                <div class="md-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" aria-label="Default select example">
                                        <option <?= $project['status'] === 'new' ? 'selected' : '' ?> value="new">New</option>
                                        <option <?= $project['status'] === 'in-progress' ? 'selected' : '' ?> value="in-progress">In progress</option>
                                        <option <?= $project['status'] === 'done' ? 'selected' : '' ?> value="done">Completed</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="project_name" class="form-label">Project name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="project_name"
                                        name="project_name"
                                        value="<?= $project['project_name'] ?>" />
                                    <?php if (isset($errors['project_name'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['project_name'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-4">
                                    <label for="project_desc" class="form-label">Project description</label>
                                    <textarea
                                        class="form-control" id="project_desc"
                                        name="project_desc"
                                        rows="5"><?= $project['project_desc'] ?></textarea>
                                    <?php if (isset($errors['project_desc'])) : ?>
                                        <li class="alert alert-danger alert-dismissible"><?= $errors['project_desc'] ?></li>
                                    <?php endif; ?>
                                </div>
                                <div>
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
