<?php

namespace Database\Seeders;

use App\Models\{Offer, Problem, Solution, Tag};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sales = Problem::create(['name'=>'Sales process is slow', 'description'=>'Sales staff need a faster way to respond to leads.']);
        $brand = Problem::create(['name'=>'Brand awareness is weak', 'description'=>'Potential clients do not know the company.']);
        $crm = Solution::create(['name'=>'Customer relationship management', 'description'=>'Centralise client and lead information.']);
        $social = Solution::create(['name'=>'Social media presence', 'description'=>'Reach and engage potential clients online.']);
        $crm->problems()->attach($sales); $social->problems()->attach($brand);
        $b2b=Tag::create(['name'=>'B2B']); $scalable=Tag::create(['name'=>'Scalable']); $free=Tag::create(['name'=>'Free']);
        $hubspot=Offer::create(['name'=>'HubSpot CRM','type'=>'product','description'=>'A CRM platform for managing contacts and sales.']);
        $hubspot->solutions()->attach($crm); $hubspot->tags()->attach([$b2b->id,$scalable->id]);
        $content=Offer::create(['name'=>'Content calendar','type'=>'approach','description'=>'A simple planned schedule for social-media content.']);
        $content->solutions()->attach($social); $content->tags()->attach([$free->id]);
    }
}
