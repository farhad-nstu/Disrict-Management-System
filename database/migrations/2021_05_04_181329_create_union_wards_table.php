<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_wards', function (Blueprint $table) {
            $table->id();
            $table->integer('zilla_id');
            $table->integer('upazilla_id');
            $table->integer('union_id');
            $table->string('name');
            $table->string('ward_no')->nullable();
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
        Schema::dropIfExists('union_wards');
    }
}
