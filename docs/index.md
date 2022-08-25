# Conventions Plugin for Craftcms 

**At [Zaengle](https://zaengle.com) we know from experience that strong conventions make projects more consistent, and consistent projects are easier to work with**.

Craft doesn't impose any particular structure on how you organize your templates. In some ways that freedom is great, but on larger sites things can quickly get out of hand without some organizing principles and the tools to enforce them.

Conventions aims to solve just that problem with easy, readable, opinionated replacements for `include` that work for approximately ~97.32% of real world use cases. Using Conventions allows you to write more expressive template code that is easier to reason about, and easier to reuse.

## The trouble with `{% include %}`

`{% include %}` is probably the most frequently used Twig tag in Craft site builds, but it comes with some considerable drawbacks: 

1. If not used carefully, it can make it hard to reason about scope
2. When used with common best practice (`only` / `ignore missing`) it is verbose, which makes it harder to quickly infer intent 
3. It does nothing to help you organize your templates, leaving consistency up to developer discipline

## Conventions helps you to manage scope

While `include` does provide a mechanism for isolating context (` with { foo: bar } only`) it is opt-in, and by default includes have access to the entire scope of the template that included them.

Conventions not only enforces `only` by default, but gives to a set of additional tools to [manage context](./03-managing-context.md) in your Patterns to help you reduce boilerplate and eliminate errors.

## Conventions allows you to write more compact and expressive code

Compare native Twig:
```twig
{% include '_components/card with { data: blogEntry } only %}
{% include '_components/card/#{entry.type.handle}', '_components/card/default'] ignore missing with { data: blogEntry } only  %}
```
vs Conventions:
```twig
{{ component('card', { data: blogEntry }) }}
{{ component(['card/#{entry.type.handle}', 'card/default'], { data: blogEntry }) }}
```

## Conventions helps you to organize your templates

Declaratively group like kinds of template fragment ("patterns") with like:

Config
```php
[
    'patterns' => [
        'component' => '_components',
        'partial' => '_partials',
    ],
];
```

Filesystem
```shell
├── _components
│     ├── button.twig
│     ├── card.twig
│     ├── tag.twig
└── _partials
      ├── footer.twig
      └── header.twig
```

Templates
```twig
{{ partial('footer') }}
```

## Minimal working example

### Config

Given the following minimal config:

```php
// config/conventions.php
return [
  'patterns' => [
    'component' => '_components',
    'partial' => '_partials',
  ],
];

```
Conventions will auto-register two new twig functions: `component()` and `partial()`. Using the default [resolver](./05-concepts.md#resolvers), the paths passed as the first argument to one of these functions will be resolved within the subdirectory of your projects `templates/` directory defined by the value side of the definition.

### Templating

```twig
{{ component('card/blog', { data: { entry: entry} }) }}
{# resolves to a template at `_components/card/blog.twig`  #}

{# or pass an array of paths to provide fallbacks, works just like `include([..paths]) ignore missing` #}
{{ component(['card/' ~entry.type.handle, 'card/default']) }}
```

Already your template code should be looking cleaner and more readable. But wait, there's more...
