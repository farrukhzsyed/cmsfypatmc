<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceSerial');
            $table->integer('user_id')->unsigned();
            $table->string('user_type');
            $table->integer('confirmed_user_id')->unsigned()->nullable();
            $table->string('confirmed_user_type')->nullable();
            $table->foreignId('projectId');
            $table->foreignId('issuedTo');
            $table->integer('amountToPay')->unsigned();
            $table->date('dueDate');
            $table->string('paymentEvidence')->nullable();
            $table->date('paymentDate')->nullable();
            $table->boolean('isPayEvidenceApproved')->default(0);
            $table->timestamps();
            $table->foreign('projectId')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('issuedTo')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
