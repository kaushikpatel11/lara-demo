<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Band extends Model {

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'location', 'size', 'price_from', 'price_to', 'bio', 'rating', 'deposit', 'status',
  ];
  protected $attributes = [
    'rating' => 0,
    'status' => 'PENDING_APPROVAL',
  ];
  protected $hidden = [
    'photo_id', 'header_photo_id', 'hospitality_and_production_rider_id',
  ];
  protected $casts = [
    'isFavorite' => 'boolean',
    'isFeatured' => 'boolean',
    'created_at' => 'timestamp',
    'updated_at' => 'timestamp',
  ];

  protected function castAttribute($key, $value) // to change boolean null value (in case of it is not marked as favorite) to false.
  {
    if ($key === "isFavorite" || $key === "isFeatured") {
      if (is_null($value) || $value == 0) {
        return false;
      } else {
        return true;
      }
    } else {
      return $value;
    }
  }
  /**
   * Get band photo.
   */
  public function photo() {
    return $this->belongsTo('App\MediaUpload');
  }

  /**
   * Get band header photo.
   */
  public function headerPhoto() {
    return $this->belongsTo('App\MediaUpload');
  }

  /**
   * Get the state where the band is willing to travel to.
   */
  public function willingToTravel() {
    return $this->belongsToMany('App\State');
  }

  /**
   * Get band genres.
   */
  public function genres() {
    return $this->belongsToMany('App\Genre', 'band_genre');
  }

  /**
   * Get the state where the band is willing to travel to.
   */
  public function preferredGigTypes() {
    return $this->belongsToMany('App\Gig');
  }

  /**
   * Get the social links for the band.
   */
  public function socialLinks() {
    return $this->hasMany('App\SocialLink');
  }

  /**
   * Get the band's featured songs.
   */
  public function featuredSongs() {
    return $this->hasMany('App\FeaturedSong');
  }

  /**
   * Get the band's user.
   */
  public function createdBy() {
    return $this->belongsTo('App\User', 'created_by');
  }

  public function productionEquipment() {
    return $this->belongsToMany('App\ProductionEquipment', 'band_production_equipment', 'band_id', 'equipment_id');
  }

  /**
   * Get band users.
   */
  public function favorite() {
    return $this->belongsToMany('App\User', 'favorite_band');
  }
  /**
   * Get band requests.
   */
  public function request() {
    return $this->hasMany('App\RequestBand');
  }

  /**
   * elasticsearch mapping
   */
  use ElasticquentTrait;

  public function hospitalityAndProductionRider() {
    return $this->belongsTo('App\MediaUpload');
  }

  public function state() {
    return $this->belongsTo('App\State');
  }

  public function reviews() {
    return $this->hasMany('App\Review');
  }

  public function agentBandStatus() {
    return $this->hasone('App\LinkAgentBand');
  }

}
