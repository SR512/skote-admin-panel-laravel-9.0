<?php


namespace App\Repositories;

use App\Models\Role;
use http\Env\Request;


class RoleRepository
{
    // Get All data
    public function getAll()
    {
        return Role::latest()->get();
    }

    // Get data by id
    public function findByID($id)
    {
        return Role::findById($id);
    }

    // Create new recoard
    public function create($request)
    {

        $role = Role::create($request->only('name'));

        $permissions = $request->permission;

        $role->syncPermissions($permissions);

        return $role;
    }

    // Update recoard
    public function update($request, $id)
    {
        $permissions = $request->permission;

        $role = $this->findByID($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($permissions);

        return $role;
    }
}
