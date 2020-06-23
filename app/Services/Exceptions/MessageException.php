<?php


namespace App\Services\Exceptions;

use Throwable;

class MessageException extends \Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct("Error sending message", 0, $previous);
    }
}
