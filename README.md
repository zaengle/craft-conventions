# Conventions plugin for Craft CMS 4.x

[![Latest Stable Version](http://poser.pugx.org/zaengle/craft-conventions/v)](https://packagist.org/packages/zaengle/craft-conventions) [![Total Downloads](http://poser.pugx.org/zaengle/craft-conventions/downloads)](https://packagist.org/packages/zaengle/craft-conventions) [![Latest Unstable Version](http://poser.pugx.org/zaengle/craft-conventions/v/unstable)](https://packagist.org/packages/zaengle/craft-conventions) [![License](http://poser.pugx.org/zaengle/craft-conventions/license)](https://packagist.org/packages/zaengle/craft-conventions)

The Conventions plugin helps you maintain a consistent template structure both within and across your Craft CMS projects, by making it easy to define and use twig helper functions that act as improved replacements for Twig's native `{% include %}` tag. These functions are designed to help you write cleaner, more consistent templates with less boilerplate.

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

[Read the documentation](https://craft-conventions.zaengle.com/)


## Conventions Roadmap

- [ ] Tests!
- [ ] Add generators for scaffolding new patterns
- [ ] Styleguide generator intergration 🧐

Brought to you by [Zaengle Corp](https://zaengle.com/)
