<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

interface CatalogInterface
{
    public const MENU_MAIN = 'main_menu';

    public const MENU_ADDITIONAL = 'additional_menu';

    public function getMenuCode(): ?string;

    public function setMenuCode(string $menuCode): self;

}
