<?php

use app\services\PostManager;
use app\services\PostManagerInterface;

$di = Yii::$container;

$di->set(PostManagerInterface::class, PostManager::class);