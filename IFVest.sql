-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 27/03/2023 às 09:59
-- Versão do servidor: 8.0.32-0ubuntu0.22.04.2
-- Versão do PHP: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `IFVest`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Alternative`
--

CREATE TABLE `Alternative` (
  `idAlternative` int NOT NULL,
  `Question_idQuestion` int NOT NULL,
  `text` varchar(200) NOT NULL,
  `isCorrect` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Comment`
--

CREATE TABLE `Comment` (
  `idComent` int NOT NULL,
  `Lession_idLession` int NOT NULL,
  `User_idUser` int NOT NULL,
  `text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `CorrectByModule`
--

CREATE TABLE `CorrectByModule` (
  `idCorrectByModule` int NOT NULL,
  `Exam_idExam` int NOT NULL,
  `totalQuestions` int NOT NULL,
  `correctQuestions` int NOT NULL,
  `isProblem` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Exam`
--

CREATE TABLE `Exam` (
  `idExam` int NOT NULL,
  `ExamReport_idExamReport` int NOT NULL,
  `User_idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ExamReport`
--

CREATE TABLE `ExamReport` (
  `idExamReport` int NOT NULL,
  `StudyPlan_idStudyPlan` int NOT NULL,
  `totalCorrects` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Lession`
--

CREATE TABLE `Lession` (
  `idLession` int NOT NULL,
  `Module_idModule` int NOT NULL,
  `StudyWeek_idStudyWeek` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `URL` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Module`
--

CREATE TABLE `module` (
  `idModule` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Module_has_StudyPlan`
--

CREATE TABLE `Module_has_StudyPlan` (
  `Module_idModule` int NOT NULL,
  `StudyPlan_idStudyPlan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Question`
--

CREATE TABLE `Question` (
  `idQuestion` int NOT NULL,
  `Module_idModule` int NOT NULL,
  `text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Question_has_Exam`
--

CREATE TABLE `Question_has_Exam` (
  `Question_idQuestion` int NOT NULL,
  `Exam_idExam` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `StudyCronogram`
--

CREATE TABLE `StudyCronogram` (
  `idStudyCronogram` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `StudyPlan`
--

CREATE TABLE `StudyPlan` (
  `idStudyPlan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `StudyWeek`
--

CREATE TABLE `StudyWeek` (
  `idStudyWeek` int NOT NULL,
  `StudyCronogram_idStudyCronogram` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `User`
--

CREATE TABLE `User` (
  `idUser` int NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `completeName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Alternative`
--
ALTER TABLE `Alternative`
  ADD PRIMARY KEY (`idAlternative`),
  ADD KEY `fk_Alternative_Question1_idx` (`Question_idQuestion`);

--
-- Índices de tabela `Coment`
--
ALTER TABLE `Coment`
  ADD PRIMARY KEY (`idComent`,`User_idUser`),
  ADD KEY `fk_Coment_Lession1_idx` (`Lession_idLession`),
  ADD KEY `fk_Coment_User1_idx` (`User_idUser`);

--
-- Índices de tabela `CorrectByModule`
--
ALTER TABLE `CorrectByModule`
  ADD PRIMARY KEY (`idCorrectByModule`),
  ADD KEY `fk_CorrectByModule_Exam1_idx` (`Exam_idExam`);

--
-- Índices de tabela `Exam`
--
ALTER TABLE `Exam`
  ADD PRIMARY KEY (`idExam`),
  ADD KEY `fk_Exam_ExamReport1_idx` (`ExamReport_idExamReport`),
  ADD KEY `fk_Exam_User1_idx` (`User_idUser`);

--
-- Índices de tabela `ExamReport`
--
ALTER TABLE `ExamReport`
  ADD PRIMARY KEY (`idExamReport`),
  ADD KEY `fk_ExamReport_StudyPlan1_idx` (`StudyPlan_idStudyPlan`);

--
-- Índices de tabela `Lession`
--
ALTER TABLE `Lession`
  ADD PRIMARY KEY (`idLession`),
  ADD KEY `fk_Lession_Module_idx` (`Module_idModule`),
  ADD KEY `fk_Lession_StudyWeek1_idx` (`StudyWeek_idStudyWeek`);

--
-- Índices de tabela `Module`
--
ALTER TABLE `Module`
  ADD PRIMARY KEY (`idModule`),
  ADD KEY `fk_Module_CorrectByModule1_idx` (`CorrectByModule_idCorrectByModule`);

--
-- Índices de tabela `Module_has_StudyPlan`
--
ALTER TABLE `Module_has_StudyPlan`
  ADD PRIMARY KEY (`Module_idModule`,`StudyPlan_idStudyPlan`),
  ADD KEY `fk_Module_has_StudyPlan_StudyPlan1_idx` (`StudyPlan_idStudyPlan`),
  ADD KEY `fk_Module_has_StudyPlan_Module1_idx` (`Module_idModule`);

--
-- Índices de tabela `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`idQuestion`),
  ADD KEY `fk_Question_Module1_idx` (`Module_idModule`);

--
-- Índices de tabela `Question_has_Exam`
--
ALTER TABLE `Question_has_Exam`
  ADD PRIMARY KEY (`Question_idQuestion`,`Exam_idExam`),
  ADD KEY `fk_Question_has_Exam_Exam1_idx` (`Exam_idExam`),
  ADD KEY `fk_Question_has_Exam_Question1_idx` (`Question_idQuestion`);

--
-- Índices de tabela `StudyCronogram`
--
ALTER TABLE `StudyCronogram`
  ADD PRIMARY KEY (`idStudyCronogram`);

--
-- Índices de tabela `StudyPlan`
--
ALTER TABLE `StudyPlan`
  ADD PRIMARY KEY (`idStudyPlan`);

--
-- Índices de tabela `StudyWeek`
--
ALTER TABLE `StudyWeek`
  ADD PRIMARY KEY (`idStudyWeek`),
  ADD KEY `fk_StudyWeek_StudyCronogram1_idx` (`StudyCronogram_idStudyCronogram`);

--
-- Índices de tabela `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Alternative`
--
ALTER TABLE `Alternative`
  ADD CONSTRAINT `fk_Alternative_Question1` FOREIGN KEY (`Question_idQuestion`) REFERENCES `Question` (`idQuestion`);

--
-- Restrições para tabelas `Coment`
--
ALTER TABLE `Coment`
  ADD CONSTRAINT `fk_Coment_Lession1` FOREIGN KEY (`Lession_idLession`) REFERENCES `Lession` (`idLession`),
  ADD CONSTRAINT `fk_Coment_User1` FOREIGN KEY (`User_idUser`) REFERENCES `User` (`idUser`);

--
-- Restrições para tabelas `CorrectByModule`
--
ALTER TABLE `CorrectByModule`
  ADD CONSTRAINT `fk_CorrectByModule_Exam1` FOREIGN KEY (`Exam_idExam`) REFERENCES `Exam` (`idExam`);

--
-- Restrições para tabelas `Exam`
--
ALTER TABLE `Exam`
  ADD CONSTRAINT `fk_Exam_ExamReport1` FOREIGN KEY (`ExamReport_idExamReport`) REFERENCES `ExamReport` (`idExamReport`),
  ADD CONSTRAINT `fk_Exam_User1` FOREIGN KEY (`User_idUser`) REFERENCES `User` (`idUser`);

--
-- Restrições para tabelas `ExamReport`
--
ALTER TABLE `ExamReport`
  ADD CONSTRAINT `fk_ExamReport_StudyPlan1` FOREIGN KEY (`StudyPlan_idStudyPlan`) REFERENCES `StudyPlan` (`idStudyPlan`);

--
-- Restrições para tabelas `Lession`
--
ALTER TABLE `Lession`
  ADD CONSTRAINT `fk_Lession_Module` FOREIGN KEY (`Module_idModule`) REFERENCES `Module` (`idModule`),
  ADD CONSTRAINT `fk_Lession_StudyWeek1` FOREIGN KEY (`StudyWeek_idStudyWeek`) REFERENCES `StudyWeek` (`idStudyWeek`);

--
-- Restrições para tabelas `Module`
--
ALTER TABLE `Module`
  ADD CONSTRAINT `fk_Module_CorrectByModule1` FOREIGN KEY (`CorrectByModule_idCorrectByModule`) REFERENCES `CorrectByModule` (`idCorrectByModule`);

--
-- Restrições para tabelas `Module_has_StudyPlan`
--
ALTER TABLE `Module_has_StudyPlan`
  ADD CONSTRAINT `fk_Module_has_StudyPlan_Module1` FOREIGN KEY (`Module_idModule`) REFERENCES `Module` (`idModule`),
  ADD CONSTRAINT `fk_Module_has_StudyPlan_StudyPlan1` FOREIGN KEY (`StudyPlan_idStudyPlan`) REFERENCES `StudyPlan` (`idStudyPlan`);

--
-- Restrições para tabelas `Question`
--
ALTER TABLE `Question`
  ADD CONSTRAINT `fk_Question_Module1` FOREIGN KEY (`Module_idModule`) REFERENCES `Module` (`idModule`);

--
-- Restrições para tabelas `Question_has_Exam`
--
ALTER TABLE `Question_has_Exam`
  ADD CONSTRAINT `fk_Question_has_Exam_Exam1` FOREIGN KEY (`Exam_idExam`) REFERENCES `Exam` (`idExam`),
  ADD CONSTRAINT `fk_Question_has_Exam_Question1` FOREIGN KEY (`Question_idQuestion`) REFERENCES `Question` (`idQuestion`);

--
-- Restrições para tabelas `StudyWeek`
--
ALTER TABLE `StudyWeek`
  ADD CONSTRAINT `fk_StudyWeek_StudyCronogram1` FOREIGN KEY (`StudyCronogram_idStudyCronogram`) REFERENCES `StudyCronogram` (`idStudyCronogram`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
