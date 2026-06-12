<?php

namespace App\Exceptions\Auth;

use Exception;

class BadCredentialsException extends Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message, 403);
    }
}
