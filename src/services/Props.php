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

use Craft;
use craft\base\Component;
use craft\base\Element;
use craft\helpers\ArrayHelper;

use zaengle\conventions\models\RelaxedModel;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.1.0
 */
class Props extends Component
{
  /**
   * Update a context container with defaul props
   */
    public function defineProps(array|RelaxedModel $container, array $props)
    {
        if ($container instanceof RelaxedModel) {
            $container->setMissingAttributes($props);
        }
    }
}
