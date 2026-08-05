<?php

if (!function_exists('uploadImage')) {

    function uploadImage($file, $folder = 'users')
    {
        // File selected nahi hai
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        // Random name
        $newName = $file->getRandomName();

        // Upload
        $file->move(FCPATH . 'uploads/' . $folder, $newName);

        return $newName;
    }
}
