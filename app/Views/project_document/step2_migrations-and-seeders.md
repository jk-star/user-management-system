# Step 2 — Migrations & Seeders

- Is step me hum `users` table manually phpMyAdmin se nahi, CI4 Migration se create karenge. Seeder se test users insert karenge.

## 1. Users Migration Create Karo

Terminal: `php spark make:migration CreateUsersTable`

File banegi:

<code><pre>
app/
└── Database/
    └── Migrations/
        └── xxxx-xx-xx-xxxxxx_CreateUsersTable.php
</pre></code>
 
Us file ke `up()` me:

<code><pre>
public function up()
{
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],

        'name' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
        ],

        'email' => [
            'type'       => 'VARCHAR',
            'constraint' => 150,
        ],

        'password' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
        ],

        'role' => [
            'type'       => 'ENUM',
            'constraint' => ['admin', 'user'],
            'default'    => 'user',
        ],

        'status' => [
            'type'       => 'ENUM',
            'constraint' => ['active', 'inactive'],
            'default'    => 'active',
        ],

        'profile_image' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => true,
        ],

        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],

        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

    $this->forge->addKey('id', true);

    $this->forge->addUniqueKey('email');

    $this->forge->createTable('users');
}
</pre></code>

`down():`

<code><pre>
public function down()
{
    $this->forge->dropTable('users');
}

</pre></code>

**Important**

`$this->forge->addKey('id', true);`

means: `id → Primary Key`

Aur: `$this->forge->addUniqueKey('email');`

- means same email se 2 accounts nahi ban sakte.

## 2. Migration Run Karo

`php spark migrate`

Successful hua to phpMyAdmin me:

<code><pre>
ci4_shop / aapka database
    ↓
users
</pre></code>

table aa jayegi. 

## 3. Seeder Create Karo

- Ab test users automatically insert karenge. 

`php spark make:seeder UserSeeder`

File: `app/Database/Seeds/UserSeeder.php`

Isme:

<code><pre>
public function run()
{
    $data = [
        [
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => password_hash('Admin@123', PASSWORD_DEFAULT),
            'role'     => 'admin',
            'status'   => 'active',
        ],

        [
            'name'     => 'Test User',
            'email'    => 'user@example.com',
            'password' => password_hash('User@123', PASSWORD_DEFAULT),
            'role'     => 'user',
            'status'   => 'active',
        ],
    ];

    $this->db
        ->table('users')
        ->insertBatch($data);
}
</pre></code>

Notice password:

`password_hash('Admin@123', PASSWORD_DEFAULT)`

- Hum plain password database me store nahi kar rahe. ✅

## 4. Seeder Run

`php spark db:seed UserSeeder`

- Ab phpMyAdmin → `users` → Browse. 2 records hone chahiye: