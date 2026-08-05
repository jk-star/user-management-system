# Step 3 — Admin Layout

Final structure:

<code><pre>
Admin Panel
│
├── Navbar
│
├── Sidebar
│   ├── Dashboard
│   ├── Users
│   └── Profile
│
└── Main Content
</pre></code>

- Abhi functionality nahi banayenge. **Sirf reusable layout + dashboard page.**

## 1. View Folders Banao

`app/Views/` ke andar:

<code><pre>
app/Views/
│
├── layouts/
│   └── admin.php
│
├── partials/
│   ├── navbar.php
│   └── sidebar.php
│
└── admin/
    └── dashboard.php
</pre></code>

## 2. Navbar Partial

Create: `app/Views/partials/navbar.php`

<code><pre>
&lt;nav class="navbar navbar-dark bg-dark px-3"&gt;
    &lt;a class="navbar-brand" href="#"&gt;
        User Management
    &lt;/a&gt;
    &lt;div class="text-white"&gt;
        Admin
    &lt;/div&gt;
&lt;/nav&gt;
</pre></code>

- Abhi Admin static hai. Login complete hone ke baad ise dynamic karenge.

## 3. Sidebar Partial

Create: `app/Views/partials/sidebar.php`

<code><pre>
&lt;$div class="sidebar bg-light p-3"&gt;
    &lt;h5&gt;Menu&lt;/h5&gt;
    &lt;hr&gt;
    &lt;ul class="nav flex-column"&gt;
        &lt;li class="nav-item"&gt;
            &lt;a
                class="nav-link"
                href="&lt;?= site_url('admin/dashboard') ?&gt;"
            &gt;
                Dashboard
            &lt;/a&gt;
        &lt;/li&gt;
        &lt;li class="nav-item"&gt;
            &lt;a
                class="nav-link"
                href="&lt;?= site_url('admin/users') ?&gt;"
            &gt;
                Users
            &lt;/a&gt;
        &lt;/li&gt;
        &lt;li class="nav-item"&gt;
            &lt;a
                class="nav-link"
                href="&lt;?= site_url('profile') ?&gt;"
            &gt;
                Profile
            &lt;/a&gt;
        &lt;/li&gt;
    &lt;/ul&gt;
&lt;/div&gt;
</pre></code>

## 4. Main Admin Layout

Create: `app/Views/layouts/admin.php`

<code><pre>
&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;

&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    &gt;
    &lt;title>
        &lt;?= esc($title ?? 'Admin Panel') ?&gt;
    &lt;/title&gt;
    &lt;link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    &gt;
    &lt;style&gt;
        .sidebar {
            min-height: calc(100vh - 56px);
        }
    &lt;/style&gt;
&lt;/head&gt;

&lt;body&gt; 
    &lt;?= $this->include('partials/navbar') ?&gt;
    &lt;div class="container-fluid"&gt;
        &lt;div class="row"&gt;
            &lt;div class="col-md-2 p-0"&gt;
                &lt;?= $this->include('partials/sidebar') ?&gt;
            &lt;/div&gt;
            &lt;main class="col-md-10 p-4"&gt;
                &lt;?= $this->renderSection('content') ?&gt;
            &lt;/main&gt;
        &lt;/div&gt;
    &lt;/div&gt;

&lt;/body&gt;

&lt;/html&gt;
</pre></code>

**Important part**

`<?= $this->renderSection('content') ?>`

- Yahan har page ka different content aayega.

## 5. Dashboard View

Create: `app/Views/admin/dashboard.php`