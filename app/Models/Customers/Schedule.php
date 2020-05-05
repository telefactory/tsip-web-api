<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Enums\AnswerQueuePolicy;
use App\Models\Customers\Enums\ManualState;
use App\Models\Customers\Enums\RingTonePolicy;
use App\Models\Customers\Enums\ScheduleType;

class Schedule extends Model
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
    protected $table = 'Schedule';

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
        'schedule_type',
        'manual_state',
        'schedule_definition',
        'open_mid',
        //'closed_mid',
        'start_date',
        'end_date',
        'change_date',
        'next_opening',
        'next_opening_message',
        'next_opening_auto_open',
        'next_opening_alert',
        'next_opening_alert_number',
        'alert_caller_on_open',
        'weekly_closed_list_id',
        'weekly_closed_play_message'
    ];

    /**
     * Extra attributes
     *
     * @var array
     */
    protected $appends = [
        'schedule_type',
        'manual_state',
        'schedule_definition',
        'open_mid',
        'closed_mid',
        'start_date',
        'end_date',
        'change_date',
        'next_opening',
        'next_opening_message',
        'next_opening_auto_open',
        'next_opening_alert',
        'next_opening_alert_number',
        'missed_calls_since_closed',
        'use_user_defined_recording',
        'alert_caller_on_open',
        'weekly_closed_list_id',
        'weekly_closed_play_message'
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
     * Get schedule type attribute
     *
     * @return string
     */
    public function getScheduleTypeAttribute()
    {
        return ScheduleType::hasKey($this->attributes['ScheduleType']) ? ScheduleType::getValue($this->attributes['ScheduleType']) : ScheduleType::getValue("MANUAL");
    }

    /**
     * Set schedule type attribute
     *
     * @param string $scheduleType
     * @return void
     */
    public function setScheduleTypeAttribute($scheduleType)
    {
        if (ScheduleType::hasKey($scheduleType)) {
            $this->attributes['ScheduleType'] = ScheduleType::getValue($scheduleType);
        }
    }

    /**
     * Get manual stateattribute
     *
     * @return string
     */
    public function getManualStateAttribute()
    {
        return ManualState::hasKey($this->attributes['ManualState']) ? ManualState::getValue($this->attributes['ManualState']) : ManualState::getValue("OPEN");
    }

    /**
     * Set manual state attribute
     *
     * @param string $manualState
     * @return void
     */
    public function setManualStateAttribute($manualState)
    {
        $this->attributes['ManualState'] = ManualState::hasKey($manualState) ? ManualState::getValue($manualState) : ManualState::getValue("OPEN");
    }

    /**
     * Get schedule definition attribute
     *
     * @return string
     */
    public function getScheduleDefinitionAttribute()
    {
        return $this->attributes['ScheduleDefinition'] ?: null;
    }

    /**
     * Set schedule definition attribute
     *
     * @param string $scheduleDefinition
     * @return void
     */
    public function setScheduleDefinitionAttribute($scheduleDefinition)
    {
        $this->attributes['ScheduleDefinition'] = $scheduleDefinition;
    }

    /**
     * Get open MID attribute
     *
     * @return int|null
     */
    public function getOpenMidAttribute()
    {
        return $this->attributes['OpenMID'] ?: null;
    }

    /**
     * Set open MID attribute
     *
     * @param int|null $openMid
     * @return void
     */
    public function setOpenMidAttribute($openMid)
    {
        $this->attributes['OpenMID'] = $openMid;
    }

    /**
     * Get WeeklyClosedListId attribute
     *
     * @return int|null
     */
    public function getWeeklyClosedListIdAttribute()
    {
        return $this->attributes['WeeklyClosedListId'] ?: null;
    }

    /**
     * Set WeeklyClosedListId attribute
     *
     * @param int|null $weeklyClosedListId
     * @return void
     */
    public function setWeeklyClosedListIdAttribute($weeklyClosedListId)
    {
        $this->attributes['WeeklyClosedListId'] = $weeklyClosedListId;
    }

    /**
    * Get WeeklyClosedPlayMessage attribute
    *
    * @return int|null
    */
    public function getWeeklyClosedPlayMessageAttribute()
    {
        return $this->attributes['WeeklyClosedPlayMessage'] ?: false;
    }

    /**
     * Set WeeklyClosedPlayMessage attribute
     *
     * @param boolean|null $weeklyClosedPlayMessage
     * @return void
     */
    public function setWeeklyClosedPlayMessageAttribute($weeklyClosedPlayMessage)
    {
        $this->attributes['WeeklyClosedPlayMessage'] = (bool) $weeklyClosedPlayMessage;
    }

    /**
     * Get closed MID attribute
     *
     * @return int
     */
    public function getClosedMidAttribute()
    {
        return $this->attributes['ClosedMID'] ?: null;
    }


    /**
     * Set closed MID attribute
     *
     * @param int|null $closedMID
     * @return void
     */
    /*
    public function setClosedMidAttribute($closedMID){
        $this->attributes['ClosedMID'] = $closedMID;
    }
    */

    /**
     * Get start date attribute
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
     * Get end date attribute
     *
     * @return string
     */
    public function getEndDateAttribute()
    {
        return $this->attributes['EndDate'] ?: null;
    }

    /**
     * Set schedule type attribute
     *
     * @param string $endDate
     * @return void
     */
    public function setEndDateAttribute($endDate)
    {
        $this->attributes['EndDate'] = $endDate;
    }

    /**
     * Get change date attribute
     *
     * @return string
     */
    public function getChangeDateAttribute()
    {
        return $this->attributes['ChangeDate'] ?: null;
    }

    /**
     * Set change date attribute
     *
     * @param string $changeDate
     * @return void
     */
    public function setChangeDateAttribute($changeDate)
    {
        $this->attributes['ChangeDate'] = $changeDate;
    }

    /**
     * Get next opening attribute
     *
     * @return string
     */
    public function getNextOpeningAttribute()
    {
        return $this->attributes['NextOpening'] ?: null;
    }

    /**
     * Set next opening attribute
     *
     * @param string $nextOpening
     * @return void
     */
    public function setNextOpeningAttribute($nextOpening)
    {
        $this->attributes['NextOpening'] = $nextOpening;
    }

    /**
     * Get next opening message attribute
     *
     * @return bool
     */
    public function getNextOpeningMessageAttribute()
    {
        return (bool) $this->attributes['NextOpeningMessage'] ?: false;
    }

    /**
     * Set next opening message attribute
     *
     * @param bool $nextOpeningMessage
     * @return void
     */
    public function setNextOpeningMessageAttribute($nextOpeningMessage)
    {
        $this->attributes['NextOpeningMessage'] = (int) ((bool) $nextOpeningMessage);
    }

    /**
     * Get next opening auto open attribute
     *
     * @return bool
     */
    public function getNextOpeningAutoOpenAttribute()
    {
        return (bool) $this->attributes['NextOpeningAutoOpen'] ?: false;
    }

    /**
     * Set next opening auto open attribute
     *
     * @param bool $nextOpeningAutoOpen
     * @return void
     */
    public function setNextOpeningAutoOpenAttribute($nextOpeningAutoOpen)
    {
        $this->attributes['NextOpeningAutoOpen'] = (int) ((bool) $nextOpeningAutoOpen);
    }

    /**
     * Get next opening alert attribute
     *
     * @return string
     */
    public function getNextOpeningAlertAttribute()
    {
        return (bool) $this->attributes['NextOpeningAlert'] ?: false;
    }

    /**
     * Set next opening alert attribute
     *
     * @param bool $nextOpeningAlert
     * @return void
     */
    public function setNextOpeningAlertAttribute($nextOpeningAlert)
    {
        $this->attributes['NextOpeningAlert'] = (int) ((bool) $nextOpeningAlert);
    }

    /**
     * Get next opening alert number attribute
     *
     * @return string
     */
    public function getNextOpeningAlertNumberAttribute()
    {
        return $this->attributes['NextOpeningAlertNumber'] ?: null;
    }

    /**
     * Set next opening alert number attribute
     *
     * @param string $nextOpeningAlertNumber
     * @return void
     */
    public function setNextOpeningAlertNumberAttribute($nextOpeningAlertNumber)
    {
        $this->attributes['NextOpeningAlertNumber'] = $nextOpeningAlertNumber;
    }

    /**
     * Get missed calls since closed attribute
     *
     * @return int
     */
    public function getMissedCallsSinceClosedAttribute()
    {
        return $this->attributes['ClosedCallCounter'] ?: 0;
    }

    /**
     * Get use user defined recording attribute
     *
     * @return bool
     */
    public function getUseUserDefinedRecordingAttribute()
    {
        return (bool) $this->attributes['ClosedRecordingType'] ?: false;
    }

    /**
     * Get alert caller on open attribute
     *
     * @return bool
     */
    public function getAlertCallerOnOpenAttribute()
    {
        return (bool) $this->attributes['AlertCallerOnOpen'] ?: null;
    }

    /**
     * Set alert caller on open attribute
     *
     * @param string $alertCallerOnOpen
     * @return void
     */
    public function setAlertCallerOnOpenAttribute($alertCallerOnOpen)
    {
        $this->attributes['AlertCallerOnOpen'] = $alertCallerOnOpen;
    }
}
