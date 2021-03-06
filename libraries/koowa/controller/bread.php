<?php
/**
 * @version		$Id: bread.php 2725 2010-10-28 01:54:08Z johanjanssens $
 * @category	Koowa
 * @package		Koowa_Controller
 * @copyright	Copyright (C) 2007 - 2010 Johan Janssens. All rights reserved.
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link     	http://www.nooku.org
 */

/**
 * Abstract Bread Controller Class
 *
 * @author		Johan Janssens <johan@nooku.org>
 * @category	Koowa
 * @package		Koowa_Controller
 */
abstract class KControllerBread extends KControllerAbstract
{
	/**
	 * Model identifier (APP::com.COMPONENT.model.NAME)
	 *
	 * @var	string|object
	 */
	protected $_model;

	/**
	 * The request information
	 *
	 * @vara array
	 */
	protected $_request = null;

	/**
	 * Constructor
	 *
	 * @param 	object 	An optional KConfig object with configuration options.
	 */
	public function __construct(KConfig $config)
	{
		parent::__construct($config);

		// Set the model identifier
		if(!empty($config->model)) {
			$this->setModel($config->model);
		}
		
		//Set the request
		$this->setRequest((array) KConfig::toData($config->request));
		
		//Register the load and save request function to make the request persistent
		if($config->persistent)
		{
			$this->registerCallback('before.browse' , array($this, 'loadRequest'));
			$this->registerCallback('after.browse'  , array($this, 'saveRequest'));
		}	
	}

 	/**
     * Initializes the default configuration for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param 	object 	An optional KConfig object with configuration options.
     * @return void
     */
    protected function _initialize(KConfig $config)
    {
    	$config->append(array(
        	'model'			=> null,
    		'request'		=> null,
    		'persistent'	=> false,
        ));

        parent::_initialize($config);
    }
    
 	/**
     * Set a request properties
     *
     * @param  	string 	The property name.
     * @param 	mixed 	The property value.
     */
 	public function __set($property, $value)
    {
    	$this->_request->$property = $value;
  	}
  	
  	/**
     * Get a request property
     *
     * @param  	string 	The property name.
     * @return 	string 	The property value.
     */
    public function __get($property)
    {
    	$result = null;
    	if(isset($this->_request->$property)) {
    		$result = $this->_request->$property;
    	} 
    	
    	return $result;
    }
    
	/**
	 * Push the request data into the model state
	 *
	 * @param	string		The action to execute
	 * @return	mixed|false The value returned by the called method, false in error case.
	 * @throws 	KControllerException
	 */
	public function execute($action, $data = null)
	{
		$this->getModel()->set($this->getRequest());

		return parent::execute($action, $data);
	}

	/**
	 * Get the request information
	 *
	 * @return KConfig	A KConfig object with request information
	 */
	public function getRequest()
	{
		return $this->_request;
	}

	/**
	 * Set the request information
	 *
	 * @param array	An associative array of request information
	 * @return KControllerBread
	 */
	public function setRequest(array $request)
	{
		$this->_request = new KConfig($request);
		return $this;
	}
	
	/**
	 * Load the model state from the request
	 *
	 * This functions merges the request information with any model state information
	 * that was saved in the session and returns the result.
	 *
	 * @param 	KCommandContext		The active command context
	 * @return array	An associative array of request information
	 */
	public function loadRequest(KCommandContext $context)
	{
		// Built the session identifier based on the action
		$identifier  = $this->getModel()->getIdentifier().'.'.$this->_action;
		$state       = KRequest::get('session.'.$identifier, 'raw', array());
			
		//Append the data to the request object
		$this->_request->append($state);
		
		//Push the request in the model
		$this->getModel()->set($this->getRequest());
		
		return $this;
	}

	/**
	 * Saves the model state in the session
	 *
	 * @param 	KCommandContext		The active command context
	 * @return KControllerBread
	 */
	public function saveRequest(KCommandContext $context)
	{
		$model  = $this->getModel();
		$state  = $model->get();

		// Built the session identifier based on the action
		$identifier  = $model->getIdentifier().'.'.$this->_action;
		
		//Set the state in the session
		KRequest::set('session.'.$identifier, $state);

		return $this;
	}

