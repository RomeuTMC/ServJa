SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `permissoes_acesso`;
CREATE TABLE `permissoes_acesso` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'Identificador do Item do Menu',
  `id_pai` smallint(5) UNSIGNED NOT NULL COMMENT 'Identificador do PAI para multiníveis',
  `menu` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Texto do Menu (apresentado)',
  `endpoint` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EndPoint chamado (ALIAS) para a URL',
  `ordem` smallint(6) NOT NULL DEFAULT 1 COMMENT 'Ordenação Dentro do MENU',
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Texto Explicativo sobre o menu',
  `icone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Icone Padrão FontAwesome (fa)',
  `perfis` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0, ' COMMENT 'IDs dos tipos de perfil que possuem acesso, 0 todos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Permissões de Acesso (menus) do Sistema';

INSERT INTO `permissoes_acesso` (`id`, `id_pai`, `menu`, `endpoint`, `ordem`, `descricao`, `icone`, `perfis`) VALUES(1, 0, 'Home', 'main', 1, 'Página Inicial', 'fas fa-home', '0,');
INSERT INTO `permissoes_acesso` (`id`, `id_pai`, `menu`, `endpoint`, `ordem`, `descricao`, `icone`, `perfis`) VALUES(2, 0, 'Login', 'login/login', 3, 'Acesse com seus dados', 'fas fa-sign-in-alt', '0,');
INSERT INTO `permissoes_acesso` (`id`, `id_pai`, `menu`, `endpoint`, `ordem`, `descricao`, `icone`, `perfis`) VALUES(3, 0, 'Logout', 'login/logout', 3, 'Sair do sistema (logout)', 'fas fa-sign-out-alt', '1,');
INSERT INTO `permissoes_acesso` (`id`, `id_pai`, `menu`, `endpoint`, `ordem`, `descricao`, `icone`, `perfis`) VALUES(4, 0, 'Minha Conta', 'minhaconta', 4, 'Minha Conta', 'fas fa-house-user', '1,');
INSERT INTO `permissoes_acesso` (`id`, `id_pai`, `menu`, `endpoint`, `ordem`, `descricao`, `icone`, `perfis`) VALUES(5, 0, 'Sobre', 'main/sobre', 2, 'Sobre Nossa Empresa', 'far fa-comments', '0,');
INSERT INTO `permissoes_acesso` (`id`, `id_pai`, `menu`, `endpoint`, `ordem`, `descricao`, `icone`, `perfis`) VALUES(6, 5, 'Empresa', 'main/empresa', 1, 'Sobre a Empresa', 'fas fa-building', '0,');

ALTER TABLE `permissoes_acesso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu` (`menu`),
  ADD UNIQUE KEY `endpoint` (`endpoint`),
  ADD KEY `paiXfilho` (`id_pai`);

ALTER TABLE `permissoes_acesso`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador do Item do Menu', AUTO_INCREMENT=8;

DROP TABLE IF EXISTS `usuarios_login`;
CREATE TABLE `usuarios_login` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'Id do Usuário',
  `email` varchar(255) NOT NULL COMMENT 'email do login',
  `password` varchar(255) NOT NULL COMMENT 'senha criptografada hash',
  `pincode` char(8) NOT NULL COMMENT 'pincode gerado de validação do email',
  `ativado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Se foi ou não validado o pincode',
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Timestamp da data/hora do cadastro',
  `data_modificacao` datetime NOT NULL COMMENT 'Data da Ultima Alteração de senha/email',
  `data_login` datetime NOT NULL COMMENT 'Data do ultimo login no sistema',
  `id_perfil` tinyint(4) NOT NULL COMMENT 'Id do Perfil de Cadastro',
  `ip_acesso` varchar(56) NOT NULL COMMENT 'IP V4 ou V6 ou MAPPED do ultimo acesso',
  `ip_country` char(3) NOT NULL COMMENT 'Código de PAIS ISO',
  `details_login` text NOT NULL COMMENT 'JSon Detailed Login Details',
  `nome` varchar(250) NOT NULL COMMENT 'Nome do Usuário Textual',
  `bloqueio_geral` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Bloqueio de Acesso',
  `bloqueio_mensagem` varchar(255) DEFAULT NULL COMMENT 'Mensagem apresentada se BLOQUEIO ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='login de usuário do sistema';

ALTER TABLE `usuarios_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_login` (`email`);

ALTER TABLE `usuarios_login`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Id do Usuário';

COMMIT;