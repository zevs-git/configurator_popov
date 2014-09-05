<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewDevices;

/**
 * ViewDevicesSerach represents the model behind the search form about `app\models\ViewDevices`.
 */
class ViewDevicesSerach extends ViewDevices
{
    public function rules()
    {
        return [
            [['id', 'typeID', 'firmwareID', 'distributorID', 'object_id', 'device_id'], 'integer'],
            [['imei', 'type', 'regDate', 'sale_date', 'settingsUpdateTime', 'lastContactTime', 'distributor', 'sim1', 'sim2', 'carmodel', 'gosnomer', 'comment'], 'safe'],
            [['firmware_version'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ViewDevices::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => isset($_SESSION['device_page_size'])?$_SESSION['device_page_size']:15,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'typeID' => $this->typeID,
            'regDate' => $this->regDate,
            'sale_date' => $this->sale_date,
            'firmwareID' => $this->firmwareID,
            'firmware_version' => $this->firmware_version,
            'settingsUpdateTime' => $this->settingsUpdateTime,
            'lastContactTime' => $this->lastContactTime,
            'distributorID' => $this->distributorID,
            'object_id' => $this->object_id,
            'device_id' => $this->device_id,
        ]);

        $query->andFilterWhere(['like', 'imei', $this->imei])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'distributor', $this->distributor])
            ->andFilterWhere(['like', 'sim1', $this->sim1])
            ->andFilterWhere(['like', 'sim2', $this->sim2])
            ->andFilterWhere(['like', 'carmodel', $this->carmodel])
            ->andFilterWhere(['like', 'gosnomer', $this->gosnomer])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
    
    public function getFavoriteDevices() {
        $query = ViewDevices::find();
        if (count($_SESSION['favorite_devices']) < 1) {
             $query->andFilterWhere(['id'=>-100]);
        }
        $query->andFilterWhere(['in', 'id', $_SESSION['favorite_devices']]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => isset($_SESSION['device_page_size'])?$_SESSION['device_page_size']:15,
            ],
        ]); 
         
         return $dataProvider;
        
    }
    public function getGridViewColumnsWS($face = true,$visible = true) {
        if (empty($_SESSION['device_visible'])) {
            $_SESSION['device_visible'] = 'id;imei;typeID;firmware_version;lastContactTime;sim1;distributorID;';
        }
        $SVOpt = explode(';', $_SESSION['device_visible']); 
        $columns = $this->getGridViewColumns();
        $res = [];
        if (is_array($SVOpt) && count($SVOpt) > 1) {
            if ($face) $res[] = $columns['check_col'];
            if ($visible) {
                foreach ($SVOpt as $col) {
                    if (isset($columns[$col])) {
                        $res[] = $columns[$col];
                    }
                }
            } else {
                foreach ($columns as $col) {
                    if (isset($col['attribute']) && !in_array($col['attribute'], $SVOpt)) {
                        $res[] = $col;
                    }
                } 
            }
            $res[] = $columns['actions'];
            
        } else {
            $res  = $visible? $columns : [];
        }
        return $res;
    }
            
    public function getGridViewColumns() {
        return [
                'check_col'=>['class' => \kartik\grid\DataColumn::className(),
                    'attribute' => 'id',
                    'format' => 'raw',
                    'filter'=>false,
                    'header'=>"<input class=d_select_all type=checkbox />",
                    'value' => function ($model, $index, $widget) {
                        $checked = array_search($model->id, $_SESSION['favorite_devices']) !== false?'checked':null;
                        return "<input class=dev_select name=d_select type=checkbox $checked value=$model->id />";
                    },
                    'order'=>  \kartik\dynagrid\DynaGrid::ORDER_FIX_LEFT
                    ],
                'id'=>['attribute' => 'id',
                    'width' => '5px'
                ],
                'imei'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'imei'
                ],
                'typeID'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'typeID',
                    'value' => 'type',
                    'filter' => \yii\helpers\ArrayHelper::map(\app\models\DeviceType::find()->asArray()->all(), 'id', 'name'),
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'width' => '150px',
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'...']
                ],
                'regDate'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'regDate',
                    'format' => ['date', 'd.m.Y'],
                //'filterType'=> \kartik\grid\GridView::FILTER_DATETIME
                    'visible' => false
                ],
                'sale_date'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'sale_date',
                    'format' => ['date', 'd.m.Y'],
                //'filterType'=> \kartik\grid\GridView::FILTER_DATETIME
                    'visible' => false
                ],
                'firmware_version'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'firmware_version',
                //'filterType'=> \kartik\grid\GridView::FILTER_SPIN,
                ],
                'lastContactTime'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'lastContactTime',
                    'format' => ['date', 'd.m.Y'],
                    
                //'filterType'=> \kartik\grid\GridView::FILTER_DATETIME
                ],
                'distributorID'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'distributorID',
                    'value' => 'distributor',
                    'filter' => \yii\helpers\ArrayHelper::map(\app\models\Distributor::find()->asArray()->all(), 'id', 'name'),
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'width' => '200px',
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'...']
                ],
                'object_id'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'object_id',
                    'width' => '00px',
                    'visible' => false
                //'filterType'=> \kartik\grid\GridView::FILTER_DATETIME
                ],
                'sim1'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'sim1',
                //'filterType'=> \kartik\grid\GridView::FILTER_DATETIME
                ],
                'sim2'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'sim2',
                    'visible' => false
                //'filterType'=> \kartik\grid\GridView::FILTER_DATETIME
                ],
                'carmodel'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'carmodel',
                    'visible' => false
                ],
                'gosnomer'=>['class' => 'kartik\grid\DataColumn',
                    'attribute' => 'gosnomer',
                ],
                'actions'=>['class' => \kartik\grid\ActionColumn::className(),
                    'template' => '{view}',
                    'width' => '30px',
                    'header' => '',
                    'viewOptions' => ['class'=>'btn btn-min btn-primary']
                ]
            ];
    }
}
