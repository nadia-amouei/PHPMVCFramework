<?php

namespace app\core\exception;

class NotFountException extends \Exception
{
    protected $code = 404;
    protected $message = "page not found";


}