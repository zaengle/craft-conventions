# Managing context

All Conventions Pattern render helper functions take two arguments: a string path used to resolve the Pattern to a Twig template, and a context object:

```twig
{{ component('blog/card', { data: entry }) }}
{# _components/blog/card.twig will be rendered with a `data` variable available set to the passed entry #}
```

Every `PatternType` definition of can optionally include a set of rules for the context object that its `Pattern`s expects.

Additionally, you can set up default rules that apply to all your `PatternType`s in one go, and then override those rules as required.

## Why is it useful?

- Reduce boilerplate defensive code to check that a variable exists before using (no need for `{% set opts = opts ?? {} %}`)
- Enforce naming patterns for context variables to increase consistency and making reasoning about (and refactoring of) your Patterns easier.

## Rule types

Three rule types are available:

1. `'ensure'` will make sure context keys/variables exist, and merge/replace them with passed context that use the same names
2. `'require'` will throw a template error (in `devMode` only) if the Pattern is rendered without the named variable(s) being passed to the Pattern
3. `'reject'` is the opposite of require: it will throw a template error (in `devMode` only) if the Pattern is rendered _with_ one or more of the named variable(s) being passed to the Pattern

## How to define context rules

Rules are defined in `config/conventions.php` inside of the `params` key of either your `defaults` declaration (for global context rules) or within your `PatternType` definitions:


```php
return [
  // defaults example
  'defaults' => [
        // Ensure that the following keys exist in the context passed to the pattern template
        'params' => [
            // Named params that *will be created if omitted*  in the context passed to the pattern template
            'ensure' => [
                // data var will exist, is an empty array
                'data' => [], 
                // opts array guaranteed to exist, will always have a `theme` key, with a default value of 'light'
                'opts' => [
                    'theme' => 'light', 
                ],
            ],
            // Named params that *must* be set in the context passed to the pattern template,
            // or an error is thrown (in devMode)
            'require' => ['data'],
            // Named params that *must not* be set in the context passed to the pattern template,
            // or an error is thrown (in devMode)
            'reject' => ['entry'],
        ]
    ],
    // custom 'field' pattern type example
    'field' => [
        'params' => [
          'ensure' => [
                'opts' => [
                    'theme' => 'light', 
                ],
          ],
          // a context key named `field` *must* be passed
          'require' => ['field'],
          // a context key named `data` *must not* be passed
          'reject' => ['data'],
        ],
    ],
];

```


## Context merging

When applying any `ensure` context rules, context keys are merged where the value passed to the PatternType helper is an array or array like object.

If an instance of a class (like `Element`) is passed, the default value will instead be overwritten, so as to maintain access to the class instance's methods (not just its properties, as would be the case if it were coerced to an `array`).

