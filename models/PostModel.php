<?php


namespace app\models;


use app\core\Application;
use app\core\Model;
use app\models\fields\DateTimeModelField;
use app\models\fields\IntegerModelField;
use app\models\fields\TextModelField;

class PostModel extends Model
{
    const STATUS_UNPUBLISHED = 0;
    const STATUS_PENDING = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_DELETED = 4;
    const DB_TABLE = "posts";

    private SessionModel $sessionModel;
    public bool $isUserLoggedIn = false;

    public IntegerModelField $author_id;
    public TextModelField $title;
    public TextModelField $content;
    public DateTimeModelField $created_at;
    public DateTimeModelField $published_at;
    public IntegerModelField $status;
    public DateTimeModelField $last_updated_at;
    public UserModel $author;
    public array $postList;
    public array $commentList;

    public function __construct()
    {
        parent::__construct();
        $this->author_id = new IntegerModelField("author_id", "Author ID");
        $this->title = new TextModelField("title", "Post Title");
        $this->content = new TextModelField("content", "Post Content");
        $this->status = new IntegerModelField("status", "Status");
        $this->created_at = new DateTimeModelField("created_at", "Created At");
        $this->published_at = new DateTimeModelField("published_at", "Published At");
        $this->last_updated_at = new DateTimeModelField("last_updated_at", "Last Updated At");

        $this->title->setMin(10)->setMax(512)->setRequired(true);
        $this->content->setMin(10)->setMax(65535)->setRequired(true);
        $this->status->setMax(self::STATUS_DELETED)->setDefault(self::STATUS_UNPUBLISHED);
    }

    public function writePost()
    {
        if ($this->isFormValid){
            $this->db->insertIntoTable(self::DB_TABLE,
                [$this->author_id, $this->title, $this->content, $this->status]);
            $this->session->setMessage("info", "Post Added",
                "You have successfully added a new post");
            return true;
        } else {
            return false;
        }
    }

    public function isPostExist($id, $loginRequired=false)
    {
        $data = ["id"=>$id];
        $searchFields = [$this->id];
        if ($loginRequired){
            $data["author_id"] = Application::$app->user->id->getValue();
            array_push($searchFields, $this->author_id);
        }
        $this->loadData($data);

        $record = $this->db->selectObject(self::DB_TABLE,
            $searchFields, [$this->id, $this->title, $this->content,
                $this->author_id, $this->status, $this->created_at, $this->published_at]);
        if ($record){
            $this->setProperties($record);
        }
        $user = new UserModel();
        $this->author = $user->setUserFromID($this->author_id->getValue());
        return ($record) ? true : false;
    }

    public function updatePost()
    {
        if ($this->isFormValid){
            $this->db->updateTable(self::DB_TABLE,
                [$this->id], [$this->title, $this->content]);
            $this->session->setMessage("info", "Post Updated",
                "You have successfully updated your post");

        }
    }

    public function newPostInstance($record)
    {
        $post = new PostModel();
        $post->loadData($record);
        return $post;
    }
    public function getAuthorPosts()
    {
        $this->loadData(["author_id"=>Application::$app->user->id->getValue()]);
        $records = $this->db->selectResult(self::DB_TABLE,
            [$this->author_id], [$this->id, $this->author_id, $this->title, $this->created_at,
                $this->published_at, $this->status]);
        $this->postList = array_map(fn($r) => $this->newPostInstance($r), $records);
        return $this->postList;
    }

    public function loadComments()
    {
        $comment = new CommentModel();
        $this->commentList = $comment->getPostComments($this);
        return $this->commentList;
    }
}