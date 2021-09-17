<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();

            $table->uuid('parent')->nullable();
            $table->enum('kind', \App\Infrastructure\Enums\CategoryKindEnum::values())->index();
            $table->unsignedTinyInteger('depth')->default(0)->index();
            $table->string('slug')->index();
            $table->string('name');
            $table->boolean('categories_status')->default(true)->index();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
