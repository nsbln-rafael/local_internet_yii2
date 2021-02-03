<?php

namespace app\services;

use app\models\Post;

interface PostManagerInterface
{
    public function save(Post $model);

    public function update(Post $model, string $oldImage);

    public function delete(Post $model);
}