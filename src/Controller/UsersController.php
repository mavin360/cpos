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
use Cake\Routing\Router;
//use ReflectionClass;
//use ReflectionMethod;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController
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
  
	$this->Auth->allow(['logout']);
	$this->viewBuilder()->setLayout('admin');
	$this->loadComponent('Paginator');
}
 public function isAuthorized($user = null)
    {
		if ($user['role_id'] === 1 ||$user['role_id'] === 2) {
            return true;
		}
    }
	
	public function signin()
    {
		//pr($this->Auth);
		if($this->Auth->user('role_id')==1){
			return $this->redirect(['controller'=>'dashboard','action' => 'index']);
		}else if($this->Auth->user('role_id')==2){
			return $this->redirect(['controller'=>'kitchen','action' => 'index']);
		}else if($this->Auth->user('role_id')==3){
			return $this->redirect(['controller'=>'MasterKitchen','action' => 'index']);
		}
		$this->viewBuilder()->setLayout('login');
		if ($this->request->is('post')) {	
			$user = $this->Auth->identify();
			if($user){
				if ($user['role_id']==1) {
					$this->Auth->setUser($user);
					return $this->redirect(['controller'=>'pos','action' => 'index']);
				}else if($user['role_id']==2){
					//$this->Auth->config(['storage'=>['key' => 'Auth.kitchen']]);
					$this->Auth->setUser($user);
					return $this->redirect(['controller'=>'kitchen','action' => 'index']);
				}else if($user['role_id']==3){
					$this->Auth->setUser($user);
					return $this->redirect(['controller'=>'MasterKitchen','action' => 'index']);
				}else{
					$this->Flash->error(__('Your are not allowed to see that?.'),['key'=>'error']);
					return $this->redirect(['action' => 'logout']);
				}
			}
			$this->Flash->error(__('Email or password is incorrect.'),['key'=>'error']);
		}
    }
	
	public function logout()
    {
		return $this->redirect($this->Auth->logout());
    }
	
	
	
}
