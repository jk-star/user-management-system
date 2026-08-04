<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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

        // echo $email . '<br/>';
        // echo $password . '<br/>';
        // exit;


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


    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to('/login');
    }
}
