﻿<?php

class EmailController extends AppController {

    public $name = 'Email';
    public $uses = array('Email');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'admin';
        if (!$this->Session->read("id") || !$this->Session->read("name")) {
            $this->redirect('/');
        }
    }
public function excel($id = null)
    {
        $this->autoLayout = false;

        $this->Email->recursive = 1;
        
        $data = $this->Email->find('all', array('conditions'=>array(),'order'=>'Email.id DESC'));

                
        $this->set('rows',$data);
    }
   function index() {
		 
		
		  $this->paginate = array('limit' => '15','order' => 'Email.id DESC');
	      $this->set('Email', $this->paginate('Email',array()));
		
		  
	}
	
	//Them bai viet
	function add() {
		
		if (!empty($this->data)) {
			$this->Email->create();
			$data['Email'] = $this->data['Email'];
			$data['Email']['images']=$_POST['userfile'];
			if ($this->Email->save($data['Email'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Category");
        $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Email->read(null, $id));
	}
	

	function search() {
		
	  
		$keyword=isset($_POST['name'])? $_POST['name'] : '';
		
	
		$this->paginate = array('conditions'=>array('Email.name like'=>'%'.$keyword.'%'),'limit' => '12','order' => 'Email.id DESC');
		
		
		$this->set('Email', $this->paginate('Email',array()));	
		$this->render('index');
		
       
		
	}
	function processing() {
		
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
	
			
			switch ($select){
				case 'active':
				$Email=($this->Email->find('all'));
				foreach($Email as $new) {
					if(isset($_POST[$new['Email']['id']]))
					{
						$new['Email']['status']=1;
						$this->Email->save($new['Email']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Email=($this->Email->find('all'));
				foreach($Email as $new) {
					if(isset($_POST[$new['Email']['id']]))
					{
						$new['Email']['status']=0;
						$this->Email->save($new['Email']);
					}
				}
				break;
				case 'delete':
				$Email=($this->Email->find('all'));
				foreach($Email as $new) {
					if(isset($_POST[$new['Email']['id']]))
					{
					    $this->Email->delete($new['Email']['id']);
					
					}
										
				}
				
					
				//vong lap xoa
				break;
				
			
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	
	//close tin tuc
	function close($id=null) {
		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Email'] = $this->data['Email'];
		$data['Email']['status']=0;
		if ($this->Email->save($data['Email'])) {
			$this->Session->setFlash(__('Bài viết không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// active tin bai viêt
	function active($id=null) {
		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Email'] = $this->data['Email'];
		$data['Email']['status']=1;
		if ($this->Email->save($data['Email'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	
	// Xoa cac dang
	function delete($id = null) {
				
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Email->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	
	

}
