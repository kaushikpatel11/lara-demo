<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptedPendingFullPayment extends Mailable {
  use Queueable, SerializesModels;
  public $bandRequest;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($bandRequest) {
    $this->bandRequest = $bandRequest;

  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build() {
    $bandName = $this->bandRequest->band->name;
    return $this->from(env('MAIL_SENDER'))
      ->subject("username- " . $bandName . " approved your request and full payment required")
      ->view('emails.acceptedPendingFullPayment');}
}
