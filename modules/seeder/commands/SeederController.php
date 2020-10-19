<?php

namespace app\modules\seeder\commands;

use app\modules\actions\models\Promo;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\ClientPhoto;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductDrawing;
use app\modules\catalog\models\ProductImage;
use app\modules\faq\models\Question;
use app\modules\review\models\Review;
use app\modules\seeder\components\CopyUploadedFile;
use app\modules\slide\models\Slide;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;

class SeederController extends Controller
{
    public function actionSeed()
    {
        $faker = \Faker\Factory::create('ru_RU');

        Console::stdout(PHP_EOL . 'categories..' );
        $images = [
            Yii::getAlias('@app/modules/seeder/images/category/parilka.jpg'),
            Yii::getAlias('@app/modules/seeder/images/category/test.png')
        ];

        $categoryIds = [];
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category([
                'title'  => $faker->realText(20),
                'status' => (int)$faker->boolean(80),
                'image'  => new CopyUploadedFile($faker->randomElement($images))
            ]);
            $category->save();
            $categoryIds[] = $category->id;

            $updatedAt = $faker->unixTime('now');
            $category->updateAttributes([
                'created_at' => $faker->unixTime($updatedAt),
                'updated_at' => $updatedAt,
            ]);
            Console::stdout('.');
        }

        $images = [
            Yii::getAlias('@app/modules/seeder/images/category/parilka.jpg'),
            Yii::getAlias('@app/modules/seeder/images/category/test.png')
        ];
        $drawings = [
            Yii::getAlias('@app/modules/seeder/images/drawings/first_drawing.jpg'),
            Yii::getAlias('@app/modules/seeder/images/drawings/second_drawing.jpg'),
        ];

        $photos = [
            Yii::getAlias('@app/modules/seeder/images/client_photos/first.jpg'),
            Yii::getAlias('@app/modules/seeder/images/client_photos/second.jpg'),
            Yii::getAlias('@app/modules/seeder/images/client_photos/third.jpg'),
        ];

        Console::stdout( PHP_EOL . 'products..' );

        for ($i = 1; $i <= 10; $i++) {

            $product = new Product([
                'title' => $faker->realText(20),
                'description' => $faker->realText(500),
                'gift' => implode(PHP_EOL, $faker->words($nb = 3, $asText = false)),
                'category_id' => $faker->randomElement($categoryIds),
                'status' => (int)$faker->boolean(80),
                'is_popular' => (int)$faker->boolean(20),
            ]);

            $max = rand(2, 5);
            for ($j = 1; $j <= $max; $j++) {
                $product->addImage(ProductImage::create(new CopyUploadedFile($faker->randomElement($images))));
            }

            $max = rand(1, 3);
            for ($j = 1; $j <= $max; $j++) {
                $product->addDrawing(ProductDrawing::create(new CopyUploadedFile($faker->randomElement($drawings))));
            }

            $max = rand(1, 3);
            for ($j = 1; $j <= $max; $j++) {
                $product->addClientPhoto(ClientPhoto::create(new CopyUploadedFile($faker->randomElement($photos))));
            }

            $product->save();

            $updatedAt = $faker->unixTime('now');
            $product->updateAttributes([
                'created_at' => $faker->unixTime($updatedAt),
                'updated_at' => $updatedAt,
            ]);

            Console::stdout('.');
        }



        Console::stdout(PHP_EOL . 'question..');
        for ($i = 1; $i <= 10; $i++) {

            $question = new Question([
                'question' => $title = $faker->realText(20),
                'answer'   => $faker->realText(300),
                'position' => $i,
                'status'   => (int)$faker->boolean(80),
            ]);
            $question->save();

            Console::stdout('.');
        }

        Console::stdout(PHP_EOL . 'actions..');

        $images = [
            Yii::getAlias('@app/modules/seeder/images/actions/ANOTHER_ACTION_NAME.jpg'),
            Yii::getAlias('@app/modules/seeder/images/actions/aktciya.png')
        ];

        $actionHrefs = [];
        for ($i = 1; $i <= 10; $i++) {

            $actions = new Promo([
                'title'       => $title = $faker->realText(20),
                'description' => $faker->realText(300),
                'status'      => (int)$faker->boolean(80),
                'is_relevant' => (int)$faker->boolean(80),
                'image'       => new CopyUploadedFile($faker->randomElement($images)),
            ]);
            $actions->save();
            $actionHrefs[] = '/specials/' . $actions->alias;

            $updatedAt = $faker->unixTime('now');
            $actions->updateAttributes([
                'created_at' => $faker->unixTime($updatedAt),
                'updated_at' => $updatedAt,
            ]);
            Console::stdout('.');
        }

        Console::stdout(PHP_EOL . 'reviews..');

        $images = [
            Yii::getAlias('@app/modules/seeder/images/people/First.jpg'),
            Yii::getAlias('@app/modules/seeder/images/people/Second.jpg'),
            Yii::getAlias('@app/modules/seeder/images/people/Third.png')
        ];

        for ($i = 1; $i <= 10; $i++) {

            $actions = new Review([
                'name'   => $faker->realText(10),
                'place'  => $faker->realText(20),
                'review' => $faker->realText(300),
                'status' => (int)$faker->boolean(80),
                'image'  => new CopyUploadedFile($faker->randomElement($images)),
            ]);
            $actions->save();

            $updatedAt = $faker->unixTime('now');
            $actions->updateAttributes([
                'created_at' => $faker->unixTime($updatedAt),
                'updated_at' => $updatedAt,
            ]);
            Console::stdout('.');
        }

        Console::stdout(PHP_EOL . 'slide');

        $images = [
            Yii::getAlias('@app/modules/seeder/images/slide/banya_bochka.jpg'),
            Yii::getAlias('@app/modules/seeder/images/slide/bani_big.jpg'),
        ];

        for ($i = 1; $i <= 10; $i++) {

            $hasLink = $faker->boolean(50);

            $slide = new Slide([
                'title'         => $faker->realText(20),
                'is_active'     => $faker->boolean(80),
                'image'         => new CopyUploadedFile($faker->randomElement($images)),
                'active_from'   => time() + (3600 * 24) * $faker->randomElement([1, -1]),
                'active_to'     => time() + 3600 * 24 * rand(2, 5),
            ]);

            if ($hasLink) {
                $slide->link_text = $faker->realText(15);
                $slide->link_href = $faker->randomElement($actionHrefs);
                $slide->link_is_blank = (int)$faker->boolean(50);
            }
            $slide->save();
            Console::stdout('.');
        }
    }

    public function actionRefresh()
    {
        $this->actionClearDb();
        $this->actionClearUploads();
        \Yii::$app->runAction('migrate', ['interactive' => 0]);
        $this->actionSeed();
    }

    public function actionClearDb()
    {
        Yii::$app->getDb()->createCommand("SET foreign_key_checks = 0")->execute();
        foreach (\Yii::$app->db->schema->tableNames as $tableName) {
            Yii::$app->getDb()->createCommand()->dropTable($tableName)->execute();
        }
        Yii::$app->getDb()->createCommand("SET foreign_key_checks = 1")->execute();
    }

    public function actionClearUploads()
    {
        if (!is_dir(Yii::getAlias('@webroot/uploads'))) {
            return;
        }

        foreach (FileHelper::findDirectories(Yii::getAlias('@webroot/uploads'), ['recursive' => false]) as $dir) {
            FileHelper::removeDirectory($dir);
        }
    }

}
