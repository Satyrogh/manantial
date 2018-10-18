<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simular extends Model
{  
    protected $table = 'simulador';
    protected $primaryKey = 'id';
    public $timestamps=true;
    protected $fillable =[
    	'tasa',
    	'cuotas',
    	'montoMin',
    	'montoMax',
    	'notario'
    ];
    protected $guarded=[];
}
