<?php
	echo $this->Html->link('戻る',array('action' => 'index'));

	echo $this->Form->create('Monsteruser', array('url' => 'locationinfo'));
	echo $this->Form->hidden('location',array('value' => 'hanamaki'));

	if (empty($user['Monsteruser']['fb_id'])) {//通常にログインしたら
		echo $this->Form->hidden('id',array('value' => $user['id']));
	}else {//facebookでログインしたら
		echo $this->Form->hidden('id',array('value' => $user['Monsteruser']['fb_id']));
		echo $this->Form->hidden('name',array('value' => $user['Monsteruser']['name']));
	}
	echo $this->Form->end('位置情報');


	echo "<h1>座敷わらし</h1><br />";



	if (isset($result[0]['Monsteruser']['hanamaki'])) {
		echo '<div class="grow pic">'.$this->Html->image('hanamaki_zasikiwarasi.png').'</div>'.'<br />';
	}else {
		echo '<div class="grow pic">'.$this->Html->image('m_zasikiwarasi.png').'</div>'.'<br />';
	}

	//echo "地域や登場する書物・作品によって性格や姿形は異なるが、共通して子供の姿をしている。 家や蔵に住み、いたずらをしたり、子供達と遊んだり、その家に幸福をもたらすといわれる。その由来は子供の霊とも神の使いとも様々。 ";
	
	echo '<pre><h2>宿泊情報</h2><hr />';
	echo 'ホテル名：'.$data[0].'<br />';
	echo '住所：'.$data[1].$data[2].'<br />';
	echo '<img class="tilt pic" id="hotelimg" src='.$data[3].'>';
	echo '<img class="tilt pic" id="hotelimg" src='.$data[4].'>';
	echo '<img class="tilt pic" id="hotelimg" src='.$data[5].'></pre>';