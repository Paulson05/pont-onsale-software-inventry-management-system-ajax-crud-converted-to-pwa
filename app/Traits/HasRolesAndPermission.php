<?php
namespace App\Traits;
use App\Models\Permission;
use App\Models\Role;
trait HasRolesAndPermission
{
    public function roles(){
        return $this->belongsToMany(Role::class, 'users_role', 'users_id', 'role_id'  );
     }
    public function permissions(){
        return $this->belongsToMany(Permission::class, 'users_permission', 'users_id', 'permission_id'  );
    }
}
