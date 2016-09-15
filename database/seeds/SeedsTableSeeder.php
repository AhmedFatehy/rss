<?php

use Illuminate\Database\Seeder;

class SeedsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('seeds')->delete();
        
        \DB::table('seeds')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_id' => 1,
                'title' => 'الوطن ',
                'slug' => 'lotn',
                'url' => 'http://www.elwatannews.com/home/rssfeeds',
                'description' => '<p><span style="font-family: monospace; line-height: normal;">الوطن&nbsp;</span><br></p>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:15:24',
                'status' => 1,
                'created_at' => '2016-09-07 11:26:11',
                'updated_at' => '2016-09-15 19:15:24',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'category_id' => 1,
                'title' => 'الدستور',
                'slug' => 'ldstor',
                'url' => 'http://www.dostor.org/rss.aspx',
                'description' => '<p>الدستور</p>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:16:51',
                'status' => 1,
                'created_at' => '2016-09-07 11:31:00',
                'updated_at' => '2016-09-15 19:16:51',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'category_id' => 1,
                'title' => 'اليوم السابع',
                'slug' => 'lyom-ls-baa',
                'url' => 'http://www.youm7.com/rss/SectionRss?SectionID=203',
                'description' => '<p>اليوم السابع</p>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:19:36',
                'status' => 1,
                'created_at' => '2016-09-07 11:48:06',
                'updated_at' => '2016-09-15 19:19:36',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'category_id' => 1,
                'title' => 'سكاي نيوز عربيه',
                'slug' => 'sk-y-nyoz-aarbyh',
                'url' => 'http://www.skynewsarabia.com/web/rss.xml',
                'description' => '<p>سكاي نيوز</p>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:25:16',
                'status' => 1,
                'created_at' => '2016-09-07 11:49:59',
                'updated_at' => '2016-09-15 19:25:16',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'category_id' => 1,
                'title' => 'عربي 21',
                'slug' => 'aarby-21',
                'url' => 'http://arabi21.com/feed',
                'description' => '<p>عربي 21</p>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:32:18',
                'status' => 1,
                'created_at' => '2016-09-07 11:53:26',
                'updated_at' => '2016-09-15 19:32:18',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'category_id' => 1,
                'title' => 'هافينغتون بوست عربي',
                'slug' => 'h-fynghton-bost-aarby',
                'url' => 'http://www.huffpostarabi.com/feeds/verticals/arabi/index.xml',
                'description' => '<h3 class="r" style="margin: 0px; padding: 0px; overflow: hidden; text-overflow: ellipsis;"><span dir="rtl" style="cursor: pointer; unicode-bidi: isolate;">هافينغتون بوست عربي</span></h3>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:34:48',
                'status' => 1,
                'created_at' => '2016-09-07 11:58:18',
                'updated_at' => '2016-09-15 19:34:48',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'category_id' => 1,
                'title' => 'ساسة بوست',
                'slug' => 's-s-bost',
                'url' => 'http://www.sasapost.com/feed/',
                'description' => '<p>ساسة</p>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:36:40',
                'status' => 1,
                'created_at' => '2016-09-07 12:06:41',
                'updated_at' => '2016-09-15 19:36:40',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'category_id' => 1,
                'title' => 'اراجيك',
                'slug' => 'r-gyk',
                'url' => 'http://www.arageek.com/feed',
                'description' => '<p>اراجيك</p>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:48:27',
                'status' => 1,
                'created_at' => '2016-09-07 12:09:42',
                'updated_at' => '2016-09-15 19:48:27',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'category_id' => 1,
                'title' => 'قل',
                'slug' => 'kl',
                'url' => 'http://qoll.net/feed',
                'description' => '<p>قل</p>',
                'reload' => 60,
                'last_reload' => '2016-09-15 19:14:04',
                'status' => 1,
                'created_at' => '2016-09-07 12:58:22',
                'updated_at' => '2016-09-07 15:41:32',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
