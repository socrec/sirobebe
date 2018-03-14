<?php
namespace backend\controllers;

use common\models\Customer;
use common\models\Order;
use common\models\OrderProduct;
use common\models\OrderSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

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
            $post = Yii::$app->request->post();
            if ($model->load($post)) {
                if (!$model->customer_id) {
                    $customerModel->load($post);
                    $customerModel->save();
                    $model->customer_id = $customerModel->id;
                }

                //reformat shipping fee
                $model->shipping_fee = str_replace(',', '', $model->shipping_fee);
                if ($model->save()) {
                    //create productSizes
                    foreach ($post['Order']['products'] as $product) {
                        $orderProduct = new OrderProduct();
                        $product['order_id'] = $model->id;
                        $orderProduct->load(['OrderProduct' => $product]);

                        $orderProduct->save();
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('create', compact('model', 'customerModel'));
    }

    public function actionUpdate($id = 0)
    {
        $model = $this->findModel($id);
        $customerModel = new Customer();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', compact('model', 'customerModel'));
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $model->delete();
        }
        return $this->redirect(Url::to(['order/index']));
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id, 'is_deleted' => 0])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
