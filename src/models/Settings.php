<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions\models;

use craft\base\Model;

use zaengle\conventions\resolvers\DefaultResolver;
use zaengle\conventions\scaffold\DefaultScaffolder;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    public array $patterns;
    public \Closure $expander;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
      ['patterns', 'array'],
      ['expander', \Closure::class ],
    ];
    }

    public function expandPatternConfig(string $handle, string $value): array
    {
        if (isset($this->expander) && is_callable($this->expander)) {
            return call_user_func($this->expander, $handle, $value);
        } else {
            return self::defaultPatternTypeExpander($handle, $value);
        }
    }

    public static function defaultPatternTypeExpander(string $handle, string $value): array
    {
        return [
      'resolver' => [
        'class' => DefaultResolver::class,
        'settings' => [ 'basePath' => $value ],
      ],
      // Ensure that the following keys exist in the ctx passed to the pattern template
      'params' => [
        // Named params that *will be created if omitted*  in the ctx passed to the pattern template
        'ensure' => [
          'data' => [],
          'opts' => [],
        ],
        // Named params that *must* be set in the ctx passed to the pattern template,
        // or an error is thrown (in devMode)
        'require' => ['opts'],
        // Named params that *must not* be set in the ctx passed to the pattern template,
        // or an error is thrown (in devMode)
        'reject' => [],
      ],
      
      // This is where the plugin can find the Scaffolder for this PatternType
      'scaffold' => DefaultScaffolder::class,
    ];
    }
}
