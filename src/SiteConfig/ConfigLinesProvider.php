<?php

namespace Graby\SiteConfig;

interface ConfigLinesProvider
{
    public function supportsHost(string $host): bool;

    public function getLinesForHost(string $host): array;

    public function reset(): void;
}
