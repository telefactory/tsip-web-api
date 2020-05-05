<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class QueueMember extends Model
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
   protected $table = 'Queue_Member';

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
        'queue_member_id',
        'description',
        'destination_number',
        'active',
        'ringing_timeout',
        'start_date',
        'end_date'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
       'queue_member_id',
       'description',
       'destination_number',
       'active',
       'ringing_timeout',
       'start_date',
       'end_date'
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
    protected static function boot(){
        parent::boot();

        static::retrieved(function($model){
            $model->hidden = array_merge($model->hidden, array_keys($model->attributes));
        });
    }
   
    /**
     * Queue member id attribute
     * 
     * @return int
     */
    public function getQueueMemberIdAttribute(){
        return $this->attributes['QM_ID'] ?: 0;
    }
 
    /**
     * Set queue member id attribute
     *
     * @param int $queueMemberId
     * @return void
     */
    public function setQueueMemberIdAttribute($queueMemberId){
        $this->attributes['QM_ID'] = $queueMemberId;
    }
   
    /**
     * Description attribute
     * 
     * @return string
     */
    public function getDescriptionAttribute(){
        return $this->attributes['Description'] ?: "none";
    }
 
    /**
     * Set description attribute
     *
     * @param string $description
     * @return void
     */
    public function setDescriptionAttribute($description){
        $this->attributes['Description'] = $description;
    }
   
    /**
     * Active attribute
     * 
     * @return bool
     */
    public function getActiveAttribute(){
        return (bool) $this->attributes['Active'] ?: false;
    }
 
    /**
     * Set active attribute
     *
     * @param bool $active
     * @return void
     */
    public function setActiveAttribute($active){
        $this->attributes['Active'] = (bool) $active;
    }
   
    /**
     * Description attribute
     * 
     * @return string
     */
    public function getRingingTimeoutAttribute(){
        return (int) $this->attributes['RingingTimeout'] ?: 0;
    }
 
    /**
     * Set ringint timeout attribute
     *
     * @param string $ringingTimeout
     * @return void
     */
    public function setRingingTimeoutAttribute($ringingTimeout){
        $this->attributes['RingingTimeout'] = (int) $ringingTimeout;
    }
   
    /**
     * Destination number attribute
     * 
     * @return string
     */
    public function getDestinationNumberAttribute(){
        return $this->attributes['DestinationNumber'] ?: null;
    }
 
    /**
     * Set destination number attribute
     *
     * @param string $destinationNumber
     * @return void
     */
    public function setDestinationNumberAttribute($destinationNumber){
        $this->attributes['DestinationNumber'] = $destinationNumber;
    }

    /**
     * Get start date attribute
     *
     * @return string
     */
    public function getStartDateAttribute(){
        return $this->attributes['StartDate'] ?: null;
    }

    /**
     * Set start date attribute
     * 
     * @param string $startDate
     * @return void
     */
    public function setStartDateAttribute($startDate){
        $this->attributes['StartDate'] = $startDate;
    }

    /**
     * Get end date attribute
     *
     * @return string
     */
    public function getEndDateAttribute(){
        return $this->attributes['EndDate'] ?: null;
    }

    /**
     * Set schedule type attribute
     * 
     * @param string $endDate
     * @return void
     */
    public function setEndDateAttribute($endDate){
        $this->attributes['EndDate'] = $endDate;
    }
}
