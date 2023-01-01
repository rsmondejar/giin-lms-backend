<?php

use App\Models\LeaveType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'leave_types';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->boolean('is_unplanned')->default(1)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        LeaveType::create(['id' => 1, 'name' => 'Vacaciones', 'is_unplanned' => 0]);
        LeaveType::create(['id' => 2, 'name' => 'Enfermedad']);
        LeaveType::create(['id' => 3, 'name' => 'Bajas no oficiales']);
        LeaveType::create(['id' => 4, 'name' => 'Permisos']);
        LeaveType::create(['id' => 5, 'name' => 'Old School']);
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
