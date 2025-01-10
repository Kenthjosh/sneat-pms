-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 08:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systemfinal`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `complete_task` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_tasks WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_tasks
        SET 
        	updated_at = NOW(),
            status = 'done'
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Task not found';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_new_project` (IN `p_project_name` VARCHAR(255), IN `p_project_desc` VARCHAR(255), IN `p_creator_uuid` CHAR(36), IN `p_status` VARCHAR(255))   BEGIN
	-- Call the procedure to ensure the table exists
    CALL ensure_tbl_projects_exists();
    
    -- Insert the user into the table
    INSERT INTO tbl_projects (
        uuid, 
        id,
        creator_uuid,
        project_name,
        project_desc,
        status,
        created_at, 
        updated_at, 
        is_deleted
    )
    VALUES (
        UUID(), -- Automatically generate a unique identifier
        NULL, -- Auto-increment ID
        p_creator_uuid,
        p_project_name,
        p_project_desc,
        p_status,
        NOW(), -- Set created_at to current date/time
        NOW(), -- Set updated_at to current date/time
        0 -- Default is_deleted to 0
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_new_task` (IN `p_task_name` VARCHAR(255), IN `p_task_desc` VARCHAR(255), IN `p_creator_uuid` CHAR(36), IN `p_for_user` CHAR(36), IN `p_for_project` CHAR(36), IN `p_status` VARCHAR(255))   BEGIN
	-- Call the procedure to ensure the table exists
    CALL ensure_tbl_tasks_exists();
    
    -- Insert the user into the table
    INSERT INTO tbl_tasks (
        uuid, 
        id,
        creator_uuid,
        task_for_user_uuid,
        task_for_project_uuid,
        task_name,
   		task_desc,
        status,
        created_at, 
        updated_at, 
        is_deleted
    )
    VALUES (
        UUID(), -- Automatically generate a unique identifier
        NULL, -- Auto-increment ID
        p_creator_uuid,
        p_for_user,
        p_for_project,
        p_task_name,
        p_task_desc,
        p_status,
        NOW(), -- Set created_at to current date/time
        NOW(), -- Set updated_at to current date/time
        0 -- Default is_deleted to 0
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ensure_tbl_projects_exists` ()   BEGIN
    CREATE TABLE IF NOT EXISTS tbl_projects (
    uuid CHAR(36) NOT NULL PRIMARY KEY,
    id INT AUTO_INCREMENT NOT NULL,
    creator_uuid CHAR(36),
    project_name VARCHAR(255),
    project_desc VARCHAR(255),
    status ENUM ('new', 'in-progress', 'done', 'deleted') DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_deleted TINYINT(1) DEFAULT 0,
    INDEX (id),
    FOREIGN KEY (creator_uuid) REFERENCES tbl_users (uuid) ON DELETE CASCADE
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ensure_tbl_tasks_exists` ()   BEGIN
    CREATE TABLE IF NOT EXISTS tbl_tasks (
    uuid CHAR(36) NOT NULL PRIMARY KEY,
    id INT AUTO_INCREMENT NOT NULL,
    creator_uuid CHAR(36),
    task_for_user_uuid CHAR(36),
    task_for_project_uuid CHAR(36),
    task_name VARCHAR(255),
    task_desc VARCHAR(255),
    status ENUM ('new', 'in-progress', 'done', 'deleted') DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_deleted TINYINT(1) DEFAULT 0,
    INDEX (id),
    FOREIGN KEY (creator_uuid) REFERENCES tbl_users (uuid) ON DELETE CASCADE,
    FOREIGN KEY (task_for_user_uuid) REFERENCES tbl_users (uuid) ON DELETE CASCADE,
    FOREIGN KEY (task_for_project_uuid) REFERENCES tbl_projects (uuid) ON DELETE CASCADE
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ensure_tbl_users_exists` ()   BEGIN
    CREATE TABLE IF NOT EXISTS tbl_users (
        uuid CHAR(36) NOT NULL PRIMARY KEY,
        id INT AUTO_INCREMENT NOT NULL,
        roles ENUM('user', 'project_manager', 'admin') DEFAULT 'user',
        first_name VARCHAR(255) NOT NULL,
        middle_name VARCHAR(255),
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        is_deleted TINYINT(1) DEFAULT 0,
        password VARCHAR(255) NOT NULL,
        INDEX (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_project_status_counts` (IN `creator_uuid_input` VARCHAR(255))   BEGIN
    SELECT 
        COUNT(CASE WHEN status = 'new' THEN 1 END) AS new_projects,
        COUNT(CASE WHEN status = 'in-progress' THEN 1 END) AS in_progress_projects,
        COUNT(CASE WHEN status = 'done' THEN 1 END) AS done_projects
    FROM tbl_projects
    WHERE creator_uuid = IFNULL(creator_uuid_input, creator_uuid);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_task_status_counts` (IN `creator_uuid_input` VARCHAR(255), IN `task_for_user_uuid_input` VARCHAR(255))   BEGIN
    SELECT 
        COUNT(CASE WHEN status = 'new' THEN 1 END) AS new_tasks,
        COUNT(CASE WHEN status = 'in-progress' THEN 1 END) AS in_progress_tasks,
        COUNT(CASE WHEN status = 'done' THEN 1 END) AS done_tasks
    FROM tbl_tasks
    WHERE (creator_uuid = IFNULL(creator_uuid_input, creator_uuid))
      AND (task_for_user_uuid = IFNULL(task_for_user_uuid_input, task_for_user_uuid));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `perma_delete_project` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the project exists and is soft-deleted
    IF EXISTS (SELECT 1 FROM tbl_projects WHERE uuid = p_uuid AND is_deleted = 1) THEN
        -- Delete the project permanently
        DELETE FROM tbl_projects
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Project not found or not soft-deleted';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `perma_delete_task` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the task exists and is soft-deleted
    IF EXISTS (SELECT 1 FROM tbl_tasks WHERE uuid = p_uuid AND is_deleted = 1) THEN
        -- Delete the task permanently
        DELETE FROM tbl_tasks
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Task not found or not soft-deleted';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `perma_delete_user` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the user exists and is soft-deleted
    IF EXISTS (SELECT 1 FROM tbl_users WHERE uuid = p_uuid AND is_deleted = 1) THEN
        -- Delete the user permanently
        DELETE FROM tbl_users
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'User not found or not soft-deleted';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_new_user` (IN `p_first_name` VARCHAR(255), IN `p_middle_name` VARCHAR(255), IN `p_last_name` VARCHAR(255), IN `p_role` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
	-- Call the procedure to ensure the table exists
    CALL ensure_tbl_users_exists();
    
    -- Insert the user into the table
    INSERT INTO tbl_users (
        uuid, 
        id, 
        roles, 
        first_name, 
        middle_name, 
        last_name, 
        email, 
        created_at, 
        updated_at, 
        is_deleted, 
        password
    )
    VALUES (
        UUID(), -- Automatically generate a unique identifier
        NULL, -- Auto-increment ID
        p_role, 
        p_first_name,
        IF(p_middle_name = '', NULL, p_middle_name), -- Handle optional middle name
        p_last_name,
        p_email,
        NOW(), -- Set created_at to current date/time
        NOW(), -- Set updated_at to current date/time
        0, -- Default is_deleted to 0
        p_password -- Password input
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restore_deleted_project` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the project exists and is soft-deleted
    IF EXISTS (SELECT 1 FROM tbl_projects WHERE uuid = p_uuid AND is_deleted = 1) THEN
        -- Restore the project by setting `is_deleted` to 0
        UPDATE tbl_projects
        SET 
            updated_at = NOW(),
            is_deleted = 0
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Project not found or not soft-deleted';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restore_deleted_task` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the task exists and is soft-deleted
    IF EXISTS (SELECT 1 FROM tbl_tasks WHERE uuid = p_uuid AND is_deleted = 1) THEN
        -- Restore the task by setting `is_deleted` to 0
        UPDATE tbl_tasks
        SET 
            updated_at = NOW(),
            is_deleted = 0
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Task not found or not soft-deleted';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restore_deleted_user` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the user exists and is soft-deleted
    IF EXISTS (SELECT 1 FROM tbl_users WHERE uuid = p_uuid AND is_deleted = 1) THEN
        -- Restore the user by setting `is_deleted` to 0
        UPDATE tbl_users
        SET 
            updated_at = NOW(),
            is_deleted = 0
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'User not found or not soft-deleted';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `revert_task` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_tasks WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_tasks
        SET 
        	updated_at = NOW(),
            status = 'in-progress'
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'User not found';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soft_delete_project` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_projects WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_projects
        SET 
        	updated_at = NOW(),
            is_deleted = 1
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Project not found';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soft_delete_task` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_tasks WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_tasks
        SET 
        	updated_at = NOW(),
            is_deleted = 1
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Task not found';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soft_delete_user` (IN `p_uuid` CHAR(36))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_users WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_users
        SET 
        	updated_at = NOW(),
            is_deleted = 1
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'User not found';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_profile` (IN `p_uuid` CHAR(36), IN `p_first_name` VARCHAR(255), IN `p_middle_name` VARCHAR(255), IN `p_last_name` VARCHAR(255))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_users WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_users
        SET 
            first_name = p_first_name,
            middle_name = IF(p_middle_name = '', NULL, p_middle_name),
            last_name = p_last_name,
            updated_at = NOW()
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'User not found';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_project` (IN `p_project_name` VARCHAR(255), IN `p_project_desc` VARCHAR(255), IN `p_uuid` CHAR(36), IN `p_status` VARCHAR(255))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_projects WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_projects
        SET 
            project_name = p_project_name,
            project_desc = p_project_desc,
            status = p_status,
            updated_at = NOW()
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Project not found';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_task` (IN `p_task_name` VARCHAR(255), IN `p_task_desc` VARCHAR(255), IN `p_for_project` VARCHAR(255), IN `p_for_user` VARCHAR(255), IN `p_uuid` CHAR(36), IN `p_status` VARCHAR(255))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_tasks WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_tasks
        SET 
            task_name = p_task_name,
            task_desc = p_task_desc,
            task_for_project_uuid = p_for_project,
            task_for_user_uuid = p_for_user,
            status = p_status,
            updated_at = NOW()
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Task not found';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user` (IN `p_uuid` CHAR(36), IN `p_first_name` VARCHAR(255), IN `p_middle_name` VARCHAR(255), IN `p_last_name` VARCHAR(255), IN `p_roles` VARCHAR(255), IN `p_email` VARCHAR(255))   BEGIN
    -- Check if the user exists
    IF EXISTS (SELECT 1 FROM tbl_users WHERE uuid = p_uuid) THEN
        -- Update the user details
        UPDATE tbl_users
        SET 
            first_name = p_first_name,
            middle_name = IF(p_middle_name = '', NULL, p_middle_name),
            last_name = p_last_name,
            roles = p_roles,
            email = p_email,
            updated_at = NOW()
        WHERE uuid = p_uuid;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'User not found';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `active_users_view`
-- (See below for the actual view)
--
CREATE TABLE `active_users_view` (
`UUID` char(36)
,`id` int(11)
,`roles` enum('user','admin','project_manager')
,`first_name` varchar(255)
,`middle_name` varchar(255)
,`last_name` varchar(255)
,`email` varchar(255)
,`created_at` datetime
,`updated_at` datetime
,`is_deleted` tinyint(1)
,`password` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `count_all_projects_view`
-- (See below for the actual view)
--
CREATE TABLE `count_all_projects_view` (
`new_projects` bigint(21)
,`in_progress_projects` bigint(21)
,`done_projects` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `count_all_tasks_view`
-- (See below for the actual view)
--
CREATE TABLE `count_all_tasks_view` (
`new_tasks` decimal(23,0)
,`in_progress_tasks` decimal(23,0)
,`done_tasks` decimal(23,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `count_all_users_view`
-- (See below for the actual view)
--
CREATE TABLE `count_all_users_view` (
`active_accounts` decimal(23,0)
,`soft_deleted_users` decimal(23,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `projects_view`
-- (See below for the actual view)
--
CREATE TABLE `projects_view` (
`first_name` varchar(255)
,`middle_name` varchar(255)
,`last_name` varchar(255)
,`uuid` char(36)
,`creator_uuid` char(36)
,`project_name` varchar(255)
,`project_desc` varchar(255)
,`status` enum('new','in-progress','done','deleted')
,`created_at` datetime
,`updated_at` datetime
,`is_deleted` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `soft_deleted_projects_view`
-- (See below for the actual view)
--
CREATE TABLE `soft_deleted_projects_view` (
`first_name` varchar(255)
,`middle_name` varchar(255)
,`last_name` varchar(255)
,`uuid` char(36)
,`creator_uuid` char(36)
,`project_name` varchar(255)
,`project_desc` varchar(255)
,`status` enum('new','in-progress','done','deleted')
,`created_at` datetime
,`updated_at` datetime
,`is_deleted` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `soft_deleted_tasks_view`
-- (See below for the actual view)
--
CREATE TABLE `soft_deleted_tasks_view` (
`uuid` char(36)
,`id` int(11)
,`creator_uuid` char(36)
,`task_for_user_uuid` char(36)
,`task_for_project_uuid` char(36)
,`task_name` varchar(255)
,`task_desc` varchar(255)
,`status` enum('new','in-progress','done','deleted')
,`created_at` datetime
,`updated_at` datetime
,`is_deleted` tinyint(1)
,`project_name` varchar(255)
,`project_desc` varchar(255)
,`assignee_roles` enum('user','admin','project_manager')
,`assignee_first_name` varchar(255)
,`assignee_middle_name` varchar(255)
,`assignee_last_name` varchar(255)
,`creator_roles` enum('user','admin','project_manager')
,`creator_first_name` varchar(255)
,`creator_middle_name` varchar(255)
,`creator_last_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `soft_deleted_users_view`
-- (See below for the actual view)
--
CREATE TABLE `soft_deleted_users_view` (
`UUID` char(36)
,`id` int(11)
,`roles` enum('user','admin','project_manager')
,`first_name` varchar(255)
,`middle_name` varchar(255)
,`last_name` varchar(255)
,`email` varchar(255)
,`created_at` datetime
,`updated_at` datetime
,`is_deleted` tinyint(1)
,`password` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tasks_view`
-- (See below for the actual view)
--
CREATE TABLE `tasks_view` (
`uuid` char(36)
,`id` int(11)
,`creator_uuid` char(36)
,`task_for_user_uuid` char(36)
,`task_for_project_uuid` char(36)
,`task_name` varchar(255)
,`task_desc` varchar(255)
,`status` enum('new','in-progress','done','deleted')
,`created_at` datetime
,`updated_at` datetime
,`is_deleted` tinyint(1)
,`project_name` varchar(255)
,`project_desc` varchar(255)
,`assignee_roles` enum('user','admin','project_manager')
,`assignee_first_name` varchar(255)
,`assignee_middle_name` varchar(255)
,`assignee_last_name` varchar(255)
,`creator_roles` enum('user','admin','project_manager')
,`creator_first_name` varchar(255)
,`creator_middle_name` varchar(255)
,`creator_last_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `uuid` char(36) NOT NULL,
  `id` int(11) NOT NULL,
  `creator_uuid` char(36) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_desc` varchar(255) DEFAULT NULL,
  `status` enum('new','in-progress','done','deleted') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`uuid`, `id`, `creator_uuid`, `project_name`, `project_desc`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
('722489f8-cf4b-11ef-801e-507b9d05e601', 9, 'f2664e33-cf45-11ef-801e-507b9d05e601', 'test', 'test', 'in-progress', '2025-01-10 20:07:21', '2025-01-10 20:07:39', 0),
('857ff9ba-ceb6-11ef-8807-507b9d05e601', 1, '741b8375-ceb5-11ef-8807-507b9d05e601', 'New project', 'This is a new project', 'new', '2025-01-10 02:21:20', '2025-01-10 19:43:03', 0),
('b5ab7faf-cf6d-11ef-a6a9-507b9d05e601', 10, '741b8375-ceb5-11ef-8807-507b9d05e601', 'Admin created', 'Admin created', 'new', '2025-01-11 00:12:37', '2025-01-11 00:12:37', 0),
('c231b69e-cf6d-11ef-a6a9-507b9d05e601', 11, 'f2664e33-cf45-11ef-801e-507b9d05e601', 'Manager Created', 'Manager Created', 'new', '2025-01-11 00:12:58', '2025-01-11 00:12:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks`
--

CREATE TABLE `tbl_tasks` (
  `uuid` char(36) NOT NULL,
  `id` int(11) NOT NULL,
  `creator_uuid` char(36) DEFAULT NULL,
  `task_for_user_uuid` char(36) DEFAULT NULL,
  `task_for_project_uuid` char(36) DEFAULT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `task_desc` varchar(255) DEFAULT NULL,
  `status` enum('new','in-progress','done','deleted') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tasks`
--

INSERT INTO `tbl_tasks` (`uuid`, `id`, `creator_uuid`, `task_for_user_uuid`, `task_for_project_uuid`, `task_name`, `task_desc`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
('8590b816-cf4b-11ef-801e-507b9d05e601', 7, 'f2664e33-cf45-11ef-801e-507b9d05e601', 'da643495-ceb6-11ef-8807-507b9d05e601', '722489f8-cf4b-11ef-801e-507b9d05e601', 'test', 'test', 'done', '2025-01-10 20:07:54', '2025-01-10 20:08:17', 0),
('e0b84936-cf4c-11ef-801e-507b9d05e601', 8, 'f2664e33-cf45-11ef-801e-507b9d05e601', 'da643495-ceb6-11ef-8807-507b9d05e601', '722489f8-cf4b-11ef-801e-507b9d05e601', 'test2', 'test2', 'new', '2025-01-10 20:17:36', '2025-01-10 20:17:36', 0),
('e6fad880-ceb6-11ef-8807-507b9d05e601', 1, '741b8375-ceb5-11ef-8807-507b9d05e601', 'da643495-ceb6-11ef-8807-507b9d05e601', '857ff9ba-ceb6-11ef-8807-507b9d05e601', 'New Task', 'Tasks', 'in-progress', '2025-01-10 02:24:04', '2025-01-10 20:04:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `UUID` char(36) NOT NULL,
  `id` int(11) NOT NULL,
  `roles` enum('user','admin','project_manager') DEFAULT 'user',
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`UUID`, `id`, `roles`, `first_name`, `middle_name`, `last_name`, `email`, `created_at`, `updated_at`, `is_deleted`, `password`) VALUES
('741b8375-ceb5-11ef-8807-507b9d05e601', 9, 'admin', 'Admin', NULL, 'Admin', 'admin@admin.com', '2025-01-10 02:13:41', '2025-01-10 02:13:54', 0, '$2y$10$7b26IDohoulbn71844RNEOki2lYsQdZbdcGbITGaPa.ztYSl/F8v2'),
('da643495-ceb6-11ef-8807-507b9d05e601', 11, 'user', 'Sheena', NULL, 'Daclan', 'User@mail.com', '2025-01-10 02:23:42', '2025-01-10 20:02:28', 0, '$2y$10$qvF6e0tHWcyDC.3dtd08mu7tTG6c6L7N9tqjrR.CkD8biEsBGc9JG'),
('f2664e33-cf45-11ef-801e-507b9d05e601', 16, 'project_manager', 'Kenth', NULL, 'Oyao', 'manager@manager.com', '2025-01-10 19:27:59', '2025-01-10 20:11:10', 0, '$2y$10$lQcppVF4ncpJ5lr.GoVQoOdDK3DV.Ay1beA1S0sFYfm2M.K7RIWkW');

-- --------------------------------------------------------

--
-- Structure for view `active_users_view`
--
DROP TABLE IF EXISTS `active_users_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `active_users_view`  AS SELECT `tbl_users`.`UUID` AS `UUID`, `tbl_users`.`id` AS `id`, `tbl_users`.`roles` AS `roles`, `tbl_users`.`first_name` AS `first_name`, `tbl_users`.`middle_name` AS `middle_name`, `tbl_users`.`last_name` AS `last_name`, `tbl_users`.`email` AS `email`, `tbl_users`.`created_at` AS `created_at`, `tbl_users`.`updated_at` AS `updated_at`, `tbl_users`.`is_deleted` AS `is_deleted`, `tbl_users`.`password` AS `password` FROM `tbl_users` WHERE `tbl_users`.`is_deleted` = 0 ORDER BY `tbl_users`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `count_all_projects_view`
--
DROP TABLE IF EXISTS `count_all_projects_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_all_projects_view`  AS SELECT count(case when `tbl_projects`.`status` = 'new' then 1 end) AS `new_projects`, count(case when `tbl_projects`.`status` = 'in-progress' then 1 end) AS `in_progress_projects`, count(case when `tbl_projects`.`status` = 'done' then 1 end) AS `done_projects` FROM `tbl_projects` ;

-- --------------------------------------------------------

--
-- Structure for view `count_all_tasks_view`
--
DROP TABLE IF EXISTS `count_all_tasks_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_all_tasks_view`  AS SELECT sum(`tbl_tasks`.`status` = 'new') AS `new_tasks`, sum(`tbl_tasks`.`status` = 'in-progress') AS `in_progress_tasks`, sum(`tbl_tasks`.`status` = 'done') AS `done_tasks` FROM `tbl_tasks` ;

-- --------------------------------------------------------

--
-- Structure for view `count_all_users_view`
--
DROP TABLE IF EXISTS `count_all_users_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `count_all_users_view`  AS SELECT sum(`tbl_users`.`is_deleted` = 0) AS `active_accounts`, sum(`tbl_users`.`is_deleted` = 1) AS `soft_deleted_users` FROM `tbl_users` ;

-- --------------------------------------------------------

--
-- Structure for view `projects_view`
--
DROP TABLE IF EXISTS `projects_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `projects_view`  AS SELECT `tbl_users`.`first_name` AS `first_name`, `tbl_users`.`middle_name` AS `middle_name`, `tbl_users`.`last_name` AS `last_name`, `tbl_projects`.`uuid` AS `uuid`, `tbl_projects`.`creator_uuid` AS `creator_uuid`, `tbl_projects`.`project_name` AS `project_name`, `tbl_projects`.`project_desc` AS `project_desc`, `tbl_projects`.`status` AS `status`, `tbl_projects`.`created_at` AS `created_at`, `tbl_projects`.`updated_at` AS `updated_at`, `tbl_projects`.`is_deleted` AS `is_deleted` FROM (`tbl_projects` left join `tbl_users` on(`tbl_projects`.`creator_uuid` = `tbl_users`.`UUID`)) WHERE `tbl_projects`.`is_deleted` = 0 ORDER BY `tbl_projects`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `soft_deleted_projects_view`
--
DROP TABLE IF EXISTS `soft_deleted_projects_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `soft_deleted_projects_view`  AS SELECT `tbl_users`.`first_name` AS `first_name`, `tbl_users`.`middle_name` AS `middle_name`, `tbl_users`.`last_name` AS `last_name`, `tbl_projects`.`uuid` AS `uuid`, `tbl_projects`.`creator_uuid` AS `creator_uuid`, `tbl_projects`.`project_name` AS `project_name`, `tbl_projects`.`project_desc` AS `project_desc`, `tbl_projects`.`status` AS `status`, `tbl_projects`.`created_at` AS `created_at`, `tbl_projects`.`updated_at` AS `updated_at`, `tbl_projects`.`is_deleted` AS `is_deleted` FROM (`tbl_projects` left join `tbl_users` on(`tbl_projects`.`creator_uuid` = `tbl_users`.`UUID`)) WHERE `tbl_projects`.`is_deleted` = 1 ORDER BY `tbl_projects`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `soft_deleted_tasks_view`
--
DROP TABLE IF EXISTS `soft_deleted_tasks_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `soft_deleted_tasks_view`  AS SELECT `tbl_tasks`.`uuid` AS `uuid`, `tbl_tasks`.`id` AS `id`, `tbl_tasks`.`creator_uuid` AS `creator_uuid`, `tbl_tasks`.`task_for_user_uuid` AS `task_for_user_uuid`, `tbl_tasks`.`task_for_project_uuid` AS `task_for_project_uuid`, `tbl_tasks`.`task_name` AS `task_name`, `tbl_tasks`.`task_desc` AS `task_desc`, `tbl_tasks`.`status` AS `status`, `tbl_tasks`.`created_at` AS `created_at`, `tbl_tasks`.`updated_at` AS `updated_at`, `tbl_tasks`.`is_deleted` AS `is_deleted`, `tbl_projects`.`project_name` AS `project_name`, `tbl_projects`.`project_desc` AS `project_desc`, `tbl_users`.`roles` AS `assignee_roles`, `tbl_users`.`first_name` AS `assignee_first_name`, `tbl_users`.`middle_name` AS `assignee_middle_name`, `tbl_users`.`last_name` AS `assignee_last_name`, `creator_users`.`roles` AS `creator_roles`, `creator_users`.`first_name` AS `creator_first_name`, `creator_users`.`middle_name` AS `creator_middle_name`, `creator_users`.`last_name` AS `creator_last_name` FROM (((`tbl_tasks` left join `tbl_projects` on(`tbl_projects`.`creator_uuid` = `tbl_tasks`.`task_for_project_uuid`)) left join `tbl_users` on(`tbl_tasks`.`task_for_user_uuid` = `tbl_users`.`UUID`)) left join `tbl_users` `creator_users` on(`tbl_tasks`.`creator_uuid` = `creator_users`.`UUID`)) WHERE `tbl_tasks`.`is_deleted` = 1 ORDER BY `tbl_tasks`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `soft_deleted_users_view`
--
DROP TABLE IF EXISTS `soft_deleted_users_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `soft_deleted_users_view`  AS SELECT `tbl_users`.`UUID` AS `UUID`, `tbl_users`.`id` AS `id`, `tbl_users`.`roles` AS `roles`, `tbl_users`.`first_name` AS `first_name`, `tbl_users`.`middle_name` AS `middle_name`, `tbl_users`.`last_name` AS `last_name`, `tbl_users`.`email` AS `email`, `tbl_users`.`created_at` AS `created_at`, `tbl_users`.`updated_at` AS `updated_at`, `tbl_users`.`is_deleted` AS `is_deleted`, `tbl_users`.`password` AS `password` FROM `tbl_users` WHERE `tbl_users`.`is_deleted` = 1 ORDER BY `tbl_users`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `tasks_view`
--
DROP TABLE IF EXISTS `tasks_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tasks_view`  AS SELECT `tbl_tasks`.`uuid` AS `uuid`, `tbl_tasks`.`id` AS `id`, `tbl_tasks`.`creator_uuid` AS `creator_uuid`, `tbl_tasks`.`task_for_user_uuid` AS `task_for_user_uuid`, `tbl_tasks`.`task_for_project_uuid` AS `task_for_project_uuid`, `tbl_tasks`.`task_name` AS `task_name`, `tbl_tasks`.`task_desc` AS `task_desc`, `tbl_tasks`.`status` AS `status`, `tbl_tasks`.`created_at` AS `created_at`, `tbl_tasks`.`updated_at` AS `updated_at`, `tbl_tasks`.`is_deleted` AS `is_deleted`, `tbl_projects`.`project_name` AS `project_name`, `tbl_projects`.`project_desc` AS `project_desc`, `tbl_users`.`roles` AS `assignee_roles`, `tbl_users`.`first_name` AS `assignee_first_name`, `tbl_users`.`middle_name` AS `assignee_middle_name`, `tbl_users`.`last_name` AS `assignee_last_name`, `creator_users`.`roles` AS `creator_roles`, `creator_users`.`first_name` AS `creator_first_name`, `creator_users`.`middle_name` AS `creator_middle_name`, `creator_users`.`last_name` AS `creator_last_name` FROM (((`tbl_tasks` left join `tbl_projects` on(`tbl_projects`.`creator_uuid` = `tbl_tasks`.`task_for_project_uuid`)) left join `tbl_users` on(`tbl_tasks`.`task_for_user_uuid` = `tbl_users`.`UUID`)) left join `tbl_users` `creator_users` on(`tbl_tasks`.`creator_uuid` = `creator_users`.`UUID`)) WHERE `tbl_tasks`.`is_deleted` = 0 ORDER BY `tbl_tasks`.`id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `id` (`id`),
  ADD KEY `creator_uuid` (`creator_uuid`);

--
-- Indexes for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `id` (`id`),
  ADD KEY `creator_uuid` (`creator_uuid`),
  ADD KEY `task_for_user_uuid` (`task_for_user_uuid`),
  ADD KEY `task_for_project_uuid` (`task_for_project_uuid`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`UUID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD CONSTRAINT `tbl_projects_ibfk_1` FOREIGN KEY (`creator_uuid`) REFERENCES `tbl_users` (`UUID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  ADD CONSTRAINT `tbl_tasks_ibfk_1` FOREIGN KEY (`creator_uuid`) REFERENCES `tbl_users` (`UUID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_tasks_ibfk_2` FOREIGN KEY (`task_for_user_uuid`) REFERENCES `tbl_users` (`UUID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_tasks_ibfk_3` FOREIGN KEY (`task_for_project_uuid`) REFERENCES `tbl_projects` (`uuid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
