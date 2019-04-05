<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('reference')->nullable();
            $table->string('amount')->nullable();
            $table->string('barcode');
            $table->integer('ebib');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE barcodes AUTO_INCREMENT = 101;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barcdoes');
    }
}
