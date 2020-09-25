<?php

namespace app\modules\seeder\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;

class SeederController extends Controller
{
    public function actionSeed()
    {
        $faker = \Faker\Factory::create('ru_RU');

        Console::stdout('categories..' . PHP_EOL);
        for ($i = 1; $i <= 10; $i++) {
            Yii::$app->db->createCommand()->insert('catalog_categories', [
                'title' => $title = $faker->realText(20),
                'alias' => $faker->slug(2),
                'status' => (int)$faker->boolean(80),
                'created_at' => $faker->unixTime('now'),
                'updated_at' => $faker->unixTime('now')
            ])->execute();
        }

        Console::stdout('products..' . PHP_EOL);
        for ($i = 1; $i <= 100; $i++) {
            $categoryIds = Yii::$app->db->createCommand('SELECT id FROM catalog_categories')->queryColumn();

            Yii::$app->db->createCommand()->insert('catalog_products', [
                'title' => $title = $faker->realText(20),
                'alias' => $faker->slug(2),
                'description' => $faker->realText(500),
                'status' => (int)$faker->boolean(80),
                'created_at' => $faker->unixTime('now'),
                'updated_at' => $faker->unixTime('now'),
                'category_id' => $faker->randomElement($categoryIds),
            ])->execute();
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