<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "v_devices".
 *
 * @property string $id
 * @property string $imei
 * @property integer $typeID
 * @property string $type
 * @property string $regDate
 * @property string $sale_date
 * @property string $firmwareID
 * @property string $firmware_version
 * @property string $settingsUpdateTime
 * @property string $lastContactTime
 * @property string $distributorID
 * @property string $distributor
 * @property integer $object_id
 * @property string $device_id
 * @property string $sim1
 * @property string $sim2
 * @property string $carmodel
 * @property string $gosnomer
 * @property string $comment
 */
class ViewDevices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_devices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeID', 'firmwareID', 'distributorID', 'object_id', 'device_id'], 'integer'],
            [['regDate', 'sale_date', 'settingsUpdateTime', 'lastContactTime'], 'safe'],
            [['firmware_version'], 'number'],
            [['imei', 'sim1', 'sim2'], 'string', 'max' => 15],
            [['type', 'distributor'], 'string', 'max' => 50],
            [['carmodel', 'gosnomer'], 'string', 'max' => 20],
            [['comment'], 'string', 'max' => 255]
        ];
    }
    
    public static function primaryKey() {
        parent::primaryKey();
        return ['id'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'imei' => Yii::t('app', 'IMEI'),
            'typeID' => Yii::t('app', 'Модель'),
            'type' => Yii::t('app', 'Модель'),
            'regDate' => Yii::t('app', 'Дата регистрации'),
            'sale_date' => Yii::t('app', 'Дата продажи'),
            'firmwareID' => Yii::t('app', 'Организация'),
            'firmware_version' => Yii::t('app', 'Версия ПО'),
            'settingsUpdateTime' => Yii::t('app', 'Посл. обн. настроек'),
            'lastContactTime' => Yii::t('app', 'Последний контакт'),
            'distributorID' => Yii::t('app', 'Дилер'),
            'distributor' => Yii::t('app', 'Distributor'),
            'object_id' => Yii::t('app', 'Объект'),
            'device_id' => Yii::t('app', 'ИД'),
            'sim1' => Yii::t('app', 'Номер симкарты 1'),
            'sim2' => Yii::t('app', 'Номер симкарты 2'),
            'carmodel' => Yii::t('app', 'Марка, модель ТС'),
            'gosnomer' => Yii::t('app', 'Гос. номер ТС'),
            'comment' => Yii::t('app', 'Комментарий'),
        ];
    }
}
