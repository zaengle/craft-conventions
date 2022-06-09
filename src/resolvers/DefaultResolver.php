<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */


namespace zaengle\conventions\resolvers;

use Craft;
use craft\base\Component;

use zaengle\conventions\Conventions;

class DefaultResolver extends Component implements ResolverInterface
{
    public ?string $initialPath;
    public ?string $basePath;

    public function __construct(array $settings): void
    {
        parent::__construct();

        $this->basePath = $settings['basePath'];
    }

    public function resolve(?string $subPath = null): ?string
    {
        $this->initialPath = $this->initialPath ?? $subPath;

        $template = $this->assemblePath($subPath);

        if (Craft::$app->view->doesTemplateExist($template)) {
            return $template;
        } elseif ($fallbackPath = $this->getFallbackPath($subPath)) {
            return $this->resolve($fallbackPath);
        }
    
        $this->handleMissing();
        return null;
    }

    protected function assemblePath(string $path): string
    {
        return rtrim($this->basePath, '/') . '/' . ltrim($path, '/');
    }

    public function getFallbackPath(string $path): ?string
    {
        $parts = explode('/', $path);

        if (count($parts) > 1) {
            return join('/', array_slice($parts, 0, -1));
        } else {
            return null;
        }
    }

    public function handleMissing(): void
    {
        Conventions::error("Missing template: {$this->initialPath}");
    }
}
