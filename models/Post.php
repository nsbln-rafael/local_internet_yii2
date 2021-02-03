<?php

namespace app\models;

use app\models\query\PostQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int    $id
 * @property string $title
 * @property string $description
 * @property string $description_short
 * @property string $image
 * @property int    $user_id
 *
 */
class Post extends ActiveRecord
{
    public const SCENARIO_CREATE = 'create';
    public const SCENARIO_UPDATE = 'update';

    public function scenarios(): array
    {
        return ArrayHelper::merge(parent::scenarios(), [
            self::SCENARIO_CREATE => ['title', 'image', 'description', 'description_short'],
            self::SCENARIO_UPDATE => ['title', 'image', 'description', 'description_short'],
        ]);
    }

    public static function tableName(): string
    {
        return 'post';
    }

    public function rules(): array
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'exist', 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],

            ['title', 'required'],
            ['title', 'string', 'max' => 255],

            ['image', 'required', 'on' => self::SCENARIO_CREATE],
            ['image', 'image', 'extensions' => 'jpeg,jpg,png', 'minWidth' => 640, 'minHeight' => 480],

            ['description', 'required'],
            ['description', 'string'],

            ['description_short', 'required'],
            ['description_short', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'                => 'ID',
            'title'             => 'Заголовок',
            'description'       => 'Описание',
            'description_short' => 'Короткое описание',
            'image'             => 'Изображение',
            'user_id'           => 'Автор',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return PostQuery
     */
    public static function find(): PostQuery
    {
        return new PostQuery(get_called_class());
    }
}
