<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblVat;

/**
 * TblVatSearch represents the model behind the search form of `app\models\TblVat`.
 */
class TblVatSearch extends TblVat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vat_id'], 'integer'],
            [['vat_name', 'colormark'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TblVat::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'vat_id' => $this->vat_id,
        ]);

        $query->andFilterWhere(['like', 'vat_name', $this->vat_name])
            ->andFilterWhere(['like', 'colormark', $this->colormark]);

        return $dataProvider;
    }
}
