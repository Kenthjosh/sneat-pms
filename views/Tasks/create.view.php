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
                    <?php if (!empty($projects) && !empty($users)) : ?>
                        <div class="card">
                            <h5 class="card-header">Add new task</h5>
                            <div class="card-body">
                                <form action="/task/store" method="POST">
                                    <input type="hidden" name="creator_uuid" value="<?= $_SESSION['user']['uuid'] ?>">
                                    <div class="md-4">
                                        <label for="for_project" class="form-label">For project:</label>
                                        <select class="form-select" id="for_project" name="for_project" aria-label="Default select example">
                                            <?php foreach ($projects as $project) : ?>
                                                <?php if ($project['is_deleted']) continue; ?>
                                                <option value="<?= $project['uuid'] ?>"><?= $project['project_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4 mt-4">
                                        <label for="task_name" class="form-label">Task name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="task_name"
                                            name="task_name"
                                            placeholder="Task name here..." />
                                        <?php if (isset($errors['task_name'])) : ?>
                                            <li class="alert alert-danger alert-dismissible"><?= $errors['task_name'] ?></li>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-4">
                                        <label for="task_desc" class="form-label">Project description</label>
                                        <textarea class="form-control" id="task_desc" name="task_desc" rows="5" placeholder="Task description here..."></textarea>
                                        <?php if (isset($errors['task_desc'])) : ?>
                                            <li class="alert alert-danger alert-dismissible"><?= $errors['task_desc'] ?></li>
                                        <?php endif; ?>
                                    </div>
                                    <div class="md-4">
                                        <label for="for_user" class="form-label">For user:</label>
                                        <select class="form-select" id="for_user" name="for_user" aria-label="Default select example">
                                            <?php foreach ($users as $user) : ?>
                                                <?php if ($user['roles'] !== 'user') continue; ?>
                                                <option value="<?= $user['UUID'] ?>"><?= $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="text-end mt-4">
                                        <a class=" btn btn-sm btn-secondary p-2" href="/task">Cancel</a>
                                        <button type="submit" class=" btn btn-sm btn-warning p-2">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if (empty($projects)) : ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4 flex-column">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">No Projects available</h5>
                                        <a href="/project/create" class="btn btn-warning">Create new Project</a>
                                    </div>
                                </div>
                            </div>
                        <?php elseif (empty($users)) : ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4 flex-column">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">No Users available</h5>
                                        <a href="/user/register" class="btn btn-warning">Create new User</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
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
