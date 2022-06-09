<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions\services;

use Craft;
use craft\base\Component;

use zaengle\conventions\errors\InvalidPatternModelException;
use zaengle\conventions\models\Pattern as PatternModel;
use zaengle\conventions\models\PatternType;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class Pattern extends Component
{
    /**
     * Render a Pattern as a template
     * @param  PatternType $patternType
     * @param  string      $path        The subpath to this pattern
     * @param  array       $ctx         Context to render the pattern with
     * @return ?string                  Rendered output|null
     */
    public function render(PatternType $patternType, string $path, array $ctx = []): ?string
    {
        $resolver = new $patternType->resolver['class']($patternType->resolver['settings']);

        $pattern = new PatternModel();

        $pattern->template = $resolver->resolve($path);
        $pattern->type = $patternType;
        $pattern->context = $ctx;


        if ($pattern->validate()) {
            return Craft::$app->view->renderTemplate($pattern->template, $pattern->getEnsuredContext());
        } else {
            throw new InvalidPatternModelException($pattern);
        }
    }
}
