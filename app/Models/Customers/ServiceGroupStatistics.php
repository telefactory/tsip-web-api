<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class ServiceGroupStatistics extends Model
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
    protected $table = 'ServiceGroupStatistics';

    /**
     * Primary key
     * 
     * @var string
     */
    public $primaryKey = 'SGS_ID';

    /**
     * Hidden values
     * 
     * @var array
     */
    protected $hidden = [
        'SGS_ID', 'SG_ID', 'NR_ID'
    ];

    /**
     * Fillable values
     * 
     * @var array
     */
    protected $fillable = [
        'service_group_statistics_id',
        'service_group_id',
        'number_id'
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'service_group_statistics_id',
        'service_group_id',
        'number_id'
    ];

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get service group statistics id
     * 
     * @return int
     */
    public function getServiceGroupStatisticsIdAttribute(){
        return (int) $this->attributes['SGS_ID'];
    }

    /**
     * Set service group statistics id
     * 
     * @param int|null $serviceGroupStatisticsId
     * 
     * @return void
     */
    public function setServiceGroupStatisticsIdAttribute($serviceGroupStatisticsId){
        $this->attributes['SGS_ID'] = $serviceGroupStatisticsId;
    }

    /**
     * Get service group id attribute
     * 
     * @return int
     */
    public function getServiceGroupIdAttribute(){
        return (int) $this->attributes['SG_ID'];
    }

    /**
     * Set service group id attribute
     * 
     * @param int $serviceGroupId
     * 
     * @return void
     */
    public function setServiceGroupIdAttribute(int $serviceGroupId){
        $this->attributes['SG_ID'] = $serviceGroupId;
    }

    /**
     * Get number id attribute
     * 
     * @return int
     */
    public function getNumberIdAttribute(){
        return (int) $this->attributes['NR_ID'];
    }

    /**
     * Set number id attribute
     * 
     * @param int $numberId
     * 
     * @return void
     */
    public function setNumberIdAttribute(int $numberId){
        $this->attributes['NR_ID'] = $numberId;
    }
}
