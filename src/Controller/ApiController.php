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
class ApiController extends AppController
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
		$this->viewBuilder()->setLayout(false);
		$this->loadComponent('Paginator');
		
	}
	
	 public function isAuthorized($user = null)
    {
       return true;
    }
	public $paginate = [
         'limit' =>20
    ];
    public function customer()
    {
        if($this->request->getData('phone')){
            $Customers=TableRegistry::get('Customers');
            $customer=$Customers->find()->contain(['Stores'])->where(['Customers.phone'=>$this->request->getData('phone')])->first();
            if($customer){
                $out=['status'=>'success','customer'=>$customer];
				$this->getRequest()->getSession()->write('Customer.phone',$this->request->getData('phone'));
				$this->getRequest()->getSession()->write('Customer.name',$customer->name);
				$this->getRequest()->getSession()->write('Customer.store',$customer->store->id);
            }else{
				$this->getRequest()->getSession()->delete('Customer');
                $out=['status'=>'new','phone'=>$this->request->getData('phone')];
            }
            echo json_encode($out);
        }
		die;
    }
	
	public function saveCustomer(){
		$Customers=TableRegistry::get('Customers');
        $customer=$Customers->newEntity();
		if($this->request->getData()){
			$this->request->data['city_zip']=$this->request->getData('city');
			$this->request->data['address']=($this->request->getData('apartment_no')?$this->request->getData('apartment_no').', ':'').($this->request->getData('street_no')?$this->request->getData('street_no').', ':'').($this->request->getData('street_name')?$this->request->getData('street_name').' - ':'').$this->request->getData('city');
			$this->request->data['status']='Active';
			$this->request->data['store_id']=3;
			$this->request->data['added_by']=$this->Auth->user('id');
			$this->request->data['added_date']=date('Y-m-d H:i:s');
			$customer=$Customers->patchEntity($customer,$this->request->getData());
			if($Customers->save($customer)){
				$customer=$Customers->find()->contain(['Stores'])->where(['Customers.phone'=>$this->request->getData('phone')])->first();
				$out=['status'=>'success','customer'=>$customer];
				$this->getRequest()->getSession()->write('Customer.phone',$this->request->getData('phone'));
				$this->getRequest()->getSession()->write('Customer.name',$customer->name);
				$this->getRequest()->getSession()->write('Customer.store',$customer->store->id);
			}else{
                $out=['status'=>'error','msg'=>'An internal error'];
            }
            echo json_encode($out);
		}
		die;
	}
	
	public function orderType(){
		if($this->request->getData('ordertype')){
			$this->getRequest()->getSession()->write('Customer.ordertype',$this->request->getData('ordertype'));
			$out=['status'=>'success','action'=>$this->request->getAttribute("webroot").'pos/order'];
		}
			echo json_encode($out);
		die;
	}
	public function changeOrderType(){
		$type=$this->request->getData('type');
		if($type){
			$this->getRequest()->getSession()->write('Customer.ordertype',$type);
			echo json_encode(['type'=>'success']);
		}
		die;
	}
	
	public function brands(){
		$Brands=TableRegistry::get('Brands');
		$allBrands=$Brands->find()->order(['Brands.sort_order'=>'ASC'])->all();
		echo json_encode($allBrands);
		die;
	}
	public function categories(){
		$id=$this->request->getQuery('id');
		$Categories=TableRegistry::get('Categories');
		if($id){
			$allCategories=$Categories->find()->where(['Categories.brand_id'=>$id])->all();
		}else{
			$allCategories=$Categories->find()->where(['Categories.brand_id'=>1])->all();
		}
		echo json_encode($allCategories);
		die;
	}
	public function change(){
		$this->getRequest()->getSession()->delete('Customer');
		die;
	}
	
	public function items(){
		$id=$this->request->getQuery('id');
		$brand_id=$this->request->getQuery('brand_id');
		$Items=TableRegistry::get('Items');
		$query=$Items->find()->contain(['ItemSizes']);
		if($id){
			$allItems=$query->where(['Items.category_id'=>$id,'Items.status'=>'Active'])->all();
		}else if($brand_id){
			$allItems=$query->where(['Items.brand_id'=>$brand_id,'Items.status'=>'Active'])->all();
		}
		echo json_encode($allItems);
		die;
	}
	
	public function addToCart(){
		$cartDatas=$this->getRequest()->getSession()->read('Customer.cart');
		$subTotal=0;
		$total=0;
		if($cartDatas){
			$subTotal=$cartDatas['cart_sub'];
			$total=$cartDatas['cart_total'];
			$items=$cartDatas;
		}
			if($items['Items'][$this->request->getData('item.id')]){
				$oldItem=$cartDatas['Items'][$this->request->getData('item.id')];
				$item['name']=$oldItem['id'];
				$item['name']=$oldItem['name'];
				$item['unit_price']=$oldItem['unit_price'];
				$item['count']=$oldItem['count']+1;
				$item['total_price']=$this->request->getData('item.price')*$item['count'];
				$items['Items'][$this->request->getData('item.id')]=$item;
			}else{
				$item['id']=$this->request->getData('item.id');
				$item['name']=$this->request->getData('item.name');
				$item['unit_price']=$this->request->getData('item.price');
				$item['count']=1;
				$item['sub_total_price']=$item['unit_price'];
				$item['total_price']=$this->request->getData('item.price')*1;
				$items['Items'][$this->request->getData('item.id')]=$item;
			}
		$items['cart_sub']=$subTotal+$item['unit_price'];
		$items['cart_total']=$total+$item['unit_price'];
		$this->getRequest()->getSession()->write('Customer.cart',$items);
		
		echo json_encode(['type'=>'success','sub_total'=>$items['cart_sub'],'cart_total'=>$items['cart_total'],'items'=>array_values($items['Items'])]);
		$this->getRequest()->getSession()->delete('Customer.discount');
		die;
	}
	
	public function addToCartWithToppings(){
		$data=$this->request->getData();
		$items=$this->getRequest()->getSession()->read('Customer.cart');
		parse_str($data['toppings'],$output);
		$data['toppings']=$output;
		if($data){
			$item['id']=$data['item']['id'];
			$item['name']=$data['item']['name'];
			$item['unit_price']=$data['item']['price'];
			$item['count']=1;
			$item['total_price']=$data['item']['price'];
			$item['size']=['name'=>$data['size']['size_name'],'price'=>$data['size']['size_price']];
			$item['total_price']=$item['total_price']+$data['size']['size_price'];
			$item['toppings'][]=['name'=>$data['crust']['crust'],'price'=>$data['crust']['price']];
			$item['total_price']=$item['total_price']+$data['crust']['price'];
			if($data['toppings']['sauce']){
				$item['toppings'][]=['name'=>$data['toppings']['sauce'],'price'=>2];
				$item['total_price']=$item['total_price']+2;
			}
			if($data['toppings']['cheese']){
				$item['toppings'][]=['name'=>$data['toppings']['cheese'],'price'=>2];
				$item['total_price']=$item['total_price']+2;
			}
			if($data['toppings']['tf-farm']){
				foreach($data['toppings']['tf-farm'] as $tf){
					$item['toppings'][]=['name'=>$tf,'price'=>2];
					$item['total_price']=$item['total_price']+2;
				}
			}
			if($data['toppings']['tf-field']){
				foreach($data['toppings']['tf-field'] as $tf){
					$item['toppings'][]=['name'=>$tf,'price'=>2];
					$item['total_price']=$item['total_price']+2;
				}
			}
			$item['sub_total_price']=$item['total_price'];
			if($items['Items']){
				array_push($items['Items'],$item);
			}else{
				$items['Items'][]=$item;
			}
			$items['cart_sub']=$items['cart_sub']+$item['total_price'];
			$items['cart_total']=$items['cart_total']+$item['total_price'];
		}
		$this->getRequest()->getSession()->write('Customer.cart',$items);
		echo json_encode(['type'=>'success','sub_total'=>$items['cart_sub'],'cart_total'=>$items['cart_total'],'items'=>array_values($items['Items'])]);
		$this->getRequest()->getSession()->delete('Customer.discount');
		die;
	}
	
	public function countAction(){
		$index=$this->request->getData('index');
		$action=$this->request->getData('action');
		$cartDatas=$this->getRequest()->getSession()->read('Customer.cart');
		$items=array_values($cartDatas['Items']);
		$selectedData=$items[$index];
		if($selectedData){
			if($action==='plus'){
				$selectedData['count']=$selectedData['count']+1;
				$selectedData['total_price']=$selectedData['count']*$selectedData['sub_total_price'];
				$items[$index]=$selectedData;
				$cartDatas['cart_sub']=$cartDatas['cart_sub']+$selectedData['sub_total_price'];
				$cartDatas['cart_total']=$cartDatas['cart_total']+$selectedData['sub_total_price'];
			}else if($action==='minus'){
				if($selectedData['count']>1){
				$selectedData['count']=$selectedData['count']-1;
				$selectedData['total_price']=$selectedData['count']*$selectedData['sub_total_price'];
				$items[$index]=$selectedData;
				}else if($selectedData['count']==1){
					unset($items[$index]);
				}
				$cartDatas['cart_sub']=$cartDatas['cart_sub']-$selectedData['sub_total_price'];
				$cartDatas['cart_total']=$cartDatas['cart_total']-$selectedData['sub_total_price'];
			}
			foreach($items as $oItem){
				if(empty($oItem['size'])){
					$outItems[$oItem['id']]=$oItem;
				}else{
					$outItems[]=$oItem;
				}
			}
			$cartDatas['Items']=$outItems;
			$this->getRequest()->getSession()->write('Customer.cart',$cartDatas);
			echo json_encode(['type'=>'success','sub_total'=>$cartDatas['cart_sub'],'cart_total'=>$cartDatas['cart_total'],'items'=>array_values($cartDatas['Items'])]);
			$this->getRequest()->getSession()->delete('Customer.discount');
		}
		die;
	}
	public function deleteAction(){
		$index=$this->request->getData('index');
		$cartDatas=$this->getRequest()->getSession()->read('Customer.cart');
		$items=array_values($cartDatas['Items']);
		if($items[$index]){
			$selectedData=$items[$index];
			unset($items[$index]);
			$cartDatas['cart_sub']=$cartDatas['cart_sub']-$selectedData['total_price'];
			$cartDatas['cart_total']=$cartDatas['cart_total']-$selectedData['total_price'];
		}
		foreach($items as $oItem){
			if(empty($oItem['size'])){
				$outItems[$oItem['id']]=$oItem;
			}else{
				$outItems[]=$oItem;
			}
		}
			$cartDatas['Items']=$outItems;
			$this->getRequest()->getSession()->write('Customer.cart',$cartDatas);
			echo json_encode(['type'=>'success','sub_total'=>$cartDatas['cart_sub'],'cart_total'=>$cartDatas['cart_total'],'items'=>array_values($cartDatas['Items'])]);
			$this->getRequest()->getSession()->delete('Customer.discount');
		die;
	}
	
	public function allCartItems(){
		$items=$this->getRequest()->getSession()->read('Customer.cart');
		$discount=$this->getRequest()->getSession()->read('Customer.discount');
		if($items){
			if($discount){
				$crtDis=($items['cart_total']/100)*$discount;
				$total=$items['cart_total']-$crtDis;
			}else{
				$crtDis=0;
				$total=$items['cart_total'];
			}
			echo json_encode(['type'=>'success','sub_total'=>$items['cart_sub'],'cart_total'=>$total,'discount_amount'=>$crtDis,'items'=>array_values($items['Items'])]);
		}else{
			echo json_encode(['type'=>'success','sub_total'=>0,'cart_total'=>0,'discount_amount'=>0,'items'=>[]]);
		}
		die;
	}
	
	public function cancelOrder(){
		$this->getRequest()->getSession()->delete('Customer.cart');
		echo json_encode(['type'=>'success','sub_total'=>0,'cart_total'=>0,'items'=>[]]);
		die;
	}
	
	function addOrder(){
		$data=$this->getRequest()->getSession()->read('Customer');
		$Orders=TableRegistry::get('Orders');
		$Customers=TableRegistry::get('Customers');
		$customer=$Customers->find()->where(['Customers.phone'=>$data['phone']])->first();
		if(!empty($data['cart']['Items'])){
			$order=$Orders->newEntity();
			$order->customer_id=$customer->id;
			$order->order_id=uniqid('CPOS-');
			$order->total_paid_amount=$data['cart']['cart_total'];
			$order->order_status="Pending";
			$order->order_type =$data['ordertype'];
			$order->payment_type ='Cash';
			$order->payment_status ='Done';
			$order->order_date=date('Y-m-d H:i:s');
			$order->payment_date=date('Y-m-d H:i:s');
			$order->store_id=$data['store'];
			if($data['cart']['Items']){
				$OrderItems=TableRegistry::get('OrderItems');
				$Items=TableRegistry::get('Items');
				foreach($data['cart']['Items'] as $item){
					$orderItem=$OrderItems->newEntity();
					$orderItem->customer_id=$customer->id;
					$orderItem->item_id=$item['id'];
					if($item['size']['name']){
						$orderItem->size=$item['size']['name'];
						$orderItem->size_amount=$item['size']['price'];
					}else{
						$orderItem->size='';
						$orderItem->size_amount='';
					}
					$orderItem->brand_id=$Items->getBrandId($item['id']);
					$orderItem->quantity=$item['count'];
					$orderItem->unit_price=$item['unit_price'];
					$orderItem->total_price=$item['total_price'];
					$orderItem->added_date=date('Y-m-d H:i:s');
					$orderItem->status='Pending';
					if($item['toppings']){
						$OrderItemToppings=TableRegistry::get('OrderItemToppings');
						foreach($item['toppings'] as $topping){
							$orderItemTopping=$OrderItemToppings->newEntity();
							$orderItemTopping->item_id=$item['id'];
							$orderItemTopping->topping_name=$topping['name'];
							$orderItemTopping->topping_amount=$topping['price'];
							$orderItemTopping->added_date=date('Y-m-d H:i:s');
							$orderItemToppingsArr[]=$orderItemTopping;
						}
						$orderItem->order_item_toppings=$orderItemToppingsArr;
					}
					$orderItemsArr[]=$orderItem;
				}
				$order->order_items=$orderItemsArr;
			}
			if($Orders->save($order)){
				$this->getRequest()->getSession()->delete('Customer');
				echo json_encode(['type'=>'success','action'=>$this->request->getAttribute("webroot").'pos']);
			}
		}else{
			echo json_encode(['type'=>'error','msg'=>'No Item(s) added in cart for order']);
		}
		die;
	}
	
	public function applyDiscount(){
		$discount=$this->request->getData('discount');
		$this->getRequest()->getSession()->write('Customer.discount',$discount);
		echo json_encode(['type'=>'success']);
		die;
	}
}
