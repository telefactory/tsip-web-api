<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
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
    protected $table = 'ServiceGroup';

    /**
     * Primary key
     * 
     * @var string
     */
    public $primaryKey = 'SG_ID';

    /**
     * Hidden values
     * 
     * @var array
     */
    protected $hidden = [
        'SG_ID', 'C_ID', 'Description', 'loadedCallFlow', 'loadedNumberList', 'loadedStatisticsList', 'CF_ID', 'customer'
    ];

    /**
     * Fillable values
     * 
     * @var array
     */
    protected $fillable = [
        'service_group_id',
        'call_flow',
        'number_list',
        'statistics_list'
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'description',
        'service_group_id',
        'call_flow',
        'customer_id',
        'number_list',
        'statistics_list'
    ];

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Customer
     * 
     * @return \App\Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'C_ID');
    }

    /**
     * Service group id
     * 
     * @return int
     */
    public function getServiceGroupIdAttribute()
    {
        return $this->SG_ID;
    }

    /**
     * Set service group id
     * 
     * @param int $serviceGroupId
     * 
     * @return void
     */
    public function setServiceGroupIdAttribute(int $serviceGroupId)
    {
        if (!$serviceGroupId) {
            return;
        }

        $this->attributes['SG_ID'] = $serviceGroupId;
    }

    /**
     * Loaded call flow
     * 
     * @return object
     */
    public function loadedCallFlow()
    {
        return $this->hasOne(CallFlow::class, 'CF_ID');
    }

    /**
     * Call flow
     * 
     * @return object
     */
    public function getCallFlowAttribute()
    {
        return $this->loadedCallFlow;
    }

    /**
     * Set call flow
     * 
     * @param object $callFlow
     * 
     * @return void
     */
    public function setCallFlowAttribute($callFlow)
    {
        $cFlow = CallFlow::where(['CF_ID' => $callFlow['call_flow_id']])->first();
        $cFlow->fill($callFlow);
        $cFlow->save();
    }

    /**
     * Customer id
     * 
     * @return int
     */
    public function getCustomerIdAttribute()
    {
        return $this->C_ID;
    }

    /**
     * Loaded number list
     * 
     * @return array
     */
    public function loadedNumberList()
    {
        return $this->hasMany(Service::class, 'SG_ID');
    }

    /**
     * Number list attribute
     * 
     * @return array
     */
    public function getNumberListAttribute()
    {
        return $this->loadedNumberList;
    }

    /**
     * Set number list attribute
     * 
     * @param array $numberLists
     * 
     * @return void
     */
    public function setNumberListAttribute(array $numberLists)
    {
        $fullList = Service::where('C_ID', $this->C_ID)->orWhere('SG_ID', $this->SG_ID)->get();
        foreach ($fullList as $service) {
            if ($service->service_group_id == $this->SG_ID) {
                $service->service_group_id = null;
                $service->customer_id = $this->customer->customer_id;
                $service->save();
            }
        }

        foreach ($numberLists as $numberList) {
            $nList = Service::where('C_ID', $this->C_ID)->find(isset($numberList['number_id']) ? $numberList['number_id'] : null);
            if ($nList) {
                $nList->fill($numberList);
                $nList->save();
            }
        }
    }

    /**
     * Loaded statistics list
     * 
     * @return array
     */
    public function loadedStatisticsList()
    {
        return $this->hasMany(ServiceGroupStatistics::class, 'SG_ID');
    }

    /**
     * Statistics list
     * 
     * @return array
     */
    public function getStatisticsListAttribute()
    {
        return $this->loadedStatisticsList;
    }

    /**
     * Set statistics list
     * 
     * @param array $numberList
     * 
     * @return void
     */
    public function setStatisticsListAttribute(array $numberLists)
    {
        // Generate array of IDs
        $numberListIds = [];
        foreach ($numberLists as $numberList) {
            if (!isset($numberList['service_group_statistics_id'])) {
                continue;
            }

            $numberListIds[] = $numberList['service_group_statistics_id'];
        }

        // Removed statistics lists
        $oldNumberLists = $this->loadedStatisticsList->filter(function ($numberList) use ($numberListIds) {
            return !in_array($numberList->serviceGroupStatisticsId, $numberListIds);
        });
        foreach ($oldNumberLists as $oldNumberList) {
            ServiceGroupStatistics::where('SGS_ID', $oldNumberList->serviceGroupStatisticsId)->delete();
        }

        // New or updated members
        foreach ($numberLists as $numberList) {
            $l = ServiceGroupStatistics::where('SGS_ID', $numberList['service_group_statistics_id'])->first();
            if (!$l instanceof ServiceGroupStatistics) {
                $l = new ServiceGroupStatistics;
            }

            $l->fill($numberList);

            if ($l->serviceGroupStatisticsId) {
                ServiceGroupStatistics::where('SGS_ID', $l->serviceGroupStatisticsId)->update($l->attributes);
            } else {
                $l->save();
            }
        }
    }

    /**
     * Description
     * 
     * @return string
     */
    public function getDescriptionAttribute()
    {
        return $this->attributes['Description'];
    }

    /**
     * Set description
     * 
     * @param string $description
     * 
     * @return void
     */
    public function setDescriptionAttribute(string $description)
    {
        $this->attributes['Description'] = $description;
    }
}
