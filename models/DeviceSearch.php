<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Device;

/**
 * DeviceSearch represents the model behind the search form about `app\models\Device`.
 */
class DeviceSearch extends Device
{
    //public $type;
 
    
    public function rules()
    {
        return [
            [['id', 'typeID', 'firmwareID', 'customID', 'object_id', 'distributorID', 'isActive', 'lastContactID'], 'integer'],
            [['imei', 'regDate', 'firmwareUpdateTime', 'settingsUpdateTime', 'lastContactTime'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Device::find();
        
        //$query->joinWith(['type']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        /*$dataProvider->sort->attributes['type.name'] = [
            // The tables are the ones our relation are configured to
            'asc'  => ['devicetype.name' => SORT_ASC],
            'desc' => ['devicetype.name' => SORT_DESC],
        ];*/
        
        /*$dataProvider->sort->attributes['firmware.version'] = [
            // The tables are the ones our relation are configured to
            'asc'  => ['firmware.version' => SORT_ASC],
            'desc' => ['firmware.version' => SORT_DESC],
        ];*/

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'typeID' => $this->typeID,
            'firmwareID' => $this->firmwareID,
            'customID' => $this->customID,
            'object_id' => $this->object_id,
            'distributorID' => $this->distributorID,
            'regDate' => $this->regDate,
            'isActive' => $this->isActive,
            'firmwareUpdateTime' => $this->firmwareUpdateTime,
            'settingsUpdateTime' => $this->settingsUpdateTime,
            'lastContactTime' => $this->lastContactTime,
            'lastContactID' => $this->lastContactID,
            //'firmware.version' => $this->firmware->version,
        ]);

        $query->andFilterWhere(['like', 'imei', $this->imei]);
        
        //$query->andFilterWhere(['like', 'devicetype.name', $this->type]);

        return $dataProvider;
    }
}
