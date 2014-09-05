<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configsave".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $deviceTypeID
 * @property integer $isActive
 * @property string $regDate
 * @property string $json
 * @property integer $isDefault
 * @property string $distributorID
 * @property integer $isDelete
 *
 * @property Devicetype $deviceType
 * @property Distributor $distributor
 */
class configuration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configsave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'deviceTypeID', 'regDate', 'json'], 'required'],
            [['deviceTypeID', 'isActive', 'isDefault', 'distributorID', 'isDelete'], 'integer'],
            [['regDate'], 'safe'],
            [['json'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            [['deviceTypeID', 'isDefault', 'distributorID'], 'unique', 'targetAttribute' => ['deviceTypeID', 'isDefault', 'distributorID'], 'message' => 'The combination of Тип устройтва, По умолчанию and Дилер has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'deviceTypeID' => Yii::t('app', 'Тип устройтва'),
            'isActive' => Yii::t('app', 'Активна'),
            'regDate' => Yii::t('app', 'Дата создания'),
            'json' => Yii::t('app', 'Данные'),
            'isDefault' => Yii::t('app', 'По умолчанию'),
            'distributorID' => Yii::t('app', 'Дилер'),
            'isDelete' => Yii::t('app', 'Удалена'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceType()
    {
        return $this->hasOne(Devicetype::className(), ['id' => 'deviceTypeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistributor()
    {
        return $this->hasOne(Distributor::className(), ['id' => 'distributorID']);
    }
}
