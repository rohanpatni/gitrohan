<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class PostsController extends AppController {
	var $name = 'Post';
	var $components = array('Session');
	var $uses = array('Post');
	var $helpers = array('Html','Form');

	public function index(){
		$this->set('posts',$this->Post->find('all'));
		
	}

	public function view($id = null){
		if(!$id){
			throw new NotFoundException(_('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if(!$post) {
			throw new NotFoundException(_('Invalid post'));
		}
		$this->set('post',$post);

	}

	public function add(){
		if($this->request->is('post')){
			$this->Post->set($this->data);
			
			$this->Post->setValidation('addPost');
			if($this->Post->validates()){
			$this->Post->save($this->request->data);
				$this->Session->setFlash(_('Your Post has been saved.'));

				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(_('Unable to add your post.'));

		}

	}

	public function edit($id = null){
		if(!$id) {
			throw new NotFoundException(_('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if(!$post){
			throw new NotFoundException(_('Inavlid post'));
		}

		if($this->request->is(array('post','put'))) {
			$this->Post->id = $id;
			if($this->Post->save($this->request->data)) {
				$this->Session->setFlash(_('Your Post has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(_('Unable to update your post.'));
		}
		if(!$this->request->data){
			$this->request->data = $post;

		} 
			
	}

	public function delete($id){
		if($this->request->is('get')){
			throw MethodNotAllowedException();
		}

		if($this->Post->delete($id)){
			$this->Session->setFlash(_('The post with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));

		}
	}
}









