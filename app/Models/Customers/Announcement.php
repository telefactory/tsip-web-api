<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Enums\AnswerCallPolicy;

class Announcement extends Model
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
   protected $table = 'Announcement';

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
        'file_name',
        'common_recording_id',
        'answer_call_policy',
        'wait_for_complete',
        'next_mid',
        'description'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
       'file_name',
       'common_recording_id',
       'answer_call_policy',
       'wait_for_complete',
       'next_mid',
       'description'
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
    * File name attribute
    * 
    * @return string
    */
   public function getFileNameAttribute(){
       return $this->attributes['FileName'] ?: null;
   }

   /**
    * Set file name attribute
    *
    * @param string $fileName
    * @return void
    */
   public function setFileNameAttribute($fileName){
       $this->attributes['FileName'] = $fileName;
   }

    /**
     * Common recording id attribute
     *
     * @return int
     */
    public function getCommonRecordingIdAttribute(){
        return $this->attributes['CommonRecordingID'] ?: 0;
    }

    /**
     * Set common recording id attribute
     *
     * @param int $commonRecordingId
     * @return void
     */
    public function setCommonRecordingIdAttribute($commonRecordingId){
        $this->attributes['CommonRecordingID'] = $commonRecordingId;
    }

    /**
     * Answer call policy attribute
     *
     * @return string
     */
    public function getAnswerCallPolicyAttribute(){
        return AnswerCallPolicy::hasKey($this->attributes['AnswerCallPolicy']) ? AnswerCallPolicy::getValue($this->attributes['AnswerCallPolicy']) : AnswerCallPolicy::getValue("NO_ANSWER");
    }

    /**
     * Set answer call policy attribute
     *
     * @param string $answerCallPolicy
     * @return void
     */
    public function setAnswerCallPolicyAttribute($answerCallPolicy){
        if(AnswerCallPolicy::hasKey($answerCallPolicy)){
            $this->attributes['AnswerCallPolicy'] = $answerCallPolicy;
        }
    }

    /**
     * Wait for complete attribute
     *
     * @return bool
     */
    public function getWaitForCompleteAttribute(){
        return (bool) $this->attributes['WaitForComplete'] ?: false;
    }

    /**
     * Set wait for complete attribute
     *
     * @param bool $waitForComplete
     * @return void
     */
    public function setWaitForCompleteAttribute($waitForComplete){
        $this->attributes['WaitForComplete'] = (int) ((bool) $waitForComplete);
    }

    /**
     * Next MID attribute
     *
     * @return int
     */
    public function getNextMidAttribute(){
        return $this->attributes['NextMID'] ?: null;
    }

    /**
     * Set next MID attribute
     *
     * @param int $nextMid
     * @return void
     */
    public function setNextMidAttribute($nextMid){
        $this->attributes['NextMID'] = $nextMid;
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
}
