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

        return $this->addPatternComments($pattern);
    }

    /**
     * Conditionally wrap Pattern output in HTML comments to make debugging / dev easier.
     *
     * Only applied in devMode by default
     *
     * @param PatternModel $pattern
     *
     * @return string
     * @throws InvalidPatternModelException
     */
    protected function addPatternComments(PatternModel $pattern): string
    {
        $output = '';

        if ($pattern->type->getOutputComments()) {
            $output .= $this->wrapComment('<<< ' . mb_strtoupper($pattern->type->handle) . ' START ' . $pattern->template . ' WITH [' . join(', ', array_keys($pattern->getContext())) . '] >>>');
        }

        $output .= $pattern->render();

        if ($pattern->type->getOutputComments()) {
            $output .= $this->wrapComment('<<< ' . mb_strtoupper($pattern->type->handle) . ' END ' . $pattern->template . ' <<<');
        }

        return $output;
    }

    /**
     * Wrap a string in an HTML comment
     *
     * @param string $content
     *
     * @return string
     */
    private function wrapComment(string $content): string
    {
        return PHP_EOL . '<!-- ' . $content . ' -->' . PHP_EOL;
    }
}
