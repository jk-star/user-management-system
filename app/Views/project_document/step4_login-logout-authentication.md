# Step 4 — Login & Logout Authentication

- **Goal:** Database ke `users` table se Admin/User login kare → password verify ho → session create ho → dashboard par redirect ho → logout par session destroy ho.

Flow:
<code><pre>
Login Form
    ↓
Email + Password
    ↓
Database me User Find
    ↓
password_verify()
   ↙            ↘
Wrong          Correct
 ↓                ↓
Error          Session Create
                  ↓
             Dashboard
                  ↓
                Logout
                  ↓
            Session Destroy
</pre></code>

## 1. User Model Create Karo

Terminal: `php spark make:model UserModel`

Open: `app/Models/UserModel.php`

Code:
<code><pre>
&lt;?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'profile_image'
    ];

    protected $useTimestamps = true;
}
</pre></code>

## 2. Auth Controller Create Karo

Terminal: `php spark make:controller AuthController`

Open: `app/Controllers/AuthController.php`

Abhi basic structure:
<code><pre>
&lt;?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login', [
            'title' => 'Login'
        ]);
    }


    public function authenticate()
    {
        // Login logic
    }


    public function logout()
    {
        // Logout logic
    }
}
</pre></code>

## 3. Login View Create Karo

Folder: `app/Views/auth/`

Create: `login.php`

Code:

<code><pre>
&lt;!DOCTYPE html&gt;

&lt;html lang="en"&gt;

&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1"&gt;
    &lt;title&gt;&lt;?= esc($title ?? 'Login') ?&gt;&lt;/title&gt;
    &lt;link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" &gt;

&lt;/head&gt;

&lt;body class="bg-light"&gt;

&lt;div class="container"&gt;

&lt;div class="row justify-content-center mt-5"&gt;

&lt;div class="col-md-5"&gt;

&lt;div class="card shadow-sm"&gt;

&lt;div class="card-body p-4"&gt;

&lt;h3 class="mb-4"&gt;

Login

&lt;/h3&gt;

&lt;?php if (session()->getFlashdata('error')): ?&gt;

&lt;div class="alert alert-danger"&gt;

&lt;?= esc(session()->getFlashdata('error')) ?&gt;

&lt;/div&gt;

&lt;?php endif; ?&gt;

&lt;form action="&lt;?= site_url('login') ?&gt;" method="post" &gt;

&lt;?= csrf_field() ?&gt;

&lt;div class="mb-3">&gt;

&lt;label class="form-label"&gt;  Email &lt;/label&gt;

&lt;input type="email" name="email" class="form-control"  value="&lt;?= esc(old('email'), 'attr') ?&gt; /&gt;

&lt;/div&gt;

&lt;div class="mb-3"&gt; &lt;label class="form-label"&gt; Password &lt;/label&gt;

&lt;input
    type="password"
    name="password"
    class="form-control" &gt;

&lt;/div&gt;

&lt;button type="submit" class="btn btn-primary w-100" &gt; Login &lt;/button&gt;

&lt;/form&gt;

&lt;/div&gt;

&lt;/div&gt;

&lt;/div&gt;

&lt;/div&gt;

&lt;/div&gt;

&lt;/body&gt;

&lt;/html&gt;
</pre></code>

## 4. Routes Add Karo

`app/Config/Routes.php`

Add:
<code><pre>
$routes->get(
    'login',
    'AuthController::login'
);

$routes->post(
    'login',
    'AuthController::authenticate'
);

$routes->get(
    'logout',
    'AuthController::logout'
);
</pre></code>

Notice:

<code><pre>
GET /login
→ Login form show

POST /login
→ Login process

GET /logout
→ Logout
</pre></code>

## 5. Login Validation

Ab `authenticate()` implement karo.

<code><pre>
public function authenticate()
{
    $rules = [
        'email' => 'required|valid_email',
        'password' => 'required'
    ];

    if (! $this->validate($rules)) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Please enter valid login details.'
            );
    }

    // next code
}
</pre></code>

- Ab empty email/password accept nahi hoga.

