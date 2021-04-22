<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Validator;

class Password implements Rule {
  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct() {
    //
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value) {
    return preg_match("/^((?=.*?[A-Z])(?=.*?[a-z])(?=.*?\d)|(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[^a-zA-Z0-9])|(?=.*?[A-Z])(?=.*?\d)(?=.*?[^a-zA-Z0-9])|(?=.*?[a-z])(?=.*?\d)(?=.*?[^a-zA-Z0-9])).{8,}$/", $value);
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message() {
    return "The password format is invalid Your password must be more than 8 characters long, Password should cover at least 3 cases from the following (Password must contain Special Characters - Password must contain Numbers - Password must contain Uppercase - Password must contain Lower case.) ";
  }
}
