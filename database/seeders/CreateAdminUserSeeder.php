<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{

         $user = User::create([
        'name' => 'سعد',
        'email' => 'saad@gmail.com',
        'password' => bcrypt('12345678'),
        'roles_name' => ["admin"],
        'Status' => 'مفعل',
        ]);

        $role = Role::create(['name' => 'admin']);
        Role::create(['name' => 'manager']);


    $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->name]);



        $role = Role::create(['name' => 'user']);


        $user = User::create([
                'name' => 'المستخدم الاول',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('12345678'),
                'roles_name' => ["user"],
                'Status' => 'مفعل',
                ]);
                $user->assignRole([$role->name]);


                $user = User::create([
                        'name' => 'المستخدم الثاني',
                        'email' => 'user2@gmail.com',
                        'password' => bcrypt('12345678'),
                        'roles_name' => ["user"],
                        'Status' => 'مفعل',
                        ]);
                        $user->assignRole([$role->name]);


}
}
