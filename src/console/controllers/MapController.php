<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions\console\controllers;

use yii\console\Controller;
use yii\helpers\Console;

use zaengle\conventions\Conventions;

/**
 * Map Command
 *
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class MapController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Handle conventions/map console commands
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'something';

        echo "Welcome to the console MapController actionIndex() method\n";

        return $result;
    }

    /**
     * Handle conventions/map/do-something console commands
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'something';

        echo "Welcome to the console MapController actionDoSomething() method\n";

        return $result;
    }
}
