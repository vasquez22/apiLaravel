<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteTable extends Migration
{
    public function up()
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->integer('edad');
            $table->string('correo', 30);
            $table->string('telefono', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiante');
    }
}
    