<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class PrePaidCheck extends Model
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
    protected $table = 'PrePaidCheck';

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
        'charge_mid',
        'continue_mid'
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'charge_mid',
        'continue_mid'
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
     * On charge mid attribute
     * 
     * @return int
     */
    public function getChargeMidAttribute(){
        return $this->attributes['ChargeMID'] ?: null;
    }
 
    /**
     * Set on charge mid attribute
     *
     * @param int $chargeMid
     * @return void
     */
    public function setChargeMidAttribute($chargeMid){
        //$this->attributes['ChargeMID'] = $chargeMid;
    }


    /**
     * On continue mid attribute
     * 
     * @return int
     */
    public function getContinueMidAttribute(){
        return $this->attributes['ContinueMID'] ?: null;
    }
 
    /**
     * Set on continue mid attribute
     *
     * @param int $continueMid
     * @return void
     */
    public function setContinueMidAttribute($continueMid){
        //$this->attributes['ChargeMID'] = $continueMid;
    }
}
