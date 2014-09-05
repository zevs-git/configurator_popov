<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devicetype".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Configsave[] $configsaves
 * @property Device[] $devices
 * @property Firmware[] $firmwares
 * @property Settingsdictionaryvalue[] $settingsdictionaryvalues
 * @property Settingstodevicetype $settingstodevicetype
 * @property Settings[] $settings
 */
class DeviceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devicetype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50]
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigsaves()
    {
        return $this->hasMany(Configsave::className(), ['deviceTypeID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::className(), ['typeID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirmwares()
    {
        return $this->hasMany(Firmware::className(), ['deviceTypeID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettingsdictionaryvalues()
    {
        return $this->hasMany(Settingsdictionaryvalue::className(), ['deviceType' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettingstodevicetype()
    {
        return $this->hasOne(Settingstodevicetype::className(), ['deviceTypeID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::className(), ['id' => 'settingsID'])->viaTable('settingstodevicetype', ['deviceTypeID' => 'id']);
    }
}
