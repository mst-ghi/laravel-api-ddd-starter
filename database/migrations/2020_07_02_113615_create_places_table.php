<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();

            $table->uuid('parent')->nullable();
            $table->enum('kind', \App\Infrastructure\Enums\PlacesKindEnum::values())->index();
            $table->string('name')->index();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('places_status')->default(true)->index();

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
        Schema::dropIfExists('places');
    }
}
