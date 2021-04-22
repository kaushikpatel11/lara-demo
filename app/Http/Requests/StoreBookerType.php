<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookerType extends FormRequest {
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
      'type' => 'required|string|unique:booker_types|max:100|min:2|not_regex:[^[0-9]*$]',
      'isTextable' => 'boolean',
    ];
  }
}
