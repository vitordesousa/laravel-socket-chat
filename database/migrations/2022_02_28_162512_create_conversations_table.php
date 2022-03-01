<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('emplooyer_id')->nullable();
            $table->foreign('emplooyer_id')->references('id')->on('users')->onDelete('cascade');

            $table->tinyInteger('status')->default(0)->comment('0 - aguardando funcionário, 1 - em andamento, 2 - finalizado pelo usuário, 3 - finalizado por inatividade do cliente');

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
        Schema::dropIfExists('conversations');
    }
};
