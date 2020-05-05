<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class HuntGroupListMember extends Model
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
   protected $table = 'HuntGroup_ListMember';

   /**
    * Primary key
    * 
    * @var string
    */
   public $primaryKey = 'hunt_group_list_member_id';

   /**
    * Fillable values
    * 
    * @var array
    */
   protected $fillable = [
        'hunt_group_list_member_id',
        'hunt_group_member_id',
        'hunt_group_list_id',
        'call_flow_id',
        'module_id',
        'active',
        'ring_timeout',
        'weight',
        'sequence'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
        'hunt_group_list_member_id',
        'hunt_group_member_id',
        'hunt_group_list_id',
        'call_flow_id',
        'module_id',
        'active',
        'ring_timeout',
        'weight',
        'sequence'
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
    public function getHuntGroupListMemberIdAttribute(){
        return $this->attributes['HGLM_ID'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $huntGroupListMemberId
     * @return void
     */
    public function setHuntGroupListMemberIdAttribute($huntGroupListMemberId){
        $this->attributes['HGLM_ID'] = $huntGroupListMemberId;
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
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getHuntGroupListIdAttribute(){
        return $this->attributes['HGL_ID'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $huntGroupListId
     * @return void
     */
    public function setHuntGroupListIdAttribute($huntGroupListId){
        $this->attributes['HGL_ID'] = $huntGroupListId;
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
     * Active attribute
     * 
     * @return int
     */
    public function getActiveAttribute(){
        return $this->attributes['Active'] ?: null;
    }
 
    /**
     * Set active attribute
     *
     * @param int $active
     * @return void
     */
    public function setActiveAttribute($active){
        $this->attributes['Active'] = $active;
    }
   
    /**
     * Ring Timeout attribute
     * 
     * @return int
     */
    public function getRingTimeoutAttribute(){
        return $this->attributes['RingTimeout'] ?: null;
    }
 
    /**
     * Set Ring Timeout attribute
     *
     * @param int $ringTimeout
     * @return void
     */
    public function setRingTimeoutAttribute($ringTimeout){
        $this->attributes['RingTimeout'] = $ringTimeout;
    }
   
    /**
     * Weight attribute
     * 
     * @return int
     */
    public function getWeightAttribute(){
        return $this->attributes['Weight'] ?: null;
    }
 
    /**
     * Set weight attribute
     *
     * @param int $weight
     * @return void
     */
    public function setWeightAttribute($weight){
        $this->attributes['Weight'] = $weight;
    }
   
    /**
     * Sequence attribute
     * 
     * @return int
     */
    public function getSequenceAttribute(){
        return $this->attributes['Sequence'] ?: null;
    }
 
    /**
     * Set sequence attribute
     *
     * @param int $sequence
     * @return void
     */
    public function setSequenceAttribute($sequence){
        $this->attributes['Sequence'] = $sequence;
    }
}
