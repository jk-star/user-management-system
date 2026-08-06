## Step 5 — Auth Filter & Protected Routes

- **Goal**: Agar user login nahi hai, to /admin/dashboard jaise pages direct URL se open nahi hone chahiye.

Abhi problem:

<code><pre>
Logout
  ↓
Session Destroy
  ↓
User manually opens:
 /admin/dashboard
  ↓
Dashboard Open ❌
</pre></code>

Step 5 ke baad:

<code><pre>
/admin/dashboard
       ↓
   Auth Filter
       ↓
logged_in ?
  ↙        ↘
YES        NO
 ↓          ↓
Allow     /login
</pre></code>

## 1. Auth Filter Create Karo

Terminal: `php spark make:filter AuthFilter`

File banegi: `app/Filters/AuthFilter.php`

Usme:

<code><pre>
&lt;?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        if (! session()->get('logged_in')) {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Please login first.'
                );
        }
    }


    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Nothing required
    }
}
</pre></code>

## 2. Filter Alias Register Karo

Open: `app/Config/Filters.php`

`$aliases` me add:

`'auth' => \App\Filters\AuthFilter::class,`

For example:

<code><pre>
public array $aliases = [
    'csrf'          => CSRF::class,
    'toolbar'       => DebugToolbar::class,
    'honeypot'      => Honeypot::class,
    'invalidchars'  => InvalidChars::class,
    'secureheaders' => SecureHeaders::class,

    'auth' => \App\Filters\AuthFilter::class,
];
</pre></code>

Ab CI4 ko pata hai:

<code><pre>
auth
 ↓
AuthFilter
</pre></code>

## 3. Dashboard Route Protect Karo

Abhi route:
<code><pre>
$routes->get(
    'admin/dashboard',
    'Admin\DashboardController::index'
);

</pre></code>

Change:
<code><pre>
$routes->get(
    'admin/dashboard',
    'Admin\DashboardController::index',
    ['filter' => 'auth']
);

</pre></code>

- Bas itna karne se dashboard protected ho gaya.

## 5. Multiple Admin Routes ko Protect Karna

Better approach: Route Group.
<code><pre>
$routes->group(
    'admin',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            'dashboard',
            'Admin\DashboardController::index'
        );

    }
);
</pre></code>
- group ke andar jitne routes hain sab par auth filter automatically lagega.

## 6. Login Page ko Logged-in User se Bachao

`AuthController::login():`
<code><pre>
public function login()
{
    if (session()->get('logged_in')) {

        return redirect()
            ->to('/admin/dashboard');
    }

    return view('auth/login', [
        'title' => 'Login'
    ]);
}
</pre></code>

Flow:
<code><pre>
Already logged in?
       ↓
      YES
       ↓
Dashboard
</pre></code>

## 7. Security Improvement — Logout ko POST Karo
<code><pre>
$routes->post(
    'logout',
    'AuthController::logout'
);

</pre></code>

- Navbar me link ki jagah form:
<code><pre>
&lt;form
    action="&lt;?= site_url('logout') ?&gt;"
    method="post"
    class="d-inline"
&gt;
    &lt;?= csrf_field() ?&gt;
    &lt;button
        type="submit"
        class="btn btn-outline-light btn-sm ms-3"
    &gt;
        Logout
    &lt;/button&gt;

&lt;/form&gt;
</pre></code>

Why?
<code><pre>
GET
→ normally data/state change nahi karna chahiye

POST
→ logout jaisi state-changing action ke liye better
</pre></code>

## 8. Final Routes Structure
Abhi `Routes.php` roughly:

<code><pre>
// Authentication

$routes->get(
    'login',
    'AuthController::login'
);

$routes->post(
    'login',
    'AuthController::authenticate'
);

$routes->post(
    'logout',
    'AuthController::logout'
);


// Protected Admin Routes

$routes->group(
    'admin',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            'dashboard',
            'Admin\DashboardController::index'
        );

    }
);
</pre></code>
