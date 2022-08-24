# Using the expanded config syntax

Conventions works "out of the box" for most users via the shorthand config but is also completely configurable  / customisable to your project's needs.

## The expanded `PatternType` syntax

When using the default shorthand config, the `patterns` array is expanded like this:

```php
// config/conventions.php
return [
    'patterns' => [
        // this shorthand
        'component' => '_components',
        // gets expanded to
        'component' => [
            'resolver' =>[
                'basePath' => '<TemplateSubDir>',
                'class' => '\\zaengle\conventions\\resolvers\\DefaultResolver',
            ],
            // these come from `defaults` below if set
            'params' => [
                'ensure' => [],
                'require' => [],
                'reject' => [],
           ],
        ],
    ],
    'defaults' => [],
];
```

By using the expanded syntax directly you can do things like:

1. Use different resolver settings for different PatternTypes
2. Configure a PatternType to [`ensure` / `require` / `reject` context](./03-managing-context.md) 
3. Use a [custom Resolver](./04-custom-resolvers.md)

1. Override resolver settings

```php
// config/conventions.php
return [
    'patterns' => [
        // component() will resolve in templates/_components/
        'component' => '_components',
        // field() helper should resolve in a special directory:
        'field' => [
            'resolver' => [
                // will use DefaultResolver class 
                'settings' => [
                    'basePath' => '_special/fields/directory'
                ],
            ],
        ],
    ],
];
```

## 2. Configure a `PatternType` to `ensure` / `require` / `reject` particular context

```php
// config/conventions.php
return [
    'patterns' => [
        // this shorthand
        'component' => '_components',
        // gets expanded to
        'field' => [
            // resolver does not need to be explicitly set unless you wish to override the settings and/or class used 
            'params' => [
                'ensure' => ['opts'],
                'require' => ['field'],
                'reject' => ['data'],
           ],
        ],
    ],
    'defaults' => [
        'params' => [
                'ensure' => ['opts'],
                'require' => ['field'],
                'reject' => ['data'],
       ],
    ],
];
```

## 3. Use a custom `Resolver`

If you need / wish to you can further customise the plugin's behavior by writing a [custom resolver](./04-custom-resolvers.md). 
