<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('users_id');
            $table->text('pesan')->nullable();
            $table->string('pengirim')->nullable();
            $table->text('alamat_tujuan')->nullable();
            $table->string('nohp')->nullable();
            
            $table->string('payment')->default('MIDTRANS');
            $table->string('payment_url')->nullable();

            $table->bigInteger('total_harga')->default(0);
            $table->string('status')->default('PENDING');

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
        Schema::dropIfExists('transaksis');
    }
}
