## Step 6 — Dynamic Admin Dashboard

- Ab dashboard par jo counts static hain:
<code><pre>
Total Users      2
Active Users     2
Inactive Users   0
</pre></code>

- unko database se dynamically laayenge.

## 1. DashboardController me UserModel use karo

Open: `app/Controllers/Admin/DashboardController.php`

Complete code:
<code><pre>
&lt;?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data = [
            'title' => 'Dashboard',

            'totalUsers' => $userModel->countAllResults(),

            'activeUsers' => $userModel
                ->where('status', 'active')
                ->countAllResults(),

            'inactiveUsers' => $userModel
                ->where('status', 'inactive')
                ->countAllResults(),

            'totalAdmins' => $userModel
                ->where('role', 'admin')
                ->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}
</pre></code>

## 2. Dashboard View Update Karo

Open: `app/Views/admin/dashboard.php`

- Static numbers hatao aur variables use karo:
<code><pre>
&lt;?= $this->extend('layouts/admin') ?&gt;

&lt;?= $this->section('content') ?&gt;

&lt;h1&gt;Dashboard&lt;/h1&gt;

&lt;p class="text-muted"&gt;
    Welcome,
    &lt;?= esc(session()->get('user_name')) ?&gt;
&lt;/p&gt;

&lt;div class="row mt-4"&gt;
    &lt;div class="col-md-3"&gt;
        &lt;div class="card shadow-sm"&gt;
            &lt;div class="card-body"&gt;
                &lt;h5&gt;Total Users&lt;/h5&gt;
                &lt;h2&gt;
                    &lt;?= esc($totalUsers) ?&gt;
                &lt;/h2&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="col-md-3"&gt;
        &lt;div class="card shadow-sm"&gt;
            &lt;div class="card-body"&gt;
                &lt;h5>Active Users&lt;/h5&gt;
                &lt;h2&gt;
                    &lt;?= esc($activeUsers) ?&gt;
                &lt;/h2&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="col-md-3"&gt;
        &lt;div class="card shadow-sm"&gt;
            &lt;div class="card-body"&gt;
                &lt;h5&gt;Inactive Users&lt;/h5&gt;
                &lt;h2&gt;
                    &lt;?= esc($inactiveUsers) ?&gt;
                &lt;/h2&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="col-md-3"&gt;
        &lt;div class="card shadow-sm"&gt;
            &lt;div class="card-body"&gt;
                &lt;h5&gt;Admins&lt;/h5&gt;
                &lt;h2&gt;
                    &lt;?= esc($totalAdmins) ?&gt;
                &lt;/h2&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;?= $this->endSection() ?&gt;
</pre></code>

## 4. Recent Users bhi Dashboard par dikhao

- Controller ke `$data` me:
<code><pre>
'recentUsers' => $userModel
    ->orderBy('id', 'DESC')
    ->findAll(5),
</pre></code>

- Add karo. Then dashboard ke cards ke neeche:

<code><pre>
&lt;div class="card mt-4 shadow-sm"&gt;
    &lt;div class="card-header"&gt;
        Recent Users
    &lt;/div&gt;
    &lt;div class="card-body"&gt;
        &lt;table class="table"&gt;
            &lt;thead&gt;
                &lt;tr&gt;
                    &lt;th&gt;Name&lt;/th&gt;
                    &lt;th&gt;Email&lt;/th&gt;
                    &lt;th&gt;Role&lt;/th&gt;
                    &lt;th&gt;Status&lt;/th&gt;
                &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
                &lt;?php foreach ($recentUsers as $user): ?&gt;
                    &lt;tr&gt;
                        &lt;td&gt;
                            <?= esc($user['name']) ?&gt;
                        &lt;/td&gt;
                        &lt;td&gt;
                            &lt;?= esc($user['email']) ?&gt;
                        &lt;/td&gt;
                        &lt;td&gt;
                            <?= esc($user['role']) ?&gt;
                        &lt;/td&gt;
                        &lt;td&gt;
                            <?= esc($user['status']) ?&gt;
                        &lt;/td&gt;
                    &lt;/tr&gt;
                &lt;?php endforeach; ?&gt;
            &lt;/tbody&gt;
        &lt;/table&gt;
    &lt;/div&gt;
&lt;/div&gt;
</pre></code>
