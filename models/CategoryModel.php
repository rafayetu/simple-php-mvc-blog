<?php


namespace app\models;


use app\core\Model;
use app\models\fields\TextModelField;

class CategoryModel extends Model
{
    public TextModelField $category_key;
    public TextModelField $category_name;
    public array $categoryList;
    const DB_TABLE = "categories";

    public function __construct()
    {
        parent::__construct();
        $this->category_key = new TextModelField("category_key", "Category Key");
        $this->category_name = new TextModelField("category_name", "Category Name");
        $this->category_key->setRequired(true);
        $this->category_name->setRequired(true);
    }

    public function getCategoryInstance($record)
    {
        $category = new CategoryModel();
        $category->loadData($record);
        return $category;
    }

    public function selectCategories()
    {
        $records = $this->db->selectResult(self::DB_TABLE);
        $this->categoryList = array_map(fn($r) => $this->getCategoryInstance($r), $records);
        return $this->categoryList;
    }

}