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

use yii\base\Exception;

class InvalidContextArgumentException extends Exception
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return "Context argument must be an associative array";
    }
}
