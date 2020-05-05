<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customers\Enums\HuntGroupStrategy;

class HuntGroup extends Model
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
   protected $table = 'HuntGroup';

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
        'hunt_group_id',
        'description',
        'active_hg_list_id',
        'active_hg_member_id',
        'ringing_timeout',
        'override_destination',
        'overflow_mid',
        'busy_mid',
        'strategy',
        'lists',
        'members'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
        'hunt_group_id',
        'description',
        'active_hg_list_id',
        'active_hg_member_id',
        'ringing_timeout',
        'override_destination',
        'overflow_mid',
        'busy_mid',
        'strategy',
        'lists',
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
     * @param int $nextMid
     * @return void
     */
    public function setDescriptionAttribute($description){
        $this->attributes['Description'] = $description;
    }
   
    /**
     * Destination number attribute
     * 
     * @return int
     */
    public function getActiveHgListIdAttribute(){
        return $this->attributes['ActiveHgListId'] ?: null;
    }
 
    /**
     * Set destination number attribute
     *
     * @param int $nextMid
     * @return void
     */
    public function setActiveHgListIdAttribute($activeHgListId){
        $this->attributes['ActiveHgListId'] = $activeHgListId;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getActiveHgMemberIdAttribute(){
        return $this->attributes['ActiveHgMemberId'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $activeHgMemberId
     * @return void
     */
    public function setActiveHgMemberIdAttribute($activeHgMemberId){
        $this->attributes['ActiveHgMemberId'] = $activeHgMemberId;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getRingingTimeoutAttribute(){
        return $this->attributes['RingingTimeout'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $ringingTimeout
     * @return void
     */
    public function setRingingTimeoutAttribute($ringingTimeout){
        $this->attributes['RingingTimeout'] = $ringingTimeout;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getOverrideDestinationAttribute(){
        return $this->attributes['OverrideDestination'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $overrideDestination
     * @return void
     */
    public function setOverrideDestinationAttribute($overrideDestination){
        $this->attributes['OverrideDestination'] = $overrideDestination;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getOverflowMidAttribute(){
        return $this->attributes['OverflowMID'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $overflowMid
     * @return void
     */
    public function setOverflowMidAttribute($overflowMid){
        $this->attributes['OverflowMID'] = $overflowMid;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getBusyMidAttribute(){
        return $this->attributes['BusyMID'] ?: null;
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $busyMid
     * @return void
     */
    public function setBusyMidAttribute($busyMid){
        $this->attributes['BusyMID'] = $busyMid;
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getStrategyAttribute(){
        return HuntGroupStrategy::hasKey($this->attributes['HuntGroupStrategy']) ? HuntGroupStrategy::getValue($this->attributes['HuntGroupStrategy']) : HuntGroupStrategy::getValue('LINEAR');
    }
 
    /**
     * Set Hunt group ID attribute
     *
     * @param int $strategy
     * @return void
     */
    public function setStrategyAttribute($strategy){
        if(HuntGroupStrategy::hasKey($strategy)){
            $this->attributes['HuntGroupStrategy'] = HuntGroupStrategy::getValue($strategy);
        }
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getListsAttribute(){
        return HuntGroupList::where([
            'CF_ID' => $this->CF_ID,
            'MID' => $this->MID
        ])->get();
    }
 
    /**
     * Set lists attribute
     *
     * @param int $nextMid
     * @return void
     */
    public function setListsAttribute($lists){
        // Generate array of IDs
        $listIds = [];
        foreach($lists as $list){
            $listIds[] = $list['hunt_group_list_id'];
        }

        // Removed lists
        $oldLists = $this->lists->filter(function($list) use($listIds){
            return !in_array($list->hunt_group_list_id, $listIds);
        });
        foreach($oldLists as $oldList){
            HuntGroupListMember::where('HGL_ID', $oldList->hunt_group_list_id)->delete();
            HuntGroupList::where('HGL_ID', $oldList->hunt_group_list_id)->delete();
        }

        // New or updated lists
        foreach($lists as $list){
            $l = HuntGroupList::where('HGL_ID', $list['hunt_group_list_id'])->first();
            if(!$l instanceof HuntGroupList){
                $l = new HuntGroupList;
            }

            $l->fill($list);

            if($l->hunt_group_list_id){
                HuntGroupList::where('HGL_ID', $l->hunt_group_list_id)->update($l->attributes);
            }
            else{
                $l->save();
            }
        }
    }
   
    /**
     * Hunt group ID attribute
     * 
     * @return int
     */
    public function getMembersAttribute(){
        return HuntGroupMember::where([
            'CF_ID' => $this->CF_ID,
            'MID' => $this->MID
        ])->get();
    }
 
    /**
     * Set members attribute
     *
     * @param array $members
     * @return void
     */
    public function setMembersAttribute($members){
        // Generate array of IDs
        $memberIds = [];
        foreach($members as $member){
            $memberIds[] = $member['hunt_group_member_id'];
        }

        // Removed members
        $oldMembers = $this->members->filter(function($member) use($memberIds){
            return !in_array($member->huntGroupMemberId, $memberIds);
        });
        foreach($oldMembers as $oldMember){
            HuntGroupListMember::where('HGM_ID', $oldMember->huntGroupMemberId)->delete();
            HuntGroupMember::where('HGM_ID', $oldMember->huntGroupMemberId)->delete();
        }

        // New or updated members
        foreach($members as $member){
            $m = HuntGroupMember::where('HGM_ID', $member['hunt_group_member_id'])->first();
            if(!$m instanceof HuntGroupMember){
                $m = new HuntGroupMember;
            }

            $m->fill($member);

            if($m->huntGroupMemberId){
                HuntGroupMember::where('HGM_ID', $m->huntGroupMemberId)->update($m->attributes);
            }
            else{
                $m->save();
            }
        }
    }
}
