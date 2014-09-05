<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "firmware".
 *
 * @property string $id
 * @property integer $isDefault
 * @property integer $version
 * @property integer $deviceTypeID
 * @property string $description
 * @property string $regDate
 * @property integer $isRelease
 * @property double $isActive
 *
 * @property Device[] $devices
 * @property Devicetype $deviceType
 * @property Log[] $logs
 */
class firmware extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'firmware';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isDefault', 'version', 'deviceTypeID', 'isRelease'], 'integer'],
            [['version', 'deviceTypeID', 'description', 'regDate'], 'required'],
            [['regDate'], 'safe'],
            [['isActive'], 'number'],
            [['description'], 'string', 'max' => 500],
            [['version', 'deviceTypeID'], 'unique', 'targetAttribute' => ['version', 'deviceTypeID'], 'message' => 'The combination of Версия and Тип устройтва has already been taken.'],
            [['isDefault', 'deviceTypeID'], 'unique', 'targetAttribute' => ['isDefault', 'deviceTypeID'], 'message' => 'The combination of По умолчанию and Тип устройтва has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isDefault' => 'По умолчанию',
            'version' => 'Версия ПО',
            'versionval' => 'Версия ПО',
            'dataFile' => 'Файл',
            'deviceTypeID' => 'Тип устройтва',
            'description' => 'Описание',
            'regDate' => 'Дата создания',
            'isRelease' => 'Релиз',
            'isActive' => 'Активно',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::className(), ['firmwareID' => 'id']);
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
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['newFrimwareID' => 'id']);
    }
    
    public function getversionval() {
        return !empty($this->version)? $this->version / 100 : NULL;
    }
    public function getDataFile() {
        return 'файл';
    }
}
