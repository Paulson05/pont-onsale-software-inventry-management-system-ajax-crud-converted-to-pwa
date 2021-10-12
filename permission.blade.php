laravel permission

Laravel 8 User Roles and Permissions Without Package
WebSolutionStuff | Sep-13-2021 | Categories : Laravel PHP

In this tutorial we will see laravel 8 user roles and permissions without package.Roles and permissions are an important part of many websites.

In this laravel 8 user roles and permissions example We are not using any type of package like spatie/laravel-permission for user roles permissions in  laravel. But you can use spatie/laravel-permission to create user roles and permissions tutorial in laravel 8.

In this example you can give roles to specific users and access permission to specific task. In this tutorial we will implement user roles and permissions tutorial in laravel 8 from scratch.

So, let's start to implement laravel 8 user roles and permissions without package tutorial.

Step 1 : Setup Laravel Project
create new fresh laravel project using below command.

composer create-project --prefer-dist laravel/laravel Laravel_Role_Permission
 

Step 2 : Make Auth
In this step we are make laravel authentication using below command.

php artisan make:auth
 

Read Also : Laravel 8 User Role and Permission
 

Step 3 : Create Model and Migration
After creating auth and project setup. We need to create model for users roles and permissions. So let's create model using below command.

php artisan make:model Permission -m
php artisan make:model Role -m
 

Step 4 : Edit Migration Files
CreateUsersTable :  

public function up()
{
Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->timestamp('email_verified_at')->nullable();
$table->string('password');
$table->rememberToken();
$table->timestamps();
});
}
CreatePermissionsTable : 

public function up()
{
Schema::create('permissions', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('slug');
$table->timestamps();
});
}
CreateRolesTable :

public function up()
{
Schema::create('roles', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('slug');
$table->timestamps();
});
}
 

Read Also : Introduction of Node.js Modules
 

Step 5 : Add pivot tables
Now we will create users_permissions pivot table. So, create new migration file for the table using below command.

php artisan make:migration create_users_permissions_table --create=users_permissions
Now edit user_permissions table and FOREIGN KEY between users and permissions table. 

public function up()
{
Schema::create('users_permissions', function (Blueprint $table) {
$table->unsignedInteger('user_id');
$table->unsignedInteger('permission_id');

//FOREIGN KEY
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

//PRIMARY KEYS
$table->primary(['user_id','permission_id']);
});
}

public function down()
{
Schema::dropIfExists('users_permissions');
}
Now we are creating a pivot table for users_roles table.

php artisan make:migration create_users_roles_table --create=users_roles
Now edit users_roles table and FOREIGN KEY between users and permissions table.

public function up()
{
Schema::create('users_roles', function (Blueprint $table) {
$table->unsignedInteger('user_id');
$table->unsignedInteger('role_id');

//FOREIGN KEY
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

//PRIMARY KEYS
$table->primary(['user_id','role_id']);
});
}

public function down()
{
Schema::dropIfExists('users_roles');
}
Now create roles_permissions table. This table is used for give permission to user. For ex. user have view permission for post and as admin have the permission to edit or delete post so, in this type of case we need this table.

 

Read Also : Laravel 8 Google Bar Chart Example
 

php artisan make:migration create_roles_permissions_table --create=roles_permissions
Edit roles_permissions table  and add  FOREIGN KEY between roles and permissions table.

public function up()
{
Schema::create('roles_permissions', function (Blueprint $table) {
$table->unsignedInteger('role_id');
$table->unsignedInteger('permission_id');

//FOREIGN KEY
$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

//PRIMARY KEYS
$table->primary(['role_id','permission_id']);
});
}

public function down()
{
Schema::dropIfExists('roles_permissions');
}
Now run following command to create migration

php artisan migrate
 

Step 6 : Setting up the relationships
Now we are creating the relationships between roles and permissions table.

App/Role.php

public function permissions() {

return $this->belongsToMany(Permission::class,'roles_permissions');

}

public function users() {

return $this->belongsToMany(User::class,'users_roles');

}
App/Permission.php

public function roles() {

return $this->belongsToMany(Role::class,'roles_permissions');

}

public function users() {

return $this->belongsToMany(User::class,'users_permissions');

}
 

Read Also : Laravel 8 QR Code Generate Example
 

Step 7 : Create Trait
let’s create a new directory and name it as Permissions and create a new file name HasPermissionsTrait.php. This is handle user relations and back in our User model, just we need to import this trait on User Model.

app/User.php

namespace App;

use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable
{
use HasPermissionsTrait; //Import The Trait
}
Now open HasPermissionsTrait.php and copy below code in this file.

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
Now we need to register our PermissionsServiceProvider. In app.php file add like below code.

 

