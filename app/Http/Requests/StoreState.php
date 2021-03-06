<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreState extends FormRequest {
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
      'title' => 'required|string|max:30|min:2|unique:states|not_regex:[^[0-9]*$]',
    ];
  }
}
