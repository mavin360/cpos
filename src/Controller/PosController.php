<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PosController extends AppController
{


    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
	 public function initialize()
	{
		parent::initialize();
		// Add the 'add' action to the allowed actions list.
		$this->viewBuilder()->setLayout('pos');
		$this->loadComponent('Paginator');
		//$this->loadComponent('Image');
	}
	
	 public function isAuthorized($user = null)
    {
        if ($user['role_id'] === 1) {
            return true;
        }else{
			return $this->redirect($this->Auth->logout());
		}
    }
	public $paginate = [
         'limit' =>20
    ];
    public function index()
    {
		//pr($this->Auth->user());
    }
	public function order()
    {
		if(!$data=$this->getRequest()->getSession()->read('Customer')){
			return $this->redirect(['action' => 'index']);
		}
		$this->viewBuilder()->setLayout('order');
		$stores=TableRegistry::get('Stores');
		$store=$stores->find()->where(['Stores.id'=>$this->getRequest()->getSession()->read('Customer.store')])->first();
		$this->set(compact('store'));
		
    }
	public function kitchen()
    {
		$this->viewBuilder()->setLayout(false);
		//pr($this->getRequest()->getSession()->read('Customer.ordertype'));
		
    }
}
