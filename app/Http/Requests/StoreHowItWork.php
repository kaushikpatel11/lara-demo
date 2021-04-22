<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHowItWork extends FormRequest {
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
      'page_name' => 'string|max:20|nullable',
      'title' => 'string|max:30|nullable',
      'subtitle' => 'string|max:100|nullable',
      'body' => 'string|nullable',
      'role' => 'required|in:BOOKER,TALENT,AGENT',
    ];
  }
}
