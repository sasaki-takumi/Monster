<?php
	class Monsteruser extends Model {
		public $name = 'Monsteruser';
		public $validate = array(
            'name' => array(
                'rule1' => array(
                    'rule' => array('custom','/^[a-zA-Z0-9_\-\s]*$/'),
                    // 'required' => true,
                    // 'allowEmpty' => false,
                    'message' => '半角英字で入力して下さい'
                    ),  
                'rule2' => array(
                    'rule' => 'isUnique',
                    // 'required' => true,
                    // 'allowEmpty' => false,
                    'message' => '入力されたユーザ名は既に使われています'
                    ),
                'rule3' => array(
                    'rule' => 'notEmpty',
                    // 'required' => true,
                    // 'allowEmpty' => false,
                    'message' => '必ず入力して下さい'
                )
            ),
            'email' => array(
                'rule' => 'email',
                // 'required' => true,
                // 'allowEmpty' => false,
                'message' => 'メールアドレスの形式で必ず入力して下さい'
            ),
            'password' => array(
                'rule' => 'notEmpty',
                // 'required' => true,
                // 'allowEmpty' => false,
                'message' => '必ず入力して下さい'
            ),
            'pass_check' => array(
                'rule' => 'notEmpty',
                // 'required' => true,
                // 'allowEmpty' => false,
                'message' => '必ず入力して下さい'
            ),
            'tw_id' => array(
                'rule' => 'isUnique', //重複登録回避
                'message' => '重複です'
            ),
        );

        //新規登録＆ログイン
        public function signin($token){
            //アクセストークンを正しく取得できなかった場合の処理
            if(is_string($token))return; //エラー

            $data['tw_id'] = $token['user_id'];
            $data['name'] = $token['screen_name'];
            $data['password'] = Security::hash($token['oauth_token']);
            //$data['oauth_token'] = Security::hash($token['oauth_token']);
            //$data['oauth_token_secret'] = Security::hash($token['oauth_token_secret']);

            //バリデーションチェックでエラーがなければ、新規登録
            // $this->set($data);
            // if($this->validates()){
            //     $res = "OK";
            //     $this->save();
            // }else
            //     $res = "NG";
            // return $res; //ログイン情報

            $this->save($data);
            return $data; //ログイン情報
        }

        public function idid($data){//twitterまたはfacebookユーザUserテーブルのidを返す
            $tmp = $this->find('all',array(
             'conditions' => array('name' => $data['Monsteruser']['name'])
            ));

            return $tmp[0]['Monsteruser']['id'];//idを返す
        }
    }