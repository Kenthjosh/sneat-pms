<?php

// dashboard
$router->get('/', 'index.php')->only('auth');

// user routes
$router->get('/user', 'users.php')->only('admin');
$router->get('/user/view', 'Users/show.php')->only('admin');
$router->get('/user/edit', 'Users/edit.php')->only('admin');
$router->patch('/user/edit', 'Users/update.php')->only('admin');
$router->delete('/user/edit', 'Users/destroy.php')->only('admin'); // soft deletes
$router->patch('/user/restore', 'Users/restore.php')->only('admin');
$router->delete('/user/delete', 'Users/delete.php')->only('admin'); // permanent delete

$router->get('/user/register', 'Users/create.php')->only('admin'); // register user
$router->post('/user/register', 'Users/store.php')->only('admin'); // register user

$router->get('/project', 'projects.php')->only('admin'); // view projects
$router->get('/project/create', 'Projects/create.php')->only('admin'); // create project
$router->post('/project/store', 'Projects/store.php')->only('admin'); // create project
$router->get('/project/view', 'Projects/show.php')->only('admin'); // show project
$router->get('/project/edit', 'Projects/edit.php')->only('admin'); // edit project
$router->patch('/project/edit', 'Projects/update.php')->only('admin'); // edit project
$router->delete('/project/edit', 'Projects/destroy.php')->only('admin'); // soft delete project
$router->patch('/project/restore', 'Projects/restore.php')->only('admin');
$router->delete('/project/delete', 'Projects/delete.php')->only('admin'); // permanent delete

$router->get('/task', 'tasks.php')->only('auth'); // view tasks
$router->get('/task/create', 'Tasks/create.php')->only('admin'); // create task
$router->post('/task/store', 'Tasks/store.php')->only('admin'); // create task
$router->get('/task/view', 'Tasks/show.php')->only('auth'); // show task
$router->get('/task/edit', 'Tasks/edit.php')->only('admin'); // edit task
$router->patch('/task/edit', 'Tasks/update.php')->only('admin'); // edit task
$router->delete('/task/edit', 'Tasks/destroy.php')->only('admin'); // delete task
$router->patch('/task/complete', 'Tasks/complete.php')->only('auth'); // complete task
$router->patch('/task/revert', 'Tasks/revert.php')->only('auth'); // complete task
$router->patch('/task/restore', 'Tasks/restore.php')->only('admin');
$router->delete('/task/delete', 'Tasks/delete.php')->only('admin'); // permanent delete

$router->get('/profile/view', '/profile/show.php')->only('auth'); // view profile
$router->get('/profile/edit', '/profile/edit.php')->only('auth'); // edit profile
$router->patch('/profile/edit', '/profile/update.php')->only('auth'); // edit profile

// session routes
$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/login', 'sessions/store.php')->only('guest');
$router->delete('/logout', 'sessions/destroy.php')->only('auth');
// registration routes
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');
