<?php
App::import('Vendor', 'OAuth/OAuthClient');

	class MonstersController extends AppController {
		public $name ='Monsters';
		public $uses = array('Monsteruser','Monster','Monsterboard');//モデルを利用
		public $layout = 'bootstrap3';//レイアウトの利用
		public $components = array(
					'DebugKit.Toolbar',//DebugKitを利用
					'TwitterKit.Twitter',//twitter
					'RequestHandler',//リクエストハンドラを利用
					'Auth' => array(//ログイン機能を利用
						'authenticate' => array(
							'Form' => array(
								'userModel' => 'Monsteruser',//Userモデルを使用
								'fields' => array('username' => 'name','password' => 'password')//認証に利用するフィールドの変更
							)
						),
					//ログイン後の移動先
					'loginRedirect' => array('controller' => 'monsters','action' => 'index'),
					//ログアウト後の移動先
					'logoutRedirect' => array('controller' => 'monsters','action' => 'login'),
					//ログインページのパス
					'loginAction' => array('controller' => 'monsters','action' => 'login'),
					//ログインしていないときのメーッセージ
					'authError' => '名前とパスワードを入力して下さい',
					)
				);

		public function beforeFilter(){
			$this->Auth->allow('useradd','login','logout','twlogin','tw_callback','createFacebook','fblogin','fb_callback','callback');//ログインしなくても、アクセスできるアクションを登録する
			$this->set('user',$this->Auth->user());//ctpで$userを使えるようにする

			App::import('Vendor','facebook', array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));//sdkのインポート
			//CakeRequest::is('mobile');
		}

		// public function twlogin(){//twitterのOAuth用ログインURLにリダイレクト
  //           $this->redirect($this->Twitter->getAuthenticateUrl(null, true));
  //       }

		// public function tw_callback(){//twitterのコールバック
		// 	if(!$this->Twitter->isRequested()){//認証が実施されずにリダイレクト先から遷移してきた場合の処理
  //               $this->flash(__('invalid access.'), '/', 5);
  //               return;
  //           }
  //           $this->Twitter->setTwitterSource('twitter');//アクセストークンの取得を実施
  //           $token = $this->Twitter->getAccessToken();

  //           $data['User'] = $this->Monsteruser->signin($token); //ユーザ登録
  //           //var_dump($data);
  //       	$this->Auth->login($data); //CakePHPのAuthログイン処理
  //           $this->redirect($this->Auth->loginRedirect); //ログイン後画面へリダイレクト
		// }



		




    public function twlogin() {
        $client = $this->createClient();
        $requestToken = $client->getRequestToken('https://api.twitter.com/oauth/request_token', 'http://hikakux.info/twittarget/index.php/login/callback');
 
        if ($requestToken) {
            $this->Session->write('twitter_request_token', $requestToken);
            $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
        } else {
        // an error occured when obtaining a request token
        }
    }
 
    public function callback() {
        $requestToken = $this->Session->read('twitter_request_token');
        $client = $this->createClient();
        $accessToken = $client->getAccessToken('https://api.twitter.com/oauth/access_token', $requestToken);
 
        if ($accessToken) {
            $client->post($accessToken->key, $accessToken->secret, 'https://api.twitter.com/1/statuses/update.json', array('status' => 'hello world!'));
        }
 
        if ($accessToken) {
        $twitter = $client->get(
            $accessToken->key,
            $accessToken->secret,
            'https://api.twitter.com/1.1/statuses/user_timeline.json',
            array()
        );// twitter上におけるユーザの情報を取得（optional）
        $twitter = json_decode($twitter, true);
 
        $this->set('test',$twitter[0]);
        $this->render('index');
 
        }
    }
 
    private function createClient() {
        return new OAuthClient('ZwsDEka6WOGmD0T2xOkuw','dpynGGFRDPuT7zpYHHSQqJ5kDOGMp8txuDvxfJRtc');
    }
 






		private function createFacebook() {
            return new Facebook(array(
                    'appId' => '1430497137186604',
                    'secret' => '6dba8b614cc3b596312111a1da9c7699'
            ));
        }

        public function fblogin(){//facebookのOAuth用ログインURLにリダイレクト
        	$facebook = $this->createFacebook();
            $fb_user = $facebook->getUser(); //これ大事

            if (!$fb_user){
            	$url = $facebook->getLoginUrl(array(
                    'scope' => 'email,publish_stream,user_birthday,user_education_history,user_likes'
                    ));
			
			$this->redirect($url);
            }
        }

        public function fb_callback(){//facebookのコールバック
			$facebook = $this->createFacebook();
	    	$me = null;
			$user = $facebook->getUser();
	          
	    	if($user) {
	    		$me = $facebook->api('/me');
	    	} else {
	    		$this->Session->setFlash(__('ユーザ情報の取得に失敗しました。もう一度ログインしてください。'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
	    		$this->redirect(array('action' => 'login')); //ログイン後画面へリダイレクト 
	    	}

	        $access_token = $facebook->getAccessToken();//access_token入手

	        $data['Monsteruser']['fb_id'] = $me['id'];//idの登録
	        $data['Monsteruser']['name'] = $me['name'];//名前の登録
	        $data['Monsteruser']['password'] = Security::hash($access_token);//パスワードの登録

	        $this->Monsteruser->set($data);
			if($this->Monsteruser->validates()){ //エラーがなければ
				$this->Monsteruser->save($data);
			}

			$this->Auth->login($data); //CakePHPのAuthログイン処理
            $this->redirect($this->Auth->loginRedirect); //ログイン後画面へリダイレクト 
	    }

		public function index(){//トップページ
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'MobileIndex';//レイアウトの指定
			}else{
				$this->layout = 'bootstrap3board';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (empty($check)) {//fbでログインしたら
				$this->set('fbid',$this->Monsteruser->idid($this->Auth->user()));
			}

			//検索処理
			if($this->request->is('post')){//POST送信だったら
				$tmp = $this->Monsterboard->find('all',array(
					'conditions' => array('Monsterboard.comment like' => '%'.$this->request->data['Monsterboard']['content'].'%'),
					'order' => 'Monsterboard.id '.$this->request->data['Monsterboard']['sort'],
					'limit' => $this->request->data['Monsterboard']['num']
				));

				$this->set('data',$tmp);
			}else {
				$this->set('data',$this->Monsterboard->find('all',array(
								'order' => 'Monsterboard.id DESC')));
			}
		}

        public function create(){
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			if (!empty($this->request->data['entry']['comment']))//コメントが入力されていたら
				$this->set('confirm',$this->request->data);
			$this->set('label','投稿内容');//追加するときのラベル内容
		}

		public function save(){//モデルにデータを渡す
			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$this->request->data['Monsterboard']['monsteruser_id'] = $this->Auth->user('id');//user_idの設定
			}else {//fbでログインしたら
				$this->request->data['Monsterboard']['monsteruser_id'] = $this->Monsteruser->idid($this->Auth->user());//user_idの設定
			}
			$this->Monsterboard->save($this->request->data);//データの登録or更新
			$this->redirect(array('action' => 'index'));
		}

		public function edit($id) {//編集アクション
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$data = $this->Monsterboard->findById($id);//$idの情報を$dataに入れる
			$this->set('data',$data);
			$this->set('label','編集内容');//編集のときのラベル内容
			$this->render('create');
		}

		public function delete($id) {//削除アクション
			$this->Monsterboard->delete($id);
			$this->redirect(array('action' => 'index'));
		}

		public function login(){

			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'MobileLogin';//レイアウトの指定
			}else{
				$this->layout = 'bootstrap3login';//レイアウトの指定
			}

			

			//ログイン
			if($this->request->is('post')){//POST送信だったら
				if ($this->Auth->login()) {//ログイン成功したら
					//$this->Session->delete('Auth.redirect');//前回ログアウト時のリンクを記録させない
					return $this->redirect($this->Auth->redirect());//Auth指定のログインページへ移動する
				}else {//ログイン失敗したら
					$this->Session->setFlash(__('ユーザ名かパスワードが違います'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
				}
			}
		}

		public function logout(){//ログアウト
            $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全に削除する
            $this->Session->setFlash(__('ログアウトしました'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			));
            $this->redirect(array('action' => 'login'));
        }

		public function useradd(){//ユーザ追加
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}
			
			if($this->request->is('post')) {//POST送信だったら
				//同じユーザ名があるかチェック
				$nameflag = 'entryname';
            	$usercheck = $this->Monsteruser->find('all');//全てのユーザの情報を取得
            	foreach ($usercheck as $value) {
            		if ($value['Monsteruser']['name'] == $this->request->data['Monsteruser']['name']) {//同じユーザ名があったら
            			$nameflag = 'samename';
            		}
            	}

				if ($nameflag == 'entryname') {//同じユーザ名がなかったら
	                //入力したパスワートとパスワードチェックの値が一致だったら
	                if($this->request->data['Monsteruser']['pass_check'] === $this->request->data['Monsteruser']['password']){	

	                    $this->Monsteruser->create();//ユーザーの作成。insertを発行するSaveメソッドが複数回呼ばれる時に、毎回create()を実行し、Saveする。それ以外のSave時は特に事前にcreate()する必要なし(Insert/Updateに関わらず)

	                    if(!empty($this->request->data['Monsteruser'])){
				            $this->Monsteruser->set($this->request->data);
				            if($this->Monsteruser->validates()){ //エラーがなければ
				            	//パスワードとパスチェックの値をハッシュ値変換する
			                	$this->request->data['Monsteruser']['password'] = AuthComponent::password($this->request->data['Monsteruser']['password']);
			                	$this->request->data['Monsteruser']['pass_check'] = AuthComponent::password($this->request->data['Monsteruser']['pass_check']);

				                $this->Monsteruser->save($this->request->data);

								$this->Session->setFlash(__('登録が完了しました'), 'alert', array(
									'plugin' => 'BoostCake',
									'class' => 'alert-success'
								));

								$this->redirect(array('action' => 'index'));//リダイレクト
				            }else{
				                $this->render('useradd');
				            }
	       				 }
	                }else{
	                    $this->Session->setFlash(__('パスワード確認の値が一致しません'), 'alert', array(
							'plugin' => 'BoostCake',
							'class' => 'alert-danger'
						));
	                }
				}else {
        			$this->Session->setFlash(__('入力されたユーザ名は既に使われています'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
				}
            }
        }

		public function locationinfo(){//位置情報
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			if (isset($this->request->data['Monsteruser']['name'])) {
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array('Monsteruser.name like' => $this->request->data['Monsteruser']['name'])
				));

				$fbdata['Monsteruser']['location'] = $this->request->data['Monsteruser']['location'];
				$fbdata['Monsteruser']['id'] = $tmp[0]['Monsteruser']['id'];

				$this->set('data',$fbdata);
				$this->set('d',$tmp);
			}else{
				$this->set('data',$this->request->data);
			}	
		}

		public function saveimg(){
			$this->Monsteruser->save($this->request->data);//データの更新
			$this->redirect(array('action' => 'index'));
		}

		public function hanamaki(){//花巻
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.hanamaki like' => 'hanamaki_zasikiwarasi.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.hanamaki like' => 'hanamaki_zasikiwarasi.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'kitakami';
			$location = 'hanamaki';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function itinoseki(){//一関
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.itinoseki like' => 'kanibouzu_itinoseki.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.itinoseki like' => 'kanibouzu_itinoseki.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'ichinoseki';
			$location = 'itinoseki';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function iwaizumi(){//岩泉
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.iwaizumi like' => 'jaryuu_iwaizumi.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.iwaizumi like' => 'jaryuu_iwaizumi.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'kuji';
			$location = 'iwaizumi';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function iwate(){//岩手
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.iwate like' => 'yorujuhime&daija_iwate.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.iwate like' => 'yorujuhime&daija_iwate.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'appi';
			$location = 'iwate';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function kuzi(){//久慈
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.kuzi like' => 'kuzishi_mojabune.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.kuzi like' => 'kuzishi_mojabune.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'kuji';
			$location = 'kuzi';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function miyako(){//宮古
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.miyako like' => 'makuragaesi_miyako.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.miyako like' => 'makuragaesi_miyako.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'kuji';
			$location = 'miyako';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function morioka(){//盛岡
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.morioka like' => 'rasetuki_morioka.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.morioka like' => 'rasetuki_morioka.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'morioka';
			$location = 'morioka';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function ninohe(){//二戸
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.ninohe like' => 'ninohe_sitagarabonboko.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.ninohe like' => 'ninohe_sitagarabonboko.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'appi';
			$location = 'ninohe';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function sizukuishi(){//雫石
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.sizukuishi like' => 'unagiotoko_sizukuisi.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.sizukuishi like' => 'unagiotoko_sizukuisi.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'shizukuishi';
			$location = 'sizukuishi';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function tono(){//遠野
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.tono like' => 'kappa_tono.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.tono like' => 'kappa_tono.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'kitakami';
			$location = 'tono';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}

		public function kitakami(){//北上
			if($this->RequestHandler->isMobile()){//モバイルでアクセスしたら
				$this->layout = 'mobile';//レイアウトの指定
			}

			$check = $this->Auth->user('id');
			if (!empty($check)) {//通常にログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.kitakami like' => 'kitakami_raiju.png'),array('Monsteruser.id like' => $this->Auth->user('id')))
				));
				$this->set('result',$tmp);
			}else {//facebookでログインしたら
				$tmp = $this->Monsteruser->find('all',array(
					'conditions' => array("AND" => array('Monsteruser.kitakami like' => 'kitakami_raiju.png'),array('Monsteruser.id like' => $this->Monsteruser->idid($this->Auth->user())))
				));
				$this->set('result',$tmp);
			}

			$type = 'kitakami';
			$location = 'kitakami';
			$this->set('data',$this->Monster->HotelInfo($type,$location));
		}
	}