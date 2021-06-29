<?php
class CategoryModel extends Db{
    public function getCategory()
    {
        $sql = parent::$connection->prepare("SELECT * FROM categories");
        return parent::select($sql);
    }
}