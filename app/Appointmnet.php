<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointmnet extends Model
{
    protected $guarded = [];

	public function doctor(){
		return $this->belongsTo(User::class,'user_id','id');
	}
	public function times(){
    	return $this->hasMany(Time::class);
    }

}
