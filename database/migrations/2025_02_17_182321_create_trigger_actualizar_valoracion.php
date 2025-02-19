<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared("
    CREATE TRIGGER actualizar_valoracion_establecimiento
    AFTER INSERT ON valoracion
    FOR EACH ROW
    BEGIN
        UPDATE establecimiento e
        JOIN cita c ON e.id_establc = c.id_establc
        SET e.valoracion_final = (
            SELECT CAST(AVG(v.calificacion) AS DECIMAL(10,2))
            FROM valoracion v
            WHERE v.id_cita IN (
                SELECT id_cita FROM cita WHERE id_establc = e.id_establc
            )
        )
        WHERE c.id_cita = NEW.id_cita;
    END;
");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS actualizar_valoracion_establecimiento;");
    }
};
