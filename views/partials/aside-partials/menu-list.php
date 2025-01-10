<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item <?= urlIs('/') ? 'active' : '' ?> ">
        <a href="/" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics"><?= checkRole($_SESSION['user']['role'] === 'admin') ? 'Admin Dashboard' : 'Dashboard' ?></div>
        </a>
    </li>

    <!-- Users -->
    <li class="menu-item <?= urlIs('/user') ? 'active' : '' ?> <?= checkRole($_SESSION['user']['role'] === 'admin') ? '' : 'hidden' ?>">
        <a href="/user" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-user-account"></i>
            <div data-i18n="Analytics">Users</div>
        </a>
    </li>

    <!-- Projects -->
    <li class="menu-item <?= urlIs('/project') ? 'active' : '' ?> <?= checkRole($_SESSION['user']['role'] === 'user') ? 'hidden' : '' ?>">
        <a href="/project" class="menu-link">
            <i class="menu-icon tf-icons bx bx-paperclip"></i>
            <div data-i18n="Analytics"><?= checkRole($_SESSION['user']['role'] === 'admin') ? 'All Projects' : 'My Projects' ?></div>
        </a>
    </li>

    <!-- Tasks -->
    <li class="menu-item <?= urlIs('/task') ? 'active' : '' ?> ">
        <a href="/task" class="menu-link">
            <i class='menu-icon tf-icons bx bx-task'></i>
            <div data-i18n="Analytics"><?= checkRole($_SESSION['user']['role'] === 'admin') ? 'All Tasks' : 'My Tasks' ?></div>
        </a>
    </li>

</ul>
<style>
    .hidden {
        display: none;
    }
</style>
