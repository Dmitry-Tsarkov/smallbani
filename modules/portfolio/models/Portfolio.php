<?php


namespace app\modules\portfolio\models;

use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\helpers\YoutubeHelper;
use app\modules\admin\traits\QueryExceptions;
use app\modules\review\models\Review;
use app\modules\seo\behaviors\SeoBehavior;
use app\modules\seo\valueObjects\Seo;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Class Portfolio
 * @package app\modules\portfolio\models
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property int $status [int(11)]
 * @property int $category_id [int(11)]
 * @property string $description
 * @property string $youtube_url [varchar(255)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 *
 * @property PortfolioCategory $category
 * @property PortfolioImage[] $images
 * @property Review[] $reviews
 *
 * @mixin SeoBehavior
 */

class Portfolio extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var Seo
     */
    private $seo;

    public static function tableName()
    {
        return '{{portfolios}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SlugBehavior::class,
            SeoBehavior::class,
            SeoBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['images'],
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'       => 'Заголовок',
            'alias'       => 'Алиас',
            'description' => 'Описание в портфолио',
            'status'      => 'Статус',
            'created_at'  => 'Создано',
            'updated_at'  => 'Обновлено',
            'youtube_url' => 'Ссылка на видео',
        ];
    }

    public static function create($title, $alias, $description, $categoryId, $youtube_url, Seo $seo): Portfolio
    {
        $portfolio = new Portfolio();
        $portfolio->title = $title;
        $portfolio->alias = $alias;
        $portfolio->description = $description;
        $portfolio->category_id = $categoryId;
        $portfolio->youtube_url = $youtube_url;
        $portfolio->status = self::STATUS_DRAFT;
        $portfolio->seo = $seo;

        return $portfolio;
    }

    public function edit($title, $alias, $description, $categoryId, $youtube_url, Seo $seo)
    {
        $this->title = $title;
        $this->alias = $alias;
        $this->description = $description;
        $this->category_id = $categoryId;
        $this->youtube_url = $youtube_url;
        $this->seo = $seo;
    }

    public function addImage(PortfolioImage $image)
    {
        $images = $this->images;
        $images[] = $image;
        $this->updateImages($images);
    }

    private function updateImages(array $images)
    {
        foreach ($images as $i => $image) {
            $image->setPosition($i + 1);
        }
        $this->images = $images;
        $this->populateRelation('mainImage', reset($images));
    }

    public function getSeo(): Seo
    {
        return $this->seo;
    }

    public function getCategory()
    {
        return $this->hasOne(PortfolioCategory::class, ['id' => 'category_id']);
    }

    public function getImages()
    {
        return $this->hasMany(PortfolioImage::class, ['portfolio_id' => 'id'])->orderBy('position');
    }

    public function activate()
    {
        if ($this->status == self::STATUS_ACTIVE) {
            throw new \DomainException('Портфолио уже активировано');
        }

        if (empty($this->category)) {
            throw new \DomainException('Не установлена категория');
        }

        $this->status = Portfolio::STATUS_ACTIVE;
    }

    public function draft()
    {
        if ($this->status == self::STATUS_DRAFT) {
            throw new \DomainException('Товар уже заблокирвоан');
        }
        $this->status = Portfolio::STATUS_DRAFT;
    }

    public function sortImages(int $oldIndex, int $newIndex)
    {
        $images = $this->images;
        $tmp = $images[$oldIndex];
        array_splice($images, $oldIndex, 1);
        array_splice($images, $newIndex, 0, [$tmp]);
        $this->updateImages($images);
    }

    public function deleteImage($photoId)
    {
        $images = $this->images;
        foreach ($images as $i => $image) {
            if ($image->id == $photoId) {
                unset($images[$i]);
                $this->updateImages($images);
                return;
            }
        }
        throw new \DomainException('Картинка не найдена');
    }

    public function hasMainImage(): bool
    {
        return !empty($this->image_id) && !empty($this->mainImage->getUploadedFilePath('image'));
    }

    public function hasYoutubeUrl()
    {
        $id = YoutubeHelper::id($this->youtube_url);
        return !empty($id);
    }

    public function getHref()
    {
        return Url::to(['/portfolio/frontend/view','alias' => $this->alias, 'category' => $this->category->alias]);
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class, ['portfolio_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('meta_t', $this->seo->getTitle());
        $this->setAttribute('meta_d', $this->seo->getDescription());
        $this->setAttribute('meta_k', $this->seo->getKeywords());
        $this->setAttribute('h1', $this->seo->getH1());
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->seo = new Seo(
            $this->getAttribute('meta_t'),
            $this->getAttribute('meta_d'),
            $this->getAttribute('meta_k'),
            $this->getAttribute('h1')
        );
        parent::afterFind();
    }
}
