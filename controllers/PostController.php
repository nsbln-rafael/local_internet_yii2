<?php

/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpDocMissingThrowsInspection */

namespace app\controllers;

use app\services\PostManagerInterface;
use Yii;
use app\models\Post;
use app\models\search\PostHeaderSearch;
use app\models\search\PostListSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return $this->isAuthor();
                        },
                    ],

                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionResult()
    {
        $searchModel = new PostHeaderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('result', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView(int $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param PostManagerInterface $manager
     * @return mixed
     */
    public function actionCreate(PostManagerInterface $manager)
    {
        $model           = new Post();
        $model->scenario = Post::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $manager->save($model);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param integer              $id
     * @param PostManagerInterface $manager
     *
     * @return mixed
     */
    public function actionUpdate(int $id, PostManagerInterface $manager)
    {
        $model           = $this->findModel($id);
        $model->scenario = Post::SCENARIO_UPDATE;
        $oldImage        = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            $manager->update($model, $oldImage);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete(int $id, PostManagerInterface $manager)
    {
        $model = $this->findModel($id);
        $manager->delete($model);

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     *
     * @return Post
     */
    protected function findModel(int $id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function isAuthor() {
        $app  = Yii::$app;
        $post = $this->findModel($app->request->get('id'));

        return $post->user->id === $app->user->id;
    }
}
