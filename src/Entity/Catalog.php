<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Symfony\Component\Config\Definition\Exception\InvalidTypeException;
use Doctrine\ORM\Mapping as ORM;

class Catalog implements CatalogInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /** @ORM\Column(name="menu_code", type="text", nullable=true) */
    protected ?string $menuCode;

    public function __construct()
    {
        if ($this->isRoot()) {
            $this->menuCode = self::MENU_MAIN;
        }
    }

    public function getMenuCode(): ?string
    {
        return $this->menuCode;
    }

    public function setMenuCode(string $menuCode): self
    {
        $allMenuCodes = self::getAllMenuCodes();

        if (!in_array($menuCode, $allMenuCodes)) {
            throw new InvalidTypeException('Invalid type. Possible menu codes are ' . implode(', ', $allMenuCodes));
        }

        $this->menuCode = $menuCode;

        return $this;
    }

    public static function getAllMenuCodes(): array
    {
        return [
            self::MENU_MAIN,
            self::MENU_ADDITIONAL
        ];
    }

    protected function createTranslation(): CatalogTranslation
    {
        return new CatalogTranslation();
    }
}
