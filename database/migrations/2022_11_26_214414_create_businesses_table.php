<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'businesses';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name', 60)->unique()->index();
            $table->string('address');
            $table->string('city', 60);
            $table->string('postal_code', 10);
            $table->string('country', 60);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('website', 100)->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(self::TABLE);
    }
};
