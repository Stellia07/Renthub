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
        $table->integer('breach_correction_period')->nullable()->after('termination_non_compliance_period');
    });
}

public function down()
{
    Schema::table('lease_agreements', function (Blueprint $table) {
        $table->dropColumn('breach_correction_period');
    });
}

};
