<?php
class CategoryofProductsModel extends DB
{
    // b2 Viết câu SQL
    public function getCategoryofProducts()
    {
        $sql = parent::$connection->prepare("SELECT * FROM categoryofproducts");
        return parent::select($sql);
    }  
}
?>