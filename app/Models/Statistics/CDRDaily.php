<?php

namespace App\Models\Statistics;

use Illuminate\Database\Eloquent\Model;
use App\Models\Statistics\Enums\CDRDirection;

class CDRDaily extends Model
{
     /**
     * Connection name
     * 
     * @var string
     */
    protected $connection = 'stats';

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'cdr_stat_daily';

    /**
     * Primary key
     * 
     * @var string
     */
    public $primaryKey = null;

    /**
     * Hidden values
     * 
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Fillable values
     * 
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * Extra attributes
     * 
     * @var array
     */
    protected $appends = [
        'id',
        'count_charge',
        'count_call',
        'count_charge_sec',
        'count_call_sec'
    ];

    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get id attribute
     * 
     * @return object
     */
    public function getIdAttribute(){
        return (object) [
            'number' => (string) $this->attributes['number'],
            'original_number' => (string) $this->attributes['original_number'],
            'timestamp' => (string) $this->attributes['timestamp'],
            'direction' => (string) CDRDirection::hasKey($this->attributes['direction']) ? CDRDirection::getValue($this->attributes['direction']) : CDRDirection::getValue('IN')
        ];
    }

    /**
     * Get count charge attribute
     * 
     * @return int
     */
    public function getCountChargeAttribute(){
        return (int) $this->attributes['count_charge'];
    }

    /**
     * Get count call attribute
     * 
     * @return int
     */
    public function getCountCallAttribute(){
        return (int) $this->attributes['count_call'];
    }

    /**
     * Get count charge sec attribute
     * 
     * @return int
     */
    public function getCountChargeSecAttribute(){
        return (int) $this->attributes['count_charge_sec'];
    }
    
    /**
     * Get count call sec attribute
     * 
     * @return int
     */
    public function getCountCallSecAttribute(){
        return (int) $this->attributes['count_call_sec'];
    }
}
