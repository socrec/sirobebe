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
                        'actions' => ['create', 'index', 'update', 'delete', 'view', 'load', 'get'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['outside'],
                        'allow' => true,
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
        $model->import_price = number_format($model->import_price) . 'đ';
        $model->list_price = number_format($model->list_price) . 'đ';

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionOutside($id)
    {
        $model = $this->findModel($id);
        $styles = Style::find()->where(['id' => explode(',', $model->style_id)])->all();
        if (count($styles)) {
            foreach ($styles as $style) {
                $model->styles[] = $style->title;
            }
            $model->styles = implode(', ', $model->styles);
        }
        $model->import_price = number_format($model->import_price) . 'đ';
        $model->list_price = number_format($model->list_price) . 'đ';

        return $this->render('outside', [
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

            if (count($model->sizes)) {
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

            if ($model->save()) {
                //create sizes & quantity
                if (count($model->sizes)) {
                    foreach ($model->sizes as $index => $size) {
                        $sizeModel = new ProductSize();
                        $sizeModel->product_id = $model->id;
                        $sizeModel->size = $size['size'];
                        $sizeModel->quantity = $size['quantity'];
                        $sizeModel->min_weight = $size['min_weight'];
                        $sizeModel->max_weight = $size['max_weight'];
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
        }
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

        $model->sizes = $model->productSizes;

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

            if ($model->save()) {
                //create sizes & quantity
                if (count($model->sizes)) {
                    foreach ($model->sizes as $index => $size) {
                        if (!$size['size_id']) {
                            $sizeModel = new ProductSize();
                            $sizeModel->product_id = $model->id;
                            $sizeModel->size = $size['size'];
                            $sizeModel->quantity = $size['quantity'];
                            $sizeModel->min_weight = $size['min_weight'];
                            $sizeModel->max_weight = $size['max_weight'];
                            $sizeModel->save();
                        } else {
                            $sizeModel = ProductSize::findOne($size['size_id']);
                            $sizeModel->size = $size['size'];
                            $sizeModel->quantity = $size['quantity'];
                            $sizeModel->min_weight = $size['min_weight'];
                            $sizeModel->max_weight = $size['max_weight'];
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
     * Get product listing
     * @param string $by
     */
    public function actionGet($by = 'title', $term = '')
    {
        $db = Yii::$app->getDb();
        $sql = "SELECT CONCAT(`products`.`title`, ' - Size ', `product_sizes`.`size`) AS `text`, `product_sizes`.`id`, 
                  `product_sizes`.`product_id`, `list_price`, `import_price`
                FROM `product_sizes`
                LEFT JOIN `products` ON `products`.`id`=`product_id`
                WHERE `$by` LIKE '%$term%'
                AND `quantity` > 0
                LIMIT 10";
        $data = $db->createCommand($sql)->queryAll();

        $result['results'] = $data;

        return json_encode($result);
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
