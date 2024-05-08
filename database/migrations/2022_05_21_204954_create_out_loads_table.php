<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_loads', function (Blueprint $table) {
            $table->id();
            $table->integer('distributor_id');
            $table->integer('vendor_pool_id');
            $table->integer('shift_id')->nullable();
            $table->date('dispatch_date')->nullable();
            $table->integer('shipment_number')->nullable();
            $table->integer('bilti_number')->nullable();
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
        Schema::dropIfExists('out_loads');
    }
}
