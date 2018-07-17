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
	
	/* ============Users And Role Management.============= */
	
	public function index($rid=null){
		$UserRoles= TableRegistry::get('UserRoles');
		$allRoles=$UserRoles->find()
		//->contain(['Acls'])
		->where(['UserRoles.role_status'=>'Active']);
		$users=$this->Users->find()->contain(['UserRoles']);
		if($rid){
			$users->where(['Users.role_id'=>$rid]);
		}
		$users = $this->Paginator->paginate($users);
		$this->set(compact('allRoles','users'));
	}
	
	public function changeStatus(){
		$id=$this->request->getData('id');
		$Users=TableRegistry::get('Users');
		if($id){
			$User=$Users->get($id);
			$User->status=$this->request->getData('status');
			if($Users->save($User)){
				$out=['status'=>'success'];
				echo json_encode($out);
			}
		}
		die;
	}
	public function addRole(){
		if($this->request->getParam('isAjax')==1){
			$this->viewBuilder()->setLayout('ajax');
		}else{
			$this->viewBuilder()->setLayout('admin');
		}
		$UserRoles= TableRegistry::get('UserRoles');
		$userRole=$UserRoles->newEntity();
		$this->set(compact('userRole'));
	}
	
	
	public function saveRole(){
		$UserRoles= TableRegistry::get('UserRoles');
		$userRole=$UserRoles->newEntity();
		 /*$controllers = $this->getControllers();
			$resources = [];
			foreach($controllers as $controller){
				$actions[$controller] = $this->getActions($controller);
				$resources=$actions;
			}
		*/
		if ($this->request->is(['patch', 'post', 'put'])){
			//if(empty($this->request->data['module'])){
				
			//}else{
				$this->request->data['role_status']='Active';
				$this->request->data['added_by']=$this->Auth->user('id');
				$this->request->data['added_date']=date('Y-m-d H:i:s');
				$this->request->data['modify_date']=date('Y-m-d H:i:s');
				$userRole=$UserRoles->patchEntity($userRole,$this->request->getData());
				if($UserRoles->save($userRole)){
					/*$role_id=$userRole->user_role_id;
					foreach($this->request->data['module'] as $key=>$modules){
						foreach($modules as $module){
							$Acls=TableRegistry::get('Acls');
							$acl=$Acls->newEntity();
							$data['controller_name']=$key;
							$data['action_name']=$module;
							$data['user_role_id']=$role_id;
							$data['added_date']=date('Y-m-d H:i:s');
							$data['added_by']=$this->Auth->user('id');
							$acl=$Acls->patchEntity($acl,$data);
							$Acls->save($acl);
						}
					}*/
					$out=['status'=>'success','msg'=>'User role has been Saved'];
					echo json_encode($out);
				}else{
					$out=['status'=>'error','msg'=>'An Internal error,please try again'];
					echo json_encode($out);
				}
			//}
			
			die;
		}
	}
	
	public function add(){
		if($this->request->getParam('isAjax')==1){
			$this->viewBuilder()->setLayout('ajax');
		}else{
			$this->viewBuilder()->setLayout('admin');
		}
		$user=$this->Users->newEntity();
		$UserRoles= TableRegistry::get('UserRoles');
		$Stores= TableRegistry::get('Stores');
		$allRoles=$UserRoles->find('list',['keyField' => 'id','valueField' =>'role_name'])->where(['UserRoles.role_status'=>'Active']);
		$stores=$Stores->find('list',['keyField' => 'id','valueField' =>'store_name'])->toArray();
		$this->set(compact('allRoles','user','stores'));
	}
	
	public function edit($id){
		if($this->request->getParam('isAjax')==1){
			$this->viewBuilder()->setLayout('ajax');
		}else{
			$this->viewBuilder()->setLayout('admin');
		}
		$user=$this->Users->get($id);
		$UserRoles= TableRegistry::get('UserRoles');
		$Stores= TableRegistry::get('Stores');
		$allRoles=$UserRoles->find('list',['keyField' => 'id','valueField' =>'role_name'])->where(['UserRoles.role_status'=>'Active']);
		$stores=$Stores->find('list',['keyField' => 'id','valueField' =>'store_name'])->toArray();
		$this->set(compact('allRoles','user','stores'));
	}
	
	public function save(){
		
		if ($this->request->is(['patch', 'post', 'put'])){
			$existUser=$this->Users->find()->where(['email'=>$this->request->getData('email')])->first();
			if($existUser->id){
				$out=['status'=>'emailerror','msg'=>'This email already Used'];
				echo json_encode($out);die;
			}
			
			$user=$this->Users->newEntity();
			if($this->request->getData('profile_image.name')){
				$uploadImage=$this->Image->upload_image_and_thumbnail($this->request->getData('profile_image'),700,500,200,250,'profile-images');
				$this->request->data['profile_image']=$uploadImage;
			}
			$this->request->data['added_date']=date('Y-m-d H:i:s');
			$this->request->data['modified_date']=date('Y-m-d H:i:s');
			$this->request->data['added_by']=$this->Auth->user('id');
			$this->request->data['status']='Active';
			$this->request->data['is_deleted']=0;
			$user=$this->Users->patchEntity($user,$this->request->getData());
			if($this->Users->save($user)){
				$out=['status'=>'success','msg'=>'User has been Saved'];
				echo json_encode($out);
			}else{
				$out=['status'=>'error','msg'=>'An Internal error,please try again'];
				echo json_encode($out);
			}
		}
		
		die;
	}
	public function saveEdit(){
		
		if ($this->request->is(['patch', 'post', 'put'])){
			$existUser=$this->Users->find()->where(['email'=>$this->request->getData('email'),'id !='=>$this->request->getData('id')])->first();
			if($existUser->id){
				$out=['status'=>'emailerror','msg'=>'This email already Used'];
				echo json_encode($out);die;
			}
			
			$user=$this->Users->get($this->request->getData('id'));
			if($this->request->getData('profile_image.name')){
				$uploadImage=$this->Image->upload_image_and_thumbnail($this->request->getData('profile_image'),700,500,200,250,'profile-images');
				$this->request->data['profile_image']=$uploadImage;
			}
			$this->request->data['modified_date']=date('Y-m-d H:i:s');
			$user=$this->Users->patchEntity($user,$this->request->getData());
			if($this->Users->save($user)){
				$out=['status'=>'success','msg'=>'User has been Saved'];
				echo json_encode($out);
			}else{
				$out=['status'=>'error','msg'=>'An Internal error,please try again'];
				echo json_encode($out);
			}
		}
		die;
	}
}
