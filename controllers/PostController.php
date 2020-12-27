<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
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
                return Application::$app->response->redirect($request->getPath()[0]);
            };
        }

        if ($request->isPost()){
            $body = $request->getBody();
            $body["author_id"] = Application::$app->user->id->getValue();
            $body["status"] = isset($body["publish"]) ? PostModel::STATUS_PENDING : PostModel::STATUS_UNPUBLISHED;
            $model->loadData($body);
            if ($post_id && $isPostExist){

                $model->updatePost();
            } else {
                if ($model->writePost()) {
                    return Application::$app->response->redirect("/");
                }
            }

        }
        return $this->render(PostEditorView::class, [
            "model" => $model
        ]);
    }

    public function postRead(Request $request)
    {
        $model = new PostModel();
        $post_id = $request->getPath()[1][0] ?? null;
        if ($post_id){
            if (!$model->isPostExist($post_id)){
                return Application::$app->response->redirect($request->getPath()[0]);
            };
        }

        return $this->render(PostReadView::class, [
            "model" => $model
        ]);
    }

    public function postAuthor(Request $request)
    {
        $model = new PostModel();
//        $post_id = $request->getPath()[1][0] ?? null;
//        if ($post_id){
//            if (!$model->isPostExist($post_id)){
//                return Application::$app->response->redirect($request->getPath()[0]);
//            };
//        }
        $model->getAuthorPosts();


        return $this->render(PostsAuthorView::class, [
            "model" => $model
        ]);
    }

}