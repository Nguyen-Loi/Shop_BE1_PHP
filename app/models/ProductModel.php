<?php
class ProductModel extends Db
{
    public function getProduct()
    {
        $sql = parent::$connection->prepare("SELECT * FROM products");
        return parent::select($sql);
    }
    //lay san pham noi bat
    public function getFeaturedProduct()
    {
        $sql = parent::$connection->prepare("SELECT * FROM products WHERE product_rating >= 4 limit 4");
        return parent::select($sql);
    }
    //lay san pham moi
    public function getLatestdProduct()
    {
        $sql = parent::$connection->prepare("SELECT * FROM products WHERE id >= 12");
        return parent::select($sql);
    }
    public function getProductById($id)
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM products WHERE id=?");
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }
    // Lấy sản phẩm theo Phân loại tên
    public function getProductsbyCategory($categoryId)
    {   
        // viết câu sql
        $sql = parent::$connection->prepare("SELECT * 
        FROM products 
        INNER join products_categories 
        ON products.id = products_categories.product_id 
        where products_categories.category_id = ?");
        $sql->bind_param('i', $categoryId);
        return parent::select($sql);
    }   
     // lấy sản phẩm theo tên
     public function searchProduct($keyword)
     {
         // viết câu sql
         $search = "%{$keyword}%";
         $sql = parent::$connection->prepare("SELECT * FROM products Where product_name LIKE ?");
         $sql->bind_param('s',$search);
         return parent::select($sql);
     }
    // Lấy tát cả sản phẩm theo trang
    public function getProductsByPage($perPage, $page)
    {
        $start = $perPage * ($page - 1);
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM products LIMIT ?, ?");
        $sql->bind_param('ii', $start, $perPage);
        return parent::select($sql);
    }
    //Lấy tất cả sản phẩm theo ngày mới nhất
    public function getProductsByNewCreated($perPage, $page)
    {
        $start = $perPage * ($page - 1);
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT ?, ?");
        $sql->bind_param('ii', $start, $perPage);
        return parent::select($sql);
    }
    // Lấy tát cả sản phẩm theo Gia
    public function getProductsByPrice()
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM `products` ORDER BY product_price");
        return parent::select($sql);
    }
    // Lấy tát cả sản phẩm theo ten
    public function getProductsByName()
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM `products` ORDER BY product_name");
        return parent::select($sql);
    }
    public function getProductsByRating()
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM `products` ORDER BY product_rating");
        return parent::select($sql);
    }
    // Lấy tổng số dòng
    public function getTotalRow()
    {
        $sql = parent::$connection->prepare("SELECT COUNT(id) FROM products");
        return parent::select($sql)[0]['COUNT(id)'];
    }
    //Xem thông tin giỏ hàng
    public function getCart()
    {
        $sql = parent::$connection->prepare("SELECT * FROM `products` WHERE `id` IN (".implode(",", array_keys($_SESSION["cart1"])).")");
        return parent::select($sql);
    }
    //Lấy thông tin giỏ hàng
    public function getOrderCart()
    {
        $sql = parent::$connection->prepare("SELECT * FROM `products` WHERE `id` IN (".implode(",", array_keys($_POST["qty"])).")");
        return parent::select($sql);
    }
    //Lấy thông tin giỏ hàng vào database
    public function createOrder($name, $phone, $address, $note, $total, $create_time, $last_update)
    {
        $sql = parent::$connection->prepare("INSERT INTO `order` (`name`, `phone`, `address`, `note`, `total`, `create_time`, `last_update`) VALUES (?,?,?,?,?,?,?);");
        $sql->bind_param('sissiii', $name, $phone, $address, $note, $total, $create_time, $last_update);
        return $sql->execute();
    }
    //Thêm sản phẩm
     public function createProduct($name, $description, $price, $photo,$rating)
     {
     $time = date("Y/m/d");
     $sql = parent::$connection->prepare("INSERT INTO `products` (`product_name`, `product_description`, `product_price`, `product_photo`,`product_rating`,`created_at`) VALUES (?, ?, ?, ?, ?,?);");
     $sql->bind_param('ssisis', $name, $description, $price, $photo, $rating,$time);
     return $sql->execute();
     }    
     //Xoa san pham theo id
     public function deleteProductById($Id)
     {
         $sql = parent::$connection->prepare("DELETE FROM `products` WHERE `id`=?");
         $sql->bind_param('i',$Id);
         return $sql->execute();
     }
     //Cap nhat san pham theo id
    public function updateProductById($name, $description, $price, $photo,$rating,$id)
    {
        $sql = parent::$connection->prepare(" UPDATE `products` SET `product_name` = ?, `product_description` = ?, `product_price` = ?, `product_photo` = ?, `product_rating` = ? WHERE `products`.`id` = ?;");
        $sql->bind_param('ssisii', $name, $description, $price, $photo, $rating,$id);
        return $sql->execute();
    }
    //Them view san pham
    public function updateView($view, $id)
    {
        $sql = parent::$connection->prepare(" UPDATE `products` SET `product_view` = ?  WHERE `products`.`id` = ?;");
        $sql->bind_param('ii', $view,$id);
        return $sql->execute();
    }
    //Lay san pham theo xem nhieu nhat
    public function getProductView()
    {
        $sql = parent::$connection->prepare("SELECT product_photo FROM `products` order BY product_view DESC LIMIT 3");
        return parent::select($sql);
    }
}
