<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

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

    public function create()
    {
        return view('admin/users/create', [
            'title' => 'Add User'
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',

            'email' =>
            'required|valid_email|is_unique[users.email]',

            'password' =>
            'required|min_length[8]',

            'role' =>
            'required|in_list[admin,user]',

            'status' =>
            'required|in_list[active,inactive]'
        ];

        if (! $this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $this->userModel->insert([

            'name' =>
            $this->request->getPost('name'),

            'email' =>
            $this->request->getPost('email'),

            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),

            'role' =>
            $this->request->getPost('role'),

            'status' =>
            $this->request->getPost('status')
        ]);

        return redirect()
            ->to('/admin/users')
            ->with(
                'success',
                'User added successfully.'
            );
    }

    public function show($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User not found'
            );
        }

        return view('admin/users/show', [
            'title' => 'User Details',
            'user'  => $user
        ]);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User not found'
            );
        }

        return view('admin/users/edit', [
            'title' => 'Edit User',
            'user'  => $user
        ]);
    }


    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User not found'
            );
        }

        $rules = [
            'name' => 'required|min_length[3]',

            'email' =>
            "required|valid_email|is_unique[users.email,id,{$id}]",

            'role' =>
            'required|in_list[admin,user]',

            'status' =>
            'required|in_list[active,inactive]'
        ];

        if (! $this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $this->userModel->update($id, [

            'name' =>
            $this->request->getPost('name'),

            'email' =>
            $this->request->getPost('email'),

            'role' =>
            $this->request->getPost('role'),

            'status' =>
            $this->request->getPost('status')
        ]);

        return redirect()
            ->to('/admin/users')
            ->with(
                'success',
                'User updated successfully.'
            );
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {

            return redirect()
                ->to('/admin/users')
                ->with(
                    'error',
                    'User not found.'
                );
        }

        $this->userModel->delete($id);

        return redirect()
            ->to('/admin/users')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}
