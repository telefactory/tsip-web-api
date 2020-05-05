<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class CustomerSpecific extends Model
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
   protected $table = 'CustomerSpecific';

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
        'next_mid',
        'description',
        'customer_specific_module'
   ];

   /**
    * Extra attributes
    * 
    * @var array
    */
   protected $appends = [
       'next_mid',
       'description',
       'customer_specific_module'
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
     * Next mid attribute
     * 
     * @return int
     */
    public function getNextMidAttribute(){
        return $this->attributes['NextMID'] ?: null;
    }
 
    /**
     * Set next mid attribute
     *
     * @param int $nextMid
     * @return void
     */
    public function setNextMidAttribute($nextMid){
        $this->attributes['NextMID'] = $nextMid;
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
     * @param string $description
     * @return void
     */
    public function setDescriptionAttribute($description){
        $this->attributes['Description'] = $description;
    }
   
    /**
     * Customer specific module attribute
     * 
     * @return string
     */
    public function getCustomerSpecificModuleAttribute(){
        return $this->attributes['CustomerSpecificModule'] ?: null;
    }
 
    /**
     * Set customer specific module attribute
     *
     * @param string $customerSpecificModule
     * @return void
     */
    public function setCustomerSpecificModuleAttribute($customerSpecificModule){
        $this->attributes['CustomerSpecificModule'] = $customerSpecificModule;
    }
}
