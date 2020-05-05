<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class IVR extends Model
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
    protected $table = 'IVR';

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
   ];

    /**
     * Extra attributes
     *
     * @var array
     */
    protected $appends = [
       'description',
       'start_date',
       'end_date',
       'illegal_entry_mid',
       'timeout',
       'timeout_mid',
       'next_mid',
       'ivr_nodes'
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
     * Description attribute
     *
     * @return string
     */
    public function getDescriptionAttribute()
    {
        return $this->attributes['Description'] ?: null;
    }
 
    /**
     * Set description attribute
     *
     * @param string $description
     * @return void
     */
    public function setDescriptionAttribute($description)
    {
        $this->attributes['Description'] = $description;
    }
   
    /**
     * Start date attribute
     *
     * @return string
     */
    public function getStartDateAttribute()
    {
        return $this->attributes['StartDate'] ?: null;
    }
 
    /**
     * Set start date attribute
     *
     * @param string $startDate
     * @return void
     */
    public function setStartDateAttribute($startDate)
    {
        $this->attributes['StartDate'] = $startDate;
    }
   
    /**
     * End date attribute
     *
     * @return string
     */
    public function getEndDateAttribute()
    {
        return $this->attributes['EndDate'] ?: null;
    }
 
    /**
     * Set end date attribute
     *
     * @param string $endDate
     * @return void
     */
    public function setEndDateAttribute($endDate)
    {
        $this->attributes['EndDate'] = $endDate;
    }
   
    /**
     * Illegal entry mid attribute
     *
     * @return string
     */
    public function getIllegalEntryMidAttribute()
    {
        return $this->attributes['IllegalEntryMID'] ?: null;
    }
 
    /**
     * Set illegal entry mid attribute
     *
     * @param int $illegalEntryMid
     * @return void
     */
    public function setIllegalEntryMidAttribute($illegalEntryMid)
    {
        $this->attributes['IllegalEntryMID'] = $illegalEntryMid;
    }
   
    /**
     * Timeout attribute
     *
     * @return string
     */
    public function getTimeoutAttribute()
    {
        return $this->attributes['Timeout'] ?: null;
    }
 
    /**
     * Set timeout attribute
     *
     * @param int $timeout
     * @return void
     */
    public function setTimeoutAttribute($timeout)
    {
        $this->attributes['Timeout'] = $timeout;
    }
   
    /**
     * Next MID attribute
     *
     * @return string
     */
    public function getNextMidAttribute()
    {
        return $this->attributes['NextMID'] ?: null;
    }
 
    /**
     * Set next MID attribute
     *
     * @param int $nextMid
     * @return void
     */
    public function setNextMidAttribute($nextMid)
    {
        $this->attributes['NextMID'] = $nextMid;
    }
   
    /**
     * Timeout mid attribute
     *
     * @return string
     */
    public function getTimeoutMidAttribute()
    {
        return $this->attributes['TimeoutMID'] ?: null;
    }
 
    /**
     * Set timeout mid attribute
     *
     * @param int $timeoutMid
     * @return void
     */
    public function setTimeoutMidAttribute($timeoutMid)
    {
        $this->attributes['TimeoutMID'] = $timeoutMid;
    }
   
    /**
     * Ivr nodes attribute
     *
     * @return string
     */
    public function getIvrNodesAttribute()
    {
        return IVRNode::where([
            'CF_ID' => $this->CF_ID,
            'MID' => $this->MID
        ])->get();
    }
 
    /**
     * Set ivr nodes attribute
     *
     * @param array $ivrNodes
     * @return void
     */
    public function setIvrNodesAttribute($ivrNodes)
    {
        //
    }
}
