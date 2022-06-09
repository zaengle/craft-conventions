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

interface ResolverInterface
{
    public function __construct(array $settings): void;

    public function resolve(?string $path): ?string;

    public function handleMissing(): void;
}
