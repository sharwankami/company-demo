<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name", 255);
            $table->bigInteger('organization_number')->unique();
            $table->string("street_name", 255)->nullable();
            $table->string("house_number", 50)->nullable();
            $table->string("zip_code", 10)->nullable();
            $table->string("country", 50);
            $table->string("phone",20)->nullable();
            $table->string("email", 255);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
