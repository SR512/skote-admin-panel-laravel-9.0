<?php


namespace App\Repositories;

use App\Models\Role;
use http\Env\Request;


class RoleRepository
{
    private $model;

    /**
     * RoleRepository constructor.
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function findByID($id)
    {
        return $this->model->findById($id);
    }

    // Create new recoard
    public function create($params)
    {

        $role = $this->model->create($params->only('name'));

        $permissions = $params->permission;

        $role->syncPermissions($permissions);

        return $role;
    }

    // Update recoard
    public function update($params, $id)
    {
        $permissions = $params->permission;

        $role = $this->findByID($id);
        $role->name = $params->name;
        $role->save();

        $role->syncPermissions($permissions);

        return $role;
    }
}
