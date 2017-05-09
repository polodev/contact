<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  protected $guarded = [];
  public function contact(){
    return $this->belongsTo(Contact::class);
  }
}