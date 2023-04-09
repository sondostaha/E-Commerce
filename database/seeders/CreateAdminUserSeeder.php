<?php
  
namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

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
        $user = Admin::create([
            'name' => 'sondos', 
            'email' => 'sondostaha11@gmail.com',
            'password' => bcrypt('12345678'),
            'roles_name' => ["superadmin"]
        ]);
    
        $adminRole =  Role::create(['guard_name' => 'admin', 'name' => 'superadmin']);;
     
        $permissions = Permission::pluck('id','id')->all();
   
        $adminRole->syncPermissions($permissions);
     
         $user->assignRole([$adminRole->id]);
      
    }
}