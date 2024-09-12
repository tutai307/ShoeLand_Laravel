<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmEmailChange extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $newEmail;

    public function __construct($user, $newEmail)
    {
        $this->user = $user;
        $this->newEmail = $newEmail;
    }

    public function build()
    {
        return $this->subject('Xác nhận thay đổi địa chỉ email')
                    ->view('client.emails.confirm_email_change')
                    ->with([
                        'user' => $this->user,
                        'newEmail' => $this->newEmail,
                        'verificationUrl' => route('email.verify', ['email' => $this->newEmail]) // Tạo URL xác nhận
                    ]);
    }
}

