-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 13, 2021 at 01:27 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportsshop`
--
CREATE DATABASE IF NOT EXISTS `sportsshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sportsshop`;

-- --------------------------------------------------------

--
-- Table structure for table `accountadmin`
--

DROP TABLE IF EXISTS `accountadmin`;
CREATE TABLE IF NOT EXISTS `accountadmin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accountadmin`
--

INSERT INTO `accountadmin` (`id`, `email`, `username`, `password`, `Phone`) VALUES
(2, 'hongloi12123@gmail.com', 'Hongloi12123', 'HongLoi12123', 13),
(3, 'admin', 'admin', 'admin', 123),
(4, 'hongloi12123@gmail.com', 'Hongloi12123', 'Hongloi12123', 123);

-- --------------------------------------------------------

--
-- Table structure for table `accountmanager`
--

DROP TABLE IF EXISTS `accountmanager`;
CREATE TABLE IF NOT EXISTS `accountmanager` (
  `id` int NOT NULL AUTO_INCREMENT,
  `photo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accountmanager`
--

INSERT INTO `accountmanager` (`id`, `photo`, `username`, `password`, `Phone`) VALUES
(16, '1610291885137041089_3612693868851505_4627387840733', 'Nghia123', '2712000Nn', 328827134),
(10, '1609930463Penguins.jpg', 'nguyen', 'Nguyen123', 123),
(58, '1609901254Hydrangeas.jpg', 'quanque123', '123', NULL),
(59, '1610164348beauty_20201130172320.jpg', 'Uyen Ngo', '060200', NULL),
(64, '1610292856136220973_4854389884635797_2370092769156', 'LeVanNghia', '1234567', NULL),
(65, '1610438551mau.png', 'ưew', '23232', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_link`) VALUES
(1, 'Home', 'index.php\r\n'),
(2, 'products', 'products.php'),
(3, 'About', ''),
(4, 'Contact', 'account.php'),
(5, 'Account', 'account.php');

-- --------------------------------------------------------

--
-- Table structure for table `categoryofproducts`
--

DROP TABLE IF EXISTS `categoryofproducts`;
CREATE TABLE IF NOT EXISTS `categoryofproducts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoryofproducts`
--

INSERT INTO `categoryofproducts` (`id`, `category_name`) VALUES
(1, 'Đồ Bộ'),
(2, 'Giày'),
(3, 'Dép'),
(4, 'Quần'),
(5, 'Áo'),
(6, 'Đồng hồ');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int NOT NULL,
  `create_time` int NOT NULL,
  `last_update` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `name`, `phone`, `address`, `note`, `total`, `create_time`, `last_update`) VALUES
(44, 'Le Van Nghia', 328827134, 'duong so 8, Linh Trung, Thu Duc', 'Giao  trước ngày mai', 12445000, 1609074004, 1609074004),
(56, 'c', 98673723, '2132', '21wqe', 5200000, 1609809522, 1609809522),
(57, 'Luu', 5954534, '343rer', '', 10065000, 1609810195, 1609810195);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `create_time` int NOT NULL,
  `last_update` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `create_time`, `last_update`) VALUES
