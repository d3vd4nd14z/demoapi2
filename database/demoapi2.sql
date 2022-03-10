USE demoapi2;

CREATE TABLE autores (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(255) NOT NULL,
	nickname VARCHAR(20),
	email VARCHAR(100) NOT NULL,
	fecha_creacion TIMESTAMP DEFAULT NOW(),
	fecha_modificacion TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
	CONSTRAINT UQAutoresEmail UNIQUE (email)	
) ENGINE=INNODB;

CREATE TABLE articulos (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(500) NOT NULL,
	contenido TEXT NOT NULL,
	autor INT NOT NULL,
	fecha_creacion TIMESTAMP DEFAULT NOW(),
	fecha_modificacion TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
	FOREIGN KEY (autor) REFERENCES autores(id)
) ENGINE=INNODB;

CREATE TABLE categorias (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(100) NOT NULL,
	descripcion VARCHAR(255),
	fecha_creacion TIMESTAMP DEFAULT NOW(),
	fecha_modificacion TIMESTAMP DEFAULT NOW() ON UPDATE NOW()
) ENGINE=INNODB;

CREATE TABLE autor_categorias (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	autor INT NOT NULL,
	categoria INT NOT NULL,
	fecha_creacion TIMESTAMP DEFAULT NOW(),
	fecha_modificacion TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
	FOREIGN KEY (autor) REFERENCES autores(id),
	FOREIGN KEY (categoria) REFERENCES categorias(id)
) ENGINE=INNODB;

CREATE TABLE articulos_categorias (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	articulo INT NOT NULL,
	categoria INT NOT NULL,
	fecha_creacion TIMESTAMP DEFAULT NOW(),
	fecha_modificacion TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
	FOREIGN KEY (articulo) REFERENCES articulos(id),
	FOREIGN KEY (categoria) REFERENCES categorias(id)
) ENGINE=INNODB;


INSERT INTO autores(nombre, nickname, email) VALUES ('Daniel Mauricio Diaz Forero', '@d4nd14z', 'd3v.d4nd14z@gmail.com');
INSERT INTO autores(nombre, nickname, email) VALUES ('Ingrid Tatiana Gomez Gamboa', '@intagoga', 'intagoga@gmail.com');

INSERT INTO articulos(titulo, contenido, autor) VALUES (
'Lorem ipsum dolor sit amet',
'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien nec sagittis aliquam malesuada bibendum arcu vitae elementum. Quam lacus suspendisse faucibus interdum posuere. Sed cras ornare arcu dui. Pulvinar sapien et ligula ullamcorper malesuada proin libero nunc. Id diam vel quam elementum. Curabitur gravida arcu ac tortor. Dolor sit amet consectetur adipiscing elit duis. Volutpat lacus laoreet non curabitur gravida arcu ac tortor dignissim. In hac habitasse platea dictumst. Nullam non nisi est sit amet facilisis.</p>
<p>Nibh tellus molestie nunc non blandit massa enim nec. Justo nec ultrices dui sapien eget mi proin sed. Lorem sed risus ultricies tristique nulla aliquet enim. Fames ac turpis egestas maecenas pharetra convallis posuere morbi leo. Consequat semper viverra nam libero justo laoreet sit amet cursus. Felis eget nunc lobortis mattis aliquam faucibus. Ipsum a arcu cursus vitae congue mauris rhoncus. Nisl tincidunt eget nullam non nisi est. Consequat ac felis donec et odio pellentesque. Potenti nullam ac tortor vitae purus faucibus ornare. In nisl nisi scelerisque eu ultrices vitae auctor eu. Porttitor eget dolor morbi non. Neque laoreet suspendisse interdum consectetur libero id faucibus. Nunc id cursus metus aliquam eleifend. Semper quis lectus nulla at volutpat diam ut. Interdum consectetur libero id faucibus nisl tincidunt eget. Et molestie ac feugiat sed lectus vestibulum.</p>
<p>Nisi porta lorem mollis aliquam. Risus pretium quam vulputate dignissim suspendisse in est ante. Aliquet nec ullamcorper sit amet risus nullam eget felis. Pretium vulputate sapien nec sagittis aliquam malesuada bibendum. Tristique et egestas quis ipsum suspendisse ultrices gravida. Diam sit amet nisl suscipit adipiscing bibendum. Feugiat in fermentum posuere urna nec. Congue eu consequat ac felis donec et. Rutrum quisque non tellus orci. Eu scelerisque felis imperdiet proin fermentum leo vel. Viverra orci sagittis eu volutpat odio facilisis. Mauris augue neque gravida in fermentum et sollicitudin ac. Diam vulputate ut pharetra sit amet aliquam id diam maecenas. Nunc mattis enim ut tellus. Fermentum dui faucibus in ornare quam viverra orci sagittis eu. Quisque sagittis purus sit amet volutpat consequat mauris. A erat nam at lectus urna duis.</p>
<p>Cras pulvinar mattis nunc sed blandit libero volutpat. Accumsan in nisl nisi scelerisque eu ultrices vitae. Elit ut aliquam purus sit amet luctus venenatis. In arcu cursus euismod quis viverra nibh cras. Sed faucibus turpis in eu. Commodo quis imperdiet massa tincidunt nunc. Lorem ipsum dolor sit amet. Elementum sagittis vitae et leo duis ut diam. Cras semper auctor neque vitae tempus quam. In dictum non consectetur a erat nam at lectus.</p>
<p>In egestas erat imperdiet sed euismod. Vel fringilla est ullamcorper eget nulla. Tellus molestie nunc non blandit massa enim. Praesent semper feugiat nibh sed pulvinar. Mi tempus imperdiet nulla malesuada pellentesque elit. Ultrices vitae auctor eu augue ut. A scelerisque purus semper eget. In ornare quam viverra orci sagittis eu volutpat. Maecenas sed enim ut sem viverra aliquet. Iaculis nunc sed augue lacus viverra vitae congue eu consequat.</p>', 
1);

INSERT INTO categorias(nombre, descripcion) VALUES ('Tecnolog&iacute;a','Tecnologia');
INSERT INTO categorias(nombre, descripcion) VALUES ('Ciencia','Ciencia');
INSERT INTO categorias(nombre, descripcion) VALUES ('Series y Pel&iacute;culas','Series y peliculas');
INSERT INTO categorias(nombre, descripcion) VALUES ('Mobile','Mobile');
INSERT INTO categorias(nombre, descripcion) VALUES ('4Devs','Para Desarrolladores');

INSERT INTO articulos_categorias (articulo, categoria) VALUES (1, 1);
INSERT INTO articulos_categorias (articulo, categoria) VALUES (1, 2);
INSERT INTO articulos_categorias (articulo, categoria) VALUES (1, 3);
INSERT INTO articulos_categorias (articulo, categoria) VALUES (1, 4);
INSERT INTO articulos_categorias (articulo, categoria) VALUES (1, 5);


SELECT *
FROM users;

SELECT *
FROM articulos
INNER JOIN autores ON articulos.autor = autores.id;

select * from `articulos` inner join `autores` on `articulos`.`autor` = `autores`.`id`


SELECT *
FROM autores;

SELECT articulos.id, articulos.titulo, articulos.contenido,
       JSON_OBJECT('id', autores.id, 
                   'nombre', autores.nombre,
                   'nickname', autores.nickname,
                   'email', autores.email) autor
FROM articulos
INNER JOIN autores ON articulos.autor = autores.id
WHERE articulos.id = 1;



SET foreign_key_checks = 0;
TRUNCATE TABLE articulos;
SET foreign_key_checks = 1;

SELECT *
FROM articulos;


