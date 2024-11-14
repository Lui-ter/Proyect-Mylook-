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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE categoria DROP COLUMN imagen');
        DB::statement('ALTER TABLE servicio DROP COLUMN img_serv');
    }
};
