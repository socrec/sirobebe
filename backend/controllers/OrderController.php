<?php
namespace backend\controllers;

use common\models\Customer;
use common\models\Order;
use common\models\OrderSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $model = new Order();
        $customerModel = new Customer();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if (!$model->customer_id) {
                    $customerModel->load(Yii::$app->request->post());
                    $customerModel->save();
                    $model->customer_id = $customerModel->id;
                }

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('create', compact('model', 'customerModel'));
    }

    public function actionUpdate($id = 0)
    {
        dd($id);
        $model = Order::find()->where(['id' => $id])->one();
        if (Yii::$app->request->isPost) {
//            dd(Yii::$app->request->post());
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', compact('model'));
    }

    public function actionView($id)
    {
        $model = Order::find()->where(['id' => $id])->one();

        return $this->render('view', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = Order::find()->where(['id' => $id])->one();
        if ($model) {
            $model->delete();
        }
        return $this->redirect(Url::to(['order/index']));
    }
}
