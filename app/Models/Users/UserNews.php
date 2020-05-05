<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UserNews extends Model
{
    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'user_news';

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;
}
