<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('uk_roles_name');
        });

        DB::table('roles')
            ->insert([
                ['id' => 1, 'name' => 'admin'],
                ['id' => 2, 'name' => 'organizer'],
                ['id' => 3, 'name' => 'user'],
            ]);

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default(1);
            $table->foreign('role_id')->references('id')->on('roles');
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }

        });
        Schema::table('booking', function (Blueprint $table) {
            $table->enum('payment_mode', ['paypal', 'card']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
