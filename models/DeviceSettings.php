<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devicesettings".
 *
 * @property string $deviceID
 * @property integer $settingsID
 * @property string $string
 * @property integer $value
 *
 * @property Settings $settings
 * @property Device $device
 */
class DeviceSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devicesettings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deviceID', 'settingsID'], 'required'],
            [['deviceID', 'settingsID', 'value'], 'integer'],
            [['string'], 'string', 'max' => 30],
            [['deviceID', 'settingsID'], 'unique', 'targetAttribute' => ['deviceID', 'settingsID'], 'message' => 'The combination of Device ID and Settings ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deviceID' => Yii::t('app', 'Device ID'),
            'settingsID' => Yii::t('app', 'Settings ID'),
            'string' => Yii::t('app', 'String'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasOne(Settings::className(), ['id' => 'settingsID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'deviceID']);
    }
}
