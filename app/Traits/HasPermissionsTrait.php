app/User.php

namespace App;

App/Permissions/HasPermissionsTrait.php
class User extends Authenticatable
{
use HasPermissionsTrait; //Import The Trait
}


App/Permissions/HasPermissionsTrait.php

namespace App\Permissions;

use App\Permission;
use App\Role;

trait HasPermissionsTrait {

public function givePermissionsTo(... $permissions) {

$permissions = $this->getAllPermissions($permissions);
dd($permissions);
if($permissions === null) {
return $this;
}
$this->permissions()->saveMany($permissions);
return $this;
}

public function withdrawPermissionsTo( ... $permissions ) {

$permissions = $this->getAllPermissions($permissions);
$this->permissions()->detach($permissions);
return $this;

}

public function refreshPermissions( ... $permissions ) {

$this->permissions()->detach();
return $this->givePermissionsTo($permissions);
}

public function hasPermissionTo($permission) {

return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
}

public function hasPermissionThroughRole($permission) {

foreach ($permission->roles as $role){
if($this->roles->contains($role)) {
return true;
}
}
return false;
}

public function hasRole( ... $roles ) {

foreach ($roles as $role) {
if ($this->roles->contains('slug', $role)) {
return true;
}
}
return false;
}

public function roles() {

return $this->belongsToMany(Role::class,'users_roles');

}
public function permissions() {

return $this->belongsToMany(Permission::class,'users_permissions');

}
protected function hasPermission($permission) {

return (bool) $this->permissions->where('slug', $permission->slug)->count();
}

protected function getAllPermissions(array $permissions) {

return Permission::whereIn('slug',$permissions)->get();

}

}
Here, through the roles and checking by the slug field, if that specific role exists. You can check or debug this by using:

$user = $request->user(); //getting the current logged in user
dd($user->hasRole('admin','editor')); // and so on
 

Step 8 :  Create CustomProvider
In this step we are use Laravel “can” directive to check if the User have Permission or not and instead of using $user->hasPermissionTo() function.

Like use $user->can(). So, we need to create a new PermissionsServiceProvider for authorization. copy below command and create service provider.

php artisan make:provider PermissionsServiceProvider
Register your service provider and head over to the boot method to provide us a Gateway to use can() method.

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{

public function register()
{
//
}

public function boot()
{
try {
Permission::get()->map(function ($permission) {
Gate::define($permission->slug, function ($user) use ($permission) {
return $user->hasPermissionTo($permission);
});
});
} catch (\Exception $e) {
report($e);
return false;
}

//Blade directives
Blade::directive('role', function ($role) {
return "if(auth()->check() && auth()->user()->hasRole({$role})) :"; //return this if statement inside php tag
});

Blade::directive('endrole', function ($role) {
return "endif;"; //return this endif statement inside php tag
});

}
}
