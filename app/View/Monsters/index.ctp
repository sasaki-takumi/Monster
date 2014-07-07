<?php echo $this->Html->link('ログアウト',array('action' => 'logout')); ?>
<h1>妖怪マップ</h1>
<ul id="imagemap">
	<?php echo '<li id="hanamaki_shi">'.$this->Html->link('',array('action' => 'hanamaki')).'</li>' ?>
	<?php echo '<li id="itinoseki_shi">'.$this->Html->link('',array('action' => 'itinoseki')).'</li>' ?>
	<?php echo '<li id="iwaizumi_tyo">'.$this->Html->link('',array('action' => 'iwaizumi')).'</li>' ?>
	<?php echo '<li id="iwate_tyo">'.$this->Html->link('',array('action' => 'iwate')).'</li>' ?>
	<?php echo '<li id="kuzi_shi">'.$this->Html->link('',array('action' => 'kuzi')).'</li>' ?>
	<?php echo '<li id="miyako_shi">'.$this->Html->link('',array('action' => 'miyako')).'</li>' ?>
	<?php echo '<li id="morioka_shi">'.$this->Html->link('',array('action' => 'morioka')).'</li>' ?>
	<?php echo '<li id="ninohe_shi">'.$this->Html->link('',array('action' => 'ninohe')).'</li>' ?>
	<?php echo '<li id="sizukuishi_tyo">'.$this->Html->link('',array('action' => 'sizukuishi')).'</li>' ?>
	<?php echo '<li id="tono_shi">'.$this->Html->link('',array('action' => 'tono')).'</li>' ?>
	<?php echo '<li id="kitakami_shi">'.$this->Html->link('',array('action' => 'kitakami')).'</li>' ?>
</ul>
<!-- ●日本地図下の地域リスト -->
<!-- 		<ul id="area">
	<li><a href="hokkaido/hokkaido.html">北海道</a></li>
	<li><a href="tohoku/miyagi.html">東北</a></li>
	<li><a href="hokuriku/nagano.html">北陸・甲信越</a></li>
</ul> -->





<?php
	//debug($user);
	//debug($data);
	//debug($fbid);

	$this->start('right_sidebar');//左にサイドバー(left_sidebar)ブロックスを作成		
		echo $this->Html->tag('h2',$this->Html->link(
			'投稿する','http://www31092u.sakura.ne.jp/~g031k068/g031k068/cake2/monsters/create'
		));

		echo $this->element('commentSearch');
		echo $this->Html->tag('hr /');

		if (empty($result)) {
			foreach ($data as $value) {
				echo 'ユーザ名：'.$value['Monsteruser']['name'].' , ';//ユーザ名を表示
				echo 'アドレス：'.$value['Monsteruser']['email'];//メールアドレスを表示
				echo $this->Html->tag('br /');
				echo 'コメント：'.$value['Monsterboard']['comment'].' , ';//コメントを表示
				echo $value['Monsterboard']['created'];//投稿年月日、時間を表示

				if (empty($fbid)) {//fbでログインしていなかったら
					if($user['id'] == $value['Monsterboard']['monsteruser_id']){//idが同じだったら
						echo $this->Html->link('編集',array('action' => 'edit', $value['Monsterboard']['id'])).' ';
						echo $this->Html->link('削除',array('action' => 'delete', $value['Monsterboard']['id']));
					}
				}else {//fbでログインしていたら
					if($fbid == $value['Monsterboard']['monsteruser_id']){//idが同じだったら
						echo $this->Html->link('編集',array('action' => 'edit', $value['Monsterboard']['id'])).' ';
						echo $this->Html->link('削除',array('action' => 'delete', $value['Monsterboard']['id']));
					}
				}

				echo $this->Html->tag('hr /');
			}
		}else {
			foreach ($result as $res) {
				echo 'ユーザ名：'.$res['Monsteruser']['name'].' , ';//ユーザ名を表示
				echo 'アドレス：'.$res['Monsteruser']['email'];//メールアドレスを表示
				echo $this->Html->tag('br /');
				echo 'コメント：'.$res['Monsterboard']['comment'].' , ';//コメントを表示
				echo $res['Monsterboard']['created'];//投稿年月日、時間を表示

				echo $this->Html->tag('hr /');
			}
		}
	$this->end();
