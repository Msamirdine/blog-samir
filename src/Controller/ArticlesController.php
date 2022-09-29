<?php

namespace App\Controller;

class ArticlesController extends AppController {

    public function index() {
        //On  récupére  tous  les  articles  et  on  les  stocke  dans $mesArticles
        $mesArticles = $this->Articles->find('all')->contain([
                    'Users' => function ($q) {
                        return $q
                                ->select(['username', 'email']);
                    },
                    'Comments' => function ($q) {
                        return $q
                                ->select(['article_id']);
                    },
                    'Tags'])->toArray();

        $this->set(compact('mesArticles'));  //Envoie  à  la  vue  le contenu de $mesArticles dans $rep qui sera utilisable
    }

    public function detail($id = null) {
        try {
            $leArticle = $this->Articles->get($id, [
                'contain' => ['Comments.Users' => function ($q) {
                        return $q
                                ->select(['username'])
                                ->order(['Comments.modified asc']);
                    },
                    'Users' => function ($q) {
                        return $q
                                ->select(['username']);
                    }]]);
        } catch (\Exception $e) {
            if ($id == null) {
                $this->Flash->error(__("L'action view doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L'article {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->loadModel('Comments');
        $leNewComment = $this->Comments->newEmptyEntity();

        //On sauvegarde le commentaire
        if ($this->request->is('post')) {
            $leNewComment = $this->Comments->patchEntity($leNewComment, $this->request->getData());
            $leNewComment->article_id = $leArticle->id;
            $leNewComment->user_id = $this->Auth->user('id');
            if ($this->Comments->save($leNewComment)) {
                $this->Flash->success(__("Le commentaire a été sauvegardé."));
                return $this->redirect(['controller' => 'articles', 'action' => 'detail', $leArticle->id]);
            } else {
                $this->Flash->error(__("Impossible d'ajouter votre commentaire."));
            }
        }

        $this->set(compact('leArticle', 'leNewComment'));
    }

    public function add() {
//        $leNewArticle = $this->Articles->newEmptyEntity();
////        $this->loadModel('Users');
////        $lesUsers = $this->Users->find('list', [
////            'keyField' => 'id',
////            'valueField' => 'username'
////        ]);
////        $lesUsers = $lesUsers->toArray();
//        if ($this->request->is('post')) {
//            $leNewArticle = $this->Articles->patchEntity($leNewArticle, $this->request->getData());
//            $leNewArticle->user_id = $this->Auth->user('id');
//            if ($this->Articles->save($leNewArticle)) {
//                $this->Flash->success(__("Le article a été sauvegardé."));
//                return $this->redirect(['action' => 'index']);
//            } else
//                $this->Flash->error(__("Impossible d'ajouter votre article."));
//        }
//        $this->set(compact('leNewArticle'));

        $leNewArticle = $this->Articles->newEmptyEntity();

        //on récupere tous les tags à afficher
        $this->loadModel('Tags');
        $lesTags = $this->Tags->find('list', [
            'valueField' => ['title']
        ]);
        $lesTags = $lesTags->toArray();

        //on charche la table association pour sauvegarder à l'interieur
        $this->loadModel('ArticlesTags');

        if ($this->request->is('post')) {
            $leNewArticle = $this->Articles->patchEntity($leNewArticle, $this->request->getData());
            $leNewArticle->user_id = $this->Auth->user('id');
            
            if ($this->Articles->save($leNewArticle)) {
                //si on a associé des tags au articles :
                if ($this->request->getData('tags._ids') != null) {
                    //on recupere chaque id du tag
                    foreach ($this->request->getData('tags._ids') as $unTag_id) {
                        //on crée l'enregistrement
                        $leNewTag = $this->ArticlesTags->newEmptyEntity();

                        //on associe au article le tag
                        $leNewTag->article_id = $leNewArticle->id;
                        $leNewTag->tag_id = $unTag_id;
                        $leNewTag->priority = 5;
                        //on enregistre dans la BDD
                        $this->ArticlesTags->save($leNewTag);
                    }
                }
                $this->Flash->success(__("Le article a été sauvegardé."));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__("Impossible d'ajouter votre article."));
        }
        $this->set(compact('leNewArticle', 'lesTags'));
        //$this->set(compact('leNewArticle'));
    }

    Public function edit($id = null) {
        try {
            $leArticle = $this->Articles->get($id, [
                'contain'=>'Tags'
            ]);
            $this->loadModel('Tags');
            
            $lesTags = $this->Tags->find('list', [
                'keyField' => 'id',
                'valueField' => 'title'
            ]);

            $lesTags = $lesTags->toArray();
        } catch (\Exception $ex) {
            if ($id == null) {
                $this->Flash->error(__("L'action edit doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L'article {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->loadModel('ArticlesTags');
        if ($this->request->is(['post', 'put'])) {
            $leArticle->tags = [];
            $leArticle=$this->Articles->patchEntity($leArticle, $this->request->getdata());
            if ($this->Articles->save($leArticle)) {
                if ($this->request->getData('tags._ids') != null) {
                    //on recupere chaque id du tag
                    foreach ($this->request->getData('tags._ids') as $unTag_id) {
                        //on crée l'enregistrement
                        $leNewTag = $this->ArticlesTags->newEmptyEntity();

                        //on associe au article le tag
                        $leNewTag->article_id = $leArticle->id;
                        $leNewTag->tag_id = $unTag_id;
                        $leNewTag->priority = 5;
                        //on enregistre dans la BDD
                        $this->ArticlesTags->save($leNewTag);
                    }
                }
                $this->Flash->success(__('Votre article a été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__('Impossible de mettre à jour votre post.'));
        }
        $this->set(compact('leArticle', 'lesTags'));
    }

    public function delete($id = null) {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $leArticle = $this->Articles->get($id);
            if ($this->Articles->deleteOrFail($leArticle)) {
                $this->Flash->success(__("L'article {0} d' id {1} a bien été supprimé ! ", $leArticle->title, $leArticle->id));
                return $this->redirect(['controller' => 'articles', 'action' => 'index']);
            }
        } catch (\Exception $ex) {
            $this->Flash->error('Votre article a été supprimer');
            return $this->redirect(['controller' => 'articles', 'action' => 'index']);
        }
    }

}
