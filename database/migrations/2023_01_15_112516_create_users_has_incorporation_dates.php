<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'users_has_incorporation_dates';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create(self::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedInteger('business_id')->index();
            $table->date('begin_date')->index();
            $table->date('end_date')->nullable();

            $table->timestamps();

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique([
                'user_id',
                'business_id',
                'begin_date'
            ], 'users_has_incorporation_unique');
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
