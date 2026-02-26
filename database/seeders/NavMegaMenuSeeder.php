<?php

namespace Database\Seeders;

use App\Models\NavItem;
use App\Models\NavMegaGroup;
use App\Models\NavMegaItem;
use Illuminate\Database\Seeder;

class NavMegaMenuSeeder extends Seeder
{
    public function run(): void
    {
        $collections = NavItem::where('label', 'Collections')->first();
        if (!$collections) {
            $this->command->info('Collections nav item not found, skipping.');
            return;
        }

        // Clear existing groups for this nav item
        $collections->megaGroups()->delete();

        // Create groups for Collections
        $g1 = NavMegaGroup::create(['nav_item_id' => $collections->id, 'label' => 'Collection Type', 'url' => '/shop', 'sort_order' => 1]);
        $g2 = NavMegaGroup::create(['nav_item_id' => $collections->id, 'label' => 'Series', 'url' => '/shop?filter=series', 'sort_order' => 2]);
        $g3 = NavMegaGroup::create(['nav_item_id' => $collections->id, 'label' => 'Featured', 'url' => '/shop?filter=featured', 'sort_order' => 3]);
        $g4 = NavMegaGroup::create(['nav_item_id' => $collections->id, 'label' => 'New Drop', 'url' => '/shop?filter=new', 'sort_order' => 4]);
        $g5 = NavMegaGroup::create(['nav_item_id' => $collections->id, 'label' => 'Best Sellers', 'url' => '/shop?filter=bestsellers', 'sort_order' => 5]);
        $g6 = NavMegaGroup::create(['nav_item_id' => $collections->id, 'label' => 'Studio Picks', 'url' => '/shop?filter=studiopicks', 'sort_order' => 6]);

        // Add items to Collection Type group
        NavMegaItem::create(['nav_mega_group_id' => $g1->id, 'label' => 'Pennants', 'url' => '/shop?subcategory=pennants', 'sort_order' => 1]);
        NavMegaItem::create(['nav_mega_group_id' => $g1->id, 'label' => 'Banners', 'url' => '/shop?subcategory=banners', 'sort_order' => 2]);
        NavMegaItem::create(['nav_mega_group_id' => $g1->id, 'label' => 'Outdoor Flags', 'url' => '/shop?subcategory=outdoor-flags', 'sort_order' => 3]);
        NavMegaItem::create(['nav_mega_group_id' => $g1->id, 'label' => 'Pin Patches', 'url' => '/shop?subcategory=pin-patches', 'sort_order' => 4]);
        NavMegaItem::create(['nav_mega_group_id' => $g1->id, 'label' => 'Signs', 'url' => '/shop?subcategory=signs', 'sort_order' => 5]);

        $this->command->info('Seeded Collections mega menu!');
    }
}
