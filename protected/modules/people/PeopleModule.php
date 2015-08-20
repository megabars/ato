<?php

class PeopleModule extends CWebModule
{
	public $defaultController = 'front';
	public function init()
	{
		$this->setImport(array(
			'people.models.*',
			'people.components.*',
		));
	}
}
