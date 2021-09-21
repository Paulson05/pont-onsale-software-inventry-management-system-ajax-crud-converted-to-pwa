<?php
namespace App\Traits;
use App\Models\Permission;
use App\Models\Role;
trait HasRolesAndPermission
{
    public function roles(){
        return $this->belogsToMany(Role::class, 'users_role');
     }
    public function permissions(){
        return $this->belogsToMany(Permission::class, 'users_permission');
    }
}
