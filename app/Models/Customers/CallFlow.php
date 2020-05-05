<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class CallFlow extends Model
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
   protected $table = 'CallFlow';

   /**
    * Primary key
    * 
    * @var string
    */
   public $primaryKey = 'CF_ID';

    /**
     * Hidden values
     * 
     * @var array
     */
    protected $hidden = [
        'CF_ID', 'FirstMID', 'Description', 'StartDate', 'loadedModuleList', 'ChangeDate', 'EndDate'
    ];

    /**
     * Fillable values
     * 
     * @var array
     */
    protected $fillable = [
        'call_flow_id',
        'first_mid',
        'description',
        'start_date',
        'change_date',
        'end_date',
        'module_list'
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'call_flow_id',
        'first_mid',
        'description',
        'start_date',
        'change_date',
        'end_date',
        'module_list'
    ];

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Call Flow ID attribute
     * 
     * @return int
     */
    public function getCallFlowIdAttribute(){
        return $this->CF_ID ?: null;
    }

    /**
     * Set call flow id attribute
     * 
     * @param int $callFlowId
     * 
     * @return void
     */
    public function setCallFlowIdAttribute(int $callFlowId){
        if(!$callFlowId){
            return;
        }

        $this->attributes['CF_ID'] = $callFlowId;
    }

    /**
     * First MID attribute
     * 
     * @return int
     */
    public function getFirstMIDAttribute(){
        return $this->attributes['FirstMID'] ?: null;
    }

    /**
     * Set first mid attribute
     * 
     * @param int $firstMID
     * 
     * @return void
     */
    public function setFirstMIDAttribute(int $firstMID){
        if(!$firstMID){
            return;
        }

        $this->attributes['FirstMID'] = $firstMID;
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
     * @param mixed $description
     * 
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
     * Set start date
     * 
     * @param string $startDate
     * 
     * @return void
     */
    public function setStartDateAttribute($startDate){
        if(!$startDate){
            return;
        }

        $this->attributes['StartDate'] = $startDate;
    }

    /**
     * Change date attribute
     * 
     * @return string
     */
    public function getChangeDateAttribute(){
        return $this->attributes['ChangeDate'] ?: null;
    }

    /**
     * Set change date
     * 
     * @param string $changeDate
     * 
     * @return void
     */
    public function setChangeDateAttribute($changeDate){
        if(!$changeDate){
            return;
        }

        $this->attributes['ChangeDate'] = $changeDate;
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
     * Set end date
     * 
     * @param string $endDate
     * 
     * @return void
     */
    public function setEndDateAttribute($endDate){
        if(!$endDate){
            return;
        }

        $this->attributes['EndDate'] = $endDate;
    }

    /**
     * Loaded module list
     * 
     * @return array
     */
    public function loadedModuleList(){
        return $this->hasMany(Module::class, 'CF_ID', 'CF_ID');
    }

    /**
     * Module list attribute
     * 
     * @return array
     */
    public function getModuleListAttribute(){
        return $this->loadedModuleList;
    }

    /**
     * Set module list attribute
     * 
     * @param array $moduleLists
     * 
     * @return void
     */
    public function setModuleListAttribute(array $moduleLists){
        foreach($moduleLists as $moduleList){
            $module = Module::where([
                'CF_ID' => isset($moduleList['id']['call_flow_id']) ? $moduleList['id']['call_flow_id'] : null,
                'MID' => isset($moduleList['id']['module_id']) ? $moduleList['id']['module_id'] : null
            ])->first();
            $module->fill($moduleList);
            $attributes = $module->attributes;

            if(isset($attributes['CF_ID'])){
                unset($attributes['CF_ID']);
            }
            if(isset($attributes['MID'])){
                unset($attributes['MID']);
            }
            

            Module::where([
                'CF_ID' => isset($moduleList['id']['call_flow_id']) ? $moduleList['id']['call_flow_id'] : null,
                'MID' => isset($moduleList['id']['module_id']) ? $moduleList['id']['module_id'] : null
            ])->update($attributes);
        }
    }
}
