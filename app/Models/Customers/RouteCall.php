<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Enums\AnswerCallPolicy;

class RouteCall extends Model
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
   protected $table = 'RouteCall';

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
        'destination_number',
        'use_true_a_number',
        'answer_call_policy',
        'no_answer_timer',
        'on_busy_next_mid',
        'on_fail_next_mid',
        'on_no_answer_next_mid',
        'description',
        'pass_through',
        'on_pass_through_next_mid'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
       'destination_number',
       'use_true_a_number',
       'answer_call_policy',
       'no_answer_timer',
       'on_busy_next_mid',
       'on_fail_next_mid',
       'on_no_answer_next_mid',
       'description',
       'pass_through',
       'on_pass_through_next_mid'
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
     * Use true a number attribute
     * 
     * @return bool
     */
    public function getUseTrueANumberAttribute(){
        return (bool) $this->attributes['UseTrueANumber'] ?: false;
    }
 
    /**
     * Set use true a number attribute
     *
     * @param bool $useTrueANumber
     * @return void
     */
    public function setUseTrueANumberAttribute($useTrueANumber){
        $this->attributes['UseTrueANumber'] = (bool) $useTrueANumber;
    }
   
    /**
     * Answer call policy attribute
     * 
     * @return string
     */
    public function getAnswerCallPolicyAttribute(){
        return AnswerCallPolicy::hasKey($this->attributes['AnswerCallPolicy']) ? AnswerCallPolicy::getValue($this->attributes['AnswerCallPolicy']) : AnswerCallPolicy::getValue('NO_ANSWER');
    }
 
    /**
     * Set answer call policy attribute
     *
     * @param string $answerCallPolicy
     * @return void
     */
    public function setAnswerCallPolicyAttribute($answerCallPolicy){
        if(AnswerCallPolicy::hasKey($answerCallPolicy)){
            $this->attributes['AnswerCallPolicy'] = AnswerCallPolicy::getValue($answerCallPolicy);
        }
    }
   
    /**
     * No answer timer attribute
     * 
     * @return int
     */
    public function getNoAnswerTimerAttribute(){
        return $this->attributes['NoAnswerTimer'] ?: null;
    }
 
    /**
     * Set no answer timer attribute
     *
     * @param int $noAnswerTimer
     * @return void
     */
    public function setNoAnswerTimerAttribute($noAnswerTimer){
        $this->attributes['NoAnswerTimer'] = $noAnswerTimer;
    }
   
    /**
     * On busy next mid attribute
     * 
     * @return int
     */
    public function getOnBusyNextMidAttribute(){
        return $this->attributes['OnBusyNextMID'] ?: null;
    }
 
    /**
     * Set on busy next mid attribute
     *
     * @param int $nextMid
     * @return void
     */
    public function setOnBusyNextMidAttribute($onBusyNextMid){
        $this->attributes['OnBusyNextMID'] = $onBusyNextMid;
    }
   
    /**
     * On fail next mid attribute
     * 
     * @return int
     */
    public function getOnFailNextMidAttribute(){
        return $this->attributes['OnFailNextMID'] ?: null;
    }
 
    /**
     * Set on fail next mid attribute
     *
     * @param int $nextMid
     * @return void
     */
    public function setOnFailNextMidAttribute($onFailNextMid){
        $this->attributes['OnFailNextMID'] = $onFailNextMid;
    }
   
    /**
     * On no answer next mid attribute
     * 
     * @return int
     */
    public function getOnNoAnswerNextMidAttribute(){
        return $this->attributes['OnNoAnswerNextMID'] ?: null;
    }
 
    /**
     * Set on no answer next mid attribute
     *
     * @param int $onNoAnswerNextMid
     * @return void
     */
    public function setOnNoAnswerNextMidAttribute($onNoAnswerNextMid){
        $this->attributes['OnNoAnswerNextMID'] = $onNoAnswerNextMid;
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
     * Pass through attribute
     * 
     * @return int
     */
    public function getPassThroughAttribute(){
        return (int) (bool) $this->attributes['PassThrough'] ?: 0;
    }
 
    /**
     * Set pass through attribute
     *
     * @param int $passThrough
     * @return void
     */
    public function setPassThroughAttribute($passThrough){
        $this->attributes['PassThrough'] = $passThrough;
    }
   
    /**
     * On pass through next mid attribute
     * 
     * @return int
     */
    public function getOnPassThroughNextMidAttribute(){
        return $this->attributes['OnPassThroughNextMID'] ?: null;
    }
 
    /**
     * Set on pass through next mid attribute
     *
     * @param int $onPassThroughNextMid
     * @return void
     */
    public function setOnPassThroughNextMidAttribute($onPassThroughNextMid){
        $this->attributes['OnPassThroughNextMID'] = $onPassThroughNextMid;
    }
}
