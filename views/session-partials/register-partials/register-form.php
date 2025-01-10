<form id="formAuthentication" class="mb-3" action="/register" method="POST">
    <div class="mb-3">
        <label for="first_name" class="form-label">First name</label>
        <input
            type="text"
            class="form-control"
            id="first_name"
            name="first_name"
            placeholder="Enter your first name"
            required
            value="<?= Core\Session::old('first_name') ?>"
            autofocus />
        <?php if (isset($errors['first_name'])) : ?>
            <li class="alert alert-danger alert-dismissible"><?= $errors['first_name'] ?></li>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="middle_name" class="form-label">Middle name</label>
        <input
            type="text"
            class="form-control"
            id="middle_name"
            name="middle_name"
            placeholder="Enter your middle name (optional)"
            value="<?= Core\Session::old('middle_name') ?>"
            autofocus />
        <?php if (isset($errors['middle_name'])) : ?>
            <li class="alert alert-danger alert-dismissible"><?= $errors['middle_name'] ?></li>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last name</label>
        <input
            type="text"
            class="form-control"
            id="last_name"
            name="last_name"
            placeholder="Enter your last name"
            value="<?= Core\Session::old('last_name') ?>"
            autofocus />
        <?php if (isset($errors['last_name'])) : ?>
            <li class="alert alert-danger alert-dismissible"><?= $errors['last_name'] ?></li>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= Core\Session::old('email') ?>" />
        <?php if (isset($errors['email'])) : ?>
            <li class="alert alert-danger alert-dismissible"><?= $errors['email'] ?></li>
        <?php endif; ?>
    </div>
    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
            <input
                type="password"
                id="password"
                class="form-control"
                name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        <?php if (isset($errors['password'])) : ?>
            <li class="alert alert-danger alert-dismissible"><?= $errors['password'] ?></li>
        <?php endif; ?>
    </div>
    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="confirm_password">Confirm Password</label>
        <div class="input-group input-group-merge">
            <input
                type="password"
                id="confirm_password"
                class="form-control"
                name="confirm_password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        <?php if (isset($errors['confirm_password'])) : ?>
            <li class="alert alert-danger alert-dismissible"><?= $errors['confirm_password'] ?></li>
        <?php endif; ?>
    </div>
    <button class="btn btn-primary d-grid w-100">Register</button>
</form>