	/**
	 * Get the identifier for the model with the same name
	 *
	 * @return	KIdentifierInterface
	 */
	public function getModel()
	{
		if(!$this->_model)
		{
			$identifier			= clone $this->_identifier;
			$identifier->path	= array('model');

			// Models are always plural
			$identifier->name	= KInflector::isPlural($identifier->name) ? $identifier->name : KInflector::pluralize($identifier->name);

			$this->_model = KFactory::get($identifier);
		}

		return $this->_model;
	}

	/**
	 * Method to set a model object attached to the controller
	 *
	 * @param	mixed	An object that implements KObjectIdentifiable, an object that
	 *                  implements KIndentifierInterface or valid identifier string
	 * @throws	KDatabaseRowsetException	If the identifier is not a model identifier
	 * @return	KControllerAbstract
	 */
	public function setModel($model)
	{
		if(!($model instanceof $model))
		{
			$identifier = KFactory::identify($model);

			if($identifier->path[0] != 'model') {
				throw new KControllerException('Identifier: '.$identifier.' is not a model identifier');
			}

			$model = KFactory::get($identifier);
		}
		
		$this->_model = $model;
		return $this;
	}

	/**
	 * Browse a list of items
	 * 
	 * @param	KCommandContext	A command context object
	 * @return 	KDatabaseRowset	A rowset object containing the selected rows
	 */
	protected function _actionBrowse(KCommandContext $context)
	{
		$rowset = $this->getModel()->getList();

		return $rowset;
	}

	/**
	 * Display a single item
	 *
	 * @param	KCommandContext	A command context object
	 * @return 	KDatabaseRow	A row object containing the selected row
	 */
	protected function _actionRead(KCommandContext $context)
	{
		$row = $this->getModel()
				->getItem();

		return $row;
	}

	/**
	 * Generic edit action, saves over an existing item
	 *
	 * @param	KCommandContext	A command context object
	 * @return 	KDatabaseRowset A rowset object containing the updated rows
	 */
	protected function _actionEdit(KCommandContext $context)
	{
		$rowset = $this->getModel()
					->getList()
					->setData(KConfig::toData($context->data));

		$rowset->save();

		return $rowset;
	}

	/**
	 * Generic add action, saves a new item
	 *
	 * @param	KCommandContext	A command context object
	 * @return 	KDatabaseRow 	A row object containing the new data
	 */
	protected function _actionAdd(KCommandContext $context)
	{
		$row = $this->getModel()
				->getItem()
				->setData(KConfig::toData($context->data));
		
		$row->save();

		return $row;
	}

	/**
	 * Generic delete function
	 *
	 * @param	KCommandContext	A command context object
	 * @return 	KDatabaseRowset	A rowset object containing the deleted rows
	 */
	protected function _actionDelete(KCommandContext $context)
	{
		$rowset = $this->getModel()	
					->getList()
					->setData(KConfig::toData($context->data));
							
		$rowset->delete();
		
		return $rowset;
	}
	
	/**
	 * Supports a simple form Fluent Interfaces. Allows you to set the request 
	 * properties by using the request property name as the method name.
	 *
	 * For example : $controller->view('name')->limit(10)->browse();
	 *
	 * @param	string	Method name
	 * @param	array	Array containing all the arguments for the original call
	 * @return	KControllerBread
	 *
	 * @see http://martinfowler.com/bliki/FluentInterface.html
	 */
	public function __call($method, $args)
	{
		//Check first if we are calling a mixed in method. This prevents the model being loaded durig 
		//object instantiation. 
		if(!isset($this->_mixed_methods[$method])) 
        {
			//Check if the method is a state property
			$state = $this->getModel()->getState();
		
			if(isset($state->$method) || in_array($method, array('layout', 'view', 'format'))) 
			{
				$this->$method = $args[0];
				return $this;
			}
        }
		
		return parent::__call($method, $args);
	}
}