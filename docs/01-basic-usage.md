## Basic usage

The easiest way to get up and running with Conventions is to use the shorthand syntax for declaring Pattern Types in your `config/conventions.php` with the Default Resolver settings:


```php

use zaengle\conventions\resolvers\DefaultResolver;

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
  ],
  'defaults' => [
        'resolver' => [
            'class' => DefaultResolver::class,
            'settings' => [],
        ],
        'params' => [
            'ensure' => [],
            'require' => [],
            'reject' => [],
        ]
    ],
];
```

This will create three Pattern Types and their helpers (`partial()`, `field()` and `component()`). With the Default Resolver these helpers will map to resolving Patterns in `templates/_partials/`, `templates/_fields/` and `templates/_components/` respectively, but you can just edit the left hand side of the definition to change the helper name, and the right hand side to change the subdirectory within `templates/` to suit your needs

## Using the Pattern helper functions


```twig
{{ component('card/blog', { data: { entry: entry } }) }}
```

All functions take two arguments 

1. A required string path that identifies the Pattern (`'card/blog` in this case)
2. A Twig object (PHP associative array) representing the context to use when rendering the template `{ data: { entry: entry } }`. This may be optional, depending on the [context rules](./03-managing-context.md) rules that you have set up for this Pattern Type

Any variables you wish to use when rendering the Pattern's template must be explicitly passed, with the exception of the `craft` global. By design it is not possible to pass additional parameters to the Pattern. Instead, add keys to the context object instead.


