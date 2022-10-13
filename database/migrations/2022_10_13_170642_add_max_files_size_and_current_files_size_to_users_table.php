<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('max_files_size')->default(104857600)->after('remember_token');
            $table->unsignedInteger('current_files_size')->default(0)->after('remember_token');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['max_files_size', 'current_files_size']);
        });
    }
};
