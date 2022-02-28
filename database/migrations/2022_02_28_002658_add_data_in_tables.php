<?php

use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Groups
        $group1 = [
            'name'  =>  'Administrators',
        ];
        $g1 = Group::create($group1);
        
        $group2 = [
            'name'  =>  'Users',
        ];
        $g2 = Group::create($group2);

        // Create Admin Users
        $admin = [
            'group_id'     =>  $g1->id,
            'name'          =>  'Admin 1',
            'email'         =>  'admin@admin.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($admin);

        $admin2 = [
            'group_id'     =>  $g1->id,
            'name'          =>  'Admin 2',
            'email'         =>  'admin2@admin.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($admin2);

        // Create Users
        $user1 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User 1',
            'email'         =>  'user1@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user1);

        $user2 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User 2',
            'email'         =>  'user2@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user2);

        $user3 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User 3',
            'email'         =>  'user3@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user3);

        $user4 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User 4',
            'email'         =>  'user4@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user4);

        $user5 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User 5',
            'email'         =>  'user5@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user5);

        $user6 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User 6',
            'email'         =>  'user6@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user6);

        $user7 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User 7',
            'email'         =>  'user7@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user7);

        $user8 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User 8',
            'email'         =>  'user8@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user8);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
