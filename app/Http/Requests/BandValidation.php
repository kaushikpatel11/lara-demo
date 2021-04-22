<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BandValidation extends FormRequest {
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
      'event' => 'required',
      'event.id' => 'required_with:event|integer|min:1|exists:events,id',
      'band' => 'required',
      'band.id' => 'required_with:band|integer|min:1|exists:bands,id',
      'notes' => 'nullable|string',
      'talent_budget' => 'required|numeric|gte:0|lt:1000000',
      'production_budget' => 'required|numeric|gte:0|lt:1000000',
    ];

  }
}
