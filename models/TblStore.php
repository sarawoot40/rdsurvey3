<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\html;
use app\models\Uploads;

/**
 * This is the model class for table "tbl_store".
 *
 * @property integer $store_id
 * @property string $store_name
 * @property string $owner_name
 * @property string $tin
 * @property string $pin
 * @property string $address
 * @property string $tel
 * @property integer $store_type_id
 * @property integer $tambon_id
 * @property string $store_desc
 * @property string $emp_total
 * @property integer $vat
 * @property string $start_date
 * @property string $tax_link
 * @property string $img
 * @property string $lat
 * @property string $long
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 * @property string $ref
 */
class TblStore extends \yii\db\ActiveRecord
{
    const UPLOAD_FOLDER='photolibrarys';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'create_date', 'update_date'], 'safe'],
            [['user_id', 'store_type_id', 'tambon_id', 'num_table', 'vat'], 'integer'],
            [['store_name', 'owner_name', 'address', 'store_desc', 'tax_link', 'img'], 'string', 'max' => 200],
            [['tin', 'pin', 'tel', 'emp_total', 'lat', 'long', 'ref'], 'string', 'max' => 100],
            [['num_table'], 'default', 'value' => 0],[['store_type_id', 'tambon_id','vat'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => 'รหัสร้าน',
            'store_name' => 'ชื่อสถานประกอบการ',
            'owner_name' => 'ชื่อผู้เสียภาษี',
            'tin' => 'TIN(รหัสร้าน)',
            'pin' => 'เลขประจำตัวประชาชน',
            'address' => 'ที่อยู่',
            'tel' => 'โทรศัพท์',
            'store_type_id' => 'ประเภทกิจการ',
            'tambon_id' => 'เขตตำบล',
            'store_desc' => 'ลักษณะการบริการ',
            'emp_total' => 'พนักงาน',
            'vat' => 'VAT',
            'start_date' => 'วันที่เริ่มประกอบกิจการ',
            'tax_link' => 'การชำระภาษี',
            'img' => 'รูปถ่าย',
            'lat' => 'ละติจูด',
            'long' => 'ลองติจูด',
            'create_date' => 'วันที่บันทึก',
            'update_date' => 'วันที่แก้ไข',
            'user_id' => 'ผู้บันทึก',
            'ref' => 'refAjax'
        ];
    }
    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function getThumbnails($ref,$event_name){
         $uploadFiles   = Uploads::find()->where(['ref'=>$ref])->all();
         $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url' => self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                'src' => self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                'options' => [
                                'title' => $event_name,
                             ]
            ];
        }
        return $preview;
    }
    
    public function getType(){
        return $this->hasOne(TblStoreType::className(), ['type_id' => 'store_type_id']);
    }

    public function getTax(){
        return $this->hasOne(TblVat::className(), ['vat_id' => 'vat']);
    }

    public static function getItems($id)
    {
        $strSQL = 'select b.type_name
            ,c.tambon_name
            ,a.store_name 
            ,a.store_id,d.vat_name
            from tbl_store a
            inner join tbl_store_type b on a.store_type_id = b.type_id
            inner join tbl_tambon c on a.tambon_id = c.tambon_id
            inner join tbl_vat d on a.vat = d.vat_id
            where c.tambon_id = '.$id.' 
            order by a.store_type_id,a.tambon_id,a.vat asc';

        $rawData = Yii::$app->db->createCommand($strSQL)->queryAll();

        return $rawData;
    }
    
    public static function  getMenu(){
        $strSQL = 'select tambon_id from tbl_store group by tambon_id
                    order by tambon_id asc';
        $rawData = Yii::$app->db->createCommand($strSQL)->queryAll();

            $menu = '';
            $chkName = '';
            $chkstoreName = '';

        for($i = 0; $i < count($rawData); $i++)
        {
            $mData = self::getItems($rawData[$i]['tambon_id']);
            
            for($j=0; $j<count($mData); $j++)
            {

                if($j == 0)
                {
                    $menu .= '<li>
                        <a href="#"><i class="fa fa-home" aria-hidden="true"></i> '.$mData[$j]['tambon_name'].'
                          <span class="fa arrow"></span></a><ul class="nav nav-second-level">';
                
                }
                if($mData[$j]['type_name'] != $chkName){
                    $menu .= '<li><a href="#">'.$mData[$j]['type_name'].' <span class="fa arrow"></span></a>';
                    $menu .= '<ul class="nav nav-third-level">';

                    for($k=0;$k<count($mData);$k++)
                    {
                        if($mData[$k]['type_name'] == $mData[$j]['type_name']){
                        $url = Yii::$app->urlManager->createUrl(['tbl-store/view-detail', 'id' => $mData[$k]['store_id']]);
                         $menu .= '<li><a href="'.$url.'">'.$mData[$k]['store_name'].'</a></li>';
                        }
                    }

                    $menu .= '</ul></li>';
                }

                $chkName = $mData[$j]['type_name'];
            }
            $menu .='</ul>';
            $chkName = '';
        }
        $menu .= '</li>';
        
        return $menu;
    }
}
