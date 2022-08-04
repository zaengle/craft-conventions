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
    public array $defaults;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['patterns', 'array'],
            ['defaults', 'array' ],
        ];
    }

    public function expandPatternConfig(string $handle, string|array $value): array
    {
        if (self::isShorthand($value)) {
            return $this->expandShorthandConfig($value);
        }

        return $this->expandArrayConfig($value);
    }

    public function expandShorthandConfig(string $value): array
    {
        return $this->expandArrayConfig([
            'resolver' => [
                'settings' => [ 'basePath' => $value ],
            ],
        ]);
    }

    public function expandArrayConfig(array $config): array
    {
        return array_merge_recursive($this->defaults, $config);
    }

    /**
     * Determine if a Pattern config is in the shorthand form
     * @param  string|array   $patternConfig
     * @return boolean
     */
    protected static function isShorthand(string|array $patternConfig): bool
    {
        return is_string($patternConfig);
    }
}
