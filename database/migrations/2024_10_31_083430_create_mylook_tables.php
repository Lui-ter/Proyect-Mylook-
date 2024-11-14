<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->integer('id_usuario')->primary();
            $table->string('nombre', 60);
            $table->string('correo', 60)->unique()->nullable();
            $table->string('contrasena', 120);
            $table->string('telefono', 30)->unique()->nullable();
            $table->string('condicion', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('negocio', function (Blueprint $table) {
            $table->integer('id_negocio')->primary();
            $table->integer('id_usuario')->unique()->nullable();
            $table->string('nombre_negocio', 30);
            $table->string('desc_negocio', 60)->nullable();
            $table->string('contrasena', 120);
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->nullable();
            $table->timestamps();
        });

        Schema::create('categoria', function (Blueprint $table) {
            $table->increments('id_categoria');
            $table->string('nom_categoria', 30);
            $table->string('desc_categoria', 60);
        });

        
        Schema::create('tipo_servicio', function (Blueprint $table) {
            $table->increments('id_tiposerv');
            $table->unsignedInteger('id_categoria');
            $table->string('tipo_serv', 30);
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria');
        });

        Schema::create('servicio', function (Blueprint $table) {
            $table->increments('id_servicio');
            $table->unsignedInteger('id_tiposerv');
            $table->string('nom_servicio', 30);
            $table->string('desc_servicio', 60);
            $table->float('duracion_serv');
            $table->float('precio_servicio');
            $table->foreign('id_tiposerv')->references('id_tiposerv')->on('tipo_servicio');
        });

        Schema::create('establecimiento', function (Blueprint $table) {
            $table->increments('id_establc');
            $table->integer('id_negocio');
            $table->string('nombre_establc', 30);
            $table->string('desc_establc', 100);
            $table->string('ubicacion', 30);
            $table->string('contrasena', 120);
            $table->string('correo', 30);
            $table->string('telefono', 30);
            $table->longText('img_establc')->nullable();
            $table->foreign('id_negocio')->references('id_negocio')->on('negocio');
        });

        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id_prod');
            $table->unsignedInteger('id_establc');
            $table->string('nombre_prod', 30);
            $table->string('nom_marca', 30);
            $table->string('desc_prod', 60);
            $table->longText('img_prod')->nullable();
            $table->integer('stock');
            $table->float('valor_prod');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
        });

        Schema::create('serv_establecimiento', function (Blueprint $table) {
            $table->unsignedInteger('id_servicio');
            $table->unsignedInteger('id_establc');
            $table->foreign('id_servicio')->references('id_servicio')->on('servicio');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
            $table->primary(['id_servicio', 'id_establc']);
        });

        Schema::create('rol', function (Blueprint $table) {
            $table->increments('id_rol');
            $table->string('desc_rol', 30);
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id_staff');
            $table->integer('id_usuario');
            $table->unsignedInteger('id_establc');
            $table->unsignedInteger('id_rol');
            $table->integer('telefono');
            $table->longText('img_staff')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
            $table->foreign('id_rol')->references('id_rol')->on('rol');
        });

        Schema::create('horario', function (Blueprint $table) {
            $table->increments('id_horario');
            $table->unsignedInteger('id_establc');
            $table->unsignedInteger('id_staff');
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
            $table->foreign('id_staff')->references('id_staff')->on('staff');
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id_agenda');
            $table->unsignedInteger('id_establc')->unique();
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
            $table->integer('id_usuario');
            $table->unsignedInteger('id_establc');
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->float('duracion_cita');
            $table->string('estado_cita', 30);
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_establc')->references('id_establc')->on('establecimiento');
        });

        Schema::create('reserva_servicio', function (Blueprint $table) {
            $table->unsignedInteger('id_cita')->unique();
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
            $table->integer('calificacion');
            $table->foreign('id_cita')->references('id_cita')->on('cita');
        });
    }

    /**
     * Reverse the migrations.
     */
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
        Schema::dropIfExists('serv_establecimiento');
        Schema::dropIfExists('producto');
        Schema::dropIfExists('establecimiento');
        Schema::dropIfExists('servicio');
        Schema::dropIfExists('tipo_servicio');
        Schema::dropIfExists('categoria');
        Schema::dropIfExists('negocio');
        Schema::dropIfExists('usuario');
    }
};