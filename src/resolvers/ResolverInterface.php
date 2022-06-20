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

use yii\base\Exception;

interface ResolverInterface
{
    public function __construct(array $settings);

    /**
     * Resolve a string path to a Pattern
     * @param  string $path   In normal usage this will be a directory
     *                        sub/path/to/a-template with no file extension
     * @return ?string        A valid Craft template path
     */
    public function resolve(string $path): ?string;

  /**
   * Called when a path cannot be resolved to a template path
   *
   * Intended for audit / debug purposes
   *
   * @param string    $resolvedPath
   * @param Exception $exception
   *
   * @return void
   */
    public function handleMissing(string $resolvedPath, Exception $exception): void;
}
