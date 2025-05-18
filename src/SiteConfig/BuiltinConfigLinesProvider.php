<?php

namespace Graby\SiteConfig;

use GrabySiteConfig\SiteConfig\Files;

class BuiltinConfigLinesProvider implements ConfigLinesProvider
{
    /**
     * @var list<string>
     */
    private $dirs;

    /**
     * @var array<string, string>
     */
    private $configFiles;

    public function __construct($dirs = array())
    {
        $this->dirs = $dirs;

        $this->reset();
    }

    public function supportsHost(string $host): bool
    {
        return array_key_exists($host . '.txt', $this->configFiles);
    }

    public function getLinesForHost(string $host): array
    {
        if (!$this->supportsHost($host)) {
            return [];
        }

        $configLines = file($this->configFiles[$host . '.txt'], \FILE_IGNORE_NEW_LINES | \FILE_SKIP_EMPTY_LINES);

        if ($configLines === false) {
            return [];
        }

        return $configLines;
    }

    public function reset(): void
    {
        $this->configFiles = Files::getFiles($this->dirs);
    }
}
