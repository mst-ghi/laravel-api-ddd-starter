<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAclTables extends Migration
{
    /**
     * @throws Exception
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();

            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->string('description')->nullable();
            $table->boolean('delete_able')->default(true);

            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();

            $table->string('module')->index();
            $table->string('name')->unique();
            $table->string('label')->nullable();

            $table->timestamps();
        });

        Schema::create('role_admin', function (Blueprint $table) {
            $table->uuid('admin_id');
            $table->uuid('role_id');

            $table->foreign('admin_id')->references('id')->on('admins')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['admin_id', 'role_id']);
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->uuid('permission_id');
            $table->uuid('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('permission_admin', function (Blueprint $table) {
            $table->uuid('permission_id');
            $table->uuid('admin_id');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'admin_id']);
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_admin');
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_admin');
        Schema::drop('roles');
    }
}
