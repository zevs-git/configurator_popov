<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distributor".
 *
 * @property string $id
 * @property string $name
 * @property integer $typeID
 * @property string $parentID
 * @property string $regDate
 * @property integer $isActive
 *
 * @property Configsave[] $configsaves
 * @property Device[] $devices
 * @property Devicetodistributorhystory[] $devicetodistributorhystories
 * @property Distributor $parent
 * @property Distributor[] $distributors
 * @property Distributortype $type
 * @property Externalservice[] $externalservices
 * @property Log[] $logs
 * @property Maker[] $makers
 * @property User[] $users
 */
class Distributor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distributor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'typeID', 'regDate'], 'required'],
            [['typeID', 'parentID', 'isActive'], 'integer'],
            [['regDate'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Организация'),
            'typeID' => Yii::t('app', 'Type ID'),
            'parentID' => Yii::t('app', 'Parent ID'),
            'regDate' => Yii::t('app', 'Reg Date'),
            'isActive' => Yii::t('app', 'Is Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigsaves()
    {
        return $this->hasMany(Configsave::className(), ['distributorID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::className(), ['distributorID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicetodistributorhystories()
    {
        return $this->hasMany(Devicetodistributorhystory::className(), ['distributorID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Distributor::className(), ['id' => 'parentID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistributors()
    {
        return $this->hasMany(Distributor::className(), ['parentID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Distributortype::className(), ['id' => 'typeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExternalservices()
    {
        return $this->hasMany(Externalservice::className(), ['distributorID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['newDistributorID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakers()
    {
        return $this->hasMany(Maker::className(), ['distributorID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['distributorID' => 'id']);
    }
}
