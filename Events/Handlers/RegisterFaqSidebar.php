<?php

namespace Modules\Faq\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;
use Modules\User\Contracts\Authentication;

class RegisterFaqSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('faq::faqs.title.faqs'), function (Item $item) {
                $item->icon('fa fa-question-circle');
                $item->weight(10);
                $item->authorize(
                    $this->auth->hasAccess('faq.faqs.index')
                );
                $item->item(trans('faq::faqs.title.questions'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.faq.faq.create');
                    $item->route('admin.faq.faq.index');
                    $item->authorize(
                        $this->auth->hasAccess('faq.faqs.index')
                    );
                });
                $item->item(trans('faq::categories.title.category'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(1);
                    $item->append('admin.faq.category.create');
                    $item->route('admin.faq.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('faq.categories.index')
                    );
                });
// append


            });
        });

        return $menu;
    }
}
