<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\configuration;

/**
 * configurationSearch represents the model behind the search form about `app\models\configuration`.
 */
class configurationSearch extends configuration
{
    public function rules()
    {
        return [
            [['id', 'deviceTypeID', 'isActive', 'isDefault', 'distributorID', 'isDelete'], 'integer'],
            [['name', 'description', 'regDate', 'json'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = configuration::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'deviceTypeID' => $this->deviceTypeID,
            'isActive' => $this->isActive,
            'regDate' => $this->regDate,
            'isDefault' => $this->isDefault,
            'distributorID' => $this->distributorID,
            'isDelete' => $this->isDelete,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'json', $this->json]);

        return $dataProvider;
    }
}
