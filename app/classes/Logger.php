<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 27.11.2017
 * Time: 1:17
 */

namespace Vulnerator;


class Logger
{
    private $className;

    /**
     * Logger constructor.
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function logError(string $errorText) {
        error_log("[$this->className] Error: {$errorText}");
    }

    public function log(string $message) {
        echo "[$this->className] $message";
    }
}