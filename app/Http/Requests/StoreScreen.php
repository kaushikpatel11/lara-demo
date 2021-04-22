<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScreen extends FormRequest {
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
      'title' => 'required|string|max:30|min:3',
      'subtitle' => 'required|string|max:30|min:3',
      'text' => 'required|string|max:255|min:3',
      'photo' => 'required',
      'photo.id' => 'required_with:photo|integer|min:1|exists:media_uploads,id',
      'role' => 'required|in:BOOKER,TALENT,AGENT',

    ];
  }
}
