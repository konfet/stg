<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserPrizes;

class UserPrizesSearch extends UserPrizes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type', 'value', 'status', ], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = UserPrizes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
/*            'sort'=> [
                'defaultOrder'=>[
                'id'=> SORT_DESC
            ]]*/
            ]);
        
        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];
        
        
/*        $dataProvider->sort->attributes['updated_at'] = [ 
            'asc'  => [$this->tablename() . '.updated_at' => SORT_DESC ], 
            'desc' => [$this->tablename() . 'id' => SORT_ASC], 
        ]; */
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'status', $this->status]);
        
//  user should see only his own prizes
        $query->andFilterWhere(['user_id' => \Yii::$app->user->getId()]);

        return $dataProvider;
    }
}
