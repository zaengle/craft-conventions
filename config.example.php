<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

use zaengle\conventions\resolvers\DefaultResolver;
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
      //   'resolver' => [
      //     'class' => \\pluginnamespace\\resolvers\\DefaultResolver',
      //     // settings will be passed to the Resolver constructor
      //     'settings' => [
      //       'basePath' => '<TemplateSubDir>',
      //     ],
      //   ],
      //   // Ensure that the following keys exist in the ctx passed to the pattern template
      //   'params' => [
      //     'ensure' => [
      //       'data' => [],
      //       'opts' => [],
      //     ],
      //     'require' => [],
      //     'reject' => [],
      //   ],
      //   // These named params *must* be set in the ctx passed to the pattern template,
      //   // or an error is thrown (at least in devMode anyway)
      //   'requiredParamsequiredParams' => [],
      //   // This is where the plugin can find the Scaffolder for this PatternType
      //   'scaffold' => '\\pluginnamespace\\scaffolds\\DefaultScaffolder',
      // ],

      /**
       * Customised / options syntax
       */
      // 'partial' => [
      //     // A custom resolver could let us do things like
      //     // - resolve wireframing patterns to vendor/
      //     // - recursively resolve patterns by walking up the fs
      //     // - audit component usage for consumption elsewhere
      //     'resolver' => [
      //         'class' => '\\module\\resolvers\\CustomResolver',
      //         // it also might not require a `basePath`
      //         'settings' => [],
      //     ],
      //     // a `data` key **must** be present in the ctx passed to the part, or else an error thrown (`devMode` only)
      // ],
  ],
  'defaults' => [
        'resolver' => [
            'class' => DefaultResolver::class,
            'settings' => [],
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
            'require' => [],
            // Named params that *must not* be set in the ctx passed to the pattern template,
            // or an error is thrown (in devMode)
            'reject' => [],
        ]
    ],
];
