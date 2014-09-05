<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_model".
 *
 * @property string $id
 * @property string $model_name
 * @property string $image_name
 *
 * @property DevicePassport[] $devicePassports
 */
class DeviceModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_name', 'image_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model_name' => Yii::t('app', 'Модель'),
            'image_name' => Yii::t('app', 'Изображение'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicePassports()
    {
        return $this->hasMany(DevicePassport::className(), ['model_id' => 'id']);
    }
}
