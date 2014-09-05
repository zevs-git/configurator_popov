<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $length
 * @property string $defaultValue
 * @property string $description
 *
 * @property Devicesettings $devicesettings
 * @property Device[] $devices
 * @property Settingsdictionaryvalue[] $settingsdictionaryvalues
 * @property Settingstodevicetype $settingstodevicetype
 * @property Devicetype[] $deviceTypes
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'length', 'defaultValue'], 'required'],
            [['type', 'length'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['defaultValue'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 250],
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
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'length' => Yii::t('app', 'Length'),
            'defaultValue' => Yii::t('app', 'Default Value'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicesettings()
    {
        return $this->hasOne(Devicesettings::className(), ['settingsID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::className(), ['id' => 'deviceID'])->viaTable('devicesettings', ['settingsID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettingsdictionaryvalues()
    {
        return $this->hasMany(Settingsdictionaryvalue::className(), ['settingsID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettingstodevicetype()
    {
        return $this->hasOne(Settingstodevicetype::className(), ['settingsID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceTypes()
    {
        return $this->hasMany(Devicetype::className(), ['id' => 'deviceTypeID'])->viaTable('settingstodevicetype', ['settingsID' => 'id']);
    }
}
