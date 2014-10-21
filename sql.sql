
CREATE TABLE `_modulos` (
  `id_mod` int(11) NOT NULL auto_increment,
  `nom_mod` varchar(30) default NULL,
  `url_mod` varchar(20) default NULL,
  `img_mod` varchar(30) default NULL,
  PRIMARY KEY  (`id_mod`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- Volcar la base de datos para la tabla `_modulos`
-- 

INSERT INTO `_modulos` VALUES (1, 'Usuarios', 'usuarios', 'usuarios.png');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `_per_mod_usu`
-- 

CREATE TABLE `_per_mod_usu` (
  `id_per` int(11) NOT NULL auto_increment,
  `id_mod` int(11) default NULL,
  `id_usu` int(11) default NULL,
  `visible` char(1) default NULL,
  `orden` int(11) default NULL,
  PRIMARY KEY  (`id_per`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

-- 
-- Volcar la base de datos para la tabla `_per_mod_usu`
-- 

INSERT INTO `_per_mod_usu` VALUES (1, 1, 1, '1', 5);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `_usuarios`
-- 

CREATE TABLE `_usuarios` (
  `id_usu` int(11) NOT NULL auto_increment,
  `nom_usu` varchar(20) default NULL,
  `log_usu` varchar(20) default NULL,
  `pas_usu` varchar(50) default NULL,
  `mail_usu` varchar(50) default NULL,
  `fec_usu` date default NULL,
  PRIMARY KEY  (`id_usu`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `_usuarios`
-- 

INSERT INTO `_usuarios` VALUES (1, 'Administrador', 'admin', '113651fe9ff483ef7905d0be9b0a2fe9', 'takashi@erdesarrollo.com', '2010-09-29');
