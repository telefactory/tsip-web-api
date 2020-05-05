<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UserManual extends Model
{
    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'user_manuals';

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;
}
