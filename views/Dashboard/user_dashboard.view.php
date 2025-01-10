<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-full">
        <div class="card-body">
            <div class="card-title d-flex align-items-start mb-4">
                <i class='bx bx-task my-1' ></i>
                <h4 class="mb-1 mx-1">My Tasks</h4>
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
