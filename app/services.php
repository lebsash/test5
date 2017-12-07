<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
     
   
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';
 	 
 	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
 	public $timestamps = true;


 	protected $fillable = ['ServiceName', 'ServiceDescription'];
            

    /**
     * Get the GetContract
     */
    public function GetContract()
    {
        return $this->hasMany('App\servoncontr', 'NumOfService','id');
    }

}
