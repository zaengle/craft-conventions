# Custom resolvers

If the bundled Pattern resolvers don't fit your workflow, you can straightforwardly write your own.

## Writing a resolver

Custom resolvers must implement [`ResolverInterface`](../src/resolvers/ResolverInterface.php).

The core method of the interface is `::resolve(string $path): ?string`, which will receive a path to a Pattern (forward slash separated by convention, but could be any string if you are feeling creative)  and must return either a path to a Twig template in a registered Craft template root, or null if no template can be found. 

Resolvers can also optionally receive a `settings` array when constructed. You can define setting statically when declaring that you wish to use a resolver in your `config/conventions.php` file


## Using a custom resolver in the config file: 

Resolvers can be set globally for all Pattern Types:

```php
return [
  'defaults' => [
        'resolver' => [
            'class' => MyFunkyResolver::class,
            // Settings array will be passed to MyResolver::__construct
            'settings' => [],
        ],
    ],
];
```

Or you can even use different resolvers for different Pattern Types:


```php
return [
  'patterns' => [
        'component' => [
            'resolver' => [
                'class' => ComponentResolver::class,
                'settings' => [
                    'basePath' => '_components',
                ],
            ],
        ],
        'widget' => [
            'resolver' => [
                'class' => WidgetResolver::class,
                'settings' => [
                    'foo' => true,
                ],
            ],
        ],
    ],
];
```
