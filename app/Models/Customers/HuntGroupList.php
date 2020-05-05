<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class HuntGroupList extends Model
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
   protected $table = 'HuntGroup_List';

   /**
    * Primary key
    * 
    * @var string
    */
   public $primaryKey = 'hunt_group_list_id';

   /**
    * Fillable values
    * 
    * @var array
    */
   protected $fillable = [
        'hunt_group_list_id',
        'call_flow_id',
        'module_id',
        'hunt_group_id',
        'name',
        'members'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
        'hunt_group_list_id',
        'call_flow_id',
        'module_id',
        'hunt_group_id',
        'name',
        'members'
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
    public function getHuntGroupListIdAttribute(){
        if(!isset($this->attributes['HGL_ID'])){
            return null;
        }

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
    public function getNameAttribute(){
        return $this->attributes['ListName'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $name
     * @return void
     */
    public function setNameAttribute($name){
        $this->attributes['ListName'] = $name;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getMembersAttribute(){
        return HuntGroupListMember::where([
            'HGL_ID' => $this->HGL_ID
        ])->get();
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param array $members
     * @return void
     */
    public function setMembersAttribute($members){
        // Generate array of IDs
        $memberIds = [];
        foreach($members as $member){
            $memberIds[] = $member['hunt_group_list_member_id'];
        }

        // Removed members
        $oldMembers = $this->members->filter(function($member) use($memberIds){
            return !in_array($member->huntGroupListMemberId, $memberIds);
        });
        foreach($oldMembers as $oldMember){
            HuntGroupListMember::where('HGLM_ID', $oldMember->huntGroupListMemberId)->delete();
        }

        // New or updated members
        foreach($members as $member){
            $m = HuntGroupListMember::where('HGLM_ID', $member['hunt_group_list_member_id'])->first();
            if(!$m instanceof HuntGroupListMember){
                $m = new HuntGroupListMember;
            }

            $m->fill($member);

            if($m->huntGroupListMemberId){
                HuntGroupListMember::where('HGLM_ID', $m->huntGroupListMemberId)->update($m->attributes);
            }
            else{
                $m->save();
            }
        }
    }
}
