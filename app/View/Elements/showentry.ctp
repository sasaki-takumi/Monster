<?php
	echo $this->Html->tag('h2','ユーザ登録フォーム');
	echo $this->Html->tag('br /');

	echo $this->Form->create('User',array(
			'type' => 'post',
			'url' => 'result'
		));

	echo $this->Form->label('User.name','名前');//ラベルの表示
	echo $this->Html->tag('br /');
	echo $this->Form->text('User.name',array('required' => 'required'));
	echo $this->Html->tag('br /');

	echo $this->Form->error('User.name');

	echo $this->Form->label('User.email','メール');//ラベルの表示
	echo $this->Html->tag('br /');
	echo $this->Form->text('User.email',array('type' => 'email','required' => 'required'));
	echo $this->Html->tag('br /');

	echo $this->Form->error('User.email');

	echo $this->Form->label('User.sex','性別');//ラベルの表示
	echo $this->Html->tag('br /');
	echo $this->Form->radio('User.sex',
		array(0 => '男',1 => '女'),
		array('legend' => false, 'label'=> true, 'value' => 1)
	);
	echo $this->Html->tag('br /');

	echo $this->Form->label('User.pass','パスワード');//ラベルの表示
	echo $this->Html->tag('br /');
	echo $this->Form->password('User.pass',array('required' => 'required'));
	echo $this->Html->tag('br /');

	echo $this->Form->submit('登録する',array('div' => false,'class' => 'btn btn-primary'));
	echo $this->Form->end();