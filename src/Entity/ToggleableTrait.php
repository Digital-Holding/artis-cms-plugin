<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

trait ToggleableTrait
{
    /**
     * @ORM\Column(type="boolean");
     */
    protected $enabled = true;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): void
    {
        $this->enabled = (bool) $enabled;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }
}
