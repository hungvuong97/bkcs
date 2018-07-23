<?php
	namespace App;
	use Illuminate\Database\Eloquent\Model;
	/**
	  * 
	  */
	 class device extends Model
	 {
	 	protected  $table = "device";
	 	public function sysadmin(){
	 		return $this->belongsToMany('App\sysadmin','device_admin','deviceId','adminId');
	 	}
	 } 
 ?>