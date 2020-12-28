<?php


namespace app\models;


use app\core\Model;
use app\models\fields\IntegerModelField;
use app\models\fields\TextModelField;

class CommentModel extends Model
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
    public TextModelField $created_at;
    public TextModelField $published_at;
    public IntegerModelField $status;
    public TextModelField $last_updated_at;
    public UserModel $author;
    public array $postList;
}