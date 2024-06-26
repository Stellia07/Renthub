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
    Schema::table('lease_agreements', function (Blueprint $table) {
        $table->date('start_date')->after('room_address')->nullable(); // Use `after` to specify placement, `nullable` if the column can be empty
    });
}

public function down()
{
    Schema::table('lease_agreements', function (Blueprint $table) {
        $table->dropColumn('start_date');
    });
}

};
