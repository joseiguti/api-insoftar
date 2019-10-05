 Summary on video: https://youtu.be/pSseQnbQoyg
 
First, we need to create a DataBase called 'insoftar'. The following SQL will necessary.

```Sql
-- Host: localhost:8889
-- Generation Time: Oct 04, 2019 at 11:16 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `insoftar`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de usuarios';

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `cedula`, `correo`, `telefono`) VALUES
(19, 'Jairo Mauricio', 'Rocha Velasquez', '11226453', 'jamaro@hotmail.com', '3158406870'),
(20, 'Jose Ignacio', 'Gutierrez Guzman', '11226452', 'jose.gutierrez@osezno-framework.org', '3012695565'),
(21, 'Jose', 'Gutierrez Paloma', '11293530', 'jose.gutierrez.paloma@gmail.com', '3205678903'),
(22, 'Florentino', 'Paez', '11226454', 'florentino.paez@gmail1.com', '3001234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_index` (`correo`),
  ADD UNIQUE KEY `usuarios_UN` (`cedula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
```
By default, the current database connection info is:
```PHP
    return [
    'db' => [
        'database' => 'insoftar',
        'driver' => 'PDO_Mysql',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'port' => '8889'
    ],
];
```
Please, consider to modify this file if you requiere *<www-directory>/api-insoftar/config/autoload/db.global.php*

So, after to clone the project enter into project directory and then run the php server.

php -S 0.0.0.0:8082 -t public
