<?php
  namespace App\Mail;

  use Illuminate\Bus\Queueable;
  use Illuminate\Contracts\Queue\ShouldQueue;
  use Illuminate\Mail\Mailable;
  use Illuminate\Queue\SerializesModels;

  class Query extends Mailable {
    use Queueable, SerializesModels;

    /**
     * * The Contact data.
     * @var array
     */
    public $data;

    /**
     * * Create a new message instance.
     * @param array $data
     */
    public function __construct ($data) {
      $this->data = $data;
    }

    /**
     * * Build the message.
     * @return $this
     */
    public function build () {
      $subject = 'Consulta de una propiedad a travez del formulario web';

      return $this->view('mail.query')
        ->from($this->data['from']['email'], $this->data['from']['name'])
        ->subject($subject);
    }
  }