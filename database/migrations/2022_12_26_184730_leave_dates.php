<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'leave_dates';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_id');
            $table->date('date')->index();
            $table->boolean('is_half_day')->default(0);
            $table->boolean('is_cancelled')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('leave_id')
                ->references('id')
                ->on('leaves')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
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
