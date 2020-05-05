<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
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
   protected $table = 'MID_To_Table';

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
        'table_name',
        'description',
        'data'
    ];

    /**
     * Modules
     * 
     * @var array
     */
    private $modules = [
        'Announcement' => Announcement::class,
        'CustomerSpecific' => CustomerSpecific::class,
        'Email' => Email::class,
        'HuntGroup' => HuntGroup::class,
        'IVR' => IVR::class,
        'Queue' => Queue::class,
        'RouteCall' => RouteCall::class,
        'Schedule' => Schedule::class,
        'SMS' => SMS::class,
        'PrePaidCheck' => PrePaidCheck::class,
        'PrePaidUpdate' => PrePaidUpdate::class
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'id',
        'module_id',
        'table_name',
        'description',
        'data'
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
     * Get module attribute
     * 
     * @return object
     */
    public function getDataAttribute(){
        if(isset($this->modules[$this->attributes['TableName']])){
            return (object) $this->modules[$this->attributes['TableName']]::where([
                'CF_ID' => $this->CF_ID,
                'MID' => $this->MID
            ])->first();
        }

        return (object) [];
    }

    /**
     * Set data attribute
     * 
     * @param array $data
     * 
     * @return void
     */
    public function setDataAttribute(array $data){
        if(isset($this->modules[$this->attributes['TableName']])){
            $module = $this->modules[$this->attributes['TableName']]::where([
                'CF_ID' => $this->CF_ID,
                'MID' => $this->MID
            ])->first();
            $module->fill($data);

            $this->modules[$this->attributes['TableName']]::where([
                'CF_ID' => $this->CF_ID,
                'MID' => $this->MID
            ])->update($module->attributes);
        }
    }

    /**
     * Get id attribute
     * 
     * @return object
     */
    public function getIdAttribute(){
        return [
            'call_flow_id' => $this->CF_ID,
            'module_id' => $this->MID
        ];
    }

    /**
     * Get module id attribute
     * 
     * @return object
     */
    public function getModuleIdAttribute(){
        return $this->MID;
    }

    /**
     * Get table name attribute
     * 
     * @return string
     */
    public function getTableNameAttribute(){
        return $this->attributes['TableName'] ?: null;
    }

    /**
     * Set table name attribute
     * 
     * @param string|null $tableName
     * 
     * @return void
     */
    public function setTableNameAttribute($tableName){
        return;
    }

    /**
     * Get description attribute
     * 
     * @return string
     */
    public function getDescriptionAttribute(){
        return $this->attributes['Description'] ?: null;
    }
    
    /**
     * Set description attribute
     * 
     * @param string|null $description
     * 
     * @return void
     */
    public function setDescriptionAttribute($description){
        $this->attributes['Description'] = $description;
    }
}