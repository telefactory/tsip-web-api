<?php

namespace App;

use Illuminate\Support\Facades\DB;

class ChangeLogHelper
{

    public function writeChangeLogLine($arr) {
        DB::connection('customers')->table('ChangeLog')->insert($arr);
    }
    
}
