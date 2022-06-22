<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions\errors;

use Exception;
use zaengle\conventions\models\Pattern as Pattern;

class InvalidPatternModelException extends Exception
{
    private Pattern $pattern;

    public function __construct(Pattern $pattern)
    {
        $this->pattern = $pattern;
        parent::__construct($this->getName());
    }

    public function getName(): string
    {
        return "Invalid Pattern usage - {$this->getErrorString()}";
    }

    public function getPattern(): Pattern
    {
        return $this->pattern;
    }

    protected function getErrorString(): string
    {
        $errors = $this->pattern->getErrors();

        return array_reduce(array_keys($errors), function($msg, $attrName) use ($errors) {
            return $msg . $attrName . ' attribute: ' . join(', ', $errors[$attrName]) . ' ';
        }, "");

        return implode(', ', array_values($this->pattern->getErrors()));
    }
}
