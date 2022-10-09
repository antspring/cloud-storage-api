<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->string('public_link')->nullable()->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->string('public_link')->nullable(false)->change();

            $table->dropUnique('files_public_link_unique');
        });
    }
};
