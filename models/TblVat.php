<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_vat".
 *
 * @property int $vat_id
 * @property string $vat_name
 * @property string $colormark
 */
class TblVat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_vat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vat_name', 'colormark'], 'required'],
            [['vat_name'], 'string', 'max' => 50],
            [['colormark'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vat_id' => 'Vat ID',
            'vat_name' => 'ประเภทภาษี',
            'colormark' => 'mark',
        ];
    }
}
