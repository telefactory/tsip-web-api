<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
    protected $table = 'Service';

    /**
     * Primary key
     * 
     * @var string
     */
    public $primaryKey = 'NR_ID';

    /**
     * Fillable values
     * 
     * @var array
     */
    protected $fillable = [
        'number_id',
        'customer_id',
        'service_group_id',
        'service_number',
        'description',
        'frozen_date',
        'dial_in_pin',
        'allow_dial_in_management',
        'start_date',
        'end_date'
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'number_id',
        'customer_id',
        'service_group_id',
        'service_number',
        'description',
        'frozen_date',
        'dial_in_pin',
        'allow_dial_in_management',
        'start_date',
        'end_date'
    ];

    /**
     * Hidden attributes
     * 
     * @var array
     */
    protected $hidden = [
        'NR_ID',
        'SG_ID',
        'C_ID',
        'ServiceNumber',
        'Description',
        'ServiceCategory_ID',
        'DialInPIN',
        'AllowDialInManagement',
        'EndServiceMessageId',
        'AnnounceNewNumber',
        'EnableCallMonitoring',
        'CallMonitoringEmail',
        'StartDate',
        'EndDate'
    ];

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get number id
     * 
     * @return int
     */
    public function getNumberIdAttribute(){
        return (int) $this->attributes['NR_ID'];
    }

    /**
     * Set number id
     * 
     * @param int $numberId
     * 
     * @return void
     */
    public function setNumberIdAttribute(int $numberId){
        $this->attributes['NR_ID'] = $numberId;
    }

    /**
     * Get customer id
     * 
     * @return int
     */
    public function getCustomerIdAttribute(){
        return (int) $this->attributes['C_ID'];
    }

    /**
     * Set customer id
     * 
     * @param int $customerId
     * 
     * @return void
     */
    public function setCustomerIdAttribute(int $customerId){
        $this->attributes['C_ID'] = $customerId;
    }

    /**
     * Get service group id
     * 
     * @return int|null
     */
    public function getServiceGroupIdAttribute(){
        return $this->attributes['SG_ID'];
    }

    /**
     * Set service group id
     * 
     * @param int|null $serviceGroupId
     * 
     * @return void
     */
    public function setServiceGroupIdAttribute($serviceGroupId){
        $this->attributes['SG_ID'] = $serviceGroupId;
    }

    /**
     * Get service number
     * 
     * @return string
     */
    public function getServiceNumberAttribute(){
        return (string) $this->attributes['ServiceNumber'];
    }

    /**
     * Set service number
     * 
     * @param string $serviceNumber
     * 
     * @return void
     */
    public function setServiceNumberAttribute(string $serviceNumber){
        $this->attributes['ServiceNumber'] = $serviceNumber;
    }

    /**
     * Get description
     * 
     * @return string
     */
    public function getDescriptionAttribute(){
        return $this->attributes['Description'];
    }

    /**
     * Set description
     * 
     * @param string $description
     * 
     * @return void
     */
    public function setDescriptionAttribute(string $description){
        $this->attributes['Description'] = $description;
    }
    
    /**
     * Get dial in pin
     * 
     * @return string
     */
    public function getDialInPinAttribute(){
        return (string) $this->attributes['DialInPIN'];
    }

    /**
     * Set dial in pin
     * 
     * @param string $dialInPin
     * 
     * @return void
     */
    public function setDialInPinAttribute(string $dialInPin){
        $this->attributes['DialInPIN'] = $dialInPin;
    }

    /**
     * Get allow dial in management
     * 
     * @return int
     */
    public function getAllowDialInManagementAttribute(){
        return (int) $this->attributes['AllowDialInManagement'];
    }

    /**
     * Set allow dial in management
     * 
     * @param int $allowDialInManagement
     * 
     * @return void
     */
    public function setAllowDialInManagementAttribute(int $allowDialInManagement){
        $this->attributes['AllowDialInManagement'] = $allowDialInManagement;
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
     * Get frozen date attribute
     *
     * @return string
     */
    public function getFrozenDateAttribute(){
        return $this->attributes['FrozenDate'] ?: null;
    }

    /**
     * Set frozen date attribute
     * 
     * @param string $frozenDate
     * @return void
     */
    public function setFrozenDateAttribute($frozenDate){
        $this->attributes['FrozenDate'] = $frozenDate;
    }
}
