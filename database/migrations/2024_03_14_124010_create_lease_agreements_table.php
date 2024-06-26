<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaseAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_agreements', function (Blueprint $table) {
            $table->id();
            $table->date('effective_date');
            $table->string('homeowner_name');
            $table->string('homeowner_address');
            $table->string('renter_name');
            $table->string('renter_address');
            $table->string('room_address');
            // Add other fields as necessary
            $table->string('termination_notice_period')->nullable();
            $table->string('termination_non_compliance_period')->nullable();
            $table->text('lessor_signature')->nullable(); // Consider how you'll store signatures
            $table->text('lessee_signature')->nullable(); // Text or another type?
            $table->date('agreement_date');
            $table->timestamps(); // Include this if you want to track created and updated times
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lease_agreements');
    }
}
