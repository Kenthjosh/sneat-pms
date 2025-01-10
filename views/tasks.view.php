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
                    <?php if (!empty($tasks)) : ?>
                        <div class="card">
                            <h5 class="card-header">
                                Tasks
                                <?php if ($_SESSION['user']['role'] !== 'user') : ?>
                                    <a href="/task/create" class="btn btn-warning mx-2">Add task</a>
                                <?php endif ?>
                            </h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Creator</th>
                                            <th>Description</th>
                                            <th>For user</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- This will have a for each loop -->
                                        <?php foreach ($tasks as $task) : ?>
                                            <tr>
                                                <td><?= $task['task_name'] ?></td>
                                                <td><?= $task['creator_first_name'] . ' ' .  $task['creator_middle_name'] . ' ' . $task['creator_last_name'] ?></td>
                                                <td class="description-column"><?= $task['task_desc'] ?></td>
                                                <td><?= $task['assignee_first_name'] . ' ' .  $task['assignee_middle_name'] . ' ' . $task['assignee_last_name'] ?></td>
                                                <td>
                                                    <div class="text-light fw-medium">
                                                        <?php if ($task['status'] === 'new') : ?>
                                                            <h5 class="badge rounded-pill bg-info ">New</h5>
                                                        <?php elseif ($task['status'] === 'in-progress') : ?>
                                                            <h5 class="badge rounded-pill bg-warning">In Progress</h5>
                                                        <?php elseif ($task['status'] === 'done') : ?>
                                                            <h5 class="badge rounded-pill bg-success">Completed</h5>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td><?= date("F j, Y", strtotime($task['created_at'])) ?></td>
                                                <td><?= date("F j, Y", strtotime($task['updated_at'])) ?></td>
                                                <td>
                                                    <a class="dropdown-item btn btn-sm btn-info mb-1" href="/task/view?id=<?= $task['uuid'] ?>"><i class='bx bx-show'></i> View</a>
                                                    <?php if ($role !== 'user') : ?>
                                                        <a class="dropdown-item btn btn-sm btn-warning mb-1" href="/task/edit?id=<?= $task['uuid'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <form action="/task/edit" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="uuid" value="<?= $task['uuid'] ?>">
                                                            <button type="submit" class="dropdown-item btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i> Delete</button>
                                                        </form>
                                                    <?php else : ?>
                                                        <?php if ($task['status'] !== 'done') : ?>
                                                            <form action="/task/complete" method="POST">
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                <input type="hidden" name="uuid" value="<?= $task['uuid'] ?>">
                                                                <button type="submit" class="dropdown-item btn btn-sm btn-success"><i class='bx bx-check'></i> Complete</button>
                                                            </form>
                                                        <?php else : ?>
                                                            <form action="/task/revert" method="POST">
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                <input type="hidden" name="uuid" value="<?= $task['uuid'] ?>">
                                                                <button type="submit" class="dropdown-item btn btn-sm btn-danger"><i class='bx bx-undo'></i> Revert</button>
                                                            </form>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if ($_SESSION['user']['role'] !== 'user') : ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4 flex-column">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">No Task available</h5>
                                        <a href="/task/create" class="btn btn-warning">Create new Task</a>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4 flex-column">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">No Task available yet.</h5>
                                        <h5 class="card-title">Wait for task to be assigned</h5>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                    <?php if (count($deleted_tasks) > 0 ?? false && $_SESSION['user']['role'] === 'admin' ?? false ) : ?>
                        <div class="card mt-4">
                            <h5 class="card-header">
                                Deleted Tasks
                            </h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Creator</th>
                                            <th>Description</th>
                                            <th>For user</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- This will have a for each loop -->
                                        <?php foreach ($deleted_tasks as $task) : ?>
                                            <tr>
                                                <td><?= $task['task_name'] ?></td>
                                                <td><?= $task['creator_first_name'] . ' ' .  $task['creator_middle_name'] . ' ' . $task['creator_last_name'] ?></td>
                                                <td class="description-column"><?= $task['task_desc'] ?></td>
                                                <td><?= $task['assignee_first_name'] . ' ' .  $task['assignee_middle_name'] . ' ' . $task['assignee_last_name'] ?></td>
                                                <td>
                                                    <div class="text-light fw-medium">
                                                        <?php if ($task['status'] === 'new') : ?>
                                                            <h5 class="badge rounded-pill bg-info ">New</h5>
                                                        <?php elseif ($task['status'] === 'in-progress') : ?>
                                                            <h5 class="badge rounded-pill bg-warning">In Progress</h5>
                                                        <?php elseif ($task['status'] === 'done') : ?>
                                                            <h5 class="badge rounded-pill bg-success">Completed</h5>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td><?= date("F j, Y", strtotime($task['created_at'])) ?></td>
                                                <td><?= date("F j, Y", strtotime($task['updated_at'])) ?></td>
                                                <td>
                                                    <form action="/task/delete" method="POST" class="mb-1">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="uuid" value="<?= $task['uuid'] ?>">
                                                        <button
                                                            type="submit"
                                                            class="dropdown-item btn btn-sm btn-danger"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-offset="0,4"
                                                            data-bs-placement="top"
                                                            data-bs-html="true"
                                                            title="<i class='bx bx-error' ></i> <span>May delete tasks connected to this project</span>">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                    <form action="/task/restore" method="POST">
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <input type="hidden" name="uuid" value="<?= $task['uuid'] ?>">
                                                        <button type="submit" class="dropdown-item btn btn-sm btn-success"><i class='bx bx-undo'></i> Restore</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <!-- / Content -->
                <?php require 'partials/page-footer.php' ?>
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
