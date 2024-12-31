-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 31, 2024 lúc 08:54 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_projectmanagerit`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avt` varchar(255) DEFAULT NULL,
  `role` enum('admin','teacher','student') NOT NULL,
  `isdeleted` tinyint(1) DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `avt`, `role`, `isdeleted`, `timestamp`) VALUES
(1, 'admin@hotmail.com', '$2y$10$qQR1KSSco7tcYbm2.0vc1.S7iVhBoDPyLonuKGvlJAb/wDmms5po2', NULL, 'admin', 0, '2024-12-31 14:21:32'),
(3, 'nguyenquockhanh', '$2y$10$Tfy1QyenksYWOXVDjkEOv.L6NrUff8cIKmpaEHHssZwfkE5KZSX5K', 'uploads/avatars/z5923648550304_249b7d24a609ad3c2dec4a7920148729.jpg', 'student', 0, '2024-12-31 16:59:26'),
(6, 'doanphuocmien', '$2y$10$yuSudUV9b735ws5fIgylru3WRP.YzGjIKpGgbnHRs/QxRV0QM/BIS', 'uploads/avatars/344537801_232579019374699_7875584346141912623_n2.jpg', 'teacher', 0, '2024-12-31 17:53:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `classname` varchar(50) NOT NULL,
  `classid` varchar(20) NOT NULL,
  `courseyear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `classrooms`
--

INSERT INTO `classrooms` (`id`, `classname`, `classid`, `courseyear`) VALUES
(2, 'Công nghệ thông tin C', 'DA21TTC', '2021');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `infos`
--

CREATE TABLE `infos` (
  `mssv` varchar(20) NOT NULL,
  `accountid` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `birthday` date DEFAULT NULL,
  `classid` varchar(20) DEFAULT NULL,
  `mail` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `infos`
--

INSERT INTO `infos` (`mssv`, `accountid`, `fullname`, `birthday`, `classid`, `mail`, `timestamp`) VALUES
('110121266', 3, 'Nguyễn Quốc Khánh', '2003-01-01', 'DA21TTC', '110121266@st.tvu.edu.vn', '2024-12-31 16:59:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `projectname` varchar(100) NOT NULL,
  `projecttype` varchar(50) NOT NULL,
  `mssv` varchar(20) DEFAULT NULL,
  `totalscore` decimal(5,2) DEFAULT NULL,
  `rating` enum('Excellent','Good','Fair','Poor') DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `status` enum('completed','notcompleted') NOT NULL DEFAULT 'notcompleted',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `projects`
--

INSERT INTO `projects` (`id`, `projectname`, `projecttype`, `mssv`, `totalscore`, `rating`, `teacherid`, `status`, `timestamp`) VALUES
(3, 'Quản lý sinh viên', 'base', '110121266', 10.00, 'Poor', 2, 'completed', '2024-12-31 18:38:38'),
(4, 'biểu đồ phân công công việc', 'specialized', '110121266', 9.00, 'Poor', 2, 'completed', '2024-12-31 19:02:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project_scores`
--

CREATE TABLE `project_scores` (
  `id` int(11) NOT NULL,
  `projectid` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `accountid` int(11) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `qualification` enum('Master','PhD') NOT NULL,
  `teacher_code` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `teachers`
--

INSERT INTO `teachers` (`id`, `accountid`, `fullname`, `qualification`, `teacher_code`, `timestamp`) VALUES
(2, 6, 'doanphuocmien', 'Master', '001', '2024-12-31 17:53:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`mssv`),
  ADD KEY `accountid` (`accountid`);

--
-- Chỉ mục cho bảng `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mssv` (`mssv`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Chỉ mục cho bảng `project_scores`
--
ALTER TABLE `project_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectid` (`projectid`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Chỉ mục cho bảng `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_code` (`teacher_code`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `project_scores`
--
ALTER TABLE `project_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `infos`
--
ALTER TABLE `infos`
  ADD CONSTRAINT `infos_ibfk_1` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`mssv`) REFERENCES `infos` (`mssv`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`teacherid`) REFERENCES `teachers` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `project_scores`
--
ALTER TABLE `project_scores`
  ADD CONSTRAINT `project_scores_ibfk_1` FOREIGN KEY (`projectid`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_scores_ibfk_2` FOREIGN KEY (`teacherid`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
