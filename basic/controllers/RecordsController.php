<?php

namespace app\controllers;

use Yii;
use app\models\Records;
use app\models\RecordsSearch;
use app\models\UploadForm;
use app\models\ImagePath;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * RecordsController implements the CRUD actions for Records model.
 */
class RecordsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Records models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecordsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Records model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $record = $this->findModel($id);

        if ($record->Is_there_a_photo == true) {
            $img = new ImagePath();
            $img->setImagePathById($record->id);
            $relativeUrlToImage = $img->relativeUrlToImage;
        } else {
            $relativeUrlToImage = false;
        }

        return $this->render('view', [
            'record' => $record,
            'relativeUrlToImage' => $relativeUrlToImage
        ]);
    }

    /**
     * Creates a new Records model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $record = new Records();
        $UploadImg = new UploadForm();

        if ($record->load(Yii::$app->request->post()) && $record->setData()) {

            if (Yii::$app->request->isPost) {
                if( $UploadImg->imageFile = UploadedFile::getInstance($UploadImg, 'imageFile')) {
                    $record->Is_there_a_photo = true;
                }
            }

            if ($record->save()){
                if ($record->Is_there_a_photo === true) {
                    $UploadImg->setPathToFile($record->id);
                    $UploadImg->upload();
                }
                return $this->redirect(['view', 'id' => $record->id]);
            }
        }

        return $this->render('create', [
            'record' => $record,
            'UploadImg' => $UploadImg
        ]);
    }

    /**
     * Updates an existing Records model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $record = $this->findModel($id);
        $UploadImg = new UploadForm();


        if ($record->load(Yii::$app->request->post())) {
            if (Yii::$app->request->post('do_i_need_to_delete_a_photo')) {
                $this->deletePhotoIfThereIs($record);
                $record->Is_there_a_photo = false;
            }

            if (Yii::$app->request->isPost) {
                if ( $UploadImg->imageFile = UploadedFile::getInstance($UploadImg, 'imageFile')) {
                    $record->Is_there_a_photo = true;
                }
            }

            $record->save();

            if ($record->save()) {
                if ($record->Is_there_a_photo === true) {
                    $UploadImg->setPathToFile($record->id);
                    $UploadImg->upload();
                }
                return $this->redirect(['view', 'id' => $record->id]);
            }
        }

        return $this->render('update', [
            'record' => $record,
            'UploadImg' => $UploadImg
        ]);
    }

    /**
     * Deletes an existing Records model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $record = $this->findModel($id);

        $this->deletePhotoIfThereIs($record);

        $record->delete();

        return $this->redirect(['index']);
    }

    private function deletePhotoIfThereIs($record) {
        if ($record->Is_there_a_photo == true) {
            $img = new ImagePath();
            $img->setImagePathById($record->id);
            $img->deleteImage();
        }
    }

    /**
     * Finds the Records model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Records the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($record = Records::findOne($id)) !== null) {
            return $record;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
