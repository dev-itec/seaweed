<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->string('name', 100);
            $table->string('lastname', 100);
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->decimal('total', 3, 2);
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizes')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropColumn(['quiz_id', 'name', 'lastname', 'email', 'tel', 'total']);
        });
    }
};
