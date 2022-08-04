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
   *
   * @param PatternType $patternType
   * @param string|array      $paths The sub-path to this pattern, or an array of sub-paths
   * @param array       $ctx  Context to render the pattern with
   *
   * @return ?string                  Rendered output|null
   * @throws InvalidPatternModelException
   */
    public function render(PatternType $patternType, string|array $paths, array $ctx = []): ?string
    {
        $pattern = new PatternModel([
            'type' => $patternType,
            'context' => $ctx,
            'paths' => $paths,
            'resolver' => new $patternType->resolver['class']($patternType->resolver['settings']),
        ]);

        return $pattern->render();
    }
}
