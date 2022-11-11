<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();

            $table->dateTime('date');
            $table->string('ticket_no')->nullable();
            $table->string('client');
            $table->string('client_contact_no')->nullable();
            $table->string('client_email')->nullable();
            $table->string('product');
            $table->string('model');
            $table->string('accessories')->nullable();
            $table->string('serial_no');
            $table->string('cyber_serial_no1');
            $table->string('cyber_serial_no2');
            $table->longText('problem_desc');
            $table->boolean('warranty');
            $table->string('invoice_no')->nullable();
            $table->integer('taken_by');
            $table->integer('assigned_to')->nullable();
            $table->longText('diagnostic')->nullable();
            $table->dateTime('diagnostic_date')->nullable();
            $table->boolean('chargeable')->nullable();
            $table->string('quotation_no')->nullable();
            $table->boolean('quotation_approved')->nullable();
            $table->longText('client_signature_request');
            $table->longText('client_signature_delivery')->nullable();
            $table->string('status');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
};
