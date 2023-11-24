SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE DATABASE IF NOT EXISTS `speak`;

USE `speak`;

CREATE TABLE IF NOT EXISTS `speak`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(14) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  `endereco` VARCHAR(45) NOT NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `complemento` VARCHAR(45) NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `tipoPerfil` VARCHAR(45) NOT NULL,
  `areaAtuacao` VARCHAR(45) NULL,
  `numeroRegistroProfessor` VARCHAR(45) NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;

INSERT INTO `usuario` (`idUsuario`, `nome`, `email`, `telefone`, `cpf`, `endereco`, `bairro`, `complemento`, `cidade`, `estado`, `tipoPerfil`, `areaAtuacao`, `numeroRegistroProfessor`, `senha`) VALUES
(1, 's', 's@gmail.com', 's', 's', 's', 's', 's', 's', 'SC', 'professor', 's', 's', 's'),
(2, 'Professor', 'professor@gmail.com', '123123123123', '12312312312', 'endereco', 'bairro', 'complemento', 'cidade', 'AC', 'professor', 'Exatas', '1231123123', '123'),
(3, 'estudante', 'estudante@gmail.com', '123123123123', '12312312312', 'endereco', 'bairro', 'complemento', 'cidade', 'AL', 'aluno', '', '', '123');

CREATE TABLE IF NOT EXISTS `speak`.`Curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `usuarioResponsavel` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`idCurso`, `usuarioResponsavel`),
  UNIQUE INDEX `titulo_UNIQUE` (`titulo` ASC) ,
  INDEX `fk_Curso_Usuario_idx` (`usuarioResponsavel` ASC) ,
  CONSTRAINT `fk_Curso_Usuario`
    FOREIGN KEY (`usuarioResponsavel`)
    REFERENCES `speak`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `curso` (`idCurso`, `usuarioResponsavel`, `titulo`, `descricao`) VALUES
(1, 2, 'Matematica', 'Resolvo questões diariamente do ENEM neste curso.');

CREATE TABLE IF NOT EXISTS `speak`.`Chat` (
  `idChat` INT NOT NULL AUTO_INCREMENT,
  `Curso_idCurso` INT NOT NULL,
  `Curso_usuarioResponsavel` INT NOT NULL,
  PRIMARY KEY (`idChat`),
  INDEX `fk_Chat_Curso1_idx` (`Curso_idCurso` ASC, `Curso_usuarioResponsavel` ASC) ,
  CONSTRAINT `fk_Chat_Curso1`
    FOREIGN KEY (`Curso_idCurso` , `Curso_usuarioResponsavel`)
    REFERENCES `speak`.`Curso` (`idCurso` , `usuarioResponsavel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `chat` (`idChat`, `Curso_idCurso`, `Curso_usuarioResponsavel`) VALUES
(1, 1, 2);

CREATE TABLE IF NOT EXISTS `speak`.`Mensagem` (
  `idMensagem` INT NOT NULL AUTO_INCREMENT,
  `conteudo` VARCHAR(500) NOT NULL,
  `Chat_id` INT NOT NULL,
  PRIMARY KEY (`idMensagem`),
  INDEX `fk_Mensagem_Chat1_idx` (`Chat_id` ASC) ,
  CONSTRAINT `fk_Mensagem_Chat1`
    FOREIGN KEY (`Chat_id`)
    REFERENCES `speak`.`Chat` (`idChat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `mensagem` (`idMensagem`, `conteudo`, `Chat_id`) VALUES
(1, 'mensagem matematica', 1);

CREATE TABLE IF NOT EXISTS `speak`.`Usuario_Cursando` (
  `Curso_idCurso` INT NOT NULL,
  `Curso_usuarioResponsavel` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`Curso_idCurso`, `Curso_usuarioResponsavel`, `Usuario_idUsuario`),
  INDEX `fk_Curso_has_Usuario_Usuario1_idx` (`Usuario_idUsuario` ASC) ,
  INDEX `fk_Curso_has_Usuario_Curso1_idx` (`Curso_idCurso` ASC, `Curso_usuarioResponsavel` ASC) ,
  CONSTRAINT `fk_Curso_has_Usuario_Curso1`
    FOREIGN KEY (`Curso_idCurso` , `Curso_usuarioResponsavel`)
    REFERENCES `speak`.`Curso` (`idCurso` , `usuarioResponsavel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_has_Usuario_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `speak`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `usuario_cursando` (`Curso_idCurso`, `Curso_usuarioResponsavel`, `Usuario_idUsuario`) VALUES
(1, 2, 2),
(1, 2, 3);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;