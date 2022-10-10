<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            ['icon' => '8415acf2-d286-4a5d-b045-7cb4db98516b/orig.jpeg', 'name' => '軟體工程師'],
            ['icon' => '7e543d78-054a-4ddb-9e65-5852dcfb73b8/orig.jpeg', 'name' => '前端工程師'],
            ['icon' => 'c4bb5181-2f3c-4c5e-8006-c8bea5a69e99/orig.jpeg', 'name' => '科技業'],
            ['icon' => 'a669b28f-25f5-4edc-ac53-d5b3eeb98b10/full.jpeg', 'name' => '傳說對決'],
            ['icon' => '17230066-f572-4d8d-b1f1-19f73fa58b11/orig.jpeg', 'name' => '英雄聯盟'],
            ['icon' => 'a7ee947c-9234-4985-af50-673a4f099326/full.jpeg', 'name' => 'APEX 英雄'],
            ['icon' => '4c8abb6f-513d-4d9c-ae20-a11f7642172a/full.jpeg', 'name' => '時事'],
            ['icon' => 'd02a84e8-1f43-49bc-8638-9252f792f3ba/full.jpeg', 'name' => '災害回報'],
            ['icon' => '0f88eaf3-8bbe-4b7d-99b2-a380d74b9571/full.jpeg', 'name' => '反詐騙'],
            ['icon' => 'c1ece9f4-ffb2-4758-aac6-4169c9ebaebb/full.jpeg', 'name' => '理財'],
            ['icon' => 'fb2eb050-73eb-4d13-a200-22fbab9a4b4d/orig.jpeg', 'name' => '股票'],
            ['icon' => '2b05f056-7995-410c-962d-ef4a13bae474/full.jpeg', 'name' => '購屋'],
        ];

        DB::table('post_categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('post_categories')->truncate();
    }
};
