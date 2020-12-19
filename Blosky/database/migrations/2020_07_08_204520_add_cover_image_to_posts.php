<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageToPosts extends Migration
{

    public function up() {
        Schema::table('posts', function($table) {
            $table->string('cover_image');
        });
    }

    public function down() {
        Schema::table('posts', function($table) {
            $table->dropColumn('cover_image');
        });
    }
}
