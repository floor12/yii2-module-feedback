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
    public $date_from;
    public $date_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filter', 'date_from', 'date_to'], 'string'],
            [['status', 'type'], 'integer']
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @return ActiveDataProvider
     */
    public function dataProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->getQuery(),
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
    }

    public function getQuery()
    {
        $query = Feedback::find()
            ->andFilterWhere(['=', 'status', $this->status])
            ->andFilterWhere(['=', 'type', $this->type])
            ->andFilterWhere(['OR', ['LIKE', 'email', $this->filter], ['LIKE', 'content', $this->filter], ['LIKE', 'name', $this->filter], ['LIKE', 'phone', $this->filter]]);

        if ($this->date_from)
            $query->andWhere(['>=', 'created_at', strtotime($this->date_from)]);

        if ($this->date_to)
            $query->andWhere(['<=', 'created_at', strtotime($this->date_to)]);


        if (!$this->validate()) {
            $query->where('0=1');
        }

        return $query;
    }
}
