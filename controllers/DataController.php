<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\UserPrizes;

class DataController extends Controller {
    /**
     * actions for the user currently logged in
     */
        
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function getUser()
    {
        return \app\models\User::findOne(['id' => Yii::$app->user->getId()]);       
    }
    
    
/*    public function beforeAction($action)
    {
        $this->user = \app\models\User::findOne(['id' => Yii::$app->user->getId()]);
        return parent::beforeAction($action);
    }  */
    
    public function actionStatistics() {
        $model = $this->user->statistics;
        //return '<pre>'. print_r($model);
        return $this->render('statistics', [
            'model' => $model,
        ]);
    }
    
    public function actionSettings() {
        $model = $this->user;        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goHome();
        }
        return $this->render('settings', ['user' => $model,]);
    }
    
    public function actionPrizes() {
   
        $searchModel = new \app\models\UserPrizesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('prizes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id) {
        $model = \app\models\UserPrizes::findOne($id);
        return $this->render('viewPrize', [
            'model' => $model,
        ]);            
    }    
    
//  ACTIONS WITH PRIZE
    public function actionTransfer($id) {
        $model = UserPrizes::findOne($id);
        $model->transfer();
        return $this->goHome();
    }    
    
    public function actionConvert($id) {
        $model = UserPrizes::findOne($id);
        $model->convert();
        return $this->goHome();
    }    

    public function actionRefuse($id) {
        $model = UserPrizes::findOne($id);
        $model->refuse();
        return $this->goHome();
    }    
    
}