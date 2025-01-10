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
                            <div class="text-light medium fw-medium mb-2">
                                <?php if ($project['status'] === 'new') : ?>
                                    <span class="badge rounded-pill bg-info">New</span>
                                <?php elseif ($project['status'] === 'in-progress') : ?>
                                    <span class="badge rounded-pill bg-warning">In Progress</span>
                                <?php elseif ($project['status'] === 'done') : ?>
                                    <span class="badge rounded-pill bg-success">Completed</span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-4">
                                <label for="project_name" class="form-label">Project name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="project_name"
                                    name="project_name"
                                    readonly
                                    value="<?= $project['project_name'] ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="project_creator" class="form-label">Project creator</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="project_creator"
                                    name="project_creator"
                                    readonly
                                    value="<?= $project['first_name'] . ' ' . $project['middle_name'] . ' ' . $project['last_name'] ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="project_desc" class="form-label">Project description</label>
                                <textarea
                                    class="form-control" id="project_desc"
                                    name="project_desc"
                                    rows="5"
                                    readonly><?= $project['project_desc'] ?></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="project_creator" class="form-label">Created at</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="project_creator"
                                    name="project_creator"
                                    readonly
                                    value="<?= date("F j, Y", strtotime($project['created_at'])) ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="project_creator" class="form-label">Updated at</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="project_creator"
                                    name="project_creator"
                                    readonly
                                    value="<?= date("F j, Y", strtotime($project['updated_at'])) ?>" />
                            </div>
                            <div class="d-flex space-between">
                                <a class=" btn btn-sm btn-secondary p-2 m-1" href="/project"><i class='bx bx-arrow-back'></i> Back</a>
                                <a class=" btn btn-sm btn-warning p-2 m-1" href="/project/edit?id=<?= $project['uuid'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <form action="/project/delete" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="uuid" value="<?= $project['uuid'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger p-2 m-1"><i class="bx bx-trash me-1"></i> Delete</button>
                                </form>
                            </div>
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
