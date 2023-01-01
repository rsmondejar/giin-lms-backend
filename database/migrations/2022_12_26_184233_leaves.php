<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'leaves';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::connection('mysql')->create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('requested_to_user_id')->nullable();
            $table->text('comment')->nullable();
            $table->string('emails')->nullable();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('type_id')->default(1);
            $table->unsignedBigInteger('user_holiday_id')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('requested_to_user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('state_id')
                ->references('id')
                ->on('leave_states')
                ->cascadeOnUpdate();

            $table->foreign('type_id')
                ->references('id')
                ->on('leave_types')
                ->cascadeOnUpdate();

            $table->foreign('user_holiday_id')
                ->references('id')
                ->on('user_holidays')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::connection('mysql')->drop(self::TABLE);
    }
};
