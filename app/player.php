<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
  protected $table ='player';
  public $fillable = ['first_name','last_name', 'team_id' ];
  
      public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
