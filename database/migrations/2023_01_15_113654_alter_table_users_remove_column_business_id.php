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
        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->dropConstrainedForeignId('business_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->unsignedInteger('business_id')
                ->nullable()
                ->index()
                ->after('remember_token');

            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }
};
