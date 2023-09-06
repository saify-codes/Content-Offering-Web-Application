<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = <<<'SQL'
        CREATE OR REPLACE PROCEDURE `deposit`(IN `amount` FLOAT UNSIGNED, IN `deduction` FLOAT UNSIGNED, IN `user_id` BIGINT UNSIGNED)
        BEGIN
        DECLARE net_amount float;
        SET net_amount = amount - (amount * deduction / 100);
        UPDATE users SET earnings = earnings + net_amount WHERE id = user_id;
        END
        SQL;

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $sql = 'DROP PROCEDURE IF EXISTS GetTotalUsers;';
        DB::unprepared($sql);
    }
};
