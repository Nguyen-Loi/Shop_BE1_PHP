<?php
class Account extends Db{
    //Lay tat ca thong tin tai khoan
    public function getAccount()
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM accountmanager");
        return parent::select($sql);
    }
    //Them tai khoan nguoi dung
    public function createAccount($Email, $UserName, $PassWord, $Phone)
    {
    $sql = parent::$connection->prepare("INSERT INTO `accountmanager` (`photo`, `username`, `password`, `Phone`) VALUES (?, ?, ?, ?);");
    $sql->bind_param('sssi', $Email, $UserName, $PassWord, $Phone);
    return $sql->execute();
    }    
    //Them tai khoan nguoi dung(Tu cach khach hang)
    public function createAccount2($Photo,$UserName, $PassWord)
    {
    $sql = parent::$connection->prepare("INSERT INTO `accountmanager` (`photo`,`username`, `password`) VALUES ( ?, ?, ?);");
    $sql->bind_param('sss',$Photo, $UserName, $PassWord);
    return $sql->execute();
    }  
     //Cap nhat tai khoan nguoi dung
    public function updateAccount($Photo, $UserName, $PassWord, $Phone, $Id)
    {
        $sql = parent::$connection->prepare(" UPDATE `accountmanager` SET `photo` = ?, `username` = ?, `password` = ?, `Phone` = ? WHERE `accountmanager`.`id` = ?;");
        $sql->bind_param('sssii', $Photo, $UserName, $PassWord, $Phone, $Id);
        return $sql->execute();
    }
     //Xoa tai khoan nguoi dung
     public function deleteAccount($Id)
     {
         $sql = parent::$connection->prepare("DELETE FROM `accountmanager` WHERE `id`=?");
         $sql->bind_param('i',$Id);
         return $sql->execute();
     }
     //Lay tai khoan theo id
    public function getAccountById($Id)
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM accountmanager WHERE `id`=?");
        $sql->bind_param('i', $Id);
        return parent::select($sql)[0];
    }
    //Lay tai khoarn admin
    public function getAccountAdmin()
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM accountadmin");
        return parent::select($sql);
    }
   
    //Cap nhat mat khau
    public function updatePassWord($PassWord,$UserName)
    {
        $sql = parent::$connection->prepare(" UPDATE `accountmanager` SET `password` = ? WHERE `accountmanager`.`username` = ?;");
        $sql->bind_param('ss', $PassWord,$UserName);
        return $sql->execute();
    }
    //Quen mat khau
    public function forgotPassWord($UserName,$Phone)
    {
        $sql = parent::$connection->prepare(" SELECT password FROM accountmanager WHERE username = ? AND Phone = ?");
        $sql->bind_param('si', $PassWord,$UserName);
        return $sql->execute();
    }
    //Tao tai khoan tu dong voi facebook
    public function createAccountWithFacebook($UserName)
    {
      $sql = parent::$connection->prepare("INSERT INTO `accountmanager` (`username`, `password`, `Phone`) VALUES ( ?, '12345', 012345 );");
      $sql->bind_param('s',$UserName);
      return $sql->execute();
    }  
}