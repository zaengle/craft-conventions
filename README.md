# Conventions plugin for Craft CMS 4.x

The Conventions plugin helps you maintain a consistent template structure both within and across your Craft CMS projects, by making it easy to define and use twig helper functions which act as improved replacements for Twig's native `{% include %}` tag. These functions are designed to help you write cleaner, more consistent templates with less boilerplate. 

Turn this:

```twig
{% include('_components/blog/card') with { data: myData } only %}
```
Into this:

```twig

{{ component('card/blog', { data: myData }) }}
```

with just a single line definition in a config file.

## Features

- Works out-of-the-box with default options 
- Flexible config options
- Easily customisable for advanced use-cases


## How to use

[Read the documentation](./docs/index.md)


## Conventions Roadmap

- [ ] Release it (Packagist + Craft plugin store)
- [ ] Add generators for scaffolding new patterns
- [ ] Context default helpers (e.g.
- [ ] Better tests

Brought to you by [Zaengle Corp](https://zaengle.com/)
