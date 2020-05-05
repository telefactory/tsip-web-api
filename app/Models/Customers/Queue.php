<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Enums\AnswerQueuePolicy;
use App\Models\Customers\Enums\RingTonePolicy;

class Queue extends Model
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
   protected $table = 'Queue';

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
        'answer_queue_policy',
        'ring_tone_policy',
        'description',
        'start_date',
        'end_date',
        'connected_call_timeout',
        'connected_call_warning',
        'allow_extended_call',
        'wait_music',
        'use_true_a_number',
        'announce_call',
        'present_number',
        'queueing_enabled',
        'give_position',
        'give_position_interval',
        'alert_on_free',
        //'sms_text',
        'busy_mid',
        'busy_recording_type',
        'queue_member_list',
        //'busy_recording',
        'show_override',
        'override_number',
        'override_active'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
       'answer_queue_policy',
       'ring_tone_policy',
       'description',
       'start_date',
       'end_date',
       'connected_call_timeout',
       'connected_call_warning',
       'allow_extended_call',
       'wait_music',
       'use_true_a_number',
       'announce_call',
       'present_number',
       'queueing_enabled',
       'give_position',
       'give_position_interval',
       'alert_on_free',
       //'sms_text',
       'busy_mid',
       'busy_recording_type',
       'queue_member_list',
       //'busy_recording',
       'show_override',
       'override_number',
       'override_active'
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
     * Answer queue policy attribute
     * 
     * @return string
     */
    public function getAnswerQueuePolicyAttribute(){
        return AnswerQueuePolicy::hasKey($this->attributes['AnswerQueuePolicy']) ? AnswerQueuePolicy::getValue($this->attributes['AnswerQueuePolicy']): AnswerQueuePolicy::getValue('NO_ANSWER');
    }
 
    /**
     * Set answer queue policy attribute
     *
     * @param string $answerQueuePolicy
     * @return void
     */
    public function setAnswerQueuePolicyAttribute($answerQueuePolicy){
        if(AnswerQueuePolicy::hasKey($answerQueuePolicy)){
            $this->attributes['AnswerQueuePolicy'] = AnswerQueuePolicy::getValue($answerQueuePolicy);
        }
    }
   
    /**
     * Description attribute
     * 
     * @return string
     */
    public function getRingTonePolicyAttribute(){
        return RingTonePolicy::hasKey($this->attributes['RingTonePolicy']) ? RingTonePolicy::getValue($this->attributes['RingTonePolicy']): RingTonePolicy::getValue('NO_ANSWER');
    }
 
    /**
     * Set ring tone policy attribute
     *
     * @param string $ringTonePolicy
     * @return void
     */
    public function setRingTonePolicyAttribute($ringTonePolicy){
        if(RingTonePolicy::hasKey($ringTonePolicy)){
            $this->attributes['RingTonePolicy'] = RingTonePolicy::getValue($ringTonePolicy);
        }
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
   
    /**
     * Connected call timeout attribute
     * 
     * @return string
     */
    public function getConnectedCallTimeoutAttribute(){
        return $this->attributes['ConnectedCallTimeout'] ?: null;
    }
 
    /**
     * Set connected call timeout attribute
     *
     * @param string $connectedCallTimeout
     * @return void
     */
    public function setConnectedCallTimeoutAttribute($connectedCallTimeout){
        $this->attributes['ConnectedCallTimeout'] = $connectedCallTimeout;
    }
   
    /**
     * Connected call timeout attribute
     * 
     * @return bool
     */
    public function getConnectedCallWarningAttribute(){
        return (bool) $this->attributes['ConnectedCallWarning'] ?: false;
    }
 
    /**
     * Set connected call timeout attribute
     *
     * @param bool $ConnectedCallWarning
     * @return void
     */
    public function setConnectedCallWarningAttribute($ConnectedCallWarning){
        $this->attributes['ConnectedCallWarning'] = (bool) $ConnectedCallWarning;
    }
   
    /**
     * Allow extended call attribute
     * 
     * @return bool
     */
    public function getAllowExtendedCallAttribute(){
        return (bool) $this->attributes['AllowExtendedCall'] ?: false;
    }
 
    /**
     * Set allow extended call attribute
     *
     * @param bool $allowExtendedCall
     * @return void
     */
    public function setAllowExtendedCallAttribute($allowExtendedCall){
        $this->attributes['AllowExtendedCall'] = (bool) $allowExtendedCall;
    }
   
    /**
     * Wait music attribute
     * 
     * @return string
     */
    public function getWaitMusicAttribute(){
        return $this->attributes['WaitMusic'] ?: null;
    }
 
    /**
     * Set wait music attribute
     *
     * @param string $waitMusic
     * @return void
     */
    public function setWaitMusicAttribute($waitMusic){
        $this->attributes['WaitMusic'] = $waitMusic;
    }
   
    /**
     * Use true a number attribute
     * 
     * @return string
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
     * Announce call attribute
     * 
     * @return bool
     */
    public function getAnnounceCallAttribute(){
        return (bool) $this->attributes['AnnounceCall'] ?: false;
    }
 
    /**
     * Set announce call attribute
     *
     * @param bool $announceCall
     * @return void
     */
    public function setAnnounceCallAttribute($announceCall){
        $this->attributes['AnnounceCall'] = (bool) $announceCall;
    }


    /**
     * Present number attribute
     * 
     * @return bool
     */
    public function getPresentNumberAttribute(){
        return (bool) $this->attributes['PresentNumber'] ?: false;
    }
 
    /**
     * Set present number attribute
     *
     * @param bool $presentNumber
     * @return void
     */
    public function setPresentNumberAttribute($presentNumber){
        $this->attributes['PresentNumber'] = (bool) $presentNumber;
    }
   
    /**
     * Queueing enabled attribute
     * 
     * @return string
     */
    public function getQueueingEnabledAttribute(){
        return (bool) $this->attributes['QueueingEnabled'] ?: false;
    }
 
    /**
     * Set queueing enabled attribute
     *
     * @param string $description
     * @return void
     */
    public function setQueueingEnabledAttribute($queueingEnabled){
        $this->attributes['QueueingEnabled'] = (bool) $queueingEnabled;
    }
   
    /**
     * Give position attribute
     * 
     * @return string
     */
    public function getGivePositionAttribute(){
        return (bool) $this->attributes['GivePosition'] ?: false;
    }
 
    /**
     * Set give position attribute
     *
     * @param string $givePosition
     * @return void
     */
    public function setGivePositionAttribute($givePosition){
        $this->attributes['GivePosition'] = (bool) $givePosition;
    }
   
    /**
     * Give position interval attribute
     * 
     * @return int
     */
    public function getGivePositionIntervalAttribute(){
        return (int) $this->attributes['GivePositionInterval'] ?: 0;
    }
 
    /**
     * Set give position interval attribute
     *
     * @param string $givePositionInterval
     * @return void
     */
    public function setGivePositionIntervalAttribute($givePositionInterval){
        $this->attributes['GivePositionInterval'] = $givePositionInterval;
    }
   
    /**
     * Alert on free attribute
     * 
     * @return bool
     */
    public function getAlertOnFreeAttribute(){
        return (bool) $this->attributes['AlertCallerWhenFree'] ?: false;
    }
 
    /**
     * Set alert on free attribute
     *
     * @param string $alertOnFree
     * @return void
     */
    public function setAlertOnFreeAttribute($alertOnFree){
        $this->attributes['AlertCallerWhenFree'] = $alertOnFree;
    }
   
    /**
     * Description attribute
     * 
     * @return string
     */
    public function getSmsTextAttribute(){
        return $this->attributes['SmsText'] ?: null;
    }
 
    /**
     * Set description attribute
     *
     * @param string $description
     * @return void
     */
    public function setSmsTextAttribute($smsText){
        $this->attributes['SmsText'] = $smsText;
    }
   
    /**
     * Busy mid attribute
     * 
     * @return int
     */
    public function getBusyMidAttribute(){
        return (int) $this->attributes['BusyMID'] ?: null;
    }
 
    /**
     * Set busy mid attribute
     *
     * @param int $busyMid
     * @return void
     */
    public function setBusyMidAttribute($busyMid){
        $this->attributes['BusyMID'] = $busyMid;
    }
   
    /**
     * Busy recording type attribute
     * 
     * @return bool
     */
    public function getBusyRecordingTypeAttribute(){
        return (bool) $this->attributes['BusyRecordingType'] ?: false;
    }
 
    /**
     * Set busy recording type attribute
     *
     * @param bool $busyRecordingType
     * @return void
     */
    public function setBusyRecordingTypeAttribute($busyRecordingType){
        $this->attributes['BusyRecordingType'] = (bool) $busyRecordingType;
    }
   
    /**
     * Queue member list attribute
     * 
     * @return string
     */
    public function getQueueMemberListAttribute(){
        return QueueMember::where([
            'CF_ID' => $this->CF_ID,
            'MID' => $this->MID
        ])->get();
    }
 
    /**
     * Set description attribute
     *
     * @param array $members
     * @return void
     */
    public function setQueueMemberListAttribute($members){

        // TODO: We need CF_ID to create new Members.
        // We should consider changing how this works when we start using the module endpoints

        // Generate array of IDs
        $memberIds = [];
        foreach($members as $member){

            // Frontend has to add queue_member_id and set it to to null for this to work
            $memberIds[] = $member['queue_member_id'];
        }

        // Removed members
        $oldMembers = $this->queue_member_list->filter(function($member) use($memberIds){
            return !in_array($member->queueMemberId, $memberIds);
        });
        foreach($oldMembers as $oldMember){
            QueueMember::where('QM_ID', $oldMember->queueMemberId)->delete();
        }

        // New or updated members
        foreach($members as $member){
            $m = QueueMember::where('QM_ID', $member['queue_member_id'])->first();
            if(!$m instanceof QueueMember){
                $m = new QueueMember;
            }

            $m->fill($member);

            if($m->queueMemberId){
                QueueMember::where('QM_ID', $m->queueMemberId)->update($m->attributes);
            }
            else{
                $m->save();
            }
        }
    }
   
    /**
     * Busy recording attribute
     * 
     * @return string
     */
    public function getBusyRecordingAttribute(){
        return $this->attributes['BusyRecording'] ?: null;
    }
 
    /**
     * Set busy recording attribute
     *
     * @param string $busyRecording
     * @return void
     */
    public function setBusyRecordingAttribute($busyRecording){
        $this->attributes['BusyRecording'] = $busyRecording;
    }
   
    /**
     * Show override attribute
     * 
     * @return bool
     */
    public function getShowOverrideAttribute(){
        return (bool) $this->attributes['ShowOverride'] ?: false;
    }
 
    /**
     * Set show override attribute
     *
     * @param string $showOverride
     * @return void
     */
    public function setShowOverrideAttribute($showOverride){
        //
    }
   
    /**
     * Override number attribute
     * 
     * @return string
     */
    public function getOverrideNumberAttribute(){
        return $this->attributes['OverrideNumber'] ?: null;
    }
 
    /**
     * Set override number attribute
     *
     * @param string $overrideNumber
     * @return void
     */
    public function setOverrideNumberAttribute($overrideNumber){
        $this->attributes['OverrideNumber'] = $overrideNumber;
    }
   
    /**
     * Override active attribute
     * 
     * @return string
     */
    public function getOverrideActiveAttribute(){
        return $this->attributes['OverrideActive'] ?: null;
    }
 
    /**
     * Set override active attribute
     *
     * @param string $overrideActive
     * @return void
     */
    public function setOverrideActiveAttribute($overrideActive){
        $this->attributes['OverrideActive'] = $overrideActive;
    }
   


}
