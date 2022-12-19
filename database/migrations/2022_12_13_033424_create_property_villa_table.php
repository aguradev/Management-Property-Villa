<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyVillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_villa', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_id");
            $table->string("property_villa_name");
            $table->string("slug");
            $table->string("location");
            $table->bigInteger("price");
            $table->longText("description");
            $table->string("img_thumbnail");
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
        Schema::dropIfExists('property_villa');
    }
}
