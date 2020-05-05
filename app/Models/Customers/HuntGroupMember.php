<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class HuntGroupMember extends Model
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
   protected $table = 'HuntGroup_Member';

   /**
    * Primary key
    * 
    * @var string
    */
   public $primaryKey = 'hunt_group_member_id';

   /**
    * Fillable values
    * 
    * @var array
    */
   protected $fillable = [
        'hunt_group_member_id',
        'call_flow_id',
        'module_id',
        'hunt_group_id',
        'description',
        'destination_number'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
        'hunt_group_member_id',
        'call_flow_id',
        'module_id',
        'hunt_group_id',
        'description',
        'destination_number'
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
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getHuntGroupMemberIdAttribute(){
        return $this->attributes['HGM_ID'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $huntGroupListId
     * @return void
     */
    public function setHuntGroupMemberIdAttribute($huntGroupMemberId){
        $this->attributes['HGM_ID'] = $huntGroupMemberId;
    }
   
    /**
     * Description attribute
     * 
     * @return string
     */
    public function getCallFlowIdAttribute(){
        return $this->attributes['CF_ID'] ?: null;
    }
 
    /**
     * Set description attribute
     *
     * @param int $callFlowId
     * @return void
     */
    public function setCallFlowIdAttribute($callFlowId){
        $this->attributes['CF_ID'] = $callFlowId;
    }
   
    /**
     * Destination number attribute
     * 
     * @return int
     */
    public function getModuleIdAttribute(){
        return $this->attributes['MID'] ?: null;
    }
 
    /**
     * Set destination number attribute
     *
     * @param int $moduleId
     * @return void
     */
    public function setModuleIdAttribute($moduleId){
        $this->attributes['MID'] = $moduleId;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getHuntGroupIdAttribute(){
        return $this->attributes['HG_ID'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $huntGroupId
     * @return void
     */
    public function setHuntGroupIdAttribute($huntGroupId){
        $this->attributes['HG_ID'] = $huntGroupId;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getDescriptionAttribute(){
        return $this->attributes['Description'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $name
     * @return void
     */
    public function setDescriptionAttribute($description){
        $this->attributes['Description'] = $description;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getDestinationNumberAttribute(){
        return $this->attributes['DestinationNumber'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $members
     * @return void
     */
    public function setDestinationNumberAttribute($destinationNumber){
        $this->attributes['DestinationNumber'] = $destinationNumber;
    }
}
