<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions\twigextensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use zaengle\conventions\Conventions;
use zaengle\conventions\services\Props as PropsService;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class ConventionsTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Conventions';
    }

    /**
     * @inheritdoc
     */
    public function getFilters(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            ...$this->generatePatternHelpers(),
            new TwigFunction('defineProps', [Conventions::getInstance()->props, 'defineProps']),
        ];
    }

    public function generatePatternHelpers(): array
    {
        $result = [];

        foreach (Conventions::$plugin->patternTypes->all() as $handle => $patternType) {
            $result[] = new TwigFunction(
                $handle,
                function(string|array $path, array $ctx = []) use ($patternType) {
                    return Conventions::$plugin->pattern->render($patternType, $path, $ctx);
                },
                ['is_safe' => ['html']]
            );
        }

        return $result;
    }
}
