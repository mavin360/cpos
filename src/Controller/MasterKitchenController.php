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
class MasterKitchenController extends AppController
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
       if ($user['role_id'] === 3) {
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
		$kitchen=$this->Auth->user('brand_id');
		$allOrders=$Orders->find()->contain(['OrderItems'=>function(\Cake\ORM\Query $q) {
				return $q->contain(['Items','OrderItemToppings']);
			}])->all()->toArray();
		
		foreach($allOrders as $ord){
				$order['id']=$ord['id'];
				$order['customer_id']=$ord['customer_id'];
				$order['total_paid_amount']=$ord['total_paid_amount'];
				$order['order_status']=$ord['order_status'];
				$order['order_status']=$ord['order_status'];
				$order['store_id']=$ord['store_id'];
				if($ord['order_items']){
					$tmpItem=[];
					foreach($ord['order_items'] as $item){
						$Brands=TableRegistry::get('Brands');
						$brand=$Brands->find()->where(['Brands.id'=>$item['brand_id']])->first();
						$tmpItem[$item['brand_id']]['items'][]=$item;
						$tmpItem[$item['brand_id']]['brand']=$item['brand_id'];
						$tmpItem[$item['brand_id']]['brand_name']=$brand->name;
						$tmpItem[$item['brand_id']]['status']=$item['status'];
					}
					$order['order_items']=array_values($tmpItem);
					
				}
				$allOrdArr[]=$order;
				//pr($allOrdArr);
		}
		
		
		
		$this->set('Auth',$this->Auth);
    }
	
	public function orders(){
		$OrderItems=TableRegistry::get('OrderItems');
		$Orders=TableRegistry::get('Orders');
		$kitchen=$this->Auth->user();
		$allOrders=$Orders->find()->contain(['OrderItems'=>function(\Cake\ORM\Query $q) {
				return $q->contain(['Items','OrderItemToppings']);
			}])->where(['Orders.order_status'=>'Pending'])->all()->toArray();
		
		foreach($allOrders as $ord){
				$order['id']=$ord['id'];
				$order['customer_id']=$ord['customer_id'];
				$order['total_paid_amount']=$ord['total_paid_amount'];
				$order['order_status']=$ord['order_status'];
				$order['order_status']=$ord['order_status'];
				$order['store_id']=$ord['store_id'];
				$order['order_delevery']='';
				$order['order_date']=$ord['order_date'];
				if($ord['order_items']){
					$tmpItem=[];
					foreach($ord['order_items'] as $item){
						$Brands=TableRegistry::get('Brands');
						$brand=$Brands->find()->where(['Brands.id'=>$item['brand_id']])->first();
						$tmpItem[$item['brand_id']]['items'][]=$item;
						$tmpItem[$item['brand_id']]['brand']=$item['brand_id'];
						$tmpItem[$item['brand_id']]['brand_name']=$brand->name;
						$tmpItem[$item['brand_id']]['status']=$item['status'];
						if($item['status']=='Pending'){
							$order['order_delevery']=$item['status'];
						}
						
					}
					$order['order_items']=array_values($tmpItem);
					
				}
				$allOrdArr[]=$order;
		}
		echo json_encode($allOrdArr);
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
	
	function dispatchOrder(){
		$order=$this->request->getData('data');
		if($order){
			$ord_des='';
			foreach($order['order_items'] as $ord){
				$i=1;
				foreach($ord['items'] as $item){
					$ord_des.=$item['item']['name'].', ';
					$i++;
				}
			}
			 $Customers=TableRegistry::get('Customers');
            $customer=$Customers->find()->contain(['Stores'])->where(['Customers.id'=>$order['customer_id']])->first();
			//pr($order);
			
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Headers: X-Requested-With');
			header('Access-Control-Allow-Headers: Content-Type');
			$fields=(array(
			  'store_id' => $customer->store->store_name,
			  'order_no' => '00'.$order['id'],
			  'order_description' => $ord_des,
			  'customer_first_name' => $customer->name,
			  'customer_last_name' => $customer->sur_name,
			  'customer_contact_no' => $customer->phone,
			  'customer_address' => $customer->address,
			  'customer_email' => $customer->email,
			  'device_androidKey' => '',
			  'device_appleKey' => ''
			));
			$url='http://demo.delivertrac.com/orders/create';
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'CONTENT_TYPE: application/x-wwww-form-urlencoded'
				));
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);
			curl_close($curl);
			if($response){
				$Orders=TableRegistry::get('Orders');
				$uorder=$Orders->get($order['id']);
				$uorder->order_status='Dispatched';
				if($Orders->save($uorder)){
					echo json_encode(['type'=>'success','response'=>$response]);
				}
			};
		}
		die;
	}
}
