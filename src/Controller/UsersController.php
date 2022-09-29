<?php

namespace App\Controller;
use Cake\Event\EventInterface;

class UsersController extends AppController {

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout']);
    }

    public function index() {
        //On  récupére  tous  les  users  et  on  les  stocke  dans $mesUsers
        $mesUsers = $this->Users->find('all')->contain([
        'Articles' => function ($q) {
            return $q
            ->select(['user_id']);
        }])->all();
        $this->set(compact('mesUsers'));  //Envoie  à  la  vue  le contenu de $mesUsersdans $rep qui sera utiliseable
    }

    public function detail($id = null) {
        try {
            $leUser = $this->Users->get($id);
        } catch (\Exception $e) {
            if ($id == null) {
                $this->Flash->error(__("L'action view doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L'user {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('leUser'));
    }

    public function add() {
        $leNewUser = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $leNewUser = $this->Users->patchEntity($leNewUser, $this->request->getData());
            if ($this->Users->save($leNewUser)) {
                $this->Flash->success(__("Le user a été sauvegardé."));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__("Impossible d'ajouter votre user."));
        }
        $this->set(compact('leNewUser'));
    }

    Public function edit($id = null) {
        try {
            $leUser = $this->Users->get($id);
        } catch (\Exception $ex) {
            if ($id == null) {
                $this->Flash->error(__("L'user edit doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L'user {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Users->patchEntity($leUser, $this->request->getdata());
            if ($this->Users->save($leUser)) {
                $this->Flash->success(__('Votre user a été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__('Impossible de mettre à jour votre user.'));
        }
        $this->set(compact('leUser'));
    }

    public function delete($id = null) {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $leUser = $this->Users->get($id);
            if ($this->Users->delete($leUser)) {
                $this->Flash->success(__("L'user {0} d' id {1} a bien été supprimé ! ", $leUser->username, $leUser->id));
            }
        } catch (\Exception $ex) {
            $this->Flash->error("Vous ne vouvez pas supprimer");
            return $this->redirect(['action' => 'index', 'controller' => 'users']);
        }
        
    }
    
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Mauvais username ou mot de passe, veuillez réessayer'));
        }
    }
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
