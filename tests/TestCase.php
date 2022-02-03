<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function tearDown(): void
    {

        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = 'food_order_test';";

        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        $tables = DB::select($sql);

        array_walk($tables, function($table){
            if ($table->TABLE_NAME != 'migrations') {
                DB::table($table->TABLE_NAME)->truncate();
            }
        });

        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
        parent::tearDown();
    }

}
