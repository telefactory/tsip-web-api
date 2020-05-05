<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class PrePaidUpdate extends Model
{
    /**
     * Connection name
     * 
     * @var string
     */
    protected $connection = 'customers';

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'PrePaidUpdate';

    /**
     * Primary key
     * 
     * @var string
     */
    public $primaryKey = null;

    /**
     * Fillable values
     * 
     * @var array
     */
    protected $fillable = [
        'next_mid'
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'next_mid'
    ];

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Setup hidden array based on booted attributes
     * 
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            $model->hidden = array_merge($model->hidden, array_keys($model->attributes));
        });
    }

        /**
     * next mid attribute
     * 
     * @return int
     */
    public function getNextMidAttribute(){
        return $this->attributes['NextMID'] ?: null;
    }
 
    /**
     * Set on continue mid attribute
     *
     * @param int $continueMid
     * @return void
     */
    public function setNextMidAttribute($nextMid){
        //$this->attributes['NextMID'] = $nextMid;
    }
}