Read Also : How to Integrate Razorpay Payment Gateway in Laravel
 

config\app.php

'providers' => [

App\Providers\PermissionsServiceProvider::class,

],
You can learn more about Laravel Gate facade at Laravel Documentation. You can test it out as:

dd($user->can('permission-slug'));
 

Step 9 : Add Dummy Data to Check
We need dummy data to check our user access.

Route::get('/roles', [PermissionController::class,'Permission']);
App\Http\Controllers\PermissionController.php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

public function Permission()
{
$user_permission = Permission::where('slug','create-tasks')->first();
$admin_permission = Permission::where('slug', 'edit-users')->first();

//RoleTableSeeder.php
$user_role = new Role();
$user_role->slug = 'user';
$user_role->name = 'User_Name';
$user_role->save();
$user_role->permissions()->attach($user_permission);

$admin_role = new Role();
$admin_role->slug = 'admin';
$admin_role->name = 'Admin_Name';
$admin_role->save();
$admin_role->permissions()->attach($admin_permission);

$user_role = Role::where('slug','user')->first();
$admin_role = Role::where('slug', 'admin')->first();

$createTasks = new Permission();
$createTasks->slug = 'create-tasks';
$createTasks->name = 'Create Tasks';
$createTasks->save();
$createTasks->roles()->attach($user_role);

$editUsers = new Permission();
$editUsers->slug = 'edit-users';
$editUsers->name = 'Edit Users';
$editUsers->save();
$editUsers->roles()->attach($admin_role);

$user_role = Role::where('slug','user')->first();
$admin_role = Role::where('slug', 'admin')->first();
$user_perm = Permission::where('slug','create-tasks')->first();
$admin_perm = Permission::where('slug','edit-users')->first();

$user = new User();
$user->name = 'Test_User';
$user->email = 'test_user@gmail.com';
$user->password = bcrypt('1234567');
$user->save();
$user->roles()->attach($user_role);
$user->permissions()->attach($user_perm);

$admin = new User();
$admin->name = 'Test_Admin';
$admin->email = 'test_admin@gmail.com';
$admin->password = bcrypt('admin1234');
$admin->save();
$admin->roles()->attach($admin_role);
$admin->permissions()->attach($admin_perm);


return redirect()->back();
}
}
Now goto this URL and hit enter on your keyboard. Then you will see some dummy data to those following tables.

$user = $request->user();
dd($user->hasRole('user')); //will return true, if user has role
dd($user->givePermissionsTo('create-tasks'));// will return permission, if not null
dd($user->can('create-tasks')); // will return true, if user has permission
In our blade files, we can use it like :

@role('user')

This is user role

@endrole

@role('admin')

This is admin role

@endrole
This means only those user can see it whose role are user. Now you can use many role as you want.

 

Step 10 : Setup the Middleware
In this step we are creating middleware using below command.

php artisan make:middleware RoleMiddleware
Add the middleware into your kernel & setup the handle method.

App\Http\Middleware\RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
public function handle($request, Closure $next, $role, $permission = null)
{
if(!$request->user()->hasRole($role)) {
abort(404);
}

if($permission !== null && !$request->user()->can($permission)) {
abort(404);
}

return $next($request);
}
}
Now we have to register RoleMiddleware in Kernel.php file.

 

Read Also : Laravel 8 REST API With Passport Authentication
 

App\Http\Kernel.php

protected $routeMiddleware = [
.
.
'role' => \App\Http\Middleware\RoleMiddleware::class,
];
Right now in our routes, you can do something like this :

Route::group(['middleware' => 'role:user'], function() {

Route::get('/user', function() {

return 'Welcome...!!';

});

});
Now you can use your controller like below to give user permission and access.

public function __construct()
{
$this->middleware('auth');
}


public function store(Request $request)
{
if ($request->user()->can('create-tasks')) {
...
}
}

public function destroy(Request $request, $id)
{
if ($request->user()->can('delete-tasks')) {
...
}

}
 

You might also like :

Read More : Stripe Payment Gateway Integration Example In Laravel 8
Read More : How to Create Multi Language Website in Laravel
Read More : Laravel 8 Yajra Datatable Example Tutorial
Read More : Bootstrap Session Timeout Example In Laravel
Tags : Laravel Example PHP Laravel 7 Laravel 8
Featured Post


How to Set Auto Database BackUp using Cron Scheduler In Laravel

How to Deploy Laravel on Heroku with Database

Server Side Custom Search in Datatables

How To File Upload
