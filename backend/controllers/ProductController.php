<?php

namespace backend\controllers;

use common\models\ProductImage;
use common\models\ProductSize;
use common\models\Style;
use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $styles = Style::find()->where(['id' => explode(',', $model->style_id)])->all();
        if (count($styles)) {
            foreach ($styles as $style) {
                $model->styles[] = $style->title;
            }
            $model->styles = implode(', ', $model->styles);
        }
        $model->import_price = number_format($model->import_price).'đ';
        $model->list_price = number_format($model->list_price).'đ';

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {
            //create style if new
            $styleIds = [];

            if (count(Yii::$app->request->post('Product')['styles'])) {
                foreach (Yii::$app->request->post('Product')['styles'] as $style) {
                    if (!Style::findOne($style)) {
                        $styleModel = new Style();
                        $styleModel->title = $style;
                        $styleModel->save();

                        $styleIds[] = $styleModel->id;
                    } else {
                        $styleIds[] = $style;
                    }
                }
            }
            $model->style_id = implode(',', $styleIds);
            $model->date = date_format(date_create_from_format('d/m/Y', Yii::$app->request->post('date')), 'Y-m-d');

            if ($model->save()) {
                //create sizes & quantity
                if (count(Yii::$app->request->post('Product')['size'])) {
                    foreach (Yii::$app->request->post('Product')['size'] as $index => $size) {
                        $sizeModel = new ProductSize();
                        $sizeModel->product_id = $model->id;
                        $sizeModel->size = $size;
                        $sizeModel->quantity = Yii::$app->request->post('Product')['quantity'][$index];
                        $sizeModel->min_weight = Yii::$app->request->post('Product')['min_weight'][$index];
                        $sizeModel->max_weight = Yii::$app->request->post('Product')['max_weight'][$index];
                        $sizeModel->save();
                    }
                }

                //create files
                $model->images = UploadedFile::getInstances($model, 'images');
                foreach ($model->images as $file) {
                    $path = 'uploads/' . uniqid() . $file->baseName . '.' . $file->extension;
                    $file->saveAs($path);
                    $productImageModel = new ProductImage();
                    $productImageModel->product_id = $model->id;
                    $productImageModel->path = $path;
                    $productImageModel->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $styles = Style::find()->all();
            $tmp = [];
            if (count($styles)) {
                foreach ($styles as $style) {
                    $tmp[$style->id] = $style->title;
                }
            }

            return $this->render('create', [
                'model' => $model,
                'styles' => $tmp
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $styles = Style::find()->all();
        $tmp = [];
        if (count($styles)) {
            foreach ($styles as $style) {
                $tmp[$style->id] = $style->title;
            }
        }

        $selectedStyles = Style::find()->where(['id' => $model->style_id])->all();
        foreach ($selectedStyles as $style) {
            $model->styles[] = $style->id;
        }
        $model->date = date_format(date_create_from_format('Y-m-d', $model->date), 'd/m/Y');
        if ($model->load(Yii::$app->request->post())) {
            //create style if new
            $styleIds = [];

            if (count(Yii::$app->request->post('Product')['styles'])) {
                foreach (Yii::$app->request->post('Product')['styles'] as $style) {
                    if (!Style::findOne($style)) {
                        $styleModel = new Style();
                        $styleModel->title = $style;
                        $styleModel->save();

                        $styleIds[] = $styleModel->id;
                    } else {
                        $styleIds[] = $style;
                    }
                }
            }
            $model->style_id = implode(',', $styleIds);
            $model->date = date_format(date_create_from_format('d/m/Y', Yii::$app->request->post('date')), 'Y-m-d');

            if ($model->save()) {
                //create sizes & quantity
                if (count(Yii::$app->request->post('Product')['size'])) {
                    $size_ids = Yii::$app->request->post('Product')['size_id'];
                    foreach (Yii::$app->request->post('Product')['size'] as $index => $size) {
                        if ($size_ids[$index] == -1) {
                            $sizeModel = new ProductSize();
                            $sizeModel->product_id = $model->id;
                            $sizeModel->size = $size;
                            $sizeModel->quantity = Yii::$app->request->post('Product')['quantity'][$index];
                            $sizeModel->min_weight = Yii::$app->request->post('Product')['min_weight'][$index];
                            $sizeModel->max_weight = Yii::$app->request->post('Product')['max_weight'][$index];
                            $sizeModel->save();
                        } else {
                            $sizeModel = ProductSize::findOne($size_ids[$index]);
                            $sizeModel->size = $size;
                            $sizeModel->quantity = Yii::$app->request->post('Product')['quantity'][$index];
                            $sizeModel->min_weight = Yii::$app->request->post('Product')['min_weight'][$index];
                            $sizeModel->max_weight = Yii::$app->request->post('Product')['max_weight'][$index];
                            $sizeModel->save();
                        }
                    }
                }

                //create files
                $model->images = UploadedFile::getInstances($model, 'images');
                foreach ($model->images as $file) {
                    $path = 'uploads/' . uniqid() . $file->baseName . '.' . $file->extension;
                    $file->saveAs($path);
                    $productImageModel = new ProductImage();
                    $productImageModel->product_id = $model->id;
                    $productImageModel->path = $path;
                    $productImageModel->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'styles' => $tmp
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
