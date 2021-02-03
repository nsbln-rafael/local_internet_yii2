<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace app\services;

use app\models\Post;
use Imagine\Image\Box;
use yii\imagine\Image;
use yii\web\UploadedFile;

class PostManager implements PostManagerInterface
{
    public function save(Post $model)
    {
        $file         = UploadedFile::getInstance($model, 'image');
        $model->image = $this->uploadImage($model, $file);

        return $model->save();
    }

    public function update(Post $model, string $oldImage): bool
    {
        $file = UploadedFile::getInstance($model, 'image');

        if (empty($file)) {
            $model->image = $oldImage;
        } else {
            $model->image = $this->uploadImage($model, $file);
        }

        return $model->save();
    }

    public function delete(Post $model): void
    {
        unlink("uploads/" . $model->image);
        $model->delete();
    }

    private function uploadImage(Post $model, UploadedFile $file): string
    {
        if ($model->image) {
            unlink("uploads/" . $model->image);
        }

        $fileName = md5(time()) . "." .$file->extension;

        Image::getImagine()->open($file->tempName)
            ->thumbnail(new Box(640, 480))
            ->save("uploads/" . $fileName);

        return $fileName;
    }
}