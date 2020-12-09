<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('categories_id')->nullable();
            $table->string('title')->nullable();
            $table->mediumText('contents')->nullable();
            $table->integer('count_view')->default('0');
            $table->string('image')->nullable()->default(url('/').'/assets/img/post-single-1.jpg');
            $table->string('image_resize')->nullable()->default(url('/').'/assets/img/post-1.jpg');
            $table->integer('created_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->tinyInteger('delete_status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
