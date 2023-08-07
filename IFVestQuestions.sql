-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 07/08/2023 às 09:38
-- Versão do servidor: 8.0.33-0ubuntu0.22.04.2
-- Versão do PHP: 8.1.2-1ubuntu2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ifvest`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Alternative`
--

CREATE TABLE `Alternative` (
  `id` int NOT NULL,
  `text` varchar(500) NOT NULL,
  `isCorrect` tinyint NOT NULL,
  `idQuestion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `Alternative`
--

INSERT INTO `Alternative` (`id`, `text`, `isCorrect`, `idQuestion`) VALUES
(1, '1', 0, 2),
(2, '2', 1, 2),
(3, '3', 0, 2),
(4, '4', 0, 2),
(5, '5', 0, 2),
(6, '1', 0, 3),
(7, '2', 0, 3),
(8, '3', 0, 3),
(9, '4', 1, 3),
(10, '5', 0, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Comment`
--

CREATE TABLE `Comment` (
  `id` int NOT NULL,
  `text` varchar(500) NOT NULL,
  `idLession` int NOT NULL,
  `idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Exam`
--

CREATE TABLE `Exam` (
  `id` int NOT NULL,
  `idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ExamModule`
--

CREATE TABLE `ExamModule` (
  `id` int NOT NULL,
  `correctQuestions` int NOT NULL,
  `isProblem` tinyint DEFAULT NULL,
  `idExam` int NOT NULL,
  `totalQuestions` int NOT NULL,
  `idModule` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Lesson`
--

CREATE TABLE `Lesson` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `videoURL` varchar(1000) NOT NULL,
  `idModule` int NOT NULL,
  `idStudyWeek` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Material`
--

CREATE TABLE `Material` (
  `id` int NOT NULL,
  `path` varchar(300) NOT NULL,
  `idLession` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Module`
--

CREATE TABLE `Module` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `subject` enum('Matemática','Português','Redação','Geografia','História','Ciências') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `Module`
--

INSERT INTO `Module` (`id`, `name`, `description`, `subject`) VALUES
(1, 'matemática Básica', 'mat', 'Matemática');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Question`
--

CREATE TABLE `Question` (
  `id` int NOT NULL,
  `text` varchar(1000) NOT NULL,
  `idModule` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `Question`
--

INSERT INTO `Question` (`id`, `text`, `idModule`) VALUES
(2, '1+ 1', 1),
(3, 'Quanto vale 2 +  2?', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `StudyPlan`
--

CREATE TABLE `StudyPlan` (
  `id` int NOT NULL,
  `idExam` int NOT NULL,
  `idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `StudyWeek`
--

CREATE TABLE `StudyWeek` (
  `id` int NOT NULL,
  `marker` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `SuggestedModule`
--

CREATE TABLE `SuggestedModule` (
  `id` int NOT NULL,
  `idStudyPlan` int NOT NULL,
  `idModule` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `User`
--

CREATE TABLE `User` (
  `id` int NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `completeName` varchar(100) NOT NULL,
  `function` enum('Professor','Administrador','Aluno') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `completeName`, `function`) VALUES
(1, 'a@a', '1234', 'Andrei Pinto', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `UserAnswer`
--

CREATE TABLE `UserAnswer` (
  `id` int NOT NULL,
  `idExamModule` int NOT NULL,
  `idQuestion` int NOT NULL,
  `userRightAnswer` tinyint DEFAULT NULL,
  `chosenAnswer` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Alternative`
--
ALTER TABLE `Alternative`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Alternative_Question1_idx` (`idQuestion`);

--
-- Índices de tabela `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Coment_Lession1_idx` (`idLession`),
  ADD KEY `fk_Coment_User1_idx` (`idUser`);

--
-- Índices de tabela `Exam`
--
ALTER TABLE `Exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Exam_User1_idx` (`idUser`);

--
-- Índices de tabela `ExamModule`
--
ALTER TABLE `ExamModule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_CorrectByModule_Exam1_idx` (`idExam`),
  ADD KEY `fk_ExamModules_Module1_idx` (`idModule`);

--
-- Índices de tabela `Lesson`
--
ALTER TABLE `Lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Lession_Module_idx` (`idModule`),
  ADD KEY `fk_Lession_StudyWeek1_idx` (`idStudyWeek`);

--
-- Índices de tabela `Material`
--
ALTER TABLE `Material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Material_Lesson1_idx` (`idLession`);

--
-- Índices de tabela `Module`
--
ALTER TABLE `Module`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Question_Module1_idx` (`idModule`);

--
-- Índices de tabela `StudyPlan`
--
ALTER TABLE `StudyPlan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_StudyPlan_Exam1_idx` (`idExam`),
  ADD KEY `fk_StudyPlan_User1_idx` (`idUser`);

--
-- Índices de tabela `StudyWeek`
--
ALTER TABLE `StudyWeek`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `SuggestedModule`
--
ALTER TABLE `SuggestedModule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_StudyPlan_has_Module_Module1_idx` (`idModule`),
  ADD KEY `fk_StudyPlan_has_Module_StudyPlan1_idx` (`idStudyPlan`);

--
-- Índices de tabela `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `UserAnswer`
--
ALTER TABLE `UserAnswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_QuestionByModule_has_Question_Question1_idx` (`idQuestion`),
  ADD KEY `fk_QuestionByModule_has_Question_QuestionByModule1_idx` (`idExamModule`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Alternative`
--
ALTER TABLE `Alternative`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Exam`
--
ALTER TABLE `Exam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ExamModule`
--
ALTER TABLE `ExamModule`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Lesson`
--
ALTER TABLE `Lesson`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Material`
--
ALTER TABLE `Material`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Module`
--
ALTER TABLE `Module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `Question`
--
ALTER TABLE `Question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `StudyPlan`
--
ALTER TABLE `StudyPlan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `StudyWeek`
--
ALTER TABLE `StudyWeek`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `SuggestedModule`
--
ALTER TABLE `SuggestedModule`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `User`
--
ALTER TABLE `User`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `UserAnswer`
--
ALTER TABLE `UserAnswer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Alternative`
--
ALTER TABLE `Alternative`
  ADD CONSTRAINT `fk_Alternative_Question1` FOREIGN KEY (`idQuestion`) REFERENCES `Question` (`id`);

--
-- Restrições para tabelas `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `fk_Coment_Lession1` FOREIGN KEY (`idLession`) REFERENCES `Lesson` (`id`),
  ADD CONSTRAINT `fk_Coment_User1` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

--
-- Restrições para tabelas `Exam`
--
ALTER TABLE `Exam`
  ADD CONSTRAINT `fk_Exam_User1` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

--
-- Restrições para tabelas `ExamModule`
--
ALTER TABLE `ExamModule`
  ADD CONSTRAINT `fk_CorrectByModule_Exam1` FOREIGN KEY (`idExam`) REFERENCES `Exam` (`id`),
  ADD CONSTRAINT `fk_ExamModules_Module1` FOREIGN KEY (`idModule`) REFERENCES `Module` (`id`);

--
-- Restrições para tabelas `Lesson`
--
ALTER TABLE `Lesson`
  ADD CONSTRAINT `fk_Lession_Module` FOREIGN KEY (`idModule`) REFERENCES `Module` (`id`),
  ADD CONSTRAINT `fk_Lession_StudyWeek1` FOREIGN KEY (`idStudyWeek`) REFERENCES `StudyWeek` (`id`);

--
-- Restrições para tabelas `Material`
--
ALTER TABLE `Material`
  ADD CONSTRAINT `fk_Material_Lesson1` FOREIGN KEY (`idLession`) REFERENCES `Lesson` (`id`);

--
-- Restrições para tabelas `Question`
--
ALTER TABLE `Question`
  ADD CONSTRAINT `fk_Question_Module1` FOREIGN KEY (`idModule`) REFERENCES `Module` (`id`);

--
-- Restrições para tabelas `StudyPlan`
--
ALTER TABLE `StudyPlan`
  ADD CONSTRAINT `fk_StudyPlan_Exam1` FOREIGN KEY (`idExam`) REFERENCES `Exam` (`id`),
  ADD CONSTRAINT `fk_StudyPlan_User1` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

--
-- Restrições para tabelas `SuggestedModule`
--
ALTER TABLE `SuggestedModule`
  ADD CONSTRAINT `fk_StudyPlan_has_Module_Module1` FOREIGN KEY (`idModule`) REFERENCES `Module` (`id`),
  ADD CONSTRAINT `fk_StudyPlan_has_Module_StudyPlan1` FOREIGN KEY (`idStudyPlan`) REFERENCES `StudyPlan` (`id`);

--
-- Restrições para tabelas `UserAnswer`
--
ALTER TABLE `UserAnswer`
  ADD CONSTRAINT `fk_QuestionByModule_has_Question_Question1` FOREIGN KEY (`idQuestion`) REFERENCES `Question` (`id`),
  ADD CONSTRAINT `fk_QuestionByModule_has_Question_QuestionByModule1` FOREIGN KEY (`idExamModule`) REFERENCES `ExamModule` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
