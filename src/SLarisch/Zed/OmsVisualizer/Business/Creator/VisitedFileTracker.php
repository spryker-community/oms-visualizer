<?php

declare(strict_types=1);

namespace SLarisch\Zed\OmsVisualizer\Business\Creator;

class VisitedFileTracker
{
    /**
     * @var array<string, bool>
     */
    protected array $visited = [];

    public function hasVisited(string $processName): bool
    {
        return isset($this->visited[$processName]);
    }

    public function markAsVisited(string $filePath): void
    {
        $this->visited[$filePath] = true;
    }

    public function getVisitedCount(): int
    {
        return count($this->visited);
    }

    public function reset(): void
    {
        $this->visited = [];
    }
}
