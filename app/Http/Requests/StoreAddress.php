<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddress extends FormRequest {
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
      'street' => 'required|string|max:255|min:1',
      'city' => 'required|string|max:50|min:1',
      'number' => 'required|Integer',
      'zip' => 'required|Integer',
      'state' => 'nullable',
      'state.id' => 'required_with:state|Integer|min:1',
    ];
  }
}
