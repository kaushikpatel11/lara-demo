<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['title', 'date', 'description', 'location', 'start_time', 'end_time', 'number_of_attendees'];
  protected $hidden = ['photo_id', 'state_id', 'event_type_id'];
  protected $appends = ['isPast'];

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ['photo'];

  protected $casts = [
    'created_at' => 'timestamp',
    'updated_at' => 'timestamp',
  ];

  protected $attributes = [
    //
  ];
/**
 * Get band photo.
 */
  public function photo() {
    return $this->belongsTo('App\MediaUpload');
  }

/**
 * Get the band's user.
 */
  public function createdBy() {
    return $this->belongsTo('App\User', 'created_by');
  }

  public function state() {
    return $this->belongsTo('App\State');
  }

  public function eventType() {
    return $this->belongsTo('App\Gig');
  }

  public function venueDescription() {
    return $this->belongsToMany('App\Venue');
  }

  public function getisPastAttribute() {
    if ($this->date < date("Y-m-d")) {
      return true;
    } else {
      return false;
    }
  }

  public function request() {
    return $this->hasMany('App\RequestBand');
  }

}
