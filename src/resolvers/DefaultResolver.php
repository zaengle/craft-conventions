<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Default Pattern Resolver
 *
 * Implements a native Twig `include()` like pattern, but namespaced to a
 * pattern directory, and with a fallback
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */
namespace zaengle\conventions\resolvers;

use Craft;
use craft\base\Component;
use yii\base\Exception;

use zaengle\conventions\Conventions;

class DefaultResolver extends Component implements ResolverInterface
{
    public ?string $basePath;
    public string $fallbackTemplate = '_missing';

    public function __construct(array $settings)
    {
        parent::__construct();

        $this->basePath = $settings['basePath'];
        if ($fallbackTemplate = $settings['fallbackTemplate'] ?? false) {
            $this->fallbackTemplate = $fallbackTemplate;
        }
    }

    public function resolve(string|array $paths): ?string
    {
        if (is_string($paths)) {
           $paths = [$paths];
        }

        foreach ($paths as $path) {
            $template = $this->assemblePath($path);

            try {
                if (Craft::$app->view->doesTemplateExist($template)) {
                    return $template;
                }
            }  catch (Exception $e) {
                Conventions::error("Error resolving template: " . $path . ", " . $e->getMessage());
            }
        }
        Conventions::warning("Missing template: " . print_r($paths, true));

        return null;
    }

    /**
     * @inheritDoc
     */
    public function handleMissing(): ?string
    {
        try {
            if (Craft::$app->view->doesTemplateExist($this->fallbackTemplate)) {
                Conventions::info("Falling back to using: " . $this->fallbackTemplate);
                return $this->fallbackTemplate;
            } else {
                Conventions::error("Missing fallback template: " . $this->fallbackTemplate);
            }
        }  catch (Exception $e) {
            Conventions::error("Error resolving fallback template: " . $this->fallbackTemplate . ", " . $e->getMessage());
        }

        return null;
    }

    protected function assemblePath(string $path): string
    {
        return rtrim($this->basePath, '/') . '/' . ltrim($path, '/');
    }
}
