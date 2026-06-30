<?php

namespace App\Exceptions;

use Exception;

class AlreadyExistsException extends Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message, 409);
    }
}
