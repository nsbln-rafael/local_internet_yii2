<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

class PostSearch extends Model
{
    public $title;

    public function formName()
    {
        return '';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['title', 'safe'],
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

        $query->andFilterWhere(['LIKE', 'title', $this->title]);

        return $dataProvider;
    }
}
