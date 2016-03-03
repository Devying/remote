<?php
public function search($params) {
    // $query = NbAopAdlist::find()->andWhere('=','order',Yii::$app->request->get('order_id'));
    $query = new Query();
    $query->select(['naa.id', 'nau.nickname', 'naa.uid', 'naa.name', 'nao.name as oname', 'nao.status as ostatus', 'naa.size', 'target_location', 'naa.type', 'naa.img_id', 'nao.web', 'naa.indent', 'naa.status', 'naa.create_time', 'naa.create_time', 'naa.address', 'naa.s_address', 'naa.describe'])->from(['nb_aop_adlist as naa', 'nb_aop_orderlist as nao', 'nb_aop_user as nau'])->where('nau.id = naa.uid and nao.id = naa.indent');
    if ($id = Yii::$app->request->get('ad_id')) {
        $query->andWhere(['naa.id' => $id]);
    }
    if ($params['AdSearch']['product'] != '') {
        $query->andWhere(['like', 'nao.product', $params['AdSearch']['product']]);
    }
    if ($params['AdSearch']['partners'] != '') {
        $query->andWhere(['like', 'nao.partners', $params['AdSearch']['partners']]);
    }
    if ($indent_id = Yii::$app->request->get('indent_id')) {
        $query->andFilterWhere(['indent' => $indent_id]);
    }
    $dataProvider = new ActiveDataProvider(['query' => $query, 'sort' => [
    // Set the default sort by name ASC and created_at DESC.
    'defaultOrder' => ['id' => SORT_DESC], 'attributes' => ['id', 'uid', 'img_id', 'name', 'size', 'target_location', 'web', 'type', 'ostatus', 'indent', 'address', 's_address', 'describe', 'status'], ], 'pagination' => ['pageSize' => 20, ], ]);
    $this->load($params);
    if (!$this->validate()) {
        // uncomment the following line if you do not want to any records when validation fails
        // $query->where('0=1');
        return $dataProvider;
    }
    $query->andFilterWhere(['naa.id' => $this->id, 'uid' => $this->uid, 'naa.size' => $this->size, 'naa.type' => $this->type, 'indent' => $this->indent, 'status' => $this->status, 'update_time' => $this->update_time, 'create_time' => $this->create_time, ]);
    $query->andFilterWhere(['like', 'img_id', $this->img_id])->andFilterWhere(['like', 'naa.name', $this->name])->andFilterWhere(['like', 'address', $this->address])->andFilterWhere(['like', 's_address', $this->s_address])->andFilterWhere(['like', 'describe', $this->describe]);
    return $dataProvider;
?>