<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblStore;

/**
 * TblStoreSearch represents the model behind the search form about `app\models\TblStore`.
 */
class TblStoreSearch extends TblStore
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'user_id', 'store_type_id', 'tambon_id'], 'integer'],
            [['store_name', 'owner_name', 'tin', 'pin', 'address', 'tel', 'store_type_id', 'store_desc', 'emp_total', 'vat', 'start_date', 'tax_link', 'img', 'lat', 'long', 'create_date', 'update_date'], 'safe'],
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
        $query = TblStore::find();

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
            'store_id' => $this->store_id,
            'start_date' => $this->start_date,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'store_name', $this->store_name])
            ->andFilterWhere(['like', 'owner_name', $this->owner_name])
            ->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'pin', $this->pin])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'store_type_id', $this->store_type_id])
            ->andFilterWhere(['like', 'tambon_id', $this->tambon_id])                
            ->andFilterWhere(['like', 'store_desc', $this->store_desc])
            ->andFilterWhere(['like', 'emp_total', $this->emp_total])
            ->andFilterWhere(['like', 'vat', $this->vat])
            ->andFilterWhere(['like', 'tax_link', $this->tax_link])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long]);

        return $dataProvider;
    }
}
