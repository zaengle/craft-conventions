<?php
/**
 * Conventions plugin for Craft CMS 3.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions\errors;

use yii\base\Exception;

class InvaildPatternTypeConfigException extends Exception
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return "The Pattern Type config provided is not valid";
    }
}
