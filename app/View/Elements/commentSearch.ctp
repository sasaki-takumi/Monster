<?php
	echo $this->Html->tag('h3','検索フォーム');
	echo $this->Html->tag('br /');

	echo $this->Form->create('Monsterboard',array(
			'type' => 'post',
			'url' => 'index'
		));

	echo $this->Form->label('Monsterboard.content','検索内容');
	echo $this->Form->text('content',array('required' => 'required'));//コメント入力欄を表示

	echo $this->Html->tag('br /');



	echo $this->Form->label('Monsterboard.num','表示件数');
	echo $this->Form->select('num',
		array(1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,
			6 => 6,7 => 7,8 => 8,9 => 9,10 => 10),
		array('value' => 1)
	);

	//降順か昇順を選択
	echo $this->Form->select('Monsterboard.sort',
		array('DESC' => '降順','ASC' => '昇順'),
		array('value' => 'DESC')
	);

	echo $this->Form->submit('検索する',array('div' => false,'class' => 'btn btn-default'));
	echo $this->Form->end();