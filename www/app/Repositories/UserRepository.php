<?php


namespace App\Repositories;


use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    // Get All data
    public function getAll()
    {
        return User::latest()->paginate(config('constants.PER_PAGE'));
    }

    // Get data by id
    public function findByID($id)
    {
        return User::findorFail($id);
    }

    // Create new recoard
    public function create($params)
    {

        $user = User::create($params);

        $user->assignRole($params['role']);

        return $user;
    }

    // Update recoard
    public function update($params, $id)
    {
        $user = $this->findByID($id)->update($params);

        // Update role
        if ($user) {
            $this->findByID($id)->syncRoles($params['role']);
        }
        return $user;
    }

    // Change Password
    public function changePassword($params, $id)
    {
        $user = $this->findByID($id)->update($params);

        return $user;
    }

    public function updateProfile($params, $id)
    {
        return $this->findByID($id)->update($params);

    }

}
