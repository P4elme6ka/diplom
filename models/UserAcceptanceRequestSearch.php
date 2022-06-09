<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserAcceptanceRequest;

/**
 * UserAcceptanceRequestSearch represents the model behind the search form of `app\models\UserAcceptanceRequest`.
 */
class UserAcceptanceRequestSearch extends UserAcceptanceRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_original', 'user_id', 'acceptance_class_id'], 'integer'],
            [['date'], 'safe'],
            [['atestat_mean'], 'number'],
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
        $query = UserAcceptanceRequest::find();

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
            'id' => $this->id,
            'date' => $this->date,
            'is_original' => $this->is_original,
            'user_id' => $this->user_id,
            'atestat_mean' => $this->atestat_mean,
            'acceptance_class_id' => $this->acceptance_class_id,
        ]);

        return $dataProvider;
    }
}
