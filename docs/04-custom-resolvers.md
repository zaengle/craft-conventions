# Custom resolvers

If the bundled Pattern resolvers don't fit your workflow, you can straightforwardly write your own.

Custom resolvers might be used for:

- resolve wireframing patterns to `vendor/`
- recursively resolving patterns by walking up the filesystem
- auditing component usage for consumption elsewhere

## Writing a resolver

Custom resolvers must implement `zaengle\conventions\resolvers\ResolverInterface`. You also can optionally extend `zaengle\conventions\resolvers\DefaultResolver`.

Resolvers can optionally receive a `settings` array when constructed. You can define settings statically in a `resolver` config in your `config/conventions.php` file.

The core of the interface is `::resolve(string|array $paths): ?string`, which will receive either a string path or an array of string paths to a Pattern (forward slash separated by convention, but could be any string if you are feeling creative) and must return either a path to a Twig template in a registered Craft template root, or null if no template can be found.

Resolvers also implement `::handleMissing(string|array $paths): ?string`, which is called if/when the result of `::resolve()` can't be found as a template. This gives you a chance to run any custom logic / logging around missing templates, and can optionally return a string template path to a fallback template to render instead.

## Using a custom resolver in the plugin config file:

Resolvers can be set globally for all `PatternType`s via `defaults.resolver.class`:

```php
use mynamespace\resolvers\MyFunkyResolver;

return [
  "defaults" => [
    "resolver" => [
      "class" => MyFunkyResolver::class,
      // Settings array will be passed to MyFunkyResolver::__construct
      "settings" => [
        "slamDunk" => "theFunk",
      ],
    ],
  ],
];
```

Or use different resolvers for different PatternTypes as part of an expanded `PatternType` definition:

```php
use mynamespace\resolvers\ComponentResolver;
use mynamespace\resolvers\WidgetResolver;

return [
  "patterns" => [
    "component" => [
      "resolver" => [
        "class" => ComponentResolver::class,
        "settings" => [
          "basePath" => "_components",
        ],
      ],
    ],
    "widget" => [
      "resolver" => [
        "class" => WidgetResolver::class,
        "settings" => [
          "foo" => true,
        ],
      ],
    ],
  ],
];
```

Or use a combination of defaults + custom config:

```php
use mynamespace\resolvers\MyFunkyResolver;
use mynamespace\resolvers\ComponentResolver;
return [
  "patterns" => [
    // widgets() will use MyFunkyResolver
    "widget" => "_widgets",
    // component() uses a custom resolver
    "component" => [
      "resolver" => [
        "class" => ComponentResolver::class,
      ],
    ],
  ],
  "defaults" => [
    "resolver" => [
      "class" => MyFunkyResolver::class,
      "settings" => [
        "slamDunk" => "theFunk",
      ],
    ],
  ],
];
```

**Note:** If you wish to render a template from a non-standard source (like a composer package) you will need to register a [custom template root with Craft](https://craftcms.com/docs/4.x/extend/template-roots.html) in order for things to work.

## Context merging

When applying any `ensure` context rules, context keys are merged where the value passed to the Pattern Type helper is an array or array-like object. If an instance of a class (like `Element`) is passed, the default value will instead be overwritten, so as to maintain access to the class instance's methods (not just its properties, as would be the case if it were coerced to an `array`).
