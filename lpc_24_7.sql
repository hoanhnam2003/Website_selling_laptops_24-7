-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 08, 2024 lúc 08:08 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lpc_24/7`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `ngaymuahang` date NOT NULL,
  `trangthai` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tongbill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`bill_id`, `ngaymuahang`, `trangthai`, `user_id`, `tongbill`) VALUES
(42, '2023-12-30', 'Đang giao hàng', 18, 14000000),
(43, '2023-12-30', 'Đang chuẩn bị hàng', 18, 94000000),
(45, '2024-01-06', 'Đang chuẩn bị hàng', 18, 16000000),
(46, '2024-01-08', 'Đang chuẩn bị hàng', 18, 30000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `quantity`, `user_id`) VALUES
(41, 20, 1, 1),
(44, 20, 3, 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(11, 'Laptop Asus'),
(12, 'Laptop Acer'),
(14, 'Phụ kiện máy tính'),
(15, 'Ghế gaming, công thái học'),
(16, 'Màn hình máy tính Acer'),
(17, 'Màn hình máy tính Asus'),
(18, 'Màn hình máy tính Sam Sung'),
(25, 'PcLPC');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(199) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(199) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `price`, `quantity`, `image`, `category_id`) VALUES
(20, 'Laptop Asus Vivobook 16 X1605VA-MB105W (Intel Core i5-1335U | 8GB | 512GB | Intel UHD Graphics | 16-inch WUXGA | Win 11| Bạc)', 'CPU: Intel Core i5-1335U (upto 4.60GHz, 12MB)\r\nRAM: RAM 8GB DDR4 Onboard (+1 DDR4 SO-DIMM slot)\r\nỔ cứng: 512GB M.2 NVMe PCIe 3.0 SSD\r\nVGA: Intel UHD Graphics\r\nMàn hình: 16.0-inch, WUXGA (1920 x 1200) 16:10 aspect ratio, IPS, 60Hz, 300nits, 45% NTSC, Anti-glare display, TÜV Rheinland-certified, Screen-to-body ratio 86%\r\nPin: 3 cell 42WHrs\r\nCân nặng: 1.88 kg\r\nTính năng: Bảo mật vân tay\r\nMàu sắc: Bạc\r\nOS: Windows 11 Home', 14000000, 100, '45269_asus_vivobook_16_x1605va_mb105w (1).jpg', 11),
(22, 'Laptop Asus Vivobook 15 X1504VA NJ070W (Core i5-1335U | 16GB | 512GB | Intel Iris Xe | 15.6 inch FHD | Win 11 | Xanh)', 'CPU: Intel® Core™ i5-1335U (1.30GHz up to 4.60GHz, 12MB Cache)\r\nRAM: 8GB DDR4 on board + 8GB DDR4 SO-DIMM\r\nỔ cứng: 512GB M.2 NVMe™ PCIe® 3.0 SSD\r\nVGA: Intel Iris Xe Graphics\r\nMàn hình: 15.6 inch FHD (1920 x 1080) 16:9 aspect ratio, LED Backlit, 60Hz, 250nits, 45% NTSC, Anti-glare display, TÜV Rheinland-certified, 84％Screen-to-body ratio\r\nPin: 3-cell, 42WHrs\r\nCân nặng: 1.70 kg\r\nMàu sắc: Quiet Blue\r\nOS: Windows 11 Home', 16000000, 100, '44632_x1504va_nj070w__1_.jpg', 11),
(23, 'Laptop Acer Aspire 7 A715-76-53PJ NH.QGESV.007 (Intel Core i5-12450H | 16GB | 512GB | Intel UHD | 15.6 inch FHD | Win 11 | Đen)', 'CPU: Intel Core i5-12450H (up to 4.4GHz, 12MB)\r\nRAM: 16GB (8x2) DDR4 3200MHz (2 slot, up to 32GB )\r\nỔ cứng: 512GB PCIe NVMe SSD\r\nVGA: Intel® UHD Graphics\r\nMàn hình: 15.6inch FHD (1920 x 1080) IPS SlimBezel, 60Hz\r\nPin: 3-cell, 50Wh\r\nCân nặng: 2.1kg\r\nMàu sắc: Đen\r\nOS: Windows 11 Home', 16000000, 100, '46547_ap7 (1).jpg', 12),
(24, 'Laptop Gaming Acer Nitro V ANV15-51-55CA NH.QN8SV.004 (Intel Core i5-13420H | 16GB | 512GB | RTX 4050 6GB | 15.6 inch FHD | Win 11 | Đen)', 'CPU: Intel Core i5-13420H (upto 4.6GHz, 12MB)\r\nRAM: 16GB (2x8GB) DDR5 5200 MHz (2 khe, tối đa 32GB)\r\nỔ cứng: 512GB PCIe NVMe SSD\r\nVGA: NVIDIA GeForce RTX 4050 6GB\r\nMàn hình: 15.6 inch FHD(1920 x 1080) IPS 144Hz SlimBezel\r\nPin: 57 Wh 4-cell\r\nCân nặng: 2.1 kg\r\nTính năng: Đèn nền bàn phím\r\nMàu sắc: Đen\r\nOS: Windows 11 Home', 25000000, 100, '46359_5 (1).jpg', 12),
(25, 'Giá Đỡ Màn Hình HyperWork A1C (17- 32 inch) Màu Trắng', 'Kích cỡ màn phù hợp: 17” ~ 32\"\r\nNâng màn tối đa: 9kg ( nâng tốt các màn hình kích thước lên đến 34-35inch có trọng lượng dưới 9kg)\r\nCông nghệ trợ lực: Lò xo cao cấp HyperLift+ 2.0', 600000, 20, '40678_62431_gia_treo_man_may_tinh_human_motion_t6_mau_trang_23.jpg', 14),
(26, 'Đầu thu USB Bluetooth 4.0 Orico BTA-403', 'Đầu thu USB Bluetooth 4.0 Orico BTA-403\r\n- Thiết kế nhỏ gọn\r\n- Cắm là chạy, không cần cài đặt\r\n- Tương thích tốt với các loại tay cầm chơi game bluetooth như PS4, Xbox One S\r\n- Truyền được tín hiệu âm thanh 2 kênh chuẩn A2DP (truyền được ra loa, tai nghe bluetooth)', 90000, 10, '25102_dau_phat_bluetooth_orico.jpg', 14),
(27, 'Ghế chơi game đa chức năng tự động Ingrem GUNDAM DXracer Gaming Workstation Zero Gravity C4 owlet S', 'Hệ thống ghế chơi game kiêm bàn làm việc máy tính Workstation\r\n-- Ingrem Multifunction Gaming Workstation GUNDAM Zero Gravity Emperor Chair C4 owlet S --\r\nMã sản phẩm :Ingrem GUNDAM C4 owlet S\r\nNguồn cấp điện: 220V\r\nĐiều chỉnh ghế: 30-145\r\nGhế ngồi DXRacer Iron Series\r\nCân nặng: 150kg\r\nTính năng khác: Âm thanh Bluetooth,đèn sáng,hỗ trợ lắp 3 màn hình', 100000000, 10, '31899_ghe_da_chuc_nang_ingrem_multifunction_gaming_workstation_zero_gravity_emperor_chair_c4_owlet_s_1.jpg', 15),
(28, 'Ghế công thái học ergonomic E-Dra EEC218', 'Ghế công thái học ergonomic E-Dra EEC218\r\n- Chất liệu: lưới chất lượng cao cho cảm giác thông thoáng\r\n- Đệm ngồi chất liệu: Fabric.\r\n- Tựa đầu 2D điều chỉnh độ cao, góc độ\r\n- Kê tay: nâng hạ gắn liền\r\n- Phần tựa lưng điều chỉnh được chiều cao\r\n- Bệ đỡ: Butterfly\r\n- Chân nhựa đường kính 320mm\r\n- Trụ thủy lực Class-3 Bifma\r\n- Bánh xe PU 50mm Bifma\r\n- Màu sắc: Black.\r\n- Cân nặng người sử dụng tối đa: 100kg', 1500000, 20, '45929_e_dra_eec218__1_.jpg', 15),
(29, 'Màn hình Acer K243Y E 23.8 inch IPS 100Hz', 'Loại màn hình: Màn hình phẳng\r\nTỉ lệ: 16:9\r\nKích thước: 23.8 inch\r\nTấm nền: IPS\r\nĐộ phân giải: Full HD (1920x1080)\r\nTốc độ làm mới: 100Hz\r\nThời gian đáp ứng: 1 ms VRB\r\nHỗ trợ : Vesa 100x100mm, loa 2Wx2\r\nCổng kết nối: 1x VGA, 1x HDMI\r\nPhụ kiện : Cáp nguồn, cáp HDMI', 2590000, 25, '44808_m__n_h__nh_acer_k243y_e_23_8_inch_ips_100hz.jpg', 16),
(30, 'Màn hình Acer CBL282K UM.PB2SV.001 (28 inch - 4K - IPS)', 'Kiểu dáng màn hình: Phẳng\r\nTỉ lệ khung hình: 16:9\r\nKích thước mặc định: 28 inch\r\nCông nghệ tấm nền: IPS\r\nPhân giải điểm ảnh: 4K(3840 x 2160)\r\nĐộ sáng hiển thị: 300 nits\r\nTần số quét màn: 60Hz\r\nThời gian đáp ứng: 4ms (GtG)\r\nChỉ số màu sắc: DeltaE < 1 , DCI-P3 90%\r\nHỗ trợ tiêu chuẩn: AMD Freesync, VESA 100x100mm\r\nCổng cắm kết nối: 2 x HDMI (2.0), 1 x Display Port (v1.2a)\r\nPhụ kiện trong hộp: Cáp nguồn, Cáp HDMI', 8000000, 26, '40530_m__n_h__nh_acer_cbl282k_um_pb2sv_001__28_inch___4k___ips_.jpg', 16),
(31, 'Màn Hình ASUS VY249HE-W (23.8 inch - FHD - IPS - 75Hz - 1ms - FreeSync - EyeCare)', 'Kiểu dáng màn hình: Phẳng (Màu Trắng)\r\nTỉ lệ khung hình: 16:9\r\nKích thước mặc định: 23.8 inch\r\nCông nghệ tấm nền: IPS\r\nPhân giải điểm ảnh: FHD - 1920 x 1080\r\nĐộ sáng hiển thị: 250 Nits cd/m2\r\nTần số quét màn: 75Hz (Hertz)\r\nThời gian đáp ứng: 1ms (MPRT)\r\nChỉ số màu sắc: 16.7 triệu màu - 8 bits\r\nHỗ trợ tiêu chuẩn: VESA (100 mm x 100 mm) - AMD FreeSync - Eye Care Plus\r\nCổng cắm kết nối: 1xHDMI 1.4, 1xD-sub, 1x3.5mm Audio Out\r\nPhụ kiện trong hộp: Dây nguồn, Dây HDMI', 2500000, 30, '44809_a13.jpg', 17),
(32, 'Màn Hình ASUS VY279HF (27 inch - IPS - FHD - 100Hz - 1ms)', 'Kiểu dáng màn hình: Phẳng\r\nTỉ lệ khung hình: 16:9\r\nKích thước mặc định: 27 inch\r\nCông nghệ tấm nền: IPS\r\nPhân giải điểm ảnh: FHD - 1920 x 1080\r\nTần số quét màn: 100Hz\r\nThời gian đáp ứng: 1ms MPRT\r\nChỉ số màu sắc: 16.7 triệu màu\r\nHỗ trợ tiêu chuẩn: VESA (100 mm x 100 mm) - Low Blue Light - Flicker Free\r\nCổng cắm kết nối: HDMI(v1.4) x 1\r\nPhụ kiện trong hộp: Dây nguồn, Dây HDMI', 3200000, 35, '46994_v34.jpg', 17),
(33, 'Màn hình cong SAMSUNG LS27C360EAEXXV (27.0 inch - FHD - VA - 75Hz - 4ms - FreeSync)', 'Kiểu dáng màn hình: Cong (1800R)\r\nTỉ lệ khung hình: 16:9\r\nKích thước mặc định: 27.0 inch\r\nCông nghệ tấm nền: VA\r\nPhân giải điểm ảnh: FHD - 1920 x 1080\r\nĐộ sáng hiển thị: 250 Nits cd/m2\r\nTần số quét màn: 60 Hz - 75 Hz (Hertz)\r\nThời gian đáp ứng: 4 ms (GTG)\r\nChỉ số màu sắc: 16.7 triệu màu - 72% NTSC 1976\r\nHỗ trợ tiêu chuẩn: VESA (75 mm x 75 mm) - AMD FreeSync\r\nCổng cắm kết nối: 1xHDMI 1.4, 1xD-Sub\r\nPhụ kiện trong hộp: Dây nguồn, Bộ chuyển đổi nguồn, Dây HDMI to HDMI', 3500000, 20, '44610_m__n_h__nh_cong_samsung_ls27c360eaexxv__27_0_inch___fhd___va___75hz___4ms___freesync_ (1).jpg', 18),
(34, 'Màn hình Gaming SAMSUNG Odyssey G9 LC49G95TSSEXXV (49 inch - DualQHD - VA - 240Hz - 1ms - G-Sync - Cong)', 'Kiểu dáng màn hình: Cong 1000R - màu trắng\r\nTỉ lệ khung hình: 32:9\r\nKích thước mặc định: 49 inch\r\nCông nghệ tấm nền: VA\r\nPhân giải điểm ảnh: 5120 x 1440\r\nĐộ sáng màn hình: 420cd/m2\r\nTần số quét màn: 240Hz\r\nThời gian đáp ứng: 1(GTG)\r\nHỗ trợ tiêu chuẩn: G-Sync Compatible , HDR 1000\r\nCổng kết nối: HDMI 2.0 , 2x Display Port 1.4, Audio 3.5mm out , USB 3.0\r\nPhụ kiện trong hộp: Cáp nguồn, Cáp DP, cáp usb', 27000000, 20, '33661_m__n_h__nh_gaming_samsung_odyssey_g9_lc49g95tssexxv__49_inch___dualqhd___va___240hz___1ms___g_sync___cong_.jpg', 18),
(35, 'PCAP Studio 3 Power by ASUS(I9 13900K | Z790 | 32GB | SSD 1TB | 850W | RTX 4080 16GB)', 'Cấu hình và hình ảnh mang tính chất minh họa cho sản phẩm, có thể thay đổi theo thời điểm\r\nMAAS0360 - Mainboard Asus TUF GAMING Z790-PLUS DDR4\r\nCPUIT0148 - CPU Intel Core I9 13900K (36MB Cache, up to 5.80 GHz, 24C32T, socket 1700)\r\nOCKT0052 - Ổ cứng SSD Kingston Kingston FURY Renegade 1TB NVMe PCIe Gen 4.0\r\nCAAS0015 - Vỏ case ASUS TUF gaming GT502 Black\r\nNGMSI0010 - Nguồn máy tính MSI MAG A850GL - 850w ( ATX 3.0, PCIe 5.0, Full Modullar)\r\nVGAS0318 - VGA Asus TUF RTX 4080 16GB GAMING GDDR6X\r\nRAKT0095 - Ram Kingston FURY Beast RGB 32GB (2x16GB) DDR4 3200MHz\r\nTNNU0770 - Tản nhiệt nước CPU Cooler master ML360L ARGB V2\r\nTNNU0884 - Fan Case Asus TUF GAMING TF120 ARGB 3IN1 ( Bộ 3 fan 12cm có Hub)', 80000000, 6, '46394_pcap_studio.png', 25),
(36, 'PCAP Gaming CS2 Begin ( I3-12100F | GTX 1660 Super 6GB | RAM 16GB | SSD 512GB | PSU 600W) - Cấu hình máy tính PC build dành cho CS2', 'MAAR0175 Mainboard Asrock B660M-HDV DDR4\r\nCPUIT0135 CPU Intel Core i3-12100F (Up To 4.30GHz, 4 Nhân 8 Luồng,12MB Cache, Socket 1700, Alder Lake)\r\nRATE0051 Ram TEAM ELITE DDR4 8Gb 3200 (TED48G3200C2201)\r\nOCTG0010 Ổ cứng SSD TeamGroup CX2 512GB 2.5 inch SATA III\r\nCAGM0014 Nguồn máy tính GAMEMAX VP-600 - 600W 80 plus bronze\r\nCAKN0027 Vỏ case KENOO ESPORT K300 3F - Màu Đen ( 3 fan RGB - ATX)\r\nVGAS0200 VGA ASUS TUF Gaming GeForce GTX 1660 SUPER 6GB GDDR6 OC edition', 13000000, 10, '45095_pcap_counter_strike_cs2_gaming_1.jpg', 25);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `sex` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `email`, `phone`, `role`, `date`, `sex`) VALUES
(1, 'Admin', '123456789', 'hoanhnam2003@gmail.com', '0349732600', 'Admin', '2003-02-20', 'Nam'),
(18, 'Quy', '123456789', 'quy@gmail.com', '0349732620', 'User', '2003-03-30', 'Nam');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