(14, 44, 5, 2, 5000000, 1609074004, 1609074004),
(15, 44, 7, 1, 375000, 1609074004, 1609074004),
(16, 44, 9, 2, 935000, 1609074004, 1609074004),
(35, 53, 5, 32, 5000000, 1609859443, 1609859443),
(36, 54, 4, 2, 1400000, 1609901397, 1609901397),
(37, 54, 6, 4, 800000, 1609901397, 1609901397),
(39, 55, 5, 1, 5000000, 1610023515, 1610023515),
(40, 55, 7, 2, 375000, 1610023515, 1610023515),
(41, 55, 10, 1, 1190000, 1610023515, 1610023515),
(42, 55, 14, 2, 2990000, 1610023515, 1610023515),
(43, 56, 4, 2, 1400000, 1610161667, 1610161667),
(44, 56, 8, 3, 500000, 1610161667, 1610161667),
(45, 57, 14, 1, 2990000, 1610164456, 1610164456);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int NOT NULL,
  `product_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_rating` int NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_price`, `product_photo`, `product_rating`, `created_at`) VALUES
(4, 'BỘ TRANG PHỤC THỂ THAO SST', 'Kiểu dáng thời trang vượt thời gian dành riêng cho trẻ em. Bộ trang phục thể thao này có 3 Sọc kẻ trên tay áo và ống quần khẳng định phong cách adidas Originals đích thực. Chất liệu vải tricot hơi bóng, mềm mại làm từ sợi tái chế mang lại vẻ hiện đại.', 1400000, 'STT1.jpg,STT2.jpg,STT3.jpg,STT4.jpg', 4, '2021-01-07'),
(5, 'GIÀY ULTRABOOST 20', 'Mỗi ngày mới. Mỗi buổi chạy mới. Hãy tận dụng tối đa. Đôi giày hiệu năng cao này có thân giày bằng vải dệt kim ôm chân. Các đường may trong trợ lực được bố trí chuẩn xác để tạo độ nâng đỡ ở đúng những vị trí cần thiết. Gót giày làm từ chất liệu elastane mềm mại cho độ ôm thoải mái hơn. Lớp đệm đàn hồi hoàn trả năng lượng cho từng sải bước tạo cảm giác như có thể chạy mãi mãi.\r\n\r\n', 5000000, 'GiayUTB1.jpg,GiayUTB2.jpg,GiayUTB3.jpg,GiayUTB4.jpg', 4, '2021-01-08'),
(6, 'DÉP QUAI NGANG ADILETTE COMFORT', 'Hồi phục năng lượng cho đôi chân mỏi mệt với mẫu dép quai ngang dành cho nam này. Đôi dép nhẹ với thân dép ôm chân theo công nghệ Cloudfoam Plus nâng niu mỗi bước đi với lớp đệm êm ái. Dép có thiết kế kinh điển với quai ngang mang họa tiết 3 Sọc tương phản.', 800000, 'Dep1.jpg,Dep2.jpg,Dep3.jpg,Dep4.jpg', 4, '2021-01-10'),
(7, 'ÁO PHÔNG RINGER 3 SỌC', 'Khi trời mưa ẩm ướt và còn cả một buổi tập burpee phía trước, bạn sẽ nhận ra giá trị của chiếc áo phông dáng lửng adidas này. Chất vải nhẹ kiểm soát độ ẩm giúp bạn luôn cảm thấy khô ráo. Tay áo bằng vải lưới nổi bật với viền 3 Sọc, cho vẻ ngoài đậm chất thể thao.', 375000, 'AoPhong1.jpg,AoPhong2.jpg,AoPhong3.jpg,AoPhong4.jpg', 5, '2021-01-04'),
(8, 'CTS MULTI TEE', 'Khi bạn đã dành cả tiếng đồng hồ miệt mài gắng sức, xóa tan mọi nghi ngờ và tự nhắc nhở về sức mạnh của bản thân. Khi mồ hôi chảy ròng ròng và cơ bắp dần đau nhức. Bạn chỉ muốn cởi ngay đồ tập ra và khoác lên mình chiếc áo mới sạch sẽ. Chiếc áo thun adidas này giúp bạn tận hưởng trọn vẹn cảm giác mãn nguyện ấy. Dáng áo suông mềm mại xoa dịu những vùng cơ bắp mỏi mệt. Hãy đứng dậy khỏi băng ghế ở phòng thay đồ. Và bước tiếp. Vẫn còn cả một ngày dài đang chờ bạn phía trước.', 500000, 'gallery-1.jpg,gallery-2.jpg,gallery-3.jpg,gallery-4.jpg', 4, '2021-01-05'),
(9, 'ÁO THUN ADIDAS Z.N.E.', 'Khi bạn đã dành cả tiếng đồng hồ miệt mài gắng sức, xóa tan mọi nghi ngờ và tự nhắc nhở về sức mạnh của bản thân. Khi mồ hôi chảy ròng ròng và cơ bắp dần đau nhức. Bạn chỉ muốn cởi ngay đồ tập ra và khoác lên mình chiếc áo mới sạch sẽ. Chiếc áo thun adidas này giúp bạn tận hưởng trọn vẹn cảm giác mãn nguyện ấy. Dáng áo suông mềm mại xoa dịu những vùng cơ bắp mỏi mệt. Hãy đứng dậy khỏi băng ghế ở phòng thay đồ. Và bước tiếp. Vẫn còn cả một ngày dài đang chờ bạn phía trước.', 935000, 'AoThun1.jpg,AoThun2.jpg,AoThun3.jpg,AoThun4.jpg', 2, '2021-01-04'),
(10, 'ÁO NGỰC ULTIMATE', 'Siêu nâng đỡ, siêu thoải mái. Mẫu áo ngực thể thao này đem lại độ hỗ trợ vận động tối đa. Từ đai áo mềm mại đến dây áo có đệm, từng chi tiết nhỏ đều được thiết kế để đem đến cho bạn cảm giác thoải mái nhất có thể. Thiết kế với khóa kéo ở phía trước giúp dễ dàng mặc vào cởi ra. Hỗ trợ vận động nặng Mẫu áo ngực này là lựa chọn lý tưởng cho các môn chạy bộ, HIIT hoặc bất cứ ai muốn có độ hỗ trợ vận động tối đa Luôn sẵn sàng Chất liệu vải AEROREADY thấm hút mồ hôi để bạn luôn khô ráo và thoải mái Tùy chỉnh độ vừa vặn Điều chỉnh dây áo đan chéo chữ X sau lưng để vừa với bạn nhất', 1190000, 'AoNguc1.jpg,AoNguc2.jpg,AoNguc3.jpg,AoNguc4.jpg', 5, '2021-01-09'),
(11, 'QUẦN SHORT CELEBRATION', 'Mỗi đường chạy đều bao hàm cả chiến thắng và thất bại. Khi bạn luôn thoải mái nhờ chiếc quần short chạy bộ này, bạn sẽ dễ dàng trân trọng hành trình ấy hơn. Công nghệ AEROREADY thoát ẩm và kiểu dáng giúp bạn tự do vận động trong từng sải bước. Các mảng phối họa tiết graphic thể hiện niềm tự hào adidas mạnh mẽ.', 700000, 'QuanDui1.jpg,QuanDui2.jpg,QuanDui3.jpg,QuanDui4.jpg', 4, '2021-01-03'),
(12, 'GIÀY ĐÁ BÓNG ADIDAS', 'Đặc điểm giày đá bóng Future 5.1 sân cỏ nhân tạo\r\n➡️ Cổ thun được thiết kế dệt nguyên bản, bảo về cổ chân cho người chơi,cũng như chống lực cổ chân\r\n\r\n➡️ Bề mặt sản phẩm được làm bằng da Microfiber cao cấp kết hợp lớp TPU tạo độ bền chắc chắn, chịu lực tốt chống thấm nước tốt, thuận tiện khi vệ sinh hoặc lau chùi giày.\r\n\r\n➡️ Phần upper là những lớp vân 3D đan xen lẫn nhau giúp tiếp xúc bóng, chạm bóng, dứt điểm bóng xoáy trở nên dễ dàng hơn.\r\n\r\n➡️ Đế giày làm từ cao su kép cao cấp có độ bền cao.\r\n\r\n➡️ Phía bên trong giày có lớp lót mềm mại, thoáng khí.\r\n\r\n➡️ Form giày ôm chân, giúp người có cảm giác bóng tốt nhất.\r\n\r\n➡️ Chất liệu nhẹ và bền rất ôm chân, tăng độ bám cho cảm giác bóng tốt hơn.', 600000, 'giay-adidas1.jpg,giay-adidas2.jpg,giay-adidas3.jpg,giay-adidas4.jpg', 3, '2021-01-04'),
(13, 'GIÀY ULTRABOOST 20', 'Ôm sát, vừa vặn như đi tất\r\nCó dây buộc\r\nThân giày bằng vải dệt công nghệ adidas Primeknit\r\nGiày chạy bộ nâng đỡ từ gót đến mũi chân\r\nĐế giữa công nghệ Boost đàn hồi\r\nTrọng lượng: 310 g (cỡ Anh: 5.5)\r\nChênh lệch độ cao đế giữa: 10 mm (gót giày 22 mm / mũi giày 12 mm)\r\nCông nghệ Torsion System tạo độ ổn định\r\nMàu sản phẩm: Core Black / Core Black / Signal Pink\r\nMã sản phẩm: FV8340', 4000000, 'GiayUTB1.jpg,GiayUTB2.jpg,GiayUTB3.jpg,GiayUTB4.jpg', 0, '2021-01-01'),
(14, 'Garmin Vivosmart 4', 'Vivosmart 4 là chiếc vòng đeo tay thông minh thế hệ mới nhất của Garmin. Nếu bạn đang tự hỏi mình còn lại bao nhiêu năng lượng trong viên \"pin cơ thể\" mỗi ngày, thì với sản phẩm mới này của Garmin, câu trả lời sẽ có trong tích tắc. Chiếc Garmin Vivosmart 4 được trang bị một công cụ theo dõi năng lượng pin cơ thể để cho bạn biết khi nào nên sử dụng phần năng lượng đó vào một hoạt động, hay khi nào cần nghỉ ngơi (tính năng body battery).', 2990000, 'SB4_1.png,SB4_2.jpg,SB4_3.jpg,SB4_4.jpg', 3, '2021-01-08'),
(33, '[UNISEX] Áo Thun Cotton Best Dog', 'Áo thun unisex mặc được cho cả bạn nam và nữ, in hình bad cat với chất liệu 100 cotton mang lại sự thoải mái cho người mặc Được kiểm tra hàng trước khi thanh toán. Nhận hàng là auto ưng - không ưng em THỀN TIỀN nhé các Sếp 😎 __________________ ◾ Cotton 100% Co giãn 4 chiều, mềm mịn, thấm hút mồ hôi, không đổ lông, chuẩn hàng vnxk ◾ Form chuẩn, dễ phối đồ, dành cho cả nam và nữ ◾ Size : M L XL XXL #thoitrangnam #quanthethaonam #quannam #quanshort #quancoc #quanngan #quannammuahe #quangym #quanthethaonam  #hànquốc #phongcách #trẻtrungnăngđộng #shortkakinam #aki #utee #tshirt #short #shortkaki #unisex  #unisex #streetstyle  --- CÁC BẠN FOLLOW SHOP ĐỂ CẬP NHẬT NHIỀU MẪU MỚI ĐẸP NHÉ', 199000, '6b826ddda757eea09621c2d14a03e42b&quot.jpg,0ed2f7c243f53531f97558d69bfd544d&quot.jpg,5d5416539c8dd90a833f7a0147c11545&quot.jpg,44ec64fd1d0f1154a9e8256f18bdf611_tn&quot.jpg', 3, '2021-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

DROP TABLE IF EXISTS `products_categories`;
CREATE TABLE IF NOT EXISTS `products_categories` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`product_id`, `category_id`) VALUES
(2, 5),
(4, 1),
(6, 3),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(11, 4),
(12, 2),
(13, 2),
(14, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sortproduct`
--

DROP TABLE IF EXISTS `sortproduct`;
CREATE TABLE IF NOT EXISTS `sortproduct` (
  `select_sortproduct` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`select_sortproduct`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sortproduct`
--

INSERT INTO `sortproduct` (`select_sortproduct`) VALUES
('Default Shop'),
('Short by popularity'),
('Short by price'),
('Short by Rating'),
('Short by Sale');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
