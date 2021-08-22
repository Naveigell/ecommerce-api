<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('shops')) {
            Schema::create('shops', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('account_id')->nullable()->index();
                $table->string("name", 100);
                $table->string("slug", 255)->unique();
                $table->text("description")->nullable();
                $table->string("city", 255);
                $table->string("address", 255);
                $table->string("shop_avatar", 255)->nullable();
                $table->timestamps();

                $table->foreign('account_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
