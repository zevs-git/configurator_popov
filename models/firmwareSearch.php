<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\firmware;

/**
 * firmwareSearch represents the model behind the search form about `app\models\firmware`.
 */
class firmwareSearch extends firmware
{
    public function rules()
    {
        return [
            [['id', 'isDefault', 'version', 'deviceTypeID', 'isRelease'], 'integer'],
            [['description', 'regDate'], 'safe'],
            [['isActive'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = firmware::find();
        
        $query->joinWith(['deviceType']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $dataProvider->sort->attributes['deviceType.name'] = [
            // The tables are the ones our relation are configured to
            'asc'  => ['devicetype.name' => SORT_ASC],
            'desc' => ['devicetype.name' => SORT_DESC],
        ];
        
        $query->andFilterWhere([
            'id' => $this->id,
            'isDefault' => $this->isDefault,
            'version' => $this->version,
            'deviceTypeID' => $this->deviceTypeID,
            'regDate' => $this->regDate,
            'isRelease' => $this->isRelease,
            'isActive' => $this->isActive,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
