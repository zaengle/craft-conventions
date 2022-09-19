<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions\services;

use craft\base\Component;
use craft\base\Element;

use zaengle\conventions\models\RelaxedModel;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.1.0
 */
class Props extends Component
{
    /**
     * Update a context container with default props
     */
    public function defineProps(array|Element|RelaxedModel $container, array $props): void
    {
        if ($container instanceof RelaxedModel) {
            $container->setMissingAttributes($props);
        }
    }
}
