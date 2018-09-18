<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_store_type".
 *
 * @property integer $type_id
 * @property string $type_name
 */
class TblStoreType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_store_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'รหัสประเภท',
            'type_name' => 'ประเภทกิจการ',
        ];
    }
}
