<?php

class SearchModule extends CWebModule
{
	public function init()
	{
		$this->defaultController = 'default';

		$this->setImport(array(
			'search.components.*',
			'search.controllers.*',
			'search.models.*',
		));
	}
}
