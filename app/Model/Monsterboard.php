<?php
	class Monsterboard extends Model {
		public $name = 'Monsterboard';
		public $belongsTo = array('Monsteruser');
	}