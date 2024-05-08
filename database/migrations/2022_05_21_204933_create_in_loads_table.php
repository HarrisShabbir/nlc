<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_loads', function (Blueprint $table) {
            $table->id();
            $table->integer('distributor_id');
            $table->integer('vendor_pool_id');
            $table->integer('shift_id')->nullable();
            $table->string('type')->nullable();
            $table->string('way_bill')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('in_loads');
    }
}
