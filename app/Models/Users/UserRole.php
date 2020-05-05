<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'user_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'role_id',
    ];
    
    /**
     * Append extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'name'
    ];

    /**
     * Primary key
     * 
     */
    protected $primaryKey = 'user_id';

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Roles stringified
     * 
     * @var array
     */
    protected $roles = [
        1 => 'CUSTOMER',
        2 => 'ADMIN',
        3 => 'SUPERADMIN',
        4 => 'AGENT',
        99 => 'USER'
    ];

    /**
     * User this role belongs to
     * 
     * @return App\User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Stringified name of role
     * 
     * @return string
     */
    public function getNameAttribute(){
        if($this->role_id == 99 || !isset($this->roles[$this->role_id]))
            return null;

        return $this->roles[$this->role_id];
    }

    /**
     * Get role id
     * 
     * @param string
     * 
     * @return int
     */
    public function roleId(string $role){
        return (int) array_search($role, $this->roles);
    }
}
