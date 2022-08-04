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

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    public string $handle;
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
            ['handle', 'string'],
            ['patterns', 'array'],
            ['defaults', 'array' ],
        ];
    }

    public function expandPatternConfig(string $handle, string|array $value): array
    {
        if (self::isShorthand($value)) {
          return $this->expandShorthandConfig($handle, $value);
        }

        return $this->expandArrayConfig($handle, $value);
    }

    public function expandShorthandConfig(string $handle, string $value): array
    {
        return $this->expandArrayConfig($handle, [
            'resolver' => [
                'settings' => [ 'basePath' => $value ],
            ],
        ]);
    }

    public function expandArrayConfig(string $handle, array $config): array
    {
        return array_merge_recursive(
            [
                'handle' => $handle,
                'resolver' => [
                    'class' => DefaultResolver::class,
                ],
            ],
            $this->defaults,
            $config
        );
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
