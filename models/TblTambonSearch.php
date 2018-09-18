<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblTambon;

/**
 * TblTambonSearch represents the model behind the search form about `app\models\TblTambon`.
 */
class TblTambonSearch extends TblTambon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tambon_id'], 'integer'],
            [['tambon_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TblTambon::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tambon_id' => $this->tambon_id,
        ]);

        $query->andFilterWhere(['like', 'tambon_name', $this->tambon_name]);

        return $dataProvider;
    }
}
