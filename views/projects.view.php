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
                    <?php if (!empty($projects)) : ?>
                        <div class="card">
                            <h5 class="card-header">Projects <a href="/project/create" class="btn btn-warning mx-2">Add project</a></h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Project name</th>
                                            <th>Creator</th>
                                            <th>Project description</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- This will have a for each loop -->
                                        <?php foreach ($projects as $project) : ?>
                                            <tr>
                                                <td><?= $project['project_name'] ?></td>
                                                <td><?= $project['first_name'] . ' ' .  $project['middle_name'] . ' ' . $project['last_name'] ?></td>
                                                <td class="description-column"><?= $project['project_desc'] ?></td>
                                                <td>
                                                    <div class="text-light fw-medium">
                                                        <?php if ($project['status'] === 'new') : ?>
                                                            <h5 class="badge rounded-pill bg-info ">New</h5>
                                                        <?php elseif ($project['status'] === 'in-progress') : ?>
                                                            <h5 class="badge rounded-pill bg-warning">In Progress</h5>
                                                        <?php elseif ($project['status'] === 'done') : ?>
                                                            <h5 class="badge rounded-pill bg-success">Completed</h5>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td><?= date("F j, Y", strtotime($project['created_at'])) ?></td>
                                                <td><?= date("F j, Y", strtotime($project['updated_at'])) ?></td>
                                                <td>
                                                    <a class="dropdown-item btn btn-sm btn-info mb-1" href="/project/view?id=<?= $project['uuid'] ?>"><i class='bx bx-show'></i> View</a>
                                                    <a class="dropdown-item btn btn-sm btn-warning mb-1" href="/project/edit?id=<?= $project['uuid'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form action="/project/edit" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="uuid" value="<?= $project['uuid'] ?>">
                                                        <button type="submit" class="dropdown-item btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-4 flex-column">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">No projects available</h5>
                                    <a href="/project/create" class="btn btn-warning">Create new Project</a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if (count($deleted_projects) > 0) : ?>
                        <div class="card mt-4">
                            <h5 class="card-header">Deleted Projects </h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Project name</th>
                                            <th>Creator</th>
                                            <th>Project description</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- This will have a for each loop -->
                                        <?php foreach ($deleted_projects as $project) : ?>
                                            <tr>
                                                <td><?= $project['project_name'] ?></td>
                                                <td><?= $project['first_name'] . ' ' .  $project['middle_name'] . ' ' . $project['last_name'] ?></td>
                                                <td class="description-column"><?= $project['project_desc'] ?></td>
                                                <td>
                                                    <div class="text-light fw-medium">
                                                        <?php if ($project['status'] === 'new') : ?>
                                                            <h5 class="badge rounded-pill bg-info ">New</h5>
                                                        <?php elseif ($project['status'] === 'in-progress') : ?>
                                                            <h5 class="badge rounded-pill bg-warning">In Progress</h5>
                                                        <?php elseif ($project['status'] === 'done') : ?>
                                                            <h5 class="badge rounded-pill bg-success">Completed</h5>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td><?= date("F j, Y", strtotime($project['created_at'])) ?></td>
                                                <td><?= date("F j, Y", strtotime($project['updated_at'])) ?></td>
                                                <td>
                                                    <form action="/project/delete" method="POST" class="mb-1">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="uuid" value="<?= $project['uuid'] ?>">
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
                                                    <form action="/project/restore" method="POST">
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <input type="hidden" name="uuid" value="<?= $project['uuid'] ?>">
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
