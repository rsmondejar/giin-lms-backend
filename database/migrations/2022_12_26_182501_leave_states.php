<?php

use App\Models\LeaveState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'leave_states';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        LeaveState::create(['id' => 1, 'name' => 'Pendiente de Aprobar']);
        LeaveState::create(['id' => 2, 'name' => 'Aprobadas']);
        LeaveState::create(['id' => 3, 'name' => 'Rechazadas']);
        LeaveState::create(['id' => 4, 'name' => 'Canceladas']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->drop(self::TABLE);
    }
};
