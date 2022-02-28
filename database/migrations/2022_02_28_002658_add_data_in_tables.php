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
        $group1 = [
            'name'  =>  'Administrators',
        ];
        $g1 = Group::create($group1);
        
        $group2 = [
            'name'  =>  'Users',
        ];
        $g2 = Group::create($group2);

        $user1 = [
            'group_id'     =>  $g1->id,
            'name'          =>  'Admin',
            'email'         =>  'admin@admin.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user1);

        $user2 = [
            'group_id'     =>  $g2->id,
            'name'          =>  'User',
            'email'         =>  'user@user.com',
            'password'      =>  bcrypt('password'),
            'verified_at'   =>  now(),
        ];

        User::create($user2);
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
