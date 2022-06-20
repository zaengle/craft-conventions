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

use yii\base\Exception;
use zaengle\conventions\Conventions;

class DefaultResolver extends Component implements ResolverInterface
{
    public ?string $initialPath;
    public ?string $basePath;

    public function __construct(array $settings)
    {
        parent::__construct();

        $this->basePath = $settings['basePath'];
    }

    public function resolve(?string $path = null): ?string
    {
        $this->initialPath = $this->initialPath ?? $path;

        $template = $this->assemblePath($path);

        try {
            if (Craft::$app->view->doesTemplateExist($template)) {
                return $template;
            } elseif ($fallbackPath = $this->getFallbackPath($path)) {
                return $this->resolve($fallbackPath);
            }
        } catch (Exception $exception) {
            $this->handleMissing($path, $exception);
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function handleMissing(string $resolvedPath, Exception $exception): void
    {
        Conventions::error("Missing template: $this->initialPath");
    }
    protected function assemblePath(string $path): string
    {
        return rtrim($this->basePath, '/') . '/' . ltrim($path, '/');
    }

    protected function getFallbackPath(string $path): ?string
    {
        $parts = explode('/', $path);

        if (count($parts) > 1) {
            return join('/', array_slice($parts, 0, -1));
        } else {
            return null;
        }
    }
}
