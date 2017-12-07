<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsFL extends Model
{
         /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients_f_ls';
 	 
 	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
 	public $timestamps = true;

 	
 	protected $fillable = ['name', 'surname', 'patronimic', 'bankAccount', 'livingAddress' ];



}
