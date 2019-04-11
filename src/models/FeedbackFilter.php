<?php

namespace floor12\feedback\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FeedbackFilter represents the model behind the search form of `floor12\feedback\models\Feedback`.
 */
class FeedbackFilter extends Model

{
    public $filter;
    public $status;
    public $type;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['filter', 'string'],
            [['status', 'type'], 'integer']
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function dataProvider()
    {
        $query = Feedback::find()
            ->andFilterWhere(['=', 'status', $this->status])
            ->andFilterWhere(['=', 'type', $this->type])
            ->andFilterWhere(['OR', ['LIKE', 'email', $this->filter], ['LIKE', 'content', $this->filter], ['LIKE', 'name', $this->filter], ['LIKE', 'phone', $this->filter]]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
