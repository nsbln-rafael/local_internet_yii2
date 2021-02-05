<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;
use yii\helpers\ArrayHelper;

class PostListSearch extends Model
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
            $sql = "SELECT * FROM idx_post_description WHERE MATCH(:description)";

            $ids = Yii::$app->sphinx->createCommand($sql)
                ->bindParam(":description", $this->description)
                ->queryAll();

            $ids = ArrayHelper::map($ids, 'id', 'id');

            $query->andFilterWhere(['id' => $ids]);
        }

        return $dataProvider;
    }
}
