<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE categoria ADD COLUMN imagen LONGBLOB');
        DB::statement('ALTER TABLE servicio ADD COLUMN img_serv LONGBLOB');
        DB::statement('ALTER TABLE producto ADD COLUMN img_prod LONGBLOB');
        DB::statement('ALTER TABLE usuario ADD COLUMN img_usuario LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE categoria DROP COLUMN imagen');
        DB::statement('ALTER TABLE servicio DROP COLUMN img_serv');
        DB::statement('ALTER TABLE producto DROP COLUMN img_prod');
        DB::statement('ALTER TABLE usuario DROP COLUMN img_usuario');
    }
};
