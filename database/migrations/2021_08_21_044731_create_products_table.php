<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->bigIncrements("id");
                $table->unsignedBigInteger("shop_id")->nullable()->index();
                $table->string("name", 100);
                $table->string("slug", 255);
                $table->text("description");
                $table->decimal("price", 15);
                $table->unsignedInteger("stock")->default(1);
                $table->unsignedInteger("weight")->default(0);
                $table->unsignedInteger("width")->default(0);
                $table->unsignedInteger("length")->default(0);
                $table->unsignedInteger("height")->default(0);
                $table->timestamps();

                $table->foreign('shop_id')->references('id')->on('shops')->onUpdate('CASCADE')->onDelete('SET NULL');
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
        Schema::dropIfExists('products');
    }
}
