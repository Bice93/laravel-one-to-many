<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 40 ; $i++) { 
            $newPost = new Post();
            $newPost->name_user = $faker->userName();
            $newPost->title = $faker->realText(40);
            $newPost->post_content = $faker->paragraphs(4, true);
            $newPost->post_image = $faker->imageUrl();
            $newPost->post_date = $faker->dateTimeThisYear();
            $newPost->save();
        }
    }
}
