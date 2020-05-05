<?php

namespace App\Models\Users;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'roles',
        'show_statistics',
        'show_statistics_restrictions',
        'show_dynamic_service_groups',
        'advanced_weekly_schedule',
        'hide_yearly_statistics',
        'user_manual_type',
        //'auto_logout',
        'service_id',
        'customer_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'fullname', 'password', 'rolesList', 'userManualList',
    ];

    /**
     * Append extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'roles',
        'user_manual'
    ];

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Passport username field
     * 
     * @return \App\Models\Users\User
     */
    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }

    /**
     * Set password
     * 
     * @param string $password
     * 
     * @return void
     */
    public function setPasswordAttribute($password){
        if(!$password)
            return;
            
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Get show statistics
     * 
     * @param int $showStatistics
     * 
     * @return bool
     */
    public function getShowStatisticsAttribute($showStatistics){
        return (bool) $showStatistics;
    }


    /**
     * Get show statistics restrictions
     * 
     * @param int $showStatisticsRestrictions
     * 
     * @return bool
     */
    public function getShowStatisticsRestrictionsAttribute($showStatisticsRestrictions){
        return (bool) $showStatisticsRestrictions;
    }

    /**
     * Get dynamic service groups
     * 
     * @param int $dynamicServiceGroups
     * 
     * @return bool
     */
    public function getShowDynamicServiceGroupsAttribute($dynamicServiceGroups){
        return (bool) $dynamicServiceGroups;
    }

    /**
     * Get advanced weekly schedule
     * 
     * @param int $advancedWeeklySchedule
     * 
     * @return bool
     */
    public function getAdvancedWeeklyScheduleAttribute($advancedWeeklySchedule){
        return (bool) $advancedWeeklySchedule;
    }

    /**
     * Get auto logout
     * 
     * @param int $autoLogout
     * 
     * @return bool
     */
/*     public function getAutoLogoutAttribute($autoLogout){
        return (bool) $autoLogout;
    } */

    /**
     * Get roles
     * 
     * @return array
     */
    public function getRolesAttribute(){
        $roles = [];
        foreach($this->rolesList as $role){
            if(!$role->name || !is_string($role->name) || in_array($role->name, $roles))
                continue;

            $roles[] = $role->name;
        }
        return $roles;
    }

    /**
     * Set roles attribute
     * 
     * @param array $roles
     * 
     * @return array
     */
    public function setRolesAttribute($roles){

        // First, remove old roles
        $oldRoles = $this->rolesList->filter(function($roleList) use($roles){
            return !in_array($roleList->name, $roles);
        });
        foreach($oldRoles as $role){
            $role->where('user_id', $role->user_id)->where('role_id', $role->role_id)->delete();
        }

        // Then, add new roles
        $newRoles = [];
        foreach($roles as $role){
            $newRole = new UserRole;
            $newRole->user_id = $this->id;
            $newRole->role_id = $newRole->roleId($role);   
            $newRoles[] = $newRole;
        }

        $roleList = $this->rolesList;
        $newRoles = array_filter($newRoles, function($role) use($roles){
            return !$this->rolesList->where('role_id', $role->role_id)->first();
        });

        $this->rolesList()->saveMany($newRoles);

        return $roles;
    }

    /**
     * Get current roles
     * 
     * @return array
     */
    public function rolesList(){
        return $this->hasMany(UserRole::class, 'user_id');
    }

    /**
     * Check access by roles
     * 
     * @param array $roles
     * 
     * @return bool
     */
    public function hasRole(array $roles){
        // Ensure all roles are uppercase for comparison
        $roles = array_map('strtoupper', $roles);

        // Loop through role list and check each role against the $roles array
        foreach($this->rolesList as $role){
            if(in_array(strtoupper($role->name), $roles)){
                return true;
            }
        }

        return false;
    }

    /**
     * User manual
     * 
     * @return object
     */
    public function userManualList(){
        return $this->hasOne(UserManual::class, 'id', 'user_manual_type');
    }

    /**
     * Get user manual
     * 
     * @return object
     */
    public function getUserManualAttribute(){
        $manual = $this->userManualList;
        return $manual instanceof UserManual ? $manual : null;
    }
}
