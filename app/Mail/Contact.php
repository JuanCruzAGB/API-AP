<?php
  namespace App\Mail;

  use Illuminate\Bus\Queueable;
  use Illuminate\Contracts\Queue\ShouldQueue;
  use Illuminate\Mail\Mailable;
  use Illuminate\Queue\SerializesModels;

  class Contact extends Mailable {
    use Queueable, SerializesModels;

    /**
     * * The Contact data.
     * @var array
     */
    public $data;

    /**
     * * Create a new message instance.
     * @param array $data.
     */
    public function __construct (array $data) {
      $this->data = $data;
    }

    /**
     * * Build the message.
     * @return Contact
     */
    public function build () {
      $subject = 'Contacto a travez del formulario web';

      return $this->view('mail.contact')
        ->from($this->data['from']['email'], $this->data['from']['name'])
        ->subject($subject);
    }
  }