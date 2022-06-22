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

class ZaengleResolver extends Component implements ResolverInterface
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
        foreach($this->assemblePaths($path) as $template) {
            if (Craft::$app->view->doesTemplateExist($template)) {
                return $template;
            }
        }
        // $this->handleMissing($path, $exception);
    }

    /**
     * @inheritDoc
     */
    public function handleMissing(string $resolvedPath, Exception $exception): void
    {
        Conventions::error("Missing template: $this->initialPath");
    }

    protected function assemblePaths(string $path): array
    {
        $baseArray = [];

        $segments = explode('/', trim($path, '/'));

        $templateName = end($segments);

        foreach($segments as $segment)
        {
            array_pop($segments);

            $baseArray[] = rtrim($this->basePath, '/') . '/' . implode('/', $segments) . '/' .  $templateName;
        }

        $baseArray[] = rtrim($this->basePath, '/') . '/_missing';

        return $baseArray;
    }
}
