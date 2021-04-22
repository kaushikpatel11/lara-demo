<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBand extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      'name' => 'required|string|max:100|min:3',
      'user_photo' => 'nullable',
      'user_photo.id' => 'required_with:user_photo|integer|min:1|exists:media_uploads,id',
      'photo' => 'nullable',
      'photo.id' => 'required_with:photo|integer|min:1|exists:media_uploads,id',
      'header_photo' => 'nullable',
      'header_photo.id' => 'required_with:header_photo|integer|min:1|exists:media_uploads,id',
      'location' => 'required|string|max:255',
      'state' => 'required',
      'state.id' => 'required_with:state|Integer|min:1',
      'size' => 'required|integer|min:1',
      'price_from' => 'required|numeric|digits_between:1,9',
      'price_to' => 'required|numeric|digits_between:1,9',
      'bio' => 'required|string',
      'genres' => 'nullable|array',
      'genres.*.id' => 'required|integer|min:1|exists:genres',
      'featured_songs' => 'nullable|array',
      'featured_songs.*.id' => 'nullable|integer|min:1|exists:featured_songs',
      'featured_songs.*.name' => 'required_with:featured_songs|string|max:150',
      'featured_songs.*.url' => 'required_with:featured_songs|string|max:255',
      'social_links' => 'nullable|array',
      'social_links.*.id' => 'nullable|integer|min:1|exists:social_links',
      'social_links.*.type' => 'required_with:social_links|string|max:150',
      'social_links.*.url' => 'required_with:social_links|string|max:255',
      'willing_to_travel' => 'required|array',
      'willing_to_travel.*.id' => 'required_with:willing_to_travel|integer|min:1|exists:states',
      'preferred_gig_types' => 'required|array',
      'preferred_gig_types.*.id' => 'required_with:preferred_gig_types|integer|min:1|exists:gigs',
      'rating' => 'nullable',
      'hospitality_and_production_rider' => 'required',
      'hospitality_and_production_rider.id' => 'required_with:hospitality_and_production_rider|integer|min:1|exists:media_uploads,id',
      'deposit' => 'nullable|integer|min:0|max:100',
      'phone_number' => 'required|string|max:15',
    ];
  }
}
