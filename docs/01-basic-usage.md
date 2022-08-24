# Basic usage

The easiest way to get up and running with Conventions is to use the shorthand syntax:


```php
// config/conventions.php
return [
    'patterns' => [
        'partial' => '_partials',
        'field' => '_fields',
        'component' => '_components',
    ],
    'defaults' => [
          'params' => [
              'ensure' => [],
              'require' => [],
              'reject' => [],
          ]
   ],
];
```

This will create three [`PatternType`s](./05-concepts.md#pattern-types) and their helpers (`partial()`, `field()` and `component()`). 

Using the default  [`Resolver`](./05-concepts.md#resolvers), these helpers will map to resolving partial templates (we call them [`Patterns`](./05-concepts.md#patterns)) in `templates/_partials/`, `templates/_fields/` and `templates/_components/` respectively, but you can change that to suit your needs by just editing the key name to change the helper name, and the value to change the subdirectory within `templates/` .

## Using the Pattern helper functions

`helperMethod($path, $context)`

All template helper functions take two arguments:

1. `path`: A required string path that identifies the Pattern (`'card/blog` in this case)
2. `context` A Twig object representing the context to use when rendering the template `{ data: { entry: entry } }`. This may be optional, depending on the [context rules](./03-managing-context.md) rules that you have set up for this Pattern Type

```twig
{{ component('card/blog', { data: { entry: entry } }) }}
```

Any variables  you wish to use when rendering the Pattern's template must be explicitly passed, with the exception of the `craft` global. By design it is not possible to pass additional parameters to the Pattern. Instead, add keys to the context object instead.


## The fallback template

By default, if Conventions can't resolve the paths you provided to a template, it will look for a special template at `templates/missing.twig` to render instead. This template will have access to a `pattern` variable that you can use for rendered debug information. For example you might add something like this:

```twig
{% if devMode %}
  Missing template for {{ pattern.type.handle }} with paths {{ pattern.paths | join (',') }}
{% endif %}
```


If no fallback template is found, Conventions won't render anything in the case of a missing template, but will log errors to `storage/logs/conventions.log`.

### Changing the fallback template path

You can change the fallback template path for all `PatternType`s via the `defaults.resolver.settings.fallbackTemplate` settings:

```php
// config/conventions.php
return [
  ...
      'defaults' => [
          'resolver' => [
              'settings' => [
                 'fallbackTemplate' => '_special/missing',
              ],
          ],
      ],
  ... 
];
```

To use a custom fallback for a single PatternType, you can use the [advanced / expanded config syntax](./02-advanced-config.md) to override the resolver settings:

```php
// config/conventions.php
return [
    'patterns' => [
        'partial' => '_partials',
        'field' => '_fields',
        'component' => [
            'resolver' => [
                'basePath' => '_components',
                // override `fallbackTemplate` for just the component() helper / PatternType            
                'fallbackTemplate' => '_missing/component',
            ],
        ],
    ],
    'defaults' => [
        'resolver' => [
            'settings' => [
                'fallbackTemplate' => '_missing/default',
            ],
        ],
    ],
];
```
