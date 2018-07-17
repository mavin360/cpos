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
class KitchenController extends AppController
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
		
		$this->viewBuilder()->setLayout('pos_admin');
		$this->loadComponent('Paginator');
		//$this->Auth->config(['storage'=>['className' => 'Session', 'key' => 'Auth.Admin']]);
	}
	
	 public function isAuthorized($user = null)
    {
       if ($user['role_id'] === 2) {
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
		$this->viewBuilder()->setLayout(false);
		$OrderItems=TableRegistry::get('OrderItems');
		$Orders=TableRegistry::get('Orders');
		//$kitchen=$this->Auth->user('brand_id');
		//pr($this->Auth->user());
		//$query=$Orders->find();
		//$itemsCount=$query->select([
		//	'count' => $query->func()->count('Orders.order_items'),
		//]);
		$allOrders=$Orders->find()->contain(['OrderItems'=>function(\Cake\ORM\Query $q) {
			$kitchen=$this->Auth->user('brand_id');
			return $q->contain(['Items','OrderItemToppings'])->where(['OrderItems.brand_id'=>$kitchen,'OrderItems.status'=>'Pending']);
			
		}])->where(['Orders.order_status'=>'Pending']);
		//->having(['Orders.order_items >' => 3])
		//$allCount=$allOrders->select(['total_order' => $allOrders->func()->count('OrderItems.id')])->leftJoinWith('OrderItems');
		
		//$allOrders=$allOrders->all();
		//pr($itemsCount->toArray());
		foreach($allOrders as $ord){
			$bList=[];
			$b_count=$OrderItems->find('list',[
					'keyField' => 'brand_id',
					'valueField' => 'brand_id'
				])->where(['OrderItems.order_id'=>$ord->id])->group(['OrderItems.brand_id'])->toArray();
				foreach($b_count as $bc){
					$bList[]=$bc;
				}
			$a=count($bList);
			$b=array_search($this->Auth->user('brand_id'),$bList);
			$ord->cart_count=($b+1).'/'.$a;
			if($ord->order_items){
				
				$allOrdArr[]=$ord;
				//print_r($bList);
			}
			
			
		}
		//pr($allOrdArr);
		$this->set('Auth',$this->Auth);
    }
	
	public function orders(){
		$OrderItems=TableRegistry::get('OrderItems');
		$Orders=TableRegistry::get('Orders');
		//$kitchen=$this->Auth->user('brand_id');
		//$kitchen=$this->getRequest()->getSession()->read('Kitchen.brand_id');
		$allOrders=$Orders->find()->contain(['OrderItems'=>function(\Cake\ORM\Query $q) {
			$kitchen=$this->Auth->user('brand_id');
			return $q->contain(['Items','OrderItemToppings'])->where(['OrderItems.brand_id'=>$kitchen,'OrderItems.status'=>'Pending']);
			
		}])->where(['Orders.order_status'=>'Pending'])->all();
		foreach($allOrders as $ord){
			$bList=[];
			$b_count=$OrderItems->find('list',[
					'keyField' => 'brand_id',
					'valueField' => 'brand_id'
				])->where(['OrderItems.order_id'=>$ord->id])->group(['OrderItems.brand_id'])->toArray();
			foreach($b_count as $bc){
				$bList[]=$bc;
			}
			$a=count($bList);
			$b=array_search($this->Auth->user('brand_id'),$bList);
			$ord->cart_count=($b+1).'/'.$a;
			if($ord->order_items){
				$allOrdArr[]=$ord;
			}
		}
		
		echo json_encode($allOrdArr);
		die;
	}
	
	public function completeOrder(){
		//pr($this->request->getData());
		$order_id=$this->request->getData('id');
		$brand_id=$this->request->getData('kitchen');
		$OrderItems=TableRegistry::get('OrderItems');
		if($OrderItems->updateAll(['status' =>'Completed'],['order_id'=>$order_id,'brand_id'=>$brand_id])){
			echo json_encode(['type'=>'success']);
		}
		die;
	}
	
	public function brand($id){
		$Brands=TableRegistry::get('Brands');
		$brand=$Brands->find()->where(['Brands.id'=>$id])->first();
		echo json_encode($brand);
		die;
	}
	
	public function changeScreen($id=null){
		if($id=='master'){
			$Users=TableRegistry::get('Users');
			$user=$Users->find()->where(['Users.brand_id'=>0,'Users.role_id'=>3])->first()->toArray();
			//pr($user);die;
			if($user){
				$this->Auth->setUser($user);
				echo $id;
			}
		}else{
			$Users=TableRegistry::get('Users');
			$user=$Users->find()->where(['Users.brand_id'=>$id,'Users.role_id'=>2])->first()->toArray();
			if($user){
				$this->Auth->setUser($user);
				echo $id;
			}
		}
		
		die;
	}
}
