<?php

namespace app\modules\seeder\commands;

use app\modules\actions\models\Promo;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductImage;
use app\modules\faq\models\Question;
use app\modules\seeder\components\CopyUploadedFile;
use Yii;
use yii\base\Action;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;

class SeederController extends Controller
{
    public function actionSeed()
    {
        $faker = \Faker\Factory::create('ru_RU');

        Console::stdout(PHP_EOL . 'categories' );
        $images = [
            Yii::getAlias('@app/modules/seeder/images/category/parilka.jpg'),
            Yii::getAlias('@app/modules/seeder/images/category/test.png')
        ];
        FileHelper::createDirectory(Yii::getAlias('@webroot/uploads/category/'));

        for ($i = 1; $i <= 10; $i++) {
            $category = new Category([
                'title'  => $faker->realText(20),
                'status' => (int)$faker->boolean(80),
                'image'  => new CopyUploadedFile($faker->randomElement($images))
            ]);
            $category->save();

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

        Console::stdout( PHP_EOL . 'products' );
        for ($i = 1; $i <= 10; $i++) {
            $categoryIds = Yii::$app->db->createCommand('SELECT id FROM catalog_categories')->queryColumn();

            $product = new Product([
                'title' => $faker->realText(20),
                'description' => $faker->realText(500),
                'category_id' => $faker->randomElement($categoryIds),
                'status' => (int)$faker->boolean(80)
            ]);

            $max = rand(2, 5);
            for ($j = 1; $j <= $max; $j++) {
                $product->addImage(ProductImage::create(new CopyUploadedFile($faker->randomElement($images))));
            }

            $product->save();

            $updatedAt = $faker->unixTime('now');
            $product->updateAttributes([
                'created_at' => $faker->unixTime($updatedAt),
                'updated_at' => $updatedAt,
            ]);

            Console::stdout('.');
        }

        Console::stdout(PHP_EOL . 'question..successfully_updated');
        for ($i = 1; $i <= 10; $i++) {

            $question = new Question([
                'question' => $title = $faker->realText(20),
                'answer'   => $faker->realText(300),
                'position' => $i,
                'status'   => (int)$faker->boolean(80),
            ]);
            $question->save();
        }

        Console::stdout(PHP_EOL . 'actions..successfully_updated');

        $images = [
            Yii::getAlias('@app/modules/seeder/images/actions/ANOTHER_ACTION_NAME.jpg'),
            Yii::getAlias('@app/modules/seeder/images/actions/aktciya.png')
        ];
        FileHelper::createDirectory(Yii::getAlias('@webroot/uploads/category/'));

        for ($i = 1; $i <= 10; $i++) {

            $actions = new Promo([
                'title'       => $title = $faker->realText(20),
                'description' => $faker->realText(300),
                'status'      => (int)$faker->boolean(80),
                'image'       => new CopyUploadedFile($faker->randomElement($images)),
            ]);
            $actions->save();

            $updatedAt = $faker->unixTime('now');
            $actions->updateAttributes([
                'created_at' => $faker->unixTime($updatedAt),
                'updated_at' => $updatedAt,
            ]);
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
