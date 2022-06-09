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
 * Scaffold Command
 *
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class ScaffoldController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Handle conventions/scaffold console commands
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'something';

        echo "Welcome to the console ScaffoldController actionIndex() method\n";

        return $result;
    }

    /**
     * Handle conventions/scaffold/do-something console commands
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'something';

        echo "Welcome to the console ScaffoldController actionDoSomething() method\n";

        return $result;
    }
}
