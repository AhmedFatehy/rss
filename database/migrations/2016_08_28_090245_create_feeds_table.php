<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('seed_id')->unsigned();
            $table->foreign('seed_id')->references('id')->on('seeds')->onDelete('cascade');
            $table->string('feed_id',255)->unique();
            $table->text('url');
            $table->text('title');
            $table->string('slug',255);
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('publishing_date')->nullable();
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->string('author_link')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
            /**/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feeds');
    }
}
