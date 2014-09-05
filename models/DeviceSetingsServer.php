<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_setings_server".
 *
 * @property string $device_id
 * @property string $dns_ip1
 * @property string $dns_ip2
 * @property string $port1
 * @property string $port2
 * @property string $protocol_id1
 * @property integer $protocol_id2
 * @property string $login1
 * @property string $password1
 * @property string $login2
 * @property string $password2
 *
 * @property Device $device
 */
class deviceSetingsServer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_setings_server';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id'], 'required'],
            [['device_id', 'port1', 'port2', 'protocol_id1', 'protocol_id2'], 'integer'],
            [['dns_ip1', 'dns_ip2'], 'string', 'max' => 50],
            [['login1', 'password1', 'login2', 'password2'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'ID устройтва'),
            'dns_ip1' => Yii::t('app', 'DNS/IP'),
            'dns_ip2' => Yii::t('app', 'DNS/IP'),
            'port1' => Yii::t('app', 'Порт'),
            'port2' => Yii::t('app', 'Порт'),
            'protocol_id1' => Yii::t('app', 'Протокол'),
            'protocol_id2' => Yii::t('app', 'Протокол'),
            'login1' => Yii::t('app', 'Логин'),
            'password1' => Yii::t('app', 'Пароль'),
            'login2' => Yii::t('app', 'Логин'),
            'password2' => Yii::t('app', 'Пароль'),
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
