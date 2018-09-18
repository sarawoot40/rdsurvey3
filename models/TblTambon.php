<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tambon".
 *
 * @property integer $tambon_id
 * @property string $tambon_name
 */
class TblTambon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tambon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tambon_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tambon_id' => 'Tambon ID',
            'tambon_name' => 'Tambon Name',
        ];
    }
}
