<?php

namespace app\models\query;

use app\models\Post;
use yii\db\ActiveQuery;

/**
 * @see Post
 */
class PostQuery extends ActiveQuery
{
    /**
     * @return Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @return Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
