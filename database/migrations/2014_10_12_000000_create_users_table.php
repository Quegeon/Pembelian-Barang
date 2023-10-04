<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_supplier',11)
                ->nullable()
                ->index('id_supplier');
            $table->string('id_customer',11)
                ->nullable()
                ->index('id_customer');
            $table->string('nama',50);
            $table->string('username',20);
            $table->string('no_telp',13);
            $table->string('email',50);
            $table->string('password',225);
            $table->string('nama_perusahaan',25)
                ->nullable();
            $table->string('alamat',255)
                ->nullable();
            $table->enum('level',['admin','petugas','customer','supplier'])
                ->default('petugas');
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
        Schema::dropIfExists('users');
    }
}
