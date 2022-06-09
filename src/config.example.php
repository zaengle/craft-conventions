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
  'patterns' => [
    /**
     * Shorthand config
     *
     * - Key name is the the key name becomes the template helper method (`{{ partial('my-partial')`)
     */
    // <PatternTypeHandle> => <TemplateSubDir>
    'partial' => '_partials',
    'field' => '_fields',
    'component' => '_components',
    /**
     * The shorthand syntax ^^^ expands to this in the options syntax:
     */
    // '<PatternTypeHandle>' => [
    //   'basePath' => '<TemplateSubDir>',
    //   'resolver' => '\\pluginnamespace\\resolvers\\DefaultResolver',
    //   // Ensure that the following keys exist in the ctx passed to the pattern template
    //   'defaultParams' => [
    //     'data' => [],
    //     'opts' => [],
    //   ],
    //   // These named params *must* be set in the ctx passed to the pattern template,
    //   // or an error is thrown (at least in devMode anyway)
    //   'requiredParams' => [],
    //   // This is where the plugin can find the Scaffolder for this PatternType
    //   'scaffold' => '\\pluginnamespace\\scaffolds\\DefaultScaffolder',
    // ],

    /**
     * Customised / options syntax
     */
    // 'partial' => [
    //   // A custom resolver could let us do things like
    //   // - resolve wireframing patterns to vendor/
    //   // - recursively resolve patterns by walking up the fs
    //   // - audit component usage for consumption elsewhere
    //   'resolver' => '\\module\\resolvers\\CustomResolver',
    //   // it also might not require a `basePath`

    //   'basePath' => '_partials',
    //   'defaultParams' => [
    //     'data' => new \yii\base\Object(),
    //     'opts' => [
    //       // opts.theme will always be set, even if no
    //       'theme' => 'light',
    //     ],
    //   ],
    //   // a `data` key **must** be present in the ctx passed to the part, or else an error thrown (`devMode` only)
    //   'requiredParams' => ['data'],
    // ],
  ],

];
