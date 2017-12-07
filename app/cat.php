<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cats';
 	 
 	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
 	public $timestamps = true;

 	
 	protected $fillable = ['idOfClient', 'idOfClient' ];


     /**
     * Get the Clients
     */
    public function Clients()
    {
        return $this->hasOne('App\Clients','id','idOfClient');
    }


     /**
     * Get the ClientsFL
     */
    public function ClientsFL()
    {
        return $this->hasOne('App\ClientsFL', 'id','idOfClientFL');
    }

    public function test(){
        return 'Ok';
    }




	 /**
     * Get ContractNumber
     */
    public function ContractNumber() {
    	 
    	return $this->hasMany('App\controncat', 'idcats','id');
    }

	/**
     * Get Contracts
     */
    public function Contracts()
    {
    	$out = array();
    	if ($this->idOfClient) { 
		$MAIN = $this->ContractNumber;
        
    	  foreach ($MAIN as $contrnumber) {
    	    		  			var_dump(json_encode($contrnumber->GetContract));
                                $out[] = $contrnumber->GetContractNoPAID;
    	    		  		}  		  		
    		
    		return $out;    		
    	}



    }    
}
