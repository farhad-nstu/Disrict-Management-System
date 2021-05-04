<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_admins', function (Blueprint $table) {
            $table->id();
            $table->integer('zilla_id');
            $table->integer('upazilla_id');
            $table->integer('union_id');
            $table->string('name');
            $table->string('designation');
            $table->string('phone');
            $table->string('email');
            $table->string('nid');
            $table->string('user_picture')->nullable();
            $table->string('post_code');
            $table->string('office_type')->nullable();
            $table->string('password');
            $table->string('free_active_date')->nullable();
            $table->string('free_expire_date')->nullable();
            $table->string('charge_type')->nullable();
            $table->string('online_charge')->nullable();
            $table->string('tax_payer_date')->nullable();
            $table->string('tax_expire_date')->nullable();
            $table->string('first_online_charge')->nullable();
            $table->string('renew_charge')->nullable();
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
        Schema::dropIfExists('union_admins');
    }
}
