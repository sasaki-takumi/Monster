<?php
	if (empty($confirm)){//入力していなかったら
		echo $this->Form->create('entry',array(
			'type' => 'post',
			'url' => 'create'
		));

		echo $this->Form->label('entry.comment',$label);//ラベルの表示
		if (isset($data)){//編集の場合
			echo $this->Form->text('entry.comment',array('value' => $data['Monsterboard']['comment'],'required' => 'required'));//コメント入力欄を表示
			echo $this->Form->hidden('entry.id',array('value' => $data['Monsterboard']['id']));//idをhidden取得
		}else//追加の場合
			echo $this->Form->text('entry.comment');//コメント入力欄を表示

		echo $this->Form->submit('投稿する',array('class' => 'btn btn-primary'));
		echo $this->Form->end();
	}else {//入力していたら
		echo $this->Html->tag('h2',$confirm['entry']['comment']);
		echo "この内容を登録してもいいですか？";

		echo $this->Form->create('Monsterboard',array(
			'type' => 'post',
			'url' => 'save'
		));

		echo $this->Form->hidden('Monsterboard.comment',array('value' => $confirm['entry']['comment']));//投稿内容をhiddenで取得
		if (isset($confirm['entry']['id']))
			echo $this->Form->hidden('Monsterboard.id',array('value' => $confirm['entry']['id']));//idをhiddenで取得

		echo $this->Form->submit('確定する',array('class' => 'btn btn-primary'));
		echo $this->Form->end();
	}