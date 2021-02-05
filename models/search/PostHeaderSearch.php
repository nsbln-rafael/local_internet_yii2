<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

class PostHeaderSearch extends Model
{
    public $description;

    public function formName()
    {
        return '';
    }

    public function attributeLabels()
    {
        return ['description' => 'Поиск по описанию'];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['description', 'safe'],
        ];
    }

    /**
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($this->description)) {
            $query->andWhere("MATCH(description) AGAINST('$this->description')");
        }

        return $dataProvider;
    }
}
