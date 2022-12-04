<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::connection('mysql')->table(self::TABLE, function (Blueprint $table) {
            $table->unsignedInteger('department_id')
                ->nullable()
                ->index()
                ->after('business_id');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::connection('mysql')->table(self::TABLE, function (Blueprint $table) {
            $table->dropConstrainedForeignId('department_id');
        });
    }
};
