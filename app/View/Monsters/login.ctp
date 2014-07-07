<h1>岩手の妖怪を探しに行こう！</h1>
<br />
<?php $this->start('right_sidebar'); ?> <!-- 左にサイドバー(left_sidebar)ブロックスを作成 -->
	<div class="hero-unit">
		<?php echo $this->Session->flash('Auth'); ?>
	    <?php echo $this->Form->create('Monsteruser', array('url' => 'login')); ?>
	    <?php echo $this->Form->input('Monsteruser.name', array('label' => 'ユーザ名')); ?>
	    <?php echo $this->Form->input('Monsteruser.password', array('label' => 'パスワード')); ?>
	    <?php echo $this->Form->end('ログイン'); ?>
	    <a href="http://49.212.46.130/~g031k068/g031k068/cake2/monsters/useradd" id="switch" class="label btn-primary">新規登録</a>
   	
		<?php //echo $this->Html->link('twitter',array('action' => 'twlogin')); ?>
		<?php echo $this->Html->link('Facebook',array('action' => 'fblogin')); ?>
	</div>
<?php $this->end(); ?>
