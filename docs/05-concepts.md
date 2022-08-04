# Concepts

_You only really need to read this page if you either want to extend Conventions with a [custom resolver]('04-custom-resolvers.md') or if you are otherwise interested in the plugin internals_

There are four key concepts to grasp when understanding how Conventions works:

1. Patterns
2. Pattern Types
3. Pattern Context
4. Resolvers

## Patterns

A Pattern is just a generic term for **an instance of a template fragment** that gets used in your templates. This might be a particular card type in your design system, or the markup for rendering a Matrix field.

Most of the templates in Craft builds are either Patterns themselves, or are composed of "parent" templates that compose patterns together to render a page. Conventions is all about helping you to systematise and streamline the way you structure and render those Patterns.

_Aside: We chose "pattern" because unlike "component" or "partial" it's not also a commonly used term for a **type** of Pattern too - we call those types of Pattern..._

Conventions implements Patterns via the `zaengle\conventions\models\Pattern` class.


## Pattern Types

Conventions allows you to organise your Patterns into groups, called Pattern Types, in order to better structure your templates. Each Pattern Type gets its own automagically generated Twig helper function that you will use whenever you want to render a Pattern of a given Type (rather than using Twig's `include` tag).

Pattern Types are just **named kinds of reusable template fragment** e.g. (partial, field, component, element etc, etc).

They are defined in the `patterns` array in Convention's [config file](02-advanced-config.md). Pattern definitions extend from a default config, so can be extremely succinct (often just one line), but they can also optionally be customised to provide both feedback and guarantees about what context should/will/will not be available within a Pattern. 

This can help to reduce boilerplate defensive code (`{% set opts = opts ?? {} %}`), and make your templates more readable as a result.

Conventions implements Patterns via the `zaengle\conventions\models\PatternType` class.

## Context

The context of a template refers to the variables that are available to the template when it is rendered. By default, Twig's `include` tag either gives access to the whole of the calling template's context (when `only` is not used) or allows a hash with custom named keys to be passed to the included template. By using Conventions to enforce rules around the naming of context keys passed to our Patterns, we can make our templates more consistent and easier to reason about.

See [Managing Context](03-managing-context.md) for more information

## Resolvers

A Resolver is a class that is responsible for resolving a `PatternType` + template path to a twig template so that Craft can render it. In the simplest case, a resolver might just map one-to-one to a path in the `templates/` directory but custom resolvers can use any strategy/logic they wish do much more: for example complex handling of missing templates, providing fallback generic templates when the requested one does not exist, or even falling back to loading templates from Composer packages.

Conventions ships with a `DefaultResolver` that mimics the way `include` works and should be suitable for most use-cases. If this doesn't suit your needs, you can write your own very easily by implementing the supplied interface. See [Custom Resolvers](./04-custom-resolvers.md) for more information.
