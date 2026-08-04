<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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

            'recentUsers' => $userModel
                ->orderBy('id', 'DESC')
                ->findAll(5),
        ];

        return view('admin/dashboard', $data);
    }
}
