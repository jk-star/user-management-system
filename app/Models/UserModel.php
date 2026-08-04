<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'profile_image'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',

        'email' =>
        'required|valid_email|max_length[150]|is_unique[users.email,id,{id}]',

        'role' =>
        'required|in_list[admin,user]',

        'status' =>
        'required|in_list[active,inactive]'
    ];

    protected $validationMessages = [

        'name' => [
            'required'   => 'Name is required.',
            'min_length' => 'Name must contain at least 3 characters.'
        ],

        'email' => [
            'required'    => 'Email is required.',
            'valid_email' => 'Please enter a valid email.',
            'is_unique'   => 'This email is already registered.'
        ],

        'role' => [
            'in_list' => 'Please select a valid role.'
        ],

        'status' => [
            'in_list' => 'Please select a valid status.'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
