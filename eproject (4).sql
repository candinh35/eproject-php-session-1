-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2022 at 10:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `position`) VALUES
(3, 'kệ tivi', 1),
(4, 'bàn ghế', 2),
(5, 'bàn ghế sofa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `logo`) VALUES
(4, 'uploadsLogo/09-22/1663497312logo-mona-furniture-14.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `status` tinyint(50) NOT NULL,
  `sub_total` decimal(50,0) NOT NULL,
  `tax` decimal(50,0) NOT NULL,
  `total` decimal(50,0) NOT NULL,
  `user_id` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date_created`, `status`, `sub_total`, `tax`, `total`, `user_id`) VALUES
(14, '2022-09-29', 1, '9134000', '10', '10047400', 1),
(15, '2022-09-29', 1, '30102000', '10', '33112200', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(50) NOT NULL,
  `product_id` bigint(50) NOT NULL,
  `order_id` bigint(50) NOT NULL,
  `price` bigint(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `sub_total` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `product_id`, `order_id`, `price`, `quantity`, `sub_total`) VALUES
(16, 6, 14, 4567000, 2, 9134000),
(17, 3, 15, 5467000, 3, 16401000),
(18, 6, 15, 4567000, 3, 13701000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `category_id`) VALUES
(1, 'ghế sofa f183', '13453000', 'Thiết kế từ dòng sản phẩm SF02 mang nét trẻ trung, đẳng cấp thể hiện phong cách, quyền lực của chủ nhân.\r\nChất liệu làm nên bộ ghế từ da cao cấp, ốp gỗ bên ngoài tinh tế\r\nBộ ghế gồm có 01 băng dài bề thế, 02 ghế đơn tiện nghi dùng đón tiếp khách hàng, đối tác.\r\nCác đường may trang trí nổi của thân và đệm ghế tạo sự trang nhã, quý phái', 'uploads/09-22/1664154854sofa1.jpg', 5),
(2, 'kệ tivi phòng khách K1312', '4564000', 'Kệ tivi phòng khách gỗ tự nhiên\r\n– Kệ khung gỗ tự nhiên sơn PU chia thành 3 khoang mỗi khoang có 1 ngăn kéo dưới, 1 khoang trống trên.\r\n– Mặt trên đá nhân tạo cao cấp bề mặt được tạo vân theo công ngh', 'uploads/09-22/1664156321tivi1.jpg', 3),
(3, 'kệ tivi phòng khách K7645', '5467000', 'Gỗ xoan đào tự nhiên thuộc nhóm gỗ số VI, gỗ xoan đào có màu cánh gián đặc trưng, thuộc loại gỗ nhẹ nhưng sau quá trình tẩm sấy kỹ càng gỗ có độ cứng rất tốt, khả năng chịu nhiệt, chống nước, chống ẩm', 'uploads/09-22/1664157440tivi.jpg', 3),
(4, 'bàn ăn b454', '7654000', 'Bộ bàn ăn BAX608 mang đến cho không gian phòng ăn của gia đình bạn vẻ đẹp hiện đại pha lẫn nét cổ điển, trẻ trung, đầy sức sống, nhưng không kém đi phần sang trọng. Mẫu bàn ăn với chất lượng vượt trội', 'uploads/09-22/1664157485table9.jpg', 4),
(5, 'ghế sofa sh109', '4764000', 'Bộ ghế sofa SF32 mang kiểu dáng hiện đại, trẻ trung, tạo điểm nhấn nổi bật cho toàn bộ kiến trúc văn phòng làm việc thêm phong cách, lịch lãm.\r\nBộ ghế được bọc PVC cao cấp, gồm có 01 băng dài bề thế, ', 'uploads/09-22/1664157633sofa2.jpg', 5),
(6, 'ghế sofa sh111', '4567000', 'Cổ điển pha lẫn hiện đại đã đưa dòng sản phẩm SF23 lên một tầm cao về thiết kế sang trọng cùng gam màu quyền quý, chất liệu cao cấp, tôn vinh không gian làm việc hiện đại, sang trọng của người lãnh đạ', 'uploads/09-22/1664157664sofa4.jpg', 5),
(7, 'ghế sofa sh106', '8769000', 'Bộ ghế sofa SF31 chuyên dùng cho văn phòng lãnh đạo, thể hiện phong thái quyền lực, sang trọng của người lãnh đạo bằng thiết kế truyền thống, màu sắc nhã nhặn, độ bền thách thức thời gian, môi trường\r', 'uploads/09-22/1664157693sofa5.jpg', 5),
(8, 'ghế sofa f176', '11243000', 'Mãn nhãn với thiết kế sang trọng, tinh tế trên từng đường nét, SF11 chuyên dùng cho văn phòng lãnh đạo cao cấp, nơi đón tiếp nồng hậu các khách hàng, đối tác quan trọng hay chỉ là những giây phút thư ', 'uploads/09-22/1664157745sofa7.jpg', 5),
(9, 'ghế sofa f143', '5467000', 'Cổ điển pha lẫn hiện đại đã đưa dòng sản phẩm SF23 lên một tầm cao về thiết kế sang trọng cùng gam màu quyền quý, chất liệu cao cấp, tôn vinh không gian làm việc hiện đại, sang trọng của người lãnh đạo.\r\nBộ ghế được bọc PVC cao cấp, gồm có 01 băng dài bề thế, 02 ghế đơn.\r\nTựa ghế nổi bật với các đường may tạo múi trang trí nhẹ nhàng', 'uploads/09-22/1664250340sofa6.jpg', 5),
(11, 'ghế sofa SH456', '7465000', 'Mãn nhãn với thiết kế sang trọng, tinh tế trên từng đường nét, SF11 chuyên dùng cho văn phòng lãnh đạo cao cấp, nơi đón tiếp nồng hậu các khách hàng, đối tác quan trọng hay chỉ là những giây phút thư', 'uploads/09-22/1664250543sofa7.jpg', 5),
(12, 'ghế sofa SH44', '3567000', 'Bộ ghế sofa SF01 với kiểu dáng sang trọng, hiện đại cho không gian văn phòng, bộ ghế khoác lên mình gam màu đen ấn tượng, mạnh mẽ, sản phẩm bán chạy nhất của nội thất Hòa Phát đến thời điểm hiện nay.\r\nBộ ghế Sofa văn phòng bọc da cao cấp, gồm có 01 băng dài rộng rãi, 02 ghế đơn tiện nghi đón tiếp khách hàng, đối tác thật sang trọng', 'uploads/09-22/1664250628sofa8.jpg', 5),
(14, 'ghế sofa f245', '11864000', 'Mãn nhãn với thiết kế sang trọng, tinh tế trên từng đường nét, SF11 chuyên dùng cho văn phòng lãnh đạo cao cấp, nơi đón tiếp nồng hậu các khách hàng, đối tác quan trọng hay chỉ là những giây phút thư giãn sau những giờ làm việc căng thẳng.', 'uploads/09-22/1664250805sofa9.jpg', 5),
(15, 'kệ gỗ tự nhiên KTV91', '5050000', '– Kệ tivi gỗ tự nhiên\r\n– Kệ có 2 ngăn kéo đựng đồ ở giữa, hai bên có 2 khoang chống.\r\n– Mặt trên đá nhân tạo cao cấp.\r\n– Sản phẩm kệ tivi KTV91 thiết kế khung gỗ tự nhiên sơn PU kết hợp với đá nhân tạo cao cấp cho sản phẩm sang trọng, khỏe khoắn hiện đại thích hợp cho không gian phòng khách gia đình, văn phòng…', 'uploads/09-22/1664261432tivi2.jpg', 3),
(16, 'kệ tivi cao cấp', '4550000', 'Kệ tivi phòng khách\r\n– Thiết kế khung gỗ tự nhiên kết hợp gỗ công nghiệp.\r\n– Mặt kệ sử dụng chất liệu veneer óc chó phủ sơn PU cao cấp\r\n– Kệ có 2 ngăn kéo ở giữa để đồ tiện dụng\r\n– Sản phẩm kệ tivi KTV19-20 thiết kế hiện đại phù hợp với mọi không gian phòng khách gia đình, văn phòng…', 'uploads/09-22/1664261485tivi3.jpg', 3),
(17, 'kệ tivi gỗ đinh hương', '4356000', 'Gỗ đinh hương là loại gỗ chủ yếu được trồng và ưa chuộng ở miền Bắc. Đinh hương là cái tên thuộc trong hàng gỗ quý hiếm ở Việt Nam. Màu sắc tươi sáng nhưng nhạt hơn so với gỗ giáng hương do đặc điểm thời tiết, đinh hương có màu vàng đỏ, hương thơm dịu nhẹ thoang thoảng, vân gỗ nhỏ màu nâu nhạt không uốn lượn, bay bổng nhưng hài hòa dịu n', 'uploads/09-22/1664261528tivi5.jpg', 3),
(18, 'kệ tivi gỗ cẩm', '7465000', 'Nội thất gỗ tự nhiên là lựa chọn hàng đầu trong các sản phẩm nội thất. Được giới đại gia săn đón rất nhiều từ các sản phẩm nội thất thông thường nhưsalon gỗ, giường ngủ gỗ… thậm chí có người chịu chi ra cả vài chục tỷ để đón được các sản phẩm nghệ thuật từ thiên nhiên hay đã qua tác chế của các nghệ nhân', 'uploads/09-22/1664261562tivi6.jpg', 3),
(19, 'Bộ bàn ghế ăn gỗ Sồi 6 ghế mẫu 2 tầng 1m6 – BAS215', '7568000', 'Bộ bàn ghế ăn được làm từ 100% gỗ Sồi tự nhiên đã qua sử lý chống cong vênh, chống mối mọt kết hợp với bộ 06 ghế có kích thước tiêu chuẩn tạo tư thế chắc chắn, thoải mái cho người dùng.', 'uploads/09-22/1664261688table1.jpg', 4),
(20, 'Bộ bàn ghế ăn tròn xoay gỗ Xoan Đào 6 ghế chân cao 1m2 – BAX208', '6543000', 'Bàn ăn tròn xoay BAX208 là một sản phẩm xuất sắc cả về kiểu dáng và chất lượng mà bạn không thể bỏ qua. Phong cách thiết kế thanh lịch, hiện đại của mẫu bàn ăn giúp làm nổi bật vẻ tươi sáng của chất liệu gỗ sồi tự nhiên.\r\n', 'uploads/09-22/1664261754table2.jpg', 4),
(21, 'Bộ bàn ghế ăn gỗ Xoan Đào 6 ghế', '8050000', 'Bộ bàn ăn với màu sắc cánh gián, được thiết kế mang âm hưởng tân cổ điển giúp tạo cảm giác ấm cúng, không đơn điệu. Kết hợp với ghế tựa lưng cao cách điệu được làm từ gỗ tự nhiên quả là 1 sự lựa chọn không tồi cho phòng ăn gia đình bạn', 'uploads/09-22/1664261794table3.jpg', 4),
(22, 'Bộ bàn ghế ăn gỗ Sồi Nga', '4564000', 'Sở hữu thiết kế hiện đại, kiểu dáng Oval (bầu dục) nhỏ gọn và đẹp mắt, nhưng vẫn đáp ứng tốt nhu cầu sử dụng của khách hàng; chất lượng sản phẩm vượt trội, đã trải qua quy trình kiểm tra chất lượng nghiêm ngặt, đảm bảo chất lượng khi sử dụng; giá thành phải chăng, hợp lý; chính những điều đó đã khiến cho bàn ăn BAS207 rất được ưa ch', 'uploads/09-22/1664261836table4.jpg', 4),
(23, 'Bộ bàn ghế ăn gỗ Sồi 6 ghế vát góc bọc', '4500000', 'Với việc sử dụng màu sơn Óc Chó đã mang đến cho sản phẩm nét đẹp cổ điển thường thấy trong các mẫu bàn ăn của những năm 80, kết hợp vào đó là thiết kế chân vát dạng cách điệu, đã mang đến cho sản phẩm nét vẻ đẹp cổ điển mang hơi hướng hiện đại. Với kiểu thiết kế trên, mẫu bàn BAS203 sẽ nổi bật và trở thành điểm nhấn trong không gian phòng ăn của bạn', 'uploads/09-22/1664261862table5.jpg', 4),
(24, 'Bộ bàn ghế ăn gỗ Sồi', '10555000', 'Bộ bàn ghế ăn đẹp hiện đại BAS217 được làm từ gỗ Sồi nhập khẩu 100%, với kiểu dáng thiết kế đơn giản nhưng thanh nhã. Bề mặt phủ sơn PU cho nước sơn bền màu, tươi sáng. Sản phẩm được sử lý chuyên nghiệp, giúp chống mối mọt và cong vênh', 'uploads/09-22/1664261898table6.jpg', 4),
(25, 'Bộ bàn ghế ăn gỗ Cao Su', '5467000', 'Bàn ăn gia đình BACS221 mang đến cho bạn một không gian phòng ăn hiện đại, đẳng cấp và tinh tế. Đây là một trong những thiết kế bàn ăn giành cho các căn hộ chung cư được đánh giá cao trên thị trường.', 'uploads/09-22/1664261955table7.jpg', 4),
(26, 'Bộ bàn ghế ăn gỗ Sồi 6 ghế phun màu mẫu Oval 1m6 – BAS531', '7654000', 'Với việc sử dụng màu sơn Óc Chó đã mang đến cho sản phẩm nét đẹp cổ điển thường thấy trong các mẫu bàn ăn của những năm 80, kết hợp vào đó là thiết kế chân vát dạng cách điệu, đã mang đến cho sản phẩm nét vẻ đẹp cổ điển mang hơi hướng hiện đại. Với kiểu thiết kế trên, mẫu bàn BAS203 sẽ nổi bật và trở thành điểm nhấn trong không gian phòng ăn của bạn', 'uploads/09-22/1664262001table8.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(20) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identification` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `phone`, `address`, `identification`) VALUES
(1, 'dinhcan355@gmail.com', 'b58aaaa7fea1189a412f5d97651e4cc5', 389288817, 'Cầu sắt đa cấu nam sơn quế võ bắc ninh', 1),
(4, 'an355@gmail.com', 'b58aaaa7fea1189a412f5d97651e4cc5', 389288817, 'Cầu sắt đa cấu nam sơn quế võ bắc ninh', 0),
(5, 'anhan355@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2147483647, 'Phạm văn đồng mai dich HN', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
