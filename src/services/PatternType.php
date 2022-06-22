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

use zaengle\conventions\Conventions;
use zaengle\conventions\errors\InvalidPatternTypeConfigException;
use zaengle\conventions\models\PatternType as PatternTypeModel;
use zaengle\conventions\models\Settings;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class PatternType extends Component
{
    protected Settings $settings;
    public array $patternTypes = [];

    // Public Methods
    // =========================================================================

    public function init(): void
    {
        parent::init();

        $this->settings = Conventions::$plugin->getSettings();

        $this->patternTypes = array_reduce(
            array_keys($this->settings->patterns),
            function($carry, $key) {
                $carry[$key] = $this->expandConfig($key);

                return $carry;
            },
          []
        );
    }

    public function all(): array
    {
        return $this->patternTypes;
    }

    /**
     * Get a PatternType by its handle
     * @param  string $handle
     * @return PatternTypeModel
     */
    public function get(string $handle): PatternTypeModel
    {
        return $this->patternTypes[$handle];
    }

    /**
     * Check if a PatternType exists
     * @param  string $handle
     * @return boolean
     */
    protected function exists(string $handle): bool
    {
        return array_key_exists($handle, $this->settings->patterns);
    }

  /**
   * Expand a shorthand Pattern config to a full config
   *
   * @param string $handle
   *
   * @return PatternTypeModel
   * @throws InvalidPatternTypeConfigException
   */
    protected function expandConfig(string $handle): PatternTypeModel
    {
        $rawConfig = $this->settings->patterns[$handle];

        $config = $this->settings->expandPatternConfig($handle, $rawConfig);

        $patternType = new PatternTypeModel($config);

        if (!$patternType->validate()) {
            throw new InvalidPatternTypeConfigException("Invalid config provided for pattern: $handle");
        }

        return $patternType;
    }
}
