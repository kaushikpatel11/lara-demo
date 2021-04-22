<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReview extends FormRequest {
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
      '_review' => 'string|nullable',
      'user_review' => 'string|nullable',
      'location' => 'string|max:150',
      'rating' => 'nullable',
      'user_rating' => 'nullable',
      'band' => 'required',
      'band.id' => 'required_with:band|Integer|min:1',
      'event' => 'required',
      'event.id' => 'required_with:event|Integer|min:1',
    ];
  }
}
