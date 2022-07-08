<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions;

use Craft;
use craft\base\Plugin;
use craft\console\Application as ConsoleApplication;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;
use yii\log\FileTarget;
use yii\log\Logger;

use zaengle\conventions\models\Settings;
use zaengle\conventions\services\Pattern as PatternService;
use zaengle\conventions\services\PatternType as PatternTypeService;
use zaengle\conventions\services\Props as PropsService;
use zaengle\conventions\services\Scaffold as ScaffoldService;
use zaengle\conventions\twigextensions\ConventionsTwigExtension;
use zaengle\conventions\variables\ConventionsVariable;

/**
 * Class Conventions
 *
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 *
 * @property  PatternService $pattern
 * @property  PatternTypeService $patternTypes
 * @property  ScaffoldService $scaffold
 * @property  PropsService $props
 *
 * @method    Settings getSettings()
 */
class Conventions extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Conventions
     */
    public static Conventions $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public bool $hasCpSettings = false;

    /**
     * @var bool
     */
    public bool $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->registerTwigExtension(new ConventionsTwigExtension());

        if (Craft::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'zaengle\conventions\console\controllers';
        }

        $this->setComponents([
            'pattern' => PatternService::class,
            'patternTypes' => PatternTypeService::class,
            'props' => PropsService::class,
            'scaffold' => ScaffoldService::class,
        ]);

        $this->configureLogger();

        $this->bindEventHandlers();

        self::log('Conventions plugin loaded');
    }

    // Static Methods
    // =========================================================================

    public static function log(mixed $message, int $level = Logger::LEVEL_INFO): void
    {
        Craft::getLogger()->log($message, $level, 'conventions');
    }

    public static function info(mixed $message): void
    {
        self::log($message);
    }

    public static function warning(mixed $message): void
    {
        self::log($message, Logger::LEVEL_WARNING);
    }

    public static function error(mixed $message): void
    {
        self::log($message, Logger::LEVEL_ERROR);
    }

    // Protected Methods
    // =========================================================================

    protected function bindEventHandlers(): void
    {
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set($this->handle, ConventionsVariable::class);
            }
        );
    }

    protected function configureLogger(): void
    {
        Craft::getLogger()->dispatcher->targets[] = new FileTarget([
            'logFile' => Craft::getAlias('@storage/logs/') . "$this->handle.log",
            'categories' => [ $this->handle ],
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }

    /**
     * Copy example config to project's config folder
     */
    protected function afterInstall(): void
    {
        $configSource = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.example.php';
        $configTarget = Craft::$app->getConfig()->configDir . DIRECTORY_SEPARATOR . 'conventions.php';

        if (!file_exists($configTarget)) {
            copy($configSource, $configTarget);
        }
    }
}
