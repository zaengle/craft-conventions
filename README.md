# Conventions plugin for Craft CMS 4.x

The Conventions plugin helps you maintain a consistent template structure both within and across your Craft CMS projects, by making it easy to define and use twig helper functions which act as improved replacements for Twig's native `{% include %}` tag. 

These functions have features that help you write cleaner templates with less boilerplate code devoted to setting up scope/context. For example they let you turn this:

```twig
{% include('_components/blog/card') with { data: myData } only %}
```
Into this:

```twig

{{ component('card/blog', { data: myData }) }}
```

with just a single line in a config file to define the `component` [pattern](00-concepts.md)

## Features

## Basic example

Given the following config:

```php
// config/conventions.php
return [
  'patterns' => [
    'component' => '_components',
    'partial' => '_partials',
  ],
];

```
Conventions will autoregister two new twig functions: `component()` and `partial`. When using the default [resolver](docs/04-custom-resolvers.md) paths passed as the first argument to one of these functions will be resolved within the subdirectory of your projects `templates/` directory defined by the value side of the definition:

```twig
{{ component('card/blog', { data: { entry: entry} }) }}
{# resolves to a template at `_components/card/blog.twig`  #}

```


## Why

- **Strong conventions make it projects more consistent, and consistent projects are easier to work with** Craft doesn't impose any particular structure on how you organise your templates. In some ways that freedom is great, but on larger sites things can quickly get out of hand without some organising principles and some tools to enforce them.
- **`include` makes it hard to reason about scope** While `include` does provide a mechanism for isolating context (` with { foo: bar } only`) it is opt-in, and by default includes have access to the entire scope of the template that included them. 
- While `include` does allow passing an array of paths to use when resolving a template, 

## How to use it

### Requirements

This plugin requires Craft CMS 4.0.0 & PHP 8.0+

### Installation

```bash
composer require zaengle/craft-conventions
./craft plugin/install conventions
```

### Configuring the plugin

Conventions is entirely configured via it's config file, a starter version of which will be created at `config/conventions.php` as part of the plugin install command. It ships with defaults that suit how we work at [Zaengle](https://zaengle.com/), but it is completely customisable to fit your own workflow. 

See the [docs](docs/01-basic-usage.md) for more information about how to set the plugin up for your needs.

## Conventions Roadmap

- [ ] Release it (Packagist + Craft plugin store)
- [ ] Add generators for scaffolding new patterns
- [ ] Context default helpers (e.g. 

```twig
{% contextEnsure('opts', {
  theme: 'light',
  layout: 'slim'
}) %}
```
- [ ] Better tests

Brought to you by [Zaengle Corp](https://zaengle.com/)
