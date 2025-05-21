<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()

{
    if (!Schema::hasColumn('users', 'document_path')) {
        Schema::table('users', function (Blueprint $table) {
            $table->string('document_path')->nullable()->after('email');
        });
    }
}



    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('document_path');
    });
}

};
