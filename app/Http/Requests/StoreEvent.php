<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvent extends FormRequest {
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
      'title' => 'required|string|max:100',
      'date' => 'required|date_format:"Y-m-d"',
      'photo' => 'nullable',
      'photo.id' => 'required_with:photo|Integer|min:1', //|exists:photos
      'description' => 'required|string',
      'location' => 'required|string|max:255',
      'number_of_attendees' => 'required|integer',
      'start_time' => 'required',
      'desired_set_length' => 'required',
      'state' => 'required',
      'state.id' => 'required_with:state|Integer|min:1|exists:states,id',
      'event_type' => 'required',
      'event_type.id' => 'required_with:event_type|Integer|min:1|exists:gigs,id',
      'venue_description' => 'required|array',
      'venue_description.*.id' => 'required_with:venue_description|integer|min:1|exists:venues',
    ];
  }
}
