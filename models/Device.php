<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property string $id
 * @property string $imei
 * @property integer $typeID
 * @property string $firmwareID
 * @property string $customID
 * @property integer $object_id
 * @property string $distributorID
 * @property string $regDate
 * @property integer $isActive
 * @property string $firmwareUpdateTime
 * @property string $settingsUpdateTime
 * @property string $lastContactTime
 * @property integer $lastContactID
 * @property string $model_id
 *
 * @property DeviceModel $model
 * @property Devicetype $type
 * @property Firmware $firmware
 * @property Distributor $distributor
 * @property DevicePassport $devicePassport
 * @property Devicesettings $devicesettings
 * @property Settings[] $settings
 * @property Devicetodistributorhystory $devicetodistributorhystory
 * @property Externalservicenewdevice $externalservicenewdevice
 * @property Externalservice[] $externalServices
 * @property Log[] $logs
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeID', 'firmwareID', 'customID', 'object_id', 'distributorID', 'isActive', 'lastContactID', 'model_id'], 'integer'],
            [['customID', 'regDate'], 'required'],
            [['regDate', 'firmwareUpdateTime', 'settingsUpdateTime', 'lastContactTime'], 'safe'],
            [['imei'], 'string', 'max' => 15],
            [['customID', 'distributorID'], 'unique', 'targetAttribute' => ['customID', 'distributorID'], 'message' => 'The combination of Custom ID and Дилер has already been taken.'],
            [['customID'], 'unique'],
            [['imei'], 'unique']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'imei' => Yii::t('app', 'IMEI'),
            'typeID' => Yii::t('app', 'Тип'),
            'type.name' => Yii::t('app', 'Тип'),
            'firmwareID' => Yii::t('app', 'Версия ПО'),
            'firmware.version' => Yii::t('app', 'Версия ПО'),
            'customID' => Yii::t('app', 'Версия настроек'),
            'distributorID' => Yii::t('app', 'Дилер'),
            'regDate' => Yii::t('app', 'Дата регистрации'),
            'isActive' => Yii::t('app', 'Активно'),
            'firmwareUpdateTime' => Yii::t('app', 'Обновление ПО'),
            'settingsUpdateTime' => Yii::t('app', 'Обновление настроек'),
            'lastContactTime' => Yii::t('app', 'Last Contact Time'),
            'lastContactID' => Yii::t('app', 'Last Contact ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(DeviceModel::className(), ['id' => 'model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Devicetype::className(), ['id' => 'typeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirmware()
    {
        return $this->hasOne(Firmware::className(), ['id' => 'firmwareID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistributor()
    {
        return $this->hasOne(Distributor::className(), ['id' => 'distributorID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicePassport()
    {
        return $this->hasOne(DevicePassport::className(), ['device_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicesettings()
    {
        return $this->hasOne(Devicesettings::className(), ['deviceID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::className(), ['id' => 'settingsID'])->viaTable('devicesettings', ['deviceID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicetodistributorhystory()
    {
        return $this->hasOne(Devicetodistributorhystory::className(), ['deviceID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExternalservicenewdevice()
    {
        return $this->hasOne(Externalservicenewdevice::className(), ['deviceID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExternalServices()
    {
        return $this->hasMany(Externalservice::className(), ['id' => 'externalServiceID'])->viaTable('externalservicenewdevice', ['deviceID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['deviceID' => 'id']);
    }
}
