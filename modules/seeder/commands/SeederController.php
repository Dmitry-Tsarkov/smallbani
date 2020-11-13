<?php

namespace app\modules\seeder\commands;

use app\modules\actions\models\Promo;
use app\modules\catalog\models\Category;
use app\modules\characteristic\models\Value;
use app\modules\characteristic\models\Characteristic;
use app\modules\catalog\models\ClientPhoto;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductDrawing;
use app\modules\catalog\models\ProductImage;
use app\modules\characteristic\models\Variant;
use app\modules\colour\models\Colour;
use app\modules\catalog\models\ColourGroup;
use app\modules\faq\models\Question;
use app\modules\order\models\Order;
use app\modules\page\models\Page;
use app\modules\portfolio\models\Portfolio;
use app\modules\portfolio\models\PortfolioCategory;
use app\modules\portfolio\models\PortfolioImage;
use app\modules\review\models\Review;
use app\modules\seeder\components\CopyUploadedFile;
use app\modules\seo\valueObjects\Seo;
use app\modules\slide\models\Slide;
use phpDocumentor\Reflection\Types\Boolean;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;

class SeederController extends Controller
{
    public function actionSeed()
    {
        $faker = \Faker\Factory::create('ru_RU');

        Console::stdout(PHP_EOL . 'colours..');

        $colourHexes = [
            '#000000' => 'Черный',
            '#555555' => 'Серый',
            '#005500' => 'Зеленый',
            '#ff0000' => 'Красный',
            '#00008b' => 'Тёмный ультрамариновый',
        ];
        $colourIds = [];
        foreach ($colourHexes as $hex => $title) {

            $colour = new Colour([
                'title' => $title,
                'hex'   => $hex,
            ]);

            $colour->save();
            $colourIds[] = $colour->id;

            Console::stdout('.');
        }

        Console::stdout(PHP_EOL . 'characteristics..');

        /** @var Characteristic[] $characteristics */
        $characteristics = [];
        $units = [
            '',
            'см',
            'руб.',
            'м3'
        ];

        for ($i = 1; $i <= 10; $i++) {

            $characteristic = new Characteristic([
                'title' => 'Характеристика_' . $i,
                'unit'  => $faker->randomElement($units),
                'type'  => $faker-> randomElement([Characteristic::TYPE_TEXT, Characteristic::TYPE_DROP_DOWN]),
            ]);

            $characteristic->save();
            $characteristics[] = $characteristic;

            Console::stdout('.');
        }


        Console::stdout(PHP_EOL . 'categories..' );
        $images = [
            Yii::getAlias('@app/modules/seeder/images/category/parilka.jpg'),
            Yii::getAlias('@app/modules/seeder/images/category/test.png')
        ];

        $categoryIds = [];
        $root = Category::find()->andWhere(['depth' => 0])->one();
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category([
                'title'  => "Категория_" . $i,
                'status' => (int)$faker->boolean(80),
                'image'  => new CopyUploadedFile($faker->randomElement($images)),
                'parent_id' => $root->id
            ]);
            $category->appendTo($root);
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

        $values = range(0, 100, 10);

        $productIds = [];
        for ($i = 1; $i <= 5; $i++) {

            $product = Product::create(
                $faker->realText(20),
                null,
                $faker->realText(500),
                $faker->randomElement($categoryIds),
                implode(PHP_EOL, $faker->words($nb = 3, $asText = false))
            );

            if ((int)$faker->boolean(80)) {
                $product->activate();
            }

            if ((int)$faker->boolean(20)) {
                $product->popular();
            }

            $max = rand(2, 5);
            for ($j = 1; $j <= $max; $j++) {
                $product->addImage(ProductImage::create(new CopyUploadedFile($faker->randomElement($images))));
            }

            $max = rand(1, 4);
            for ($j = 1; $j <= $max; $j++) {
                $product->addDrawing(ProductDrawing::create(new CopyUploadedFile($faker->randomElement($drawings))));
            }

            $max = rand(1, 3);
            for ($j = 1; $j <= $max; $j++) {
                $product->addClientPhoto(ClientPhoto::create(new CopyUploadedFile($faker->randomElement($photos))));
            }

            for ($j = 1; $j <= 3; $j++) {

                $product->addColourGroup(
                    ColourGroup::create(
                        'Группа ' . $j,
                        $faker->randomElements($colourIds, 3)
                    )
                );
            }

            foreach ($characteristics as $characteristic) {
                if ($faker->boolean(80)) {
                    $product->setValue($characteristic->createValue(
                        $faker->randomElement($values),
                        $faker->boolean(50)
                    ));
                }
            }

            $product->save();
            $productIds[] = $product->id;

            $updatedAt = $faker->unixTime('now');
            $product->updateAttributes([
                'created_at' => $faker->unixTime($updatedAt),
                'updated_at' => $updatedAt,
            ]);

            Console::stdout('.');
        }

        Console::stdout(PHP_EOL . 'order..');

        for ($i = 1; $i <= 5; $i++) {
            $id = $faker->randomElement($productIds);
            $modificationIds = [];
            $product = Product::findOne($id);

            foreach ($product->colourGroups as $group) {
                $modificationIds[] = $faker->randomElement($group->modifications)->id;
            }
            $order = Order::create(
                $faker->name,
                $faker->phoneNumber,
                $product,
                $modificationIds
            );

            if ($faker->boolean(80)) {
                $order->changeStatus(Order::STATUS_PROCESS);
            }

            $updatedAt = $faker->unixTime('now');
            $order->created_at = $faker->unixTime($updatedAt);
            $order->updated_at = $updatedAt;

            $order->save();

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

        Console::stdout(PHP_EOL . 'portfolio_category..');
        $catIds = [];
        for ($i = 1; $i <= 5; $i++) {

            $portfolio_category = new PortfolioCategory([
                'title' => $faker->realText(20),

            ]);
            $portfolio_category->save();
            $catIds[] = $portfolio_category->id;

            Console::stdout('.');
        }


        Console::stdout(PHP_EOL . 'portfolio..');

        $utubeurls = [
          'https://www.youtube.com/watch?v=Fip2ISJxFTI',
          'https://www.youtube.com/watch?v=VMS30oV8ApE'
        ];
        $portfolioIds = [];
        for ($i = 1; $i <= 10; $i++) {

            $portfolio = Portfolio::create(
                $faker->realText(20),
                null,
                $faker->realText(500),
                $faker->randomElement($catIds),
                $faker->randomElement($utubeurls),
                Seo::blank()
            );
            $portfolio->status = (int)$faker->boolean(80);

            $portfolio->save();
            $portfolioIds[] = $portfolio->id;

            $updatedAt = $faker->unixTime('now');
            $portfolio->updateAttributes([
                'created_at' => $faker->unixTime($updatedAt),
                'updated_at' => $updatedAt,
            ]);

            Console::stdout('.');
        }

        $images = [
            Yii::getAlias('@app/modules/seeder/images/portfolio/first.jpg'),
            Yii::getAlias('@app/modules/seeder/images/portfolio/second.jpg')
        ];

        Console::stdout( PHP_EOL . 'portfolio_images..' );

        for ($i = 1; $i <= 25; $i++) {

            $pImage = new PortfolioImage([
                'position'     => $i,
                'portfolio_id' => $faker->randomElement($portfolioIds),
                'image'        => new CopyUploadedFile($faker->randomElement($images)),
            ]);

            $pImage->save();
        }

        Console::stdout(PHP_EOL . 'reviews');

        $images = [
            Yii::getAlias('@app/modules/seeder/images/people/First.jpg'),
            Yii::getAlias('@app/modules/seeder/images/people/Second.jpg'),
            Yii::getAlias('@app/modules/seeder/images/people/Third.png')
        ];

        foreach ($productIds as $productId) {

            for ($i = 1; $i <= 3; $i++) {

                $review = Review::createForProduct(
                    $productId,
                    $faker->name(),
                    $faker->city,
                    $faker->realText(300),
                    (int)$faker->boolean(80)
                );
                $review->changePhoto(new CopyUploadedFile($faker->randomElement($images)));

                $updatedAt = $faker->unixTime('now');
                $review->created_at = $faker->unixTime($updatedAt);
                $review->updated_at = $updatedAt;

                $review->save();
                Console::stdout('.');
            }
        }

        foreach ($portfolioIds as $portfolioId) {

            for ($i = 1; $i <= 3; $i++) {

                $review = Review::createForPortfolio(
                    $portfolioId,
                    $faker->name(),
                    $faker->city,
                    $faker->realText(300),
                    (int)$faker->boolean(80)
                );
                $review->changePhoto(new CopyUploadedFile($faker->randomElement($images)));

                $updatedAt = $faker->unixTime('now');
                $review->created_at = $faker->unixTime($updatedAt);
                $review->updated_at = $updatedAt;

                $review->save();

                Console::stdout('.');
            }
        }

        for ($i = 1; $i <= 3; $i++) {

            $review = Review::create(
                $faker->name(),
                $faker->city,
                $faker->realText(300),
                (int)$faker->boolean(80)
            );
            $review->changePhoto(new CopyUploadedFile($faker->randomElement($images)));

            $updatedAt = $faker->unixTime('now');
            $review->created_at = $faker->unixTime($updatedAt);
            $review->updated_at = $updatedAt;

            $review->save();
            Console::stdout('.');
        }

        Console::stdout(PHP_EOL . 'pages');
        $root = Page::findOne(['depth' => 0]);
        Page::create(
            'index',
            'Главная страница',
             '/',
            '/site/index'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'policy',
            'Политика конфиденциальности',
            'policy'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'catalog',
            'Каталог',
            'catalog',
            '/catalog/frontend/index'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'portfolio',
            'Портфолио',
            'portfolio',
            '/portfolio/frontend/index'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'delivery',
            'Доставка и оплата',
            'delivery'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'reviews',
            'Отзывы',
            'reviews',
            '/review/frontend/index'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'about',
            'Компания',
            'about',
            '/site/about',
            '<ul>
	<li>Крупнейший завод-изготовитель бань-бочек в Башкирии. Общая площадь цехов (заготовочный, столярный, цех металлообработки, сборочный участок) составляет порядка двух с половиной тысяч квадратных метров;</li>
	<li>Собственная производственная линейка, созданная профессионалами с огромным опытом создания деревообрабатывающего оборудования;</li>
	<li>Специальная конструкция, учитывающая особенности древесины</li>
	<li>в климатических условиях России;</li>
	<li>Оборудование собственного производства, позволяющее изготавливать качественные бани быстро и недорого;</li>
	<li>Низкая цена, за счет высокой заводской производительности;</li>
	<li>Постоянный контроль качества выпускаемой продукции;</li>
	<li>Постоянная модернизация оборудования и улучшение конструкции бань-бочек, чтобы сделать бани еще более качественными и недорогими;</li>
	<li>Доступность продукции по всей России.</li>
</ul>
'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'stocks',
            'Акции',
            'stocks',
            '/actions/frontend/index'
        )->appendTo($root);
        Console::stdout('.');


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
