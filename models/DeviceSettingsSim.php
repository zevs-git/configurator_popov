<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_settings_sim".
 *
 * @property string $device_id
 * @property string $APN
 * @property string $login
 * @property string $password
 * @property string $PIN
 * @property string $USSD
 * @property integer $is_rouming
 *
 * @property Device $device
 */
class DeviceSettingsSim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_settings_sim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_rouming'], 'integer'],
            [['APN', 'login', 'password', 'PIN'], 'string', 'max' => 50],
            [['USSD'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'ID'),
            'APN' => Yii::t('app', 'APN'),
            'login' => Yii::t('app', 'Логин'),
            'password' => Yii::t('app', 'Пароль'),
            'PIN' => Yii::t('app', 'PIN-код'),
            'USSD' => Yii::t('app', 'USSD запрос балнса'),
            'is_rouming' => Yii::t('app', 'Рруминг разрешен'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }
}
