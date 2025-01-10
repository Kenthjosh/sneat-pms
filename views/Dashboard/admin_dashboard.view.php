<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-full">
        <div class="card-body">
            <div class="card-title d-flex align-items-start mb-4">
                <i class="bx bx-paperclip my-1"></i>
                <h4 class="mb-1 mx-1">Projects</h4>
            </div>
            <h5 class="mb-1 text-info">New Projects: </h5>
            <strong class="card-title mb-3"><?= $projects['new_projects'] ?> Projects</strong>
            <br />
            <h5 class="mb-1 text-warning">Pending Projects: </h5>
            <strong class="card-title mb-3"><?= $projects['in_progress_projects'] ?> Projects</strong>
            <br />
            <h5 class="mb-1 text-success">Completed Projects: </h5>
            <strong class="card-title mb-3"><?= $projects['done_projects'] ?> Projects</strong>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-full">
        <div class="card-body">
            <div class="card-title d-flex align-items-start mb-4">
                <i class='bx bx-task my-1' ></i>
                <h4 class="mb-1 mx-1">Tasks</h4>
            </div>
            <h5 class="mb-1 text-info">New Tasks: </h5>
            <strong class="card-title mb-3"><?= $tasks['new_tasks'] ?> Tasks</strong>
            <br />
            <h5 class="mb-1 text-warning">Pending Tasks: </h5>
            <strong class="card-title mb-3"><?= $tasks['in_progress_tasks'] ?> Tasks</strong>
            <br />
            <h5 class="mb-1 text-success">Completed Tasks: </h5>
            <strong class="card-title mb-3"><?= $tasks['done_tasks'] ?> Tasks</strong>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-full">
        <div class="card-body">
            <div class="card-title d-flex align-items-start mb-4">
                <i class='bx bxs-user my-1'></i>
                <h4 class="mb-1 mx-1">User</h4>
            </div>
            <h5 class="mb-1 text-success">Active users: </h5>
            <strong class="card-title mb-3"><?= $users['active_accounts'] ?> Users</strong>
            <br />
            <h5 class="mb-1 text-danger">Inactive users: </h5>
            <strong class="card-title mb-3"><?= $users['soft_deleted_users'] ?> Users</strong>
        </div>
    </div>
</div>
