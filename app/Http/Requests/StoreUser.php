<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Password;

class StoreUser extends FormRequest {
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
      'fname' => 'required|string|max:35|min:1',
      'lname' => 'required|string|max:35|min:1',
      'username' => 'required|string|max:65',
      'role' => 'required|in:BOOKER,TALENT,AGENT,AGENT',
      'email' => 'required|email|max:100|min:5',
      'password' => ['required', 'string', 'min:8', new Password]
      ,
      // 'genres'                   => 'required_if:role,==,TALENT|array',
      // 'genres.*.id'              => 'required|integer|min:1|exists:genres',
      // 'bookerType'             => "required_if:role,==,BOOKER",
      // 'bookerType.id'          => 'required_with:bookerType|integer|min:1|exists:booker_types,id',
      // 'photo'                    => 'nullable',
      // 'photo.id'                 => 'required_with:photo|integer|min:1|exists:media_uploads,id',

    ];
  }
}
