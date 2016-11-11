<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_root = new User();
        $user_root -> name = 'root123';
        $user_root -> email = 'root123@gmail.com';
        $user_root -> password = bcrypt('root123');
        $user_root -> save();

        $user_admin = new User();
        $user_admin -> name = 'admin123';
        $user_admin -> email = 'admin123@gmail.com';
        $user_admin -> password = bcrypt('admin123');
        $user_admin -> save();

        $user_user = new User();
        $user_user -> name = 'user123';
        $user_user -> email = 'user123@gmail.com';
        $user_user -> password = bcrypt('user123');
        $user_user -> save();

        $role_root = new Role();
        $role_root->name         = 'root';
        $role_root->display_name = 'Root Super Administrator'; // optional
        $role_root->description  = 'Root is allowed to manage and edit admin and user'; // optional
        $role_root->save();

        $role_admin = new Role();
        $role_admin->name         = 'admin';
        $role_admin->display_name = 'Amin Administrator'; // optional
        $role_admin->description  = 'Admin is allowed to manage and edit admin and user'; // optional
        $role_admin->save();

        $role_user = new Role();
        $role_user->name         = 'user';
        $role_user->display_name = 'Project Owner'; // optional
        $role_user->description  = 'User is the owner of a given project'; // optional
        $role_user->save();

        $user = User::find($user_root);
        $user->attachRole($role_root); 

        $user = User::find($user_admin);
        $user->attachRole($role_admin); 

        $user = User::find($role_user);
        $user->attachRole($owner);


        $manageAdmin = new Permission();
        $manageAdmin->name         = 'manage-admin';
        $manageAdmin->display_name = ''; // optional
        // Allow a user to...
        $manageAdmin->description  = ''; // optional
        $manageAdmin->save();

        $manageUser = new Permission();
        $manageUser->name         = 'manage-user';
        $manageUser->display_name = ''; // optional
        // Allow a user to...
        $manageUser->description  = ''; // optional
        $manageUser->save();

        $displayData = new Permission();
        $displayData->name         = 'display-data';
        $displayData->display_name = ''; // optional
        // Allow a user to...
        $displayData->description  = ''; // optional
        $displayData->save();

        $user_root->attachPermissions([$manageAdmin,$manageUser,$displayData]);
        // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));

        $user_admin->attachPermissions([$manageUser,$displayData]);
        // equivalent to $admin->perms()->sync(array($createPost->id));

        $user_user->attachPermission($displayData);
        // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));
    }
}
