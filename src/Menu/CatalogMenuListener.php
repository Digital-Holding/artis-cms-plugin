<?php

namespace DH\ArtisCmsPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class CatalogMenuListener
{
    public function buildMenu(MenuBuilderEvent $menuBuilderEvent): void
    {
        $menu = $menuBuilderEvent->getMenu();

        $cmsRootMenuItem = $menu
            ->getChild('bitbag_cms')
        ;

        $cmsRootMenuItem
            ->addChild('catalog', [
                'route' => 'artis_cms_plugin_admin_catalog_index',
            ])
            ->setLabel('artis_cms_plugin.ui.catalog_sections')
            ->setLabelAttribute('icon', 'grid layout')
        ;
    }
}
