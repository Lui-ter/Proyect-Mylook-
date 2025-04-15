<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->increments('id_rol');
            $table->string('nombre_rol', 20);
        });

        Schema::create('usuario', function (Blueprint $table) {
            $table->bigInteger('id_usuario')->primary();
            $table->string('nombre', 30);
            $table->string('apellido', 30)->nullable();
            $table->string('correo', 60)->unique()->nullable();
            $table->string('contrasena');
            $table->string('telefono', 20)->unique()->nullable();
            $table->string('condicion', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('negocio', function (Blueprint $table) {
            $table->bigInteger('id_negocio')->primary();
            $table->bigInteger('id_usuario')->unique()->nullable();
            $table->string('nombre_negocio', 30);
            $table->string('desc_negocio', 300)->nullable();
            $table->string('contrasena');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->nullable();
            $table->timestamps();
        });

        Schema::create('establecimiento', function (Blueprint $table) {
            $table->bigInteger('id_establc')->primary();
            $table->bigInteger('id_negocio');
            $table->string('nombre_establc', 30);
            $table->string('desc_establc', 300);
            $table->string('ubicacion', 30);
            $table->string('correo', 60);
            $table->string('telefono', 20);
            $table->decimal('valoracion_final', 10, 2)->default(0);
            $table->foreign('id_negocio')->references('id_negocio')->on('negocio');
        });

        Schema::create('categoria', function (Blueprint $table) {
            $table->increments('id_categoria');
            $table->bigInteger('id_establc')->nullable();
            $table->string('nom_categoria', 30);
            $table->string('desc_categoria', 300);
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
        });

        Schema::create('servicio', function (Blueprint $table) {
            $table->increments('id_servicio');
            $table->unsignedInteger('id_categoria');
            $table->string('nombre_servicio', 30);
            $table->string('desc_servicio', 300);
            $table->float('duracion_serv');
            $table->float('precio_servicio');
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria');
        });

        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id_prod');
            $table->bigInteger('id_establc')->nullable();
            $table->string('nombre_prod', 30);
            $table->string('nom_marca', 30);
            $table->string('desc_prod', 300);
            $table->integer('stock');
            $table->float('valor_prod');
            $table->timestamps();
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id_staff');
            $table->bigInteger('id_usuario');
            $table->unsignedInteger('id_rol');
            $table->bigInteger('id_establc');
            $table->bigInteger('id_negocio');
            $table->string('estado', 30)->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
            $table->foreign('id_negocio')->references('id_negocio')->on('negocio');
            $table->foreign('id_rol')->references('id_rol')->on('rol')->onDelete('cascade');
        });

        Schema::create('horario', function (Blueprint $table) {
            $table->increments('id_horario');
            $table->bigInteger('id_establc');
            $table->unsignedInteger('id_staff');
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
            $table->foreign('id_staff')->references('id_staff')->on('staff');
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id_agenda');
            $table->bigInteger('id_establc');
            $table->boolean('lun');
            $table->boolean('mar');
            $table->boolean('mie');
            $table->boolean('jue');
            $table->boolean('vie');
            $table->boolean('sab');
            $table->boolean('dom');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
        });

        Schema::create('cita', function (Blueprint $table) {
            $table->increments('id_cita');
            $table->bigInteger('id_usuario');
            $table->bigInteger('id_establc');
            $table->unsignedInteger('id_staff');
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->float('duracion_cita');
            $table->string('estado_cita', 30);
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
            $table->foreign('id_staff')->references('id_staff')->on('staff');
        });

        Schema::create('reserva_servicio', function (Blueprint $table) {
            $table->unsignedInteger('id_cita');
            $table->unsignedInteger('id_servicio');
            $table->primary(['id_cita', 'id_servicio']);
            $table->foreign('id_cita')->references('id_cita')->on('cita');
            $table->foreign('id_servicio')->references('id_servicio')->on('servicio');
        });

        Schema::create('reserva_producto', function (Blueprint $table) {
            $table->unsignedInteger('id_cita');
            $table->unsignedInteger('id_prod');
            $table->integer('cantidad');
            $table->primary(['id_cita', 'id_prod']);
            $table->foreign('id_cita')->references('id_cita')->on('cita');
            $table->foreign('id_prod')->references('id_prod')->on('producto');
        });

        Schema::create('valoracion', function (Blueprint $table) {
            $table->increments('id_valoracion');
            $table->unsignedInteger('id_cita');
            $table->string('comentario', 30);
            $table->decimal('calificacion', 10, 2);
            $table->foreign('id_cita')->references('id_cita')->on('cita');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('valoracion');
        Schema::dropIfExists('reserva_producto');
        Schema::dropIfExists('reserva_servicio');
        Schema::dropIfExists('cita');
        Schema::dropIfExists('agenda');
        Schema::dropIfExists('horario');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('rol');
        Schema::dropIfExists('producto');
        Schema::dropIfExists('establecimiento');
        Schema::dropIfExists('servicio');
        Schema::dropIfExists('categoria');
        Schema::dropIfExists('negocio');
        Schema::dropIfExists('usuario');
    }
};
