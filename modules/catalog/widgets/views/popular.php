<?php

use app\modules\catalog\widgets\ProductWidget;
use yii\helpers\Url;

/**
 * @var $this \yii\web\View
 * @var \app\modules\catalog\models\Product[] $products
 */

?>

<?php if (!empty($products)): ?>
    <section class="section">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">Самые популярные модели</h2>
            </header>
            <div class="section__body">
                <div class="grid is-row">
                    <?php foreach ($products as $product) :?>
                        <div class="col-3">
                            <?= ProductWidget::widget(compact('product')) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="button js-button unfill look-all" area-label="Смотреть все" href="<?= Url::to(['/catalog/frontend/index']) ?>">Смотреть все</a>
            </div>
        </div>
    </section>
<?php endif ?>
