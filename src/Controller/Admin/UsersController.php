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
namespace App\Controller\Admin;
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
	$this->loadComponent('Image');
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
		}
		$this->viewBuilder()->setLayout('login');
		if ($this->request->is('post')) {	
			$user = $this->Auth->identify();
			if($user){
				if ($user['role_id']==1) {
					$this->Auth->setUser($user);
					return $this->redirect(['controller'=>'dashboard','action' => 'index']);
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
	
	public function companyProfile(){
		$user=$this->Users->get($this->Auth->user('id'));
		$this->set(compact('user'));
	}
	public function update(){
		$user=$this->Users->get($this->Auth->user('id'));
		$user->name=$this->request->getData('name');
		$user->phone=$this->request->getData('phone');
		$user->address=$this->request->getData('address');
		if($this->request->getData('profile_image.name')){
			if($user->profile_image){
				$this->Image->delete_image($user->profile_image,'company-logo');
			}
			$uploadImage=$this->Image->upload_image_and_thumbnail($this->request->getData('profile_image'),700,500,200,250,'company-logo');
			$user->profile_image=$uploadImage;
		}
		if($this->Users->save($user)){
			$this->Auth->setUser($user->toArray());
			$out=['status'=>'success','msg'=>'Company Profile has been updated'];
			echo json_encode($out);
		}else{
			$out=['status'=>'error','msg'=>'An Internal error,please try again'];
			echo json_encode($out);
		}
			die;
	}
	
	public function deleteImage(){
		$user=$this->Users->get($this->Auth->user('id'));
		$user->profile_image='';
		if($this->Users->save($user)){
			$this->Auth->setUser($user->toArray());
			$out=['status'=>'success','msg'=>'Company Profile has been updated'];
			echo json_encode($out);
		}else{
			$out=['status'=>'error','msg'=>'An Internal error,please try again'];
			echo json_encode($out);
		}
		die;
	}
}
