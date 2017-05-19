<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
  protected $guarded = [];
  public function user(){
    return $this->belongsTo(User::class);
  }
  public function statuses(){
    return $this->hasMany(Status::class);
  }
  public function getAvatarUrlAttribute(){
    $avatar = $this->attributes['avatar'];
    return asset(Storage::url($avatar));
  }
}
