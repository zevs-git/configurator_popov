<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_settings_track".
 *
 * @property string $device_id
 * @property integer $curs
 * @property integer $speed
 * @property integer $interval_stop
 * @property integer $interval_packets
 * @property integer $flag_min_speed
 * @property integer $flag_move
 * @property integer $flag_start
 * @property integer $flag_nav_time
 *
 * @property Device $device
 */
class deviceSetingsTrack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_settings_track';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id'], 'required'],
            [['device_id', 'curs', 'speed', 'interval_stop', 'interval_packets', 'flag_min_speed', 'flag_move', 'flag_start', 'flag_nav_time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'Device ID'),
            'curs' => Yii::t('app', 'При измененнии курса на'),
            'speed' => Yii::t('app', 'При изменении скорости на'),
            'interval_stop' => Yii::t('app', 'Передача при стоянке каждые'),
            'interval_packets' => Yii::t('app', 'Минимальный интервал между пакетами'),
            'flag_min_speed' => Yii::t('app', 'При скорости меньше 2 км/ч'),
            'flag_move' => Yii::t('app', 'По датчику движения'),
            'flag_start' => Yii::t('app', 'По зажиганию'),
            'flag_nav_time' => Yii::t('app', 'Использовать время навигационного приемника'),
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
