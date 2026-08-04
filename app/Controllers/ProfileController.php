<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $user = $this->userModel->find(session()->get('user_id'));

        return view('profile/index', [
            'title' => 'My Profile',
            'user'  => $user
        ]);
    }

    public function edit()
    {
        $user = $this->userModel
            ->find(session()->get('user_id'));

        return view('profile/edit', [

            'title' => 'Edit Profile',

            'user' => $user

        ]);
    }

    public function update()
    {
        $id = session()->get('user_id');

        $rules = [

            'name' => 'required|min_length[3]',

            'email' => "required|valid_email|is_unique[users.email,id,{$id}]"

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

            'name' => $this->request->getPost('name'),

            'email' => $this->request->getPost('email')

        ]);

        // Navbar name bhi update karo
        session()->set('user_name', $this->request->getPost('name'));
        session()->set('email', $this->request->getPost('email'));

        return redirect()

            ->to('/profile')

            ->with(
                'success',
                'Profile updated successfully.'
            );
    }
}
