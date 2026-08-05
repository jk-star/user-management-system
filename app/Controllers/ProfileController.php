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

    // ==========================
    // My Profile
    // ==========================
    public function index()
    {
        $user = $this->userModel->find(session()->get('user_id'));

        return view('profile/index', [
            'title' => 'My Profile',
            'user'  => $user
        ]);
    }

    // ==========================
    // Edit Profile
    // ==========================
    public function edit()
    {
        $user = $this->userModel->find(session()->get('user_id'));

        return view('profile/edit', [
            'title' => 'Edit Profile',
            'user'  => $user
        ]);
    }

    // ==========================
    // Update Profile
    // ==========================
    public function update($id)
    {
        print_r($id);
        //exit;
        // $id = session()->get('user_id');

        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // -----------------------
        // Validation
        // -----------------------
        $rules = [
            'name'  => 'required|min_length[3]',
            'email' => "required|valid_email",
        ];

        $file = $this->request->getFile('profile_image');

        // Image validation only if image selected
        if ($file && $file->getError() != UPLOAD_ERR_NO_FILE) {

            $rules['profile_image'] =
                'is_image[profile_image]'
                . '|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]'
                . '|max_size[profile_image,2048]';
        }

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // -----------------------
        // Update Data
        // -----------------------

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // -----------------------
        // Upload Image
        // -----------------------

        if ($file && $file->getError() != UPLOAD_ERR_NO_FILE) {

            // Delete old image
            if (
                !empty($user['profile_image']) &&
                file_exists(FCPATH . 'uploads/profiles/' . $user['profile_image'])
            ) {
                unlink(FCPATH . 'uploads/profiles/' . $user['profile_image']);
            }

            // Upload new image
            $imageName = $file->getRandomName();

            $file->move(
                FCPATH . 'uploads/profiles/',
                $imageName
            );

            $data['profile_image'] = $imageName;
        }

        // -----------------------
        // Update User
        // -----------------------

        $this->userModel->update($id, $data);

        // -----------------------
        // Update Session
        // -----------------------

        session()->set([
            'user_name' => $data['name'],
            'email'     => $data['email'],
        ]);

        return redirect()
            ->to('/profile/' . $id)
            ->with('success', 'Profile updated successfully.');
    }
}
