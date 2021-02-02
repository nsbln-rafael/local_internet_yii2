<?php

namespace app\models;

use app\models\query\PostQuery;
use yii\db\ActiveRecord;

/**
 * @property int    $id
 * @property string $title
 * @property string $description
 * @property string $description_short
 * @property string $image_path
 */
class Post extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'post';
    }

    public function rules(): array
    {
        return [
            ['title', 'required'],
            ['title', 'string', 'max' => 255],

            ['image_path', 'required'],
            ['image_path', 'string', 'max' => 255],

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
            'image_path'        => 'Изображение',
        ];
    }

    /**
     * @return PostQuery
     */
    public static function find(): PostQuery
    {
        return new PostQuery(get_called_class());
    }
}
