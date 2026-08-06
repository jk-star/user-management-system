## Step 7 — User Management CRUD

- **Goal:** Admin users ko **List, Add, View, Edit aur Delete** kar sake.

Final flow:
<code><pre>
Users
  │
  ├── List Users
  ├── Add User
  ├── View User
  ├── Edit User
  └── Delete User
</pre></code>

- Abhi **basic CRUD** banayenge. Search, pagination, AJAX etc. baad ke steps me isi CRUD me add honge.

## 1. User Controller Create Karo
Terminal: `php spark make:controller Admin/UserController`

File: `app/Controllers/Admin/UserController.php`

Basic structure:
<code><pre>
&lt;?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
}
</pre></code>

- `$userModel` baar-baar kyun nahi bana rahe?
- Instead of every method:  `$userModel = new UserModel();`
- hum constructor me ek baar:  `$this->userModel = new UserModel();` kar rahe hain.
- Phir kisi bhi method me: `$this->userModel` use kar sakte hain.


## 2. User Routes

- Apne existing protected admin group ke andar routes add karo:

<code><pre>
$routes->group(
    'admin',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            'dashboard',
            'Admin\DashboardController::index'
        );

        $routes->get(
            'users',
            'Admin\UserController::index'
        );

        $routes->get(
            'users/create',
            'Admin\UserController::create'
        );

        $routes->post(
            'users/store',
            'Admin\UserController::store'
        );

        $routes->get(
            'users/(:num)',
            'Admin\UserController::show/$1'
        );

        $routes->get(
            'users/edit/(:num)',
            'Admin\UserController::edit/$1'
        );

        $routes->post(
            'users/update/(:num)',
            'Admin\UserController::update/$1'
        );

        $routes->post(
            'users/delete/(:num)',
            'Admin\UserController::delete/$1'
        );
    }
);
</pre></code>

## 3. User List — READ
Controller:
<code><pre>
public function index()
{
    $data = [
        'title' => 'Users',
        'users' => $this->userModel
            ->orderBy('id', 'DESC')
            ->findAll()
    ];

    return view('admin/users/index', $data);
}
</pre></code>

Create: `app/Views/admin/users/index.php`

<code><pre>
&lt;?= $this->extend('layouts/admin') ?&gt;

&lt;?= $this->section('content') ?&gt;

&lt;div class="d-flex justify-content-between mb-4"&gt;
    &lt;h2&gt;Users&lt;/h2&gt;
    &lt;a
        href="&lt;?= site_url('admin/users/create') ?&gt;"
        class="btn btn-primary"
    &gt;
        Add User
    &lt;/a&gt;

&lt;/div&gt;

&lt;?php if (session()->getFlashdata('success')): ?&gt;
    &lt;div class="alert alert-success"&gt;
        &lt;?= esc(session()->getFlashdata('success')) ?&gt;
    &lt;/div&gt;

&lt;?php endif; ?&gt;

&lt;table class="table table-bordered"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th&gt;ID&lt;/th&gt;
            &lt;th&gt;Name&lt;/th&gt;
            &lt;th&gt;Email&lt;/th&gt;
            &lt;th&gt;Role&lt;/th&gt;
            &lt;th&gt;Status&lt;/th&gt;
            &lt;th&gt;Action&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
        &lt;?php foreach ($users as $user): ?&gt;
            &lt;tr&gt;
                &lt;td&gt;&lt;?= esc($user['id']) ?&gt;&lt;/td&gt;
                &lt;td&gt;&lt;?= esc($user['name']) ?&gt;&lt;/td&gt;
                &lt;td&gt;&lt;?= esc($user['email']) ?&gt;&lt;/td&gt;
                &lt;td&gt;&lt;?= esc($user['role']) ?&gt;&lt;/td&gt;
                &lt;td&gt;&lt;?= esc($user['status']) ?&gt;&lt;/td&gt;
                &lt;td&gt;
                    &lt;a href="$lt;?= site_url('admin/users/' . $user['id']) ?&gt;" class="btn btn-info btn-sm"
                    &gt;  View  &lt;/a&gt;
                    &lt;a href="&lt;?= site_url('admin/users/edit/' . $user['id']) ?&gt;" class="btn btn-warning btn-sm"
                    &gt; Edit &lt;/a&gt;
                    &lt;form action="&lt;?= site_url('admin/users/delete/' . $user['id']) ?&gt;"
                        method="post"
                        class="d-inline"
                    &gt;
                        &lt;?= csrf_field() ?&gt;
                        &lt;button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this user?')"
                        &gt;
                            Delete
                        &lt;/button&gt;
                    &lt;/form&gt;
                &lt;/td&gt;
            &lt;/tr&gt;
        &lt;?php endforeach; ?&gt;
    &lt;/tbody&gt;
&lt;/table&gt;
&lt;?= $this->endSection() ?&gt;
</pre></code>

- Open: `/admin/users`
- Ab seeded users table me dikhne chahiye. ✅

## 4. CREATE — Add User Form
Controller:
<code><pre>
public function create()
{
    return view('admin/users/create', [
        'title' => 'Add User'
    ]);
}
</pre></code>

Create: `app/Views/admin/users/create.php`
<code><pre>
</pre></code>

<code><pre>
</pre></code>

<code><pre>
</pre></code>
