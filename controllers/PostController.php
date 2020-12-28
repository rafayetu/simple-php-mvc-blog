<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\CommentModel;
use app\models\PostModel;
use app\views\LoginView;
use app\views\PostEditorView;
use app\views\PostReadView;
use app\views\PostsAuthorView;

class PostController extends Controller
{
    public function postEditor(Request $request)
    {
        $isPostExist = false;
        $this->loginRequired();
        $model = new PostModel();
        $post_id = $request->getPath()[1][0] ?? null;
        if ($post_id){
            $isPostExist = $model->isPostExist($post_id, $loginRequired=true);
            if (!$isPostExist){
                return $this->redirect($request->getPath()[0]);
            };
        }

        if ($request->isPost()){
            $body = $request->getBody();
            $body["author_id"] = $this->currentUserID();
            $body["status"] = isset($body["publish"]) ? PostModel::STATUS_PENDING : PostModel::STATUS_UNPUBLISHED;
            $model->loadData($body);
            if ($post_id && $isPostExist){
                $model->updatePost();
            } else {
                $model->writePost();
            }
            return $this->redirect(PostsAuthorView::PATH);
        }
        return $this->render(PostEditorView::class, ["model" => $model]);
    }

    public function postRead(Request $request)
    {
        $isPostExist = false;
        $model = new PostModel();
        $post_id = $request->getPath()[1][0] ?? null;
        if ($post_id) {
            $isPostExist = $model->isPostExist($post_id);
            if (!$isPostExist)
                return $this->redirectHome();
        } else {
            return $this->redirectHome();
        }

        if ($request->isPost()){
            $body = $request->getBody();
            $body["author_id"] = $this->currentUserID();
            $body["post_id"] = $post_id;

            if (isset($body["comment"]) && $isPostExist){
                $this->loginRequired();
                $commentModel = new CommentModel();
                $commentModel->loadData($body);
                $commentModel->writeComment();
            } elseif (isset($body["delete-comment"]) && $isPostExist){
                $this->loginRequired();
                $body["id"] = $body["delete-comment"];
                $commentModel = new CommentModel();
                $commentModel->loadData($body);
                $commentModel->deleteComment();
            }
            return $this->redirectSameURI();

        }
        return $this->render(PostReadView::class, ["model" => $model]);
    }

    public function postAuthor(Request $request)
    {
        $this->loginRequired();
        $model = new PostModel();
        $model->getAuthorPosts();

        return $this->render(PostsAuthorView::class, ["model" => $model]);
    }

}