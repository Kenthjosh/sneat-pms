<form class="mb-3" action="/login" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email or Username</label>
        <input
            type="text"
            class="form-control"
            id="email"
            name="email"
            placeholder="Enter your email"
            value="<?= Core\Session::old('email') ?>"
            autofocus />
    </div>
    <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Password</label>
        </div>
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
    </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">Log in</button>
    </div>
    <ul>
        <?php if (isset($errors['email'])) : ?>
            <li class="alert alert-danger alert-dismissible"><?= $errors['email'] ?></li>
        <?php endif; ?>

        <?php if (isset($errors['password'])) : ?>
            <li class="alert alert-danger alert-dismissible"><?= $errors['password'] ?></li>
        <?php endif; ?>
    </ul>
</form>
