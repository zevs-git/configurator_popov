<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_settings_system".
 *
 * @property string $device_id
 * @property integer $flag_lat_long
 * @property integer $flag_speed
 * @property integer $flag_PVH
 * @property integer $flag_info_mess
 * @property integer $flag_sates
 * @property integer $flag_signal
 * @property integer $flag_LAC_CID
 * @property integer $flag_power
 * @property integer $device_mode_id
 * @property integer $flag_settingscheck
 * @property integer $settings_check_time
 * @property integer $dinamic_volume
 * @property integer $mic_volume
 * @property integer $flag_sensor_filter
 * @property integer $power_save_id
 * @property integer $deep_power
 * @property integer $deep_interval
 * @property integer $deep_timeout
 * @property integer $flag_deep_sensor
 * @property integer $flag_deep_in_out
 * @property integer $flag_deep_move
 *
 * @property Device $device
 */
class DeviceSettingsSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_settings_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flag_lat_long', 'flag_speed', 'flag_PVH', 'flag_info_mess', 'flag_sates', 'flag_signal', 'flag_LAC_CID', 'flag_power', 'device_mode_id', 'flag_settingscheck', 'settings_check_time', 'dinamic_volume', 'mic_volume', 'flag_sensor_filter', 'power_save_id', 'deep_power', 'deep_interval', 'deep_timeout', 'flag_deep_sensor', 'flag_deep_in_out', 'flag_deep_move'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'ID устройства'),
            'flag_lat_long' => Yii::t('app', 'GPS/Glonass координаты: широта, долгота'),
            'flag_speed' => Yii::t('app', 'GPS/Glonass параметры: скорость, высота, спутники (GPS,Glonass), азимут'),
            'flag_PVH' => Yii::t('app', 'GPS/Glonass доп. параметры: PDOP, VDOP, HDOP'),
            'flag_info_mess' => Yii::t('app', 'Информационные сообщения (ошибки, статусы и прочее)'),
            'flag_sates' => Yii::t('app', 'Статусы устройства: побитовое состояние входов, побитовое состояние выходов, приемника, статус датчика движения, наличие симкарты, симкарта / симчип'),
            'flag_signal' => Yii::t('app', 'уровень сигнала GSM + параметры оператора (код страны и оператора)'),
            'flag_LAC_CID' => Yii::t('app', 'LAC и CID текущей базовой станции'),
            'flag_power' => Yii::t('app', 'Бортовое напряжение в мВ и напряжене аккумаулятора'),
            'device_mode_id' => Yii::t('app', 'Режим устройтва'),
            'flag_settingscheck' => Yii::t('app', 'Проверка настроек при каждом старте'),
            'settings_check_time' => Yii::t('app', 'Каждые'),
            'dinamic_volume' => Yii::t('app', 'Уровень громкости динамика'),
            'mic_volume' => Yii::t('app', 'Уровень чуствительности микрофона'),
            'flag_sensor_filter' => Yii::t('app', 'Фильтровать значения с датчиков'),
            'power_save_id' => Yii::t('app', 'Режим энергосбережения'),
            'deep_power' => Yii::t('app', 'Напряжении притания меньше'),
            'deep_interval' => Yii::t('app', 'Выходить на связь каждые'),
            'deep_timeout' => Yii::t('app', 'Время прибывания на связи'),
            'flag_deep_sensor' => Yii::t('app', 'Срабатывание датчика движения'),
            'flag_deep_in_out' => Yii::t('app', 'При изменении состояния дискретного входа (входов)'),
            'flag_deep_move' => Yii::t('app', 'Не переходить в режим сна при движении (по датчику движения)'),
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
