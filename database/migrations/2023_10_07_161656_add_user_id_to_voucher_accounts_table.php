<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToVoucherAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voucher_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher_accounts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

    }
}
