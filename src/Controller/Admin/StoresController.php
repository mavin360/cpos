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

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class StoresController extends AppController
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
		
		$this->viewBuilder()->setLayout('admin');
		
		$this->loadComponent('Paginator');
		$this->loadComponent('Image');
	}
	
	 public function isAuthorized($user = null)
    {
        if ($user['role_id'] === 1) {
            return true;
        }
    }
	public $paginate = [
         'limit' =>20
    ];
    public function index()
    {
		$Stores=$this->Stores->find()->where(['Stores.company_id'=>$this->Auth->user('id')]);
        $Stores = $this->paginate($Stores)->toArray();
        $this->set(compact('Stores'));
    }
	
	public function add(){
		$store=$this->Stores->newEntity();
		$allCountries=json_decode(file_get_contents('countries.json'),true);
		if($allCountries){
			$countryArr['']='';
			foreach($allCountries as $count){
				$countryArr[$count['name']]=$count['name'];
			}
		}
		 $this->set(compact('store','countryArr'));
	}
	
	public function save(){
		//pr($this->request->getData());
		
		$store=$this->Stores->newEntity();
		
		if($this->request->getData('store_image.name')){
			$uploadImage=$this->Image->upload_image_and_thumbnail($this->request->getData('store_image'),700,500,200,250,'store-logo');
			$this->request->data['store_image']=$uploadImage;
		}
		$this->request->data['company_id']=$this->Auth->user('id');
		$this->request->data['created']=date('Y-m-d H:i:s');
		$store=$this->Stores->patchEntity($store,$this->request->getData());
		$timedata=$this->request->getData();
		if($data=$this->request->getData('store_open_days_from')){
			foreach($data as $key=>$ddata){
				$storeTime=$this->Stores->StoreTimes->newEntity();
				$storeTime->from_open_day=$ddata;
				$storeTime->to_open_day=$timedata['store_open_days_to'][$key];
				$storeTime->from_open_time=$timedata['store_open_time_from'][$key];
				$storeTime->to_open_time=$timedata['store_open_time_to'][$key];
				$storeTime->status='active';
				$storeTime->added_date=date('Y-m-d H:i:s');
				$dataArr[]=$storeTime;
			}
			$store->store_times=$dataArr;
		}
		if($this->Stores->save($store)){
			$out=['status'=>'success','msg'=>'Store has been Saved'];
			echo json_encode($out);
		}else{
			$out=['status'=>'error','msg'=>'An Internal error,please try again'];
			echo json_encode($out);
		}
		die;
	}
	public function view($id=null){
		 if (empty($id)) {
			throw new NotFoundException(__('Store not found'));
		}
		$store=$this->Stores->get($id,['contain'=>'StoreTimes']);
		$this->set(compact('store'));
	}
	
	public function edit($id=null){
		if (empty($id)) {
			throw new NotFoundException(__('Store not found'));
		}
		$store=$this->Stores->get($id,['contain'=>'StoreTimes']);
		$allCountries=json_decode(file_get_contents('countries.json'),true);
		if($allCountries){
			$countryArr['']='';
			foreach($allCountries as $count){
				$countryArr[$count['name']]=$count['name'];
			}
		}
		 $this->set(compact('store','countryArr'));	
	}
	
	public function saveEdit(){
		$id=$this->request->getData('id');
		//pr($this->request->getData());die;
		if($id){
			$store=$this->Stores->get($id,['contain'=>'StoreTimes']);
		}
		if($this->request->getData('store_image.name')){
			$uploadImage=$this->Image->upload_image_and_thumbnail($this->request->getData('store_image'),700,500,200,250,'store-logo');
			$this->request->data['store_image']=$uploadImage;
		}
		$this->request->data['modified']=date('Y-m-d H:i:s');
		$store=$this->Stores->patchEntity($store,$this->request->getData());
		$timedata=$this->request->getData();
		if($data=$this->request->getData('store_open_days_from')){
			$this->Stores->StoreTimes->deleteAll(['store_id'=>$id]);
			foreach($data as $key=>$ddata){
				$storeTime=$this->Stores->StoreTimes->newEntity();
				$storeTime->from_open_day=$ddata;
				$storeTime->to_open_day=$timedata['store_open_days_to'][$key];
				$storeTime->from_open_time=$timedata['store_open_time_from'][$key];
				$storeTime->to_open_time=$timedata['store_open_time_to'][$key];
				$storeTime->status='active';
				$storeTime->added_date=date('Y-m-d H:i:s');
				$dataArr[]=$storeTime;
			}
			$store->store_times=$dataArr;
		}
		if($this->Stores->save($store)){
			$out=['status'=>'success','msg'=>'Store has been Edited'];
			echo json_encode($out);
		}else{
			$out=['status'=>'error','msg'=>'An Internal error,please try again'];
			echo json_encode($out);
		}
		die;
	}
	public function changeStatus(){
		$id=$this->request->getData('id');
		if($id){
			$store=$this->Stores->get($id);
			$store->status=$this->request->getData('status');
			if($this->Stores->save($store)){
				$out=['status'=>'success'];
				echo json_encode($out);
			}
		}
		die;
	}
	
	
	public function Brands(){
		$Brands=$this->Stores->Brands->find()->contain(['Stores'])->where(['Brands.added_by'=>$this->Auth->user('id')]);
        $Stores = $this->paginate($Brands)->toArray();
        $this->set(compact('Brands'));
		
	}
	public function addBrand(){
		if($this->request->getParam('isAjax')==1){
			$this->viewBuilder()->setLayout('ajax');
		}else{
			$this->viewBuilder()->setLayout('admin');
		}
		$brand=$this->Stores->Brands->newEntity();
		$stores=$this->Stores->find('list',['keyField' => 'id','valueField' =>'store_name'])->toArray();
		$this->set(compact('brand','stores'));
	}
	
	public function editBrand($id=null){
		if($this->request->getParam('isAjax')==1){
			$this->viewBuilder()->setLayout('ajax');
		}else{
			$this->viewBuilder()->setLayout('admin');
		}
		if (empty($id)) {
			throw new NotFoundException(__('Brand not found'));
		}
		$brand=$this->Stores->Brands->get($id);
		$stores=$this->Stores->find('list',['keyField' => 'id','valueField' =>'store_name'])->toArray();
		$addedstores=$this->Stores->Brands->BrandStores->find('list',['keyField' => 'id','valueField' =>'store_id'])->where(['brand_id'=>$id])->toArray();
		$this->set(compact('brand','stores','addedstores'));
	}
	
	public function saveBrand(){
		$brand=$this->Stores->Brands->newEntity();
		$brand->name=$this->request->getData('name');
		$brand->description=$this->request->getData('description');
		if($this->request->getData('logo.name')){
			$uploadImage=$this->Image->upload_image_and_thumbnail($this->request->getData('logo'),700,500,200,250,'brand-images');
			$brand->logo=$uploadImage;
		}
		$brand->added_by=$this->Auth->user('id');
		$brand->added_date=date('Y-m-d H:i:s');
		if($this->request->getData('store_id')){
			$storesIds=$this->request->getData('store_id');
			foreach($storesIds as $stId){
				if($stId!=0){
					$brand_store=$this->Stores->Brands->BrandStores->newEntity();
					$brand_store->store_id=$stId;
					$brand_store->added_date=date('Y-m-d H:i:s');
					$brandStores[]=$brand_store;
				}
			}
			$brand->brand_stores=$brandStores;
		}
		if($this->Stores->Brands->save($brand)){
			$out=['status'=>'success','msg'=>'Brand has been Saved'];
			echo json_encode($out);
		}else{
			$out=['status'=>'error','msg'=>'An Internal error,please try again'];
			echo json_encode($out);
		}
		die;
	}
	public function saveEditBrand(){
		$id=$this->request->getData('id');
		$brand=$this->Stores->Brands->get($id);
		$brand->name=$this->request->getData('name');
		$brand->description=$this->request->getData('description');
		if($this->request->getData('logo.name')){
			$uploadImage=$this->Image->upload_image_and_thumbnail($this->request->getData('logo'),700,500,200,250,'brand-images');
			$brand->logo=$uploadImage;
		}
		if($this->request->getData('store_id')){
			$storesIds=$this->request->getData('store_id');
			$this->Stores->Brands->BrandStores->deleteAll(['brand_id'=>$id]);
			foreach($storesIds as $stId){
				if($stId!=0){
				$brand_store=$this->Stores->Brands->BrandStores->newEntity();
				$brand_store->store_id=$stId;
				$brand_store->added_date=date('Y-m-d H:i:s');
				$brandStores[]=$brand_store;
				}
			}
			$brand->brand_stores=$brandStores;
		}
		if($this->Stores->Brands->save($brand)){
			$out=['status'=>'success','msg'=>'Brand has been Saved'];
			echo json_encode($out);
		}else{
			$out=['status'=>'error','msg'=>'An Internal error,please try again'];
			echo json_encode($out);
		}
		die;
	}
	public function orderTypes()
    {
		$StOrdTypes=TableRegistry::get('StoreOrderTypes');
		$StoresOrderTypes=$StOrdTypes->find()->contain(['Stores'])->where(['StoreOrderTypes.added_by'=>$this->Auth->user('id')]);
        $StoresOrderTypes = $this->paginate($StoresOrderTypes)->toArray();
        $this->set(compact('StoresOrderTypes'));
    }
	
	public function addOrderType(){
		if($this->request->getParam('isAjax')==1){
			$this->viewBuilder()->setLayout('ajax');
		}else{
			$this->viewBuilder()->setLayout('admin');
		}
		$StOrdTypes=TableRegistry::get('StoreOrderTypes');
		$StoresOrderType=$StOrdTypes->newEntity();
		$stores=$this->Stores->find('list',['keyField' => 'id','valueField' =>'store_name'])->toArray();
		$this->set(compact('StoresOrderType','stores'));
	}
	
	public function saveType(){
		$StOrdTypes=TableRegistry::get('StoreOrderTypes');
		$StoresOrderType=$StOrdTypes->newEntity();
		$StoresOrderType->name=$this->request->getdata('name');
		$StoresOrderType->order_type=$this->request->getdata('order_type');
		$StoresOrderType->added_by=$this->Auth->user('id');
		$StoresOrderType->surcharge=$this->request->getdata('surcharge');
		$StoresOrderType->status='Active';
		$StoresOrderType->added_date=date('Y-m-d H:i:s');
		if($this->request->getdata('store_id')){
			$OrdTypeSts=TableRegistry::get('OrderTypeStores');
			foreach($this->request->getdata('store_id') as $id){
				if($id!=0){
					$ordTyStr=$OrdTypeSts->newEntity();
					$ordTyStr->store_id=$id;
					$ordTyStr->added_date=date('Y-m-d H:i:s');
					$arrs[]=$ordTyStr;
				}
			}
			$StoresOrderType->order_type_stores=$arrs;
		}
		if($StOrdTypes->save($StoresOrderType)){
			$out=['status'=>'success','msg'=>'Order Type has been Saved'];
			echo json_encode($out);
		}else{
			$out=['status'=>'error','msg'=>'An Internal error,please try again'];
			echo json_encode($out);
		}
		die;
	}
	
	public function changeTypeStatus(){
		$id=$this->request->getData('id');
		$StOrdTypes=TableRegistry::get('StoreOrderTypes');
		if($id){
			$status=$StOrdTypes->get($id);
			$status->status=$this->request->getData('status');
			if($StOrdTypes->save($status)){
				$out=['status'=>'success'];
				echo json_encode($out);
			}
		}
		die;
	}
	
	public function editOrderType($id=null){
		if($this->request->getParam('isAjax')==1){
			$this->viewBuilder()->setLayout('ajax');
		}else{
			$this->viewBuilder()->setLayout('admin');
		}
		$StOrdTypes=TableRegistry::get('StoreOrderTypes');
		$StoresOrderType=$StOrdTypes->get($id);
		$stores=$this->Stores->find('list',['keyField' => 'id','valueField' =>'store_name'])->toArray();
		$OrdTypeSts=TableRegistry::get('OrderTypeStores');
		$addedstores=$OrdTypeSts->find('list',['keyField' => 'id','valueField' =>'store_id'])->where(['store_order_type_id'=>$id])->toArray();
		$this->set(compact('StoresOrderType','stores','addedstores'));
	}
	
	public function saveEditType(){
		$id=$this->request->getData('id');
		$StOrdTypes=TableRegistry::get('StoreOrderTypes');
		$StoresOrderType=$StOrdTypes->get($id);
		
		//pr(die;);
		$StoresOrderType->name=$this->request->getdata('name');
		$StoresOrderType->order_type=$this->request->getdata('order_type');
		$StoresOrderType->surcharge=$this->request->getdata('surcharge');
		$StoresOrderType->modify_date=date('Y-m-d H:i:s');
		if($this->request->getdata('store_id')){
			$OrdTypeSts=TableRegistry::get('OrderTypeStores');
			$OrdTypeSts->deleteAll(['store_order_type_id'=>$id]);
			foreach($this->request->getdata('store_id') as $oid){
				if($oid!=0){
					$ordTyStr=$OrdTypeSts->newEntity();
					$ordTyStr->store_id=$oid;
					$ordTyStr->added_date=date('Y-m-d H:i:s');
					$arrs[]=$ordTyStr;
				}
			}
			$StoresOrderType->order_type_stores=$arrs;
			//pr($StoresOrderType);die;
		}
		if($StOrdTypes->save($StoresOrderType)){
			$out=['status'=>'success','msg'=>'Order Type has been Saved'];
			echo json_encode($out);
		}else{
			$out=['status'=>'error','msg'=>'An Internal error,please try again'];
			echo json_encode($out);
		}
		die;
	}
}
