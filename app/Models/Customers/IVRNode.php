<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class IVRNode extends Model
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
   protected $table = 'IVR_node';

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
       'ivrNodeId',
       'description',
       'start_date',
       'end_date',
       'digit',
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
    protected static function boot(){
        parent::boot();

        static::retrieved(function($model){
            $model->hidden = array_merge($model->hidden, array_keys($model->attributes));
        });
    }
   
    /**
     * Ivr node id attribute
     * 
     * @return string
     */
    public function getIvrNodeIdAttribute(){
        return $this->attributes['IN_ID'] ?: null;
    }
 
    /**
     * Set ivr node id attribute
     *
     * @param string $ivrNodeId
     * @return void
     */
    public function setIvrNodeIdAttribute($ivrNodeId){
        $this->attributes['IN_ID'] = $ivrNodeId;
    }
   
    /**
     * Description attribute
     * 
     * @return string
     */
    public function getDescriptionAttribute(){
        return $this->attributes['Description'] ?: null;
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
     * Start date attribute
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
     * End date attribute
     * 
     * @return string
     */
    public function getEndDateAttribute(){
        return $this->attributes['EndDate'] ?: null;
    }
 
    /**
     * Set end date attribute
     *
     * @param string $endDate
     * @return void
     */
    public function setEndDateAttribute($endDate){
        $this->attributes['EndDate'] = $endDate;
    }
   
    /**
     * Illegal digit attribute
     * 
     * @return int
     */
    public function getDigitAttribute(){
        return $this->attributes['Digit'] ?: null;
    }
 
    /**
     * Set digit attribute
     *
     * @param int $digit
     * @return void
     */
    public function setDigitAttribute($digit){
        $this->attributes['Digit'] = $digit;
    }
   
    /**
     * Next mid attribute
     * 
     * @return string
     */
    public function getNextMidAttribute(){
        return $this->attributes['NextMID'] ?: null;
    }
 
    /**
     * Set next mid attribute
     *
     * @param int $nextMid
     * @return void
     */
    public function setNextMidAttribute($nextMid){
        $this->attributes['NextMID'] = $nextMid;
    }
}
