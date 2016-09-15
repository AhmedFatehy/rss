<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'title' => 'الأخبار',
                'slug' => 'lakhb-r',
                'description' => '<p>الاخبار حصريا</p>',
                'status' => 1,
                'created_at' => '2016-09-02 22:15:00',
                'updated_at' => '2016-09-03 23:28:46',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'title' => 'السياسة',
                'slug' => 'lsy-s',
                'description' => '<p>اخبار السياسة</p>',
                'status' => 1,
                'created_at' => '2016-09-02 22:19:31',
                'updated_at' => '2016-09-02 22:50:04',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 0,
                'title' => 'الرياضة',
                'slug' => 'lry-d',
                'description' => '<p>اخبار الرياضة</p>',
                'status' => 1,
                'created_at' => '2016-09-02 22:44:47',
                'updated_at' => '2016-09-02 22:50:04',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 0,
                'title' => 'التكنولوجيا',
                'slug' => 'ltknology',
                'description' => '<p>اخر اخبار التكنولوجيا</p>',
                'status' => 1,
                'created_at' => '2016-09-02 22:49:50',
                'updated_at' => '2016-09-02 22:50:04',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 0,
                'title' => 'الفنون',
                'slug' => 'lfn',
                'description' => '<p>اخبار القن و المشاهير</p>',
                'status' => 1,
                'created_at' => '2016-09-02 22:54:18',
                'updated_at' => '2016-09-03 19:20:23',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 0,
                'title' => 'الاقتصاد',
                'slug' => 'l-kts-d',
                'description' => '<p>اخبار الاقتصاد</p>',
                'status' => 1,
                'created_at' => '2016-09-02 23:06:02',
                'updated_at' => '2016-09-02 23:06:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
