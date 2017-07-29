<?php
namespace backend\controllers;

use common\models\Customer;
use common\models\CustomerSearch;
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
class CustomerController extends Controller
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
                        'actions' => ['create', 'index', 'update', 'delete', 'view', 'load'],
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
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $model = new Customer();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', compact('model'));
    }

    public function actionView($id)
    {
        $model = Customer::find()->where(['id' => $id])->one();

        return $this->render('view', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = Customer::find()->where(['id' => $id])->one();
        if ($model) {
            $model->delete();
        }
        return $this->redirect(Url::to(['customer/index']));
    }

    public function actionUpdate($id = 0)
    {
        $model = Customer::find()->where(['id' => $id])->one();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('edit', compact('model'));
    }

    public function actionLoad()
    {
        $customers = Customer::find()
            ->andFilterWhere(['LIKE', 'name', Yii::$app->request->get('term')])
            ->orFilterWhere(['LIKE', 'phone', Yii::$app->request->get('term')])
            ->limit(10)
            ->all();
        $result = [];
        foreach ($customers as $customer) {
            $result[] = [
                'id' => $customer->id,
                'text' => $customer->name . ' - ' . $customer->phone
            ];
        }

        return json_encode($result);
    }
}
