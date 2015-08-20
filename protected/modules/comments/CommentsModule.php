<?php

class CommentsModule extends CWebModule
{       
    public $defaultController = 'comment';

    const CAPTCHA_ACTION_ROUTE = 'comments/comment/captcha';

    const DELETE_ACTION_ROUTE = 'comments/comment/delete';

    const APPROVE_ACTION_ROUTE = 'comments/comment/approve';

    public $commentableModels = array();

    public $postCommentAction;

    public $userConfig;

    protected $_defaultModelConfig = array(
        //only registered users can post comments
        'registeredOnly' => false,
        'useCaptcha' => false,
        //allow comment tree
        'allowSubcommenting' => true,
        //display comments after moderation
        'premoderate' => false,
        //action for postig comment
        'postCommentAction' => 'comments/comment/postComment',
        //super user condition(display comment list in admin view and automoderate comments)
        'isSuperuser'=>'false',
        //order direction for comments
        'orderComments'=>'DESC',
        //settings for comments page url
        'pageUrl'=>null
    );
    
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'comments.models.*',
			'comments.components.*',
		));
	}

    public function outComments($model, $controller)
    {
        //if this model is commentable
        if(($modelConfig = $this->getModelConfig($model)) !== null)
        {
            $this->outCommentsList($model, $controller);
        }
    }

    public function getModelConfig($model)
    {
        $modelName = is_object($model) ? get_class($model) : $model;
        $modelConfig = array();
        if(in_array($modelName, $this->commentableModels) || isset($this->commentableModels[$modelName]))
        {
            $modelConfig = isset($this->commentableModels[$modelName]) ?
                array_merge($this->_defaultModelConfig, $this->commentableModels[$modelName]) :
                $this->_defaultModelConfig;
        }
        return $modelConfig;
    }

    public function setDefaultModelConfig($config)
    {
        if(is_array($config))
            $this->_defaultModelConfig = array_merge($this->_defaultModelConfig, $config);
    }
}
