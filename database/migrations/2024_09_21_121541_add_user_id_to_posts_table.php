<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // user_id sütunu ekleniyor ve foreign key tanımlanıyor
            $table->unsignedBigInteger('user_id')->after('id'); // user_id, id'den sonra gelir
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Geri alma işlemi sırasında foreign key ve sütun siliniyor
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