## 6. Email se User Find Karo

Validation ke neeche:

<code><pre>
$userModel = new UserModel();

$email = $this->request->getPost('email');

$password = $this->request->getPost('password');

$user = $userModel
    ->where('email', $email)
    ->first();
</pre></code>

## 7. User Exists Check

<code><pre>
if (! $user) {

    return redirect()
        ->back()
        ->withInput()
        ->with(
            'error',
            'Invalid email or password.'
        );
}
</pre></code>

## 8. Password Verify

Seeder me password:

<code><pre>
password_hash(
    'Admin@123',
    PASSWORD_DEFAULT
)
</pre></code>
se store kiya tha.

Login ke time:

<code><pre>
if (! password_verify(
    $password,
    $user['password']
)) {

    return redirect()
        ->back()
        ->withInput()
        ->with(
            'error',
            'Invalid email or password.'
        );
}
</pre></code>

Remember:

<code><pre>
Registration / Seeder
        ↓
password_hash()


Login
        ↓
password_verify()
</pre></code>

## 9. Inactive User Check

- Hamare table me: `status` bhi hai.

Add:

<code><pre>
if ($user['status'] !== 'active') {

    return redirect()
        ->back()
        ->with(
            'error',
            'Your account is inactive.'
        );
}
</pre></code>

- Ab inactive user login nahi kar payega.

## 10. Session Create

- Successful login ke baad:

<code><pre>
session()->regenerate();

session()->set([
    'user_id'   => $user['id'],
    'user_name' => $user['name'],
    'email'     => $user['email'],
    'role'      => $user['role'],
    'logged_in' => true
]);
</pre></code>

Then:

<code><pre>
return redirect()
    ->to('/admin/dashboard');
</pre></code>

## 11. Complete authenticate()
<code><pre>
public function authenticate()
{
    $rules = [
        'email'    => 'required|valid_email',
        'password' => 'required'
    ];

    if (! $this->validate($rules)) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Please enter valid login details.'
            );
    }


    $userModel = new UserModel();

    $email = $this->request->getPost('email');

    $password = $this->request->getPost('password');


    $user = $userModel
        ->where('email', $email)
        ->first();


    if (! $user) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Invalid email or password.'
            );
    }


    if (! password_verify(
        $password,
        $user['password']
    )) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Invalid email or password.'
            );
    }


    if ($user['status'] !== 'active') {

        return redirect()
            ->back()
            ->with(
                'error',
                'Your account is inactive.'
            );
    }


    session()->regenerate();

    session()->set([
        'user_id'   => $user['id'],
        'user_name' => $user['name'],
        'email'     => $user['email'],
        'role'      => $user['role'],
        'logged_in' => true
    ]);


    return redirect()
        ->to('/admin/dashboard');
}
</pre></code>

## 12. Navbar ko Dynamic Karo

- Abhi navbar me static: `Admin` tha.

`partials/navbar.php` me change:
<code><pre>
&lt;div class="text-white"&gt;
    &lt;?= esc(
        session()->get('user_name')
    ) ?&gt;

&lt;/div&gt;
</pre></code>

## 13. Logout Link Add Karo

Navbar me:

<code><pre>
&lt;a
    href="&lt;?= site_url('logout') ?&gt;"
    class="btn btn-outline-light btn-sm ms-3"
&gt;
    Logout
&lt;/a&gt;
</pre></code>

Navbar ka relevant section:

<code><pre>
&lt;div class="text-white"&gt;
    &lt;?= esc(session()->get('user_name')) ?&gt;
    &lt;a
        href="&lt;?= site_url('logout') ?&gt;"
        class="btn btn-outline-light btn-sm ms-3"
    &gt;
        Logout
    &lt;/a&gt;

&lt;/div&gt;
</pre></code>

## 14. Logout Logic

AuthController:
<code><pre>
public function logout()
{
    session()->destroy();

    return redirect()
        ->to('/login');
}
</pre></code>

Flow:
<code><pre>
Logout
   ↓
Session Destroy
   ↓
/login
</pre></code>
