<?php

namespace app\controllers;

use Yii;
use app\models\TblStore;
use app\models\TblStoreSearch;
use app\models\Uploads;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

use yii\db\Expression;

use yii\filters\AccessControl;

/**
 * TblStoreController implements the CRUD actions for TblStore model.
 */
class TblStoreController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup', 'create', 'update' ,'index', 'UploadAjax'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'create', 'update' ,'index', 'UploadAjax'],
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
     * Lists all TblStore models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblStoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblStore model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblStore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblStore();

        if ($model->load(Yii::$app->request->post())) {
            
            $this->Uploads(false);
            
            $model->create_date =  new Expression('NOW()');
            $model->user_id = Yii::$app->user->identity->profile->user_id;
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->store_id]);
            }
        } else {
             $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        }
        
        return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing TblStore model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->ref);

        if ($model->load(Yii::$app->request->post())) {
            
            $this->Uploads(false);
            
            $model->update_date =  new Expression('NOW()');
            $model->user_id = Yii::$app->user->identity->profile->user_id;
            
            if($model->save()){
                 return $this->redirect(['view', 'id' => $model->store_id]);
            }
        }
        
        return $this->render('update', [
                'model' => $model,
                'initialPreview' => $initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig
            ]);   
    }

    /**
     * Deletes an existing TblStore model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
                
        //remove upload file & data
        $this->removeUploadDir($model->ref);
        
        Uploads::deleteAll(['ref'=>$model->ref]);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblStore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblStore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblStore::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionViewDetail($id){
        
         return $this->render('store-details', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionViewDetailMobile($id){
        $this->layout = 'mobile';       
         return $this->render('store-details_mobile', [
            'model' => $this->findModel($id),
        ]);
    }
    
    
    public function actionViewDetailJson($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;        
        $row = $this->findModel($id);
        
        return $row;
    }
    
    public function actionPrint($id)
    {
        $searchModel = new TblStoreSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       return $this->render('print', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
           'model' => $this->findModel($id)
       ]);
    }


    /*|*********************************************************************************|
  |================================ Upload Ajax ====================================|
  |*********************************************************************************|*/

    public function actionUploadAjax(){
           $this->Uploads(true);
     }

    private function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = TblStore::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(TblStore::getUploadPath().$dir);
    }

    private function Uploads($isAjax = false) {
             if (Yii::$app->request->isPost) {
                $images = UploadedFile::getInstancesByName('upload_ajax');
                //print_r($images);
                if ($images) {
//echo 'am in';
                    if($isAjax===true){
                        $ref =Yii::$app->request->post('ref');
                    }else{
                        $PhotoLibrary = Yii::$app->request->post('TblStore');
                        $ref = $PhotoLibrary['ref'];
                    }

                    $this->CreateDir($ref);

                    foreach ($images as $file){
                        $fileName       = $file->baseName . '.' . $file->extension;
                        $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                        $savePath       = TblStore::UPLOAD_FOLDER.'/'.$ref.'/'. $realFileName;
                        if($file->saveAs($savePath)){

                            if($this->isImage(Url::base(true).'/'.$savePath)){
                                 $this->createThumbnail($ref,$realFileName);
                            }

                            $model                  = new Uploads;
                            $model->ref             = $ref;
                            $model->file_name       = $fileName;
                            $model->real_filename   = $realFileName;
                            $model->save();

                            if($isAjax===true){
                                echo json_encode(['success' => 'true']);
                            }

                        }else{
                            if($isAjax===true){
                                echo json_encode(['success'=>'false','eror'=>$file->error]);
                            }
                        }

                    }
                }
            }
    }

    private function getInitialPreview($ref) {
            $datas = Uploads::find()->where(['ref'=>$ref])->all();
            $initialPreview = [];
            $initialPreviewConfig = [];
            foreach ($datas as $key => $value) {
                array_push($initialPreview, $this->getTemplatePreview($value));
                array_push($initialPreviewConfig, [
                    'caption'=> $value->file_name,
                    'width'  => '120px',
                    'url'    => Url::to(['/tbl-store/deletefile-ajax']),
                    'key'    => $value->upload_id
                ]);
            }
            return  [$initialPreview,$initialPreviewConfig];
    }

    public function isImage($filePath){
            return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model){
            $filePath = TblStore::getUploadUrl().$model->ref.'/thumbnail/'.$model->real_filename;
            $isImage  = $this->isImage($filePath);
            if($isImage){
                $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
            }else{
                $file =  "<div class='file-preview-other'> " .
                         "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                         "</div>";
            }
            return $file;
    }

    private function createThumbnail($folderName, $fileName, $width = 250){
      $uploadPath   = TblStore::getUploadPath().'/'.$folderName.'/';
      //echo $uploadPath;
      $file         = $uploadPath.$fileName;
      $image        = Yii::$app->image->load($file);
      $image->resize($width);
      $image->save($uploadPath.'thumbnail/'.$fileName);
      return;
    }

    public function actionDeletefileAjax(){

        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if($model!==NULL){
            $filename  = TblStore::getUploadPath().$model->ref.'/'.$model->real_filename;
            $thumbnail = TblStore::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
            if($model->delete()){
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success'=>true]);
            }else{
                echo json_encode(['success'=>false]);
            }
        }else{
          echo json_encode(['success'=>false]);  
        }
    }
}
