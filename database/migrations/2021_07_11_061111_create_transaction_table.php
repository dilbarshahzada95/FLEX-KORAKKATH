<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['purchase', 'sell','expense','salary','quotation']);
            $table->integer('contact_id')->unsigned();
            $table->string('invoice_no')->nullable();
            $table->string('ref_no')->nullable();
            $table->enum('payment_status', ['paid', 'due'])->nullable();;
            $table->decimal('final_total', 22, 4)->default(0);
            $table->string('advance')->nullable();
            $table->string('transaction_date');
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
        Schema::dropIfExists('transaction');
    }
}
