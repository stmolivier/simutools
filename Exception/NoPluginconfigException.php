<?php

namespace CPASimUSante\SimutoolsBundle\Exception;


class NoPluginconfigException extends \RuntimeException
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }
}