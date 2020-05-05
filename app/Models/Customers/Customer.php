<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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
    protected $table = 'Customer';

    /**
     * Primary key
     * 
     * @var string
     */
    public $primaryKey = 'C_ID';

    /**
     * Fillable values
     * 
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'customer_name',
        'contact_name',
        'contact_number',
        'start_date',
        'end_date',
        'service_groups',
        'number_list'
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'customer_id',
        'customer_name',
        'contact_name',
        'contact_number',
        'start_date',
        'end_date',
        'service_groups',
        'number_list'
    ];

    /**
     * Hidden attributes
     * 
     * @var array
     */
    protected $hidden = [
        'loadedServiceGroups',
        'loadedNumberList'
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
     * Get customer id
     * 
     * @return int
     */
    public function getCustomerIdAttribute()
    {
        return $this->C_ID;
    }

    /**
     * Set customer id
     * 
     * @param int $customerId
     * 
     * @return void
     */
    public function setCustomerIdAttribute(int $customerId)
    {
        if (!$customerId) {
            return;
        }

        $this->attributes['C_ID'] = $customerId;
    }

    /**
     * Get customer name
     * 
     * @param string $customerName
     * 
     * @return string
     */
    public function getCustomerNameAttribute()
    {
        return $this->attributes['CustomerName'];
    }

    /**
     * Set customer name
     * 
     * @param string $customerName
     * 
     * @return void
     */
    public function setCustomerNameAttribute(string $customerName)
    {
        if (!$customerName) {
            return;
        }

        $this->attributes['CustomerName'] = $customerName;
    }

    /**
     * Get contact name
     * 
     * @return string
     */
    public function getContactNameAttribute()
    {
        return $this->attributes['ContactName'];
    }

    /**
     * Set contact name
     * 
     * @param string $contactName
     * 
     * @return void
     */
    public function setContactNameAttribute($contactName)
    {
        if (!$contactName) {
            return;
        }

        $this->attributes['ContactName'] = $contactName;
    }

    /**
     * Get contact number
     * 
     * @return string
     */
    public function getContactNumberAttribute()
    {
        return $this->attributes['ContactNumber'];
    }

    /**
     * Set contact number
     * 
     * @param string $contactNumber
     * 
     * @return void
     */
    public function setContactNumberAttribute($contactNumber)
    {
        if (!$contactNumber) {
            return;
        }

        $this->attributes['ContactNumber'] = $contactNumber;
    }

    /**
     * Get start date
     * 
     * @return string
     */
    public function getStartDateAttribute()
    {
        return $this->attributes['StartDate'];
    }

    /**
     * Set start date
     * 
     * @param string $startDate
     * 
     * @return void
     */
    public function setStartDateAttribute($startDate)
    {
        if (!$startDate) {
            return;
        }

        $this->attributes['StartDate'] = $startDate;
    }

    /**
     * Get end date
     * 
     * @return string
     */
    public function getEndDateAttribute()
    {
        return $this->attributes['EndDate'];
    }

    /**
     * Set end date
     * 
     * @param string $endDate
     * 
     * @return void
     */
    public function setEndDateAttribute($endDate)
    {
        if (!$endDate) {
            return;
        }

        $this->attributes['EndDate'] = $endDate;
    }

    /**
     * Service groups relation
     * 
     * @return array
     */
    public function loadedServiceGroups()
    {
        return $this->hasMany(ServiceGroup::class, 'C_ID');
    }

    /**
     * Service groups attribute
     * 
     * @return array
     */
    public function getServiceGroupsAttribute()
    {
        return $this->loadedServiceGroups;
    }

    /**
     * Set service groups attribute
     * 
     * @param array $serviceGroups
     * 
     * @return void
     */
    public function setServiceGroupsAttribute(array $serviceGroups)
    {
        foreach ($serviceGroups as $serviceGroup) {
            $sGroup = ServiceGroup::where('C_ID', $this->C_ID)->find(isset($serviceGroup['service_group_id']) ? $serviceGroup['service_group_id'] : null);
            $sGroup->fill($serviceGroup);
            $sGroup->save();
        }
    }

    /**
     * Number list relation
     * 
     * @return array
     */
    public function loadedNumberList()
    {
        return $this->hasMany(Service::class, 'C_ID');
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
        foreach ($numberLists as $numberList) {
            $nList = Service::where('C_ID', $this->C_ID)->find(isset($numberList['number_id']) ? $numberList['number_id'] : null);
            if ($nList) {
                $nList->fill($numberList);
                $nList->save();
            }
        }
    }
}
