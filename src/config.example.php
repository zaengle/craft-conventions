<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

/**
 * Conventions config.php
 *
 * This file exists only as a template for the Conventions settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'conventions.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
    /**
     * Pattern Types (Shorthand config)
     *
     * A `patterns` associative array where:
     * - Keys defines the name of the PatternType's template helper ( e.g. `{{ partial('my-partial')`)
     * - Values define the subdirectory within CRAFT_TEMPLATES_PATH to resolve this pattern type within
     *
     * Advanced / options syntax is also available if the shorthand doesn't meet your needs, see
     * vendor/zaengle/craft-conventions/docs/02-advanced-config.md
     */
    'patterns' => [
        // <PatternTypeHandle> => <TemplateSubDir>
        'partial' => '_partials',
        'field' => '_fields',
        'component' => '_components',
    ],
    /**
     * Default
     *
     * These settings apply to all PatternTypes defined above
     */
    'defaults' => [
        'params' => [
            // Named params that *will be created if omitted*  in the ctx passed to the pattern template
            'ensure' => [],
            // Named params that *must* be set in the ctx passed to the pattern template,
            // or an error is thrown (in devMode)
            'require' => [],
            // Named params that *must not* be set in the ctx passed to the pattern template,
            // or an error is thrown (in devMode)
            'reject' => [],
        ],
    ],
];
