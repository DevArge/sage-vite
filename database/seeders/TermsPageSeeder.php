<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermsPageSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // CHECK IF THE PAGE 'TERMS' EXIST
        $existingPage = DB::table('posts')
            ->where('post_type', 'page')
            ->where(function ($query) {
                $query->where('post_title', 'Terms')
                    ->orWhere('post_name', 'terms');
            })
            ->first();

        if (!$existingPage) {
            // CREATE THE TERMS PAGE IN WORDPRESS
            $id = DB::table("posts")->insertGetId([
                'post_author'           => 1,
                'post_date'             => now(),
                'post_date_gmt'         => now(),
                'post_content'          => '',
                'post_title'            => 'Terms',
                'post_excerpt'          => '',
                'post_status'           => 'publish',
                'comment_status'        => 'open',
                'ping_status'           => 'open',
                'to_ping'               => '',
                'pinged'                => '',
                'post_content_filtered' => '',
                'post_name'             => 'terms',
                'post_modified'         => now(),
                'post_modified_gmt'     => now(),
                'post_type'             => 'page',
            ]);

            // ASIGN THE TEMPLATE TO THE PAGE
            DB::table('postmeta')->insert([
                'post_id'       => $id,
                'meta_key'      => '_wp_page_template',
                'meta_value'    => 'template-custom.blade.php',
            ]);
        }
    }
}
