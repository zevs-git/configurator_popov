<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_passport".
 *
 * @property string $device_id
 * @property string $made_date
 * @property string $sale_date
 * @property string $sim1
 * @property string $sim2
 * @property string $carmodel
 * @property string $gosnomer
 * @property string $object
 * @property string $comment
 *
 * @property Device $device
 */
class DevicePassport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_passport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id'], 'required'],
            [['device_id'], 'integer'],
            [['made_date', 'sale_date'], 'safe'],
            [['sim1', 'sim2'], 'string', 'max' => 15],
            [['comment'], 'string', 'max' => 255],            
            [['carmodel', 'gosnomer', 'object'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'ИД'),
            'made_date' => Yii::t('app', 'Дата производства'),
            'sale_date' => Yii::t('app', 'Дата покупки'),
            'sim1' => Yii::t('app', 'Номер симкарты 1'),
            'sim2' => Yii::t('app', 'Номер симкарты 2'),
            'carmodel' => Yii::t('app', 'Марка, модель ТС'),
            'gosnomer' => Yii::t('app', 'Гос. номер ТС'),
            'object' => Yii::t('app', 'Объект'),
            'comment' => Yii::t('app', 'Комментарий'),
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
