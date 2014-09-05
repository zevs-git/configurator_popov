<?php

namespace app\controllers;

use Yii;
use app\models\Device;
use app\models\DeviceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeviceController implements the CRUD actions for Device model.
 */
class DeviceController extends Controller
{
    public function behaviors() {
        return [ 'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [ 'allow' => true, 'roles' => ['@']],
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
     * Lists all Device models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (empty($_SESSION['favorite_devices'])) {
            $_SESSION['favorite_devices'] = [];
        }
        
        $searchModel = new \app\models\ViewDevicesSerach;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        $favoriteDivices = $searchModel->getFavoriteDevices();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'favoriteDivices' => $favoriteDivices,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Device model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = "device_settings";
        
        $passport = \app\models\DevicePassport::findOne($id);
        if (!$passport) {
            $passport = new \app\models\DevicePassport(); 
            $passport->device_id = $id;
            $passport->save();
        }
        
        if ($passport->load(Yii::$app->request->post()) && $passport->save()) {
            $is_save = true;
        } else {
            $is_save = false;
        }
        
        
        return $this->render('passport', [
            'model' => $this->findModel($id),
            'passport' => $passport,
            'is_save' => $is_save
        ]);
    }
    
    public function actionSettingsserver($id)
    {
        $this->layout = "device_settings";
        
        $set_model = \app\models\DeviceSetingsServer::findOne($id);
        if (!$set_model) {
            $set_model = new \app\models\DeviceSetingsServer(); 
            $set_model->device_id = $id;
            $set_model->save();
        }
        
        if ($set_model->load(Yii::$app->request->post()) && $set_model->save()) {
            $is_save = true;
        } else {
            $is_save = false;
        }
        
        
        return $this->render('server_settings', [
            'model' => $this->findModel($id),
            'set_model' => $set_model,
            'is_save' => $is_save
        ]);
    }
    
     
    public function actionSettingssystem($id)
    {
        $this->layout = "device_settings";
        
        $set_model = \app\models\DeviceSettingsSystem::findOne($id);
        if (!$set_model) {
            $set_model = new \app\models\DeviceSettingsSystem(); 
            $set_model->device_id = $id;
            $set_model->save();
        }
        
        if ($set_model->load(Yii::$app->request->post()) && $set_model->save()) {
            $is_save = true;
        } else {
            $is_save = false;
        }
        
        
        return $this->render('system_settings', [
            'model' => $this->findModel($id),
            'set_model' => $set_model,
            'is_save' => $is_save
        ]);
    }
    
    public function actionSettingstrack ($id)
    {
        $this->layout = "device_settings";
        
        $set_model = \app\models\deviceSetingsTrack::findOne($id);
        if (!$set_model) {
            $set_model = new \app\models\deviceSetingsTrack(); 
            $set_model->device_id = $id;
            $set_model->save();
        }
        
        if ($set_model->load(Yii::$app->request->post()) && $set_model->save()) {
            $is_save = true;
        } else {
            $is_save = false;
        }
        
        
        return $this->render('track_settings', [
            'model' => $this->findModel($id),
            'set_model' => $set_model,
            'is_save' => $is_save
        ]);
    }
    public function actionSettingssim ($id)
    {
        $this->layout = "device_settings";
        
        $set_model1 = \app\models\DeviceSettingsSim::findOne($id);
        $set_model2 = new \app\models\DeviceSettingsSim();
        if (!$set_model1) {
            $set_model1 = new \app\models\DeviceSettingsSim(); 
            $set_model1->device_id = $id;
            $set_model1->save();
        }
        
        if ($set_model1->load(Yii::$app->request->post()) && $set_model1->save()) {
            $is_save = true;
        } else {
            $is_save = false;
        }
        
        
        return $this->render('sim_settings', [
            'model' => $this->findModel($id),
            'set_model1' => $set_model1,
            'set_model2' => $set_model2,
            'is_save' => $is_save
        ]);
    }

    /**
     * Creates a new Device model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Device;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Device model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionGridoptions() {
        $_SESSION['device_visible'] = $_REQUEST['device_visible'];
        $_SESSION['device_page_size'] = $_REQUEST['device_page_size'];
    }

    /**
     * Deletes an existing Device model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionAddfavorite($id)
    {
        if(!count($_SESSION['favorite_devices'])) {
            $_SESSION['favorite_devices'] = [];
        }
        
        if(!in_array($id, $_SESSION['favorite_devices'])) {
            $_SESSION['favorite_devices'][] = $id;
        }
        print count($_SESSION['favorite_devices']);
    }
    
    public function actionRemovefavorite($id)
    {
        if(($key = array_search($id, $_SESSION['favorite_devices'])) !== false) {
            unset($_SESSION['favorite_devices'][$key]);
        }
        print count($_SESSION['favorite_devices']);
    }
    public function actionGetfavoritecount()
    {
        print count($_SESSION['favorite_devices']);

    }

    /**
     * Finds the Device model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
