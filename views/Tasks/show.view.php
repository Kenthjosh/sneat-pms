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
                                <?php if ($task['status'] === 'new') : ?>
                                    <span class="badge rounded-pill bg-info">New</span>
                                <?php elseif ($task['status'] === 'in-progress') : ?>
                                    <span class="badge rounded-pill bg-warning">In Progress</span>
                                <?php elseif ($task['status'] === 'done') : ?>
                                    <span class="badge rounded-pill bg-success">Completed</span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-4">
                                <label for="task_name" class="form-label">Task name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="task_name"
                                    name="task_name"
                                    readonly
                                    value="<?= $task['task_name'] ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="task_creator" class="form-label">Task creator</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="task_creator"
                                    name="task_creator"
                                    readonly
                                    value="<?= $task['creator_first_name'] . ' ' .  $task['creator_middle_name'] . ' ' . $task['creator_last_name'] ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="task_desc" class="form-label">Task description</label>
                                <textarea
                                    class="form-control" id="task_desc"
                                    name="task_desc"
                                    rows="5"
                                    readonly><?= $task['task_desc'] ?></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="task_assignee" class="form-label">Task assigned</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="task_assignee"
                                    name="task_assignee"
                                    readonly
                                    value="<?= $task['assignee_first_name'] . ' ' .  $task['assignee_middle_name'] . ' ' . $task['assignee_last_name'] ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="project_creator" class="form-label">Created at</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="project_creator"
                                    name="project_creator"
                                    readonly
                                    value="<?= date("F j, Y", strtotime($task['created_at'])) ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="project_creator" class="form-label">Updated at</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="project_creator"
                                    name="project_creator"
                                    readonly
                                    value="<?= date("F j, Y", strtotime($task['updated_at'])) ?>" />
                            </div>
                            <div class="d-flex space-between">
                                <a class=" btn btn-sm btn-secondary p-2 m-1" href="/task"><i class='bx bx-arrow-back'></i> Back</a>
                                <?php if($_SESSION['user']['role'] !== 'user') : ?>
                                    <a class=" btn btn-sm btn-warning p-2 m-1" href="/task/edit?id=<?= $task['uuid'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <form action="/task/delete" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="uuid" value="<?= $task['uuid'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger p-2 m-1"><i class="bx bx-trash me-1"></i> Delete</button>
                                    </form>
                                <?php endif ?>
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
