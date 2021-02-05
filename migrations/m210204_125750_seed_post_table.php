<?php

use yii\db\Migration;
use Faker\Factory;

class m210204_125750_seed_post_table extends Migration
{
    private const TABLE_NAME = "post";

    public function safeUp()
    {
        $faker = Factory::create();

        $posts = [];

        for ($i = 1; $i <= 20000; $i++) {
            $imageName = "post{$i}.png";
            $this->loadImage($i, $imageName);

            $posts[] = [
                $i,
                rand(1, 3),
                "Post #{$i}",
                "Post #{$i} short description: " . $faker->text(200),
                "Post #{$i} full description: " . $faker->text(1000),
                $imageName,
            ];
        }

        $this->batchInsert(
            self::TABLE_NAME,
            [
                'id',
                'user_id',
                'title',
                'description_short',
                'description',
                'image'
            ],
            $posts
        );
    }

    public function safeDown()
    {
        $range = range(1, 20000);

        $this->delete(self::TABLE_NAME, ['id' => $range]);

        foreach ($range as $item) {
            unlink("web/uploads/post{$item}.png");
        }
    }

    private function loadImage(int $i, string $imageName)
    {
        $image            = imagecreate(640, 480);
        $background_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        $text_color       = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));

        imagettftext($image, 50, 0, 100, 100, $text_color,  'web/fonts/SpicyRice.ttf', "Post #{$i}", );
        header("Content-Type: image/png");
        imagepng($image, "web/uploads/$imageName");
    }

}
