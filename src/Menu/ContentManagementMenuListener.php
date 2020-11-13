<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class ContentManagementMenuListener
{
    public function buildMenu(MenuBuilderEvent $menuBuilderEvent): void
    {
        $menu = $menuBuilderEvent->getMenu();

        $cmsRootMenuItem = $menu
            ->getChild('bitbag_cms')
        ;

        $cmsRootMenuItem
            ->addChild('faq_sections', [
                'route' => 'artis_cms_plugin_admin_frequently_asked_question_section_index',
            ])
            ->setLabel('artis_cms_plugin.ui.faq_sections')
            ->setLabelAttribute('icon', 'grid layout')
        ;

        $cmsRootMenuItem
            ->addChild('map_point', [
                'route' => 'artis_cms_plugin_admin_map_point_index',
            ])
            ->setLabel('artis_cms_plugin.ui.map_points')
            ->setLabelAttribute('icon', 'map marker alternate')
        ;
    }
}
