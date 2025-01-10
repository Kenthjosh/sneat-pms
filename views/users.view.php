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
                    <?php if (count($users) > 1) : ?>
                        <div class="card">
                            <h5 class="card-header">Users <a href="/user/register" class="btn btn-warning mx-2">Add user</a></h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>First name</th>
                                            <th>Middle name</th>
                                            <th>Last name</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- This will have a for each loop -->
                                        <?php foreach ($users as $user) : ?>
                                            <?php if ($user['roles'] === 'admin' || $user['UUID'] === $_SESSION['user']['uuid']) continue ?>
                                            <tr>
                                                <td><?= htmlspecialchars(convertToTitleCase($user['roles'])) ?></td>
                                                <td class="description-column"><?= htmlspecialchars($user['email']) ?></td>
                                                <td><?= htmlspecialchars($user['first_name']) ?></td>
                                                <td><?= htmlspecialchars($user['middle_name'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($user['last_name']) ?></td>
                                                <td><?= date("F j, Y", strtotime($user['created_at'])) ?></td>
                                                <td><?= date("F j, Y", strtotime($user['updated_at'])) ?></td>
                                                <td>
                                                    <a class="dropdown-item btn btn-sm btn-info mb-1" href="/user/view?id=<?= $user['UUID'] ?>"><i class='bx bx-show'></i> View</a>
                                                    <a class="dropdown-item btn btn-sm btn-warning mb-1" href="/user/edit?id=<?= $user['UUID'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form action="/user/edit" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="uuid" value="<?= $user['UUID'] ?>">
                                                        <button type="submit" class="dropdown-item btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/ Basic Bootstrap Table -->
                    <?php else : ?>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-4 flex-column">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">No users registered</h5>
                                    <a href="/user/register" class="btn btn-warning">Create new User</a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if (count($deleted_users) > 0) : ?>
                        <div class="card mt-4">
                            <h5 class="card-header">Deleted Users</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>First name</th>
                                            <th>Middle name</th>
                                            <th>Last name</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- This will have a for each loop -->
                                        <?php foreach ($deleted_users as $user) : ?>
                                            <?php if ($user['roles'] === 'admin' || $user['UUID'] === $_SESSION['user']['uuid']) continue ?>
                                            <tr>
                                                <td><?= convertToTitleCase($user['roles']) ?></td>
                                                <td class="description-column"><?= $user['email'] ?></td>
                                                <td><?= $user['first_name'] ?></td>
                                                <td><?= $user['middle_name'] ?></td>
                                                <td><?= $user['last_name'] ?></td>
                                                <td><?= date("F j, Y", strtotime($user['created_at'])) ?></td>
                                                <td><?= date("F j, Y", strtotime($user['updated_at'])) ?></td>
                                                <td>
                                                    <form action="/user/delete" method="POST" class="mb-1">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="uuid" value="<?= $user['UUID'] ?>">
                                                        <button
                                                            type="submit"
                                                            class="dropdown-item btn btn-sm btn-danger"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-offset="0,4"
                                                            data-bs-placement="top"
                                                            data-bs-html="true"
                                                            title="<i class='bx bx-error' ></i> <span>May delete the task connected to this user</span>">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                    <form action="/user/restore" method="POST">
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <input type="hidden" name="uuid" value="<?= $user['UUID'] ?>">
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
