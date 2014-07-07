<div id="hero-unit">
    新規ユーザー登録
    <?php echo $this->Session->flash('Auth'); ?>
    <?php echo $this->Form->create('Monsteruser', array('url' => 'useradd')); ?>
    <?php echo $this->Form->input('Monsteruser.name',array('label'=>'ユーザ名')); ?><!-- ユーザ名 -->
    <?php echo $this->Form->input('Monsteruser.password',array('label'=>'パスワード')); ?><!-- パスワード -->
    <?php echo $this->Form->input('Monsteruser.pass_check',array('label'=>'パスワード確認','type'=>"password")); ?>
    <?php echo $this->Form->input('Monsteruser.email',array('label'=>'メールアドレス')); ?><!-- メールアドレス -->
    <?php 
    	echo $this->Form->label('Monsteruser.sex','性別');
    	echo $this->Form->radio('Monsteruser.sex',array(0 => '男',1 => '女'),array('legend' => false, 'label'=> true, 'value' => 1));
    ?><!-- 性別 -->
    <?php echo $this->Form->end('新規ユーザを作成する'); ?>
    <a href="http://www31092u.sakura.ne.jp/~g031k068/g031k068/cake2/monsters" id="switch2" class="label btn-primary">ログインへ</a>
</div>