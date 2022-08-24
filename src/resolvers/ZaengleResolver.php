<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Legacy Zaengle Pattern resolver for older projects
 *
 * If you don't know what this is,
 * you almost certainly don't want to use it 😛
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */


namespace zaengle\conventions\resolvers;

use Craft;

class ZaengleResolver extends DefaultResolver
{
    public function resolve(string|array $paths): ?string
    {
        if (is_array($paths)) {
            $paths = $paths[0];
        }
        foreach ($this->assemblePaths($paths) as $template) {
            if (Craft::$app->view->doesTemplateExist($template)) {
                return $template;
            }
        }

        return null;
    }

    protected function assemblePaths(string $path): array
    {
        $baseArray = [];

        $segments = explode('/', trim($path, '/'));

        $basePath = trim($this->basePath, '/');

        $templateName = end($segments);

        foreach ($segments as $ignored) {
            array_pop($segments);

            $baseArray[] = implode(
                '/',
                [
                    $basePath,
                    ...$segments,
                    $templateName,
                ]
            );
        }

        $baseArray[] = $basePath . '/_missing';

        return $baseArray;
    }
}
