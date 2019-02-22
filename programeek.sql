-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2019 at 04:44 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `programeek`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `keywords` varchar(500) NOT NULL,
  `construction` tinyint(4) NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `logo`, `slogan`, `page_title`, `copyright`, `description`, `keywords`, `construction`, `date_modified`) VALUES
(1, 'code1.png', 'Talk less Code more', 'Progeekmer Tech | Talk Less Code More', 'Progeekmer 1.0', 'Free Web tutorials & Code Snippets on Web Programming Languages.', 'code snippets,learn programming online,HTML,CSS,Bootstrap,JavaScript,Php,Mysql,Materialize', 0, '2017-07-01 17:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `date_created`, `date_modified`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2017-04-19 08:37:20', '2017-07-01 16:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` int(2) NOT NULL,
  `sub` int(2) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `content` varchar(60000) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `views` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `category`, `sub`, `image`, `content`, `featured`, `description`, `keywords`, `slug`, `status`, `views`, `date_created`, `date_modified`) VALUES
(1, 'PHP Login Page Example.', 5, 0, 'login_form.png', '<p><span style="font-size:20px">Are</span> you looking for PHP login script, in this post I want to discuss how to create a simple PHP login with welcome page using MySQL database. This will explain you creating user tables, posting form values and storing and destroying the session values. If you are a PHP beginner take a quick look at this live demo&nbsp;with Username : <em>demo&nbsp;</em>&nbsp;Password :&nbsp;<em>test</em>. This post has been updated with&nbsp;<em>mysqli</em>.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Database</strong><br />\r\nMySQL admin table columns id, username, passcode.</p>\r\n\r\n<pre>\r\n<code>CREATE TABLE admin\r\n(\r\nid INT PRIMARY KEY AUTO_INCREMENT,\r\nusername VARCHAR(30) UNIQUE,\r\npasscode VARCHAR(30)\r\n);</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Config.php</strong><br />\r\nDatabase configuration file.</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\ndefine(''DB_SERVER'', ''localhost'');\r\ndefine(''DB_USERNAME'', ''username'');\r\ndefine(''DB_PASSWORD'', ''password'');\r\ndefine(''DB_DATABASE'', ''database'');\r\n$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Login.php</strong><br />\r\nContains PHP and HTML code.</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\ninclude("config.php");\r\nsession_start();\r\nif($_SERVER["REQUEST_METHOD"] == "POST")\r\n{\r\n// username and password sent from Form\r\n$myusername=mysqli_real_escape_string($db,$_POST[''username'']); \r\n$mypassword=mysqli_real_escape_string($db,$_POST[''password'']); \r\n$passwordSecure=md5($mypassword);\r\n$sql="SELECT id FROM admin WHERE username=''$myusername'' and passcode=''$passwordSecure''";\r\n$result=mysqli_query($db,$sql);\r\n$row=mysqli_fetch_array($result,MYSQLI_ASSOC);\r\n$active=$row[''active''];\r\n$count=mysqli_num_rows($result);\r\n\r\n\r\n// If result matched $myusername and $mypassword, table row must be 1 row\r\nif($count==1)\r\n{\r\nsession_register("myusername");\r\n$_SESSION[''login_user'']=$myusername;\r\n\r\nheader("location: welcome.php");\r\n}\r\nelse \r\n{\r\n$error="Your Login Name or Password is invalid";\r\n}\r\n}\r\n?&gt;\r\n&lt;form action="" method="post"&gt;\r\n&lt;label&gt;UserName :&lt;/label&gt;\r\n&lt;input type="text" name="username"/&gt;&lt;br /&gt;\r\n&lt;label&gt;Password :&lt;/label&gt;\r\n&lt;input type="password" name="password"/&gt;&lt;br/&gt;\r\n&lt;input type="submit" value=" Submit "/&gt;&lt;br /&gt;\r\n&lt;/form&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>lock.php</strong><br />\r\nSession verification. If no session value page redirect to login.php</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\ninclude(''config.php'');\r\nsession_start();\r\n$user_check=$_SESSION[''login_user''];\r\n\r\n$ses_sql=mysqli_query($db,"select username from admin where username=''$user_check'' ");\r\n\r\n$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);\r\n\r\n$login_session=$row[''username''];\r\n\r\nif(!isset($login_session))\r\n{\r\nheader("Location: login.php");\r\n}\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>welcome.php</strong></p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\ninclude(''lock.php'');\r\n?&gt;\r\n&lt;body&gt;\r\n&lt;h1&gt;Welcome &lt;?php echo $login_session; ?&gt;&lt;/h1&gt;\r\n&lt;/body&gt;\r\n</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>logout.php</strong><br />\r\nSignOut Destroy the session value.</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\nsession_start();\r\nif(session_destroy())\r\n{\r\nheader("Location: login.php");\r\n}\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n', 0, 'learn login system', 'login,pph', 'php-login-page-example-', 1, 7022, '2017-02-27 07:56:06', '2017-05-10 16:34:39'),
(3, 'Upload and Resize an Image with PHP', 5, NULL, 'ajax-upload-image-php-jquery.jpg', '<p><span style="font-size:18px">A</span>re you looking for image upload and Resize PHP script. I had implemented a simple PHP script to re-sizing image into different dimensions. It&#39;s very useful to your web projects to save hosting space and bandwidth to reduce the original image to compressed size.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>PHP Code</strong><br />\r\nThis script resize an Image into two 60px and 25px. Take a look at&nbsp;<strong><em>$newwidth</em>&nbsp;</strong>you have to modify size values.</p>\r\n\r\n<pre>\r\n<code>&lt;?php \r\n\r\n define ("MAX_SIZE","400");\r\n\r\n $errors=0;\r\n \r\n if($_SERVER["REQUEST_METHOD"] == "POST")\r\n {\r\n        $image =$_FILES["file"]["name"];\r\n $uploadedfile = $_FILES[''file''][''tmp_name''];\r\n\r\n  if ($image) \r\n  {\r\n  $filename = stripslashes($_FILES[''file''][''name'']);\r\n        $extension = getExtension($filename);\r\n  $extension = strtolower($extension);\r\n if (($extension != "jpg") &amp;&amp; ($extension != "jpeg") \r\n&amp;&amp; ($extension != "png") &amp;&amp; ($extension != "gif")) \r\n  {\r\necho '' Unknown Image extension '';\r\n$errors=1;\r\n  }\r\n else\r\n{\r\n   $size=filesize($_FILES[''file''][''tmp_name'']);\r\n \r\nif ($size &gt; MAX_SIZE*1024)\r\n{\r\n echo "You have exceeded the size limit";\r\n $errors=1;\r\n}\r\n \r\nif($extension=="jpg" || $extension=="jpeg" )\r\n{\r\n$uploadedfile = $_FILES[''file''][''tmp_name''];\r\n$src = imagecreatefromjpeg($uploadedfile);\r\n}\r\nelse if($extension=="png")\r\n{\r\n$uploadedfile = $_FILES[''file''][''tmp_name''];\r\n$src = imagecreatefrompng($uploadedfile);\r\n}\r\nelse \r\n{\r\n$src = imagecreatefromgif($uploadedfile);\r\n}\r\n \r\nlist($width,$height)=getimagesize($uploadedfile);\r\n\r\n$newwidth=60;\r\n$newheight=($height/$width)*$newwidth;\r\n$tmp=imagecreatetruecolor($newwidth,$newheight);\r\n\r\n$newwidth1=25;\r\n$newheight1=($height/$width)*$newwidth1;\r\n$tmp1=imagecreatetruecolor($newwidth1,$newheight1);\r\n\r\nimagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,\r\n $width,$height);\r\n\r\nimagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1, \r\n$width,$height);\r\n\r\n$filename = "images/". $_FILES[''file''][''name''];\r\n$filename1 = "images/small". $_FILES[''file''][''name''];\r\n\r\nimagejpeg($tmp,$filename,100);\r\nimagejpeg($tmp1,$filename1,100);\r\n\r\nimagedestroy($src);\r\nimagedestroy($tmp);\r\nimagedestroy($tmp1);\r\n}\r\n}\r\n}\r\n//If no errors registred, print the success message\r\n\r\n if(isset($_POST[''Submit'']) &amp;&amp; !$errors) \r\n {\r\n   // mysql_query("update SQL statement ");\r\n  echo "Image Uploaded Successfully!";\r\n\r\n }\r\n ?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Extention PHP funtion</strong><br />\r\nFinds file extensions.</p>\r\n\r\n<pre>\r\n<code>function getExtension($str) {\r\n\r\n         $i = strrpos($str,".");\r\n         if (!$i) { return ""; } \r\n         $l = strlen($str) - $i;\r\n         $ext = substr($str,$i+1,$l);\r\n         return $ext;\r\n }</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n', 1, '', '', 'Upload-and-Resize-an-Image-with-PHP', 1, 1120, '2017-02-27 08:11:56', NULL),
(4, 'Dynamic Dependent Select Box using Jquery and Ajax', 2, 14, '02.jpg', '<p>How to do dynamic dependent select box using Jquery, Ajax, PHP and Mysql. Dependent select box when a selection is made in a &quot;Parent&quot; box it allow to refresh a &quot;child&quot; box list data. In this post I had given a database relationship example betweent &quot;catergory&quot; and &quot;subcategory&quot;. It&#39;s very simple jquery code hope you like this.</p>\r\n\r\n<p><strong>Database</strong><br />\r\nSample database tables.&nbsp;<em>Data</em>&nbsp;table contains list boxes complete data,&nbsp;<em>data_parent</em>table foreign key relationship with&nbsp;<em>Data</em>&nbsp;table contains parent and child relation.</p>\r\n\r\n<pre>\r\n<code>CREATE TABLE ''data''\r\n(\r\n''id'' int primary key auto_increment,\r\n''data'' varchar(50),\r\n''weight'' int(2),\r\n);\r\n\r\nCREATE TABLE `data_parent` \r\n(\r\n`pid` int(11) primary key auto_increment,\r\n`did` int(11) unique,\r\n`parent` int(11),\r\nForeign key(did) references data(id)\r\n)</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>sections_demo.php</strong><br />\r\nContains javascipt and PHP code.&nbsp;<em>$(&quot;.country&quot;).change(function(){}</em>-&nbsp;<em>country</em>&nbsp;is the class name of select box. Using&nbsp;<em>$(this).val()</em>&nbsp;calling select box value. PHP code displaying results from&nbsp;<em>data</em>&nbsp;table where&nbsp;<em>weight=&#39;1&#39;</em></p>\r\n\r\n<pre>\r\n<code>&lt;script type="text/javascript" src="http://ajax.googleapis.com/\r\najax/libs/jquery/1.4.2/jquery.min.js"&gt;&lt;/script&gt;\r\n&lt;script type="text/javascript"&gt;\r\n$(document).ready(function()\r\n{\r\n$(".country").change(function()\r\n{\r\nvar id=$(this).val();\r\nvar dataString = ''id=''+ id;\r\n\r\n$.ajax\r\n({\r\ntype: "POST",\r\nurl: "ajax_city.php",\r\ndata: dataString,\r\ncache: false,\r\nsuccess: function(html)\r\n{\r\n$(".city").html(html);\r\n} \r\n});\r\n\r\n});\r\n\r\n});\r\n&lt;/script&gt;\r\n//HTML Code\r\nCountry :\r\n&lt;select name="country" class="country"&gt;\r\n&lt;option selected="selected"&gt;--Select Country--&lt;/option&gt;\r\n&lt;?php\r\ninclude(''db.php'');\r\n$sql=mysql_query("select id,data from data where weight=''1''");\r\nwhile($row=mysql_fetch_array($sql))\r\n{\r\n$id=$row[''id''];\r\n$data=$row[''data''];\r\necho ''&lt;option value="''.$id.''"&gt;''.$data.''&lt;/option&gt;'';\r\n} ?&gt;\r\n&lt;/select&gt; &lt;br/&gt;&lt;br/&gt;\r\n\r\nCity :\r\n&lt;select name="city" class="city"&gt;\r\n&lt;option selected="selected"&gt;--Select City--&lt;/option&gt;\r\n&lt;/select&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n', 0, 'In this tutorial we are going to learn dynamic dependent select box using jquery, ajax and php. This type of feature mostly use if you have use Country State City or you have working with Category and you want to load Sub Category of particular category. At that time this feature is very useful. But Here we have take an example of dynamic dependent drop down list box of Country, State and City. Here State data has been dependent on selection of Country. ', 'dynamic data,ajax,jquery', 'dynamic-dependent-select-box-using-jquery-and-ajax', 1, 103, '2017-04-06 08:17:18', '2017-05-10 16:43:56'),
(10, 'PHP - GET & POST Methods', 5, 0, 'software.png', '<p>There are two ways the browser client can send information to the web server.</p>\r\n\r\n<ul>\r\n	<li>The GET Method</li>\r\n	<li>The POST Method</li>\r\n</ul>\r\n\r\n<p>Before the browser sends the information, it encodes it using a scheme called URL encoding. In this scheme, name/value pairs are joined with equal signs and different pairs are separated by the ampersand.</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n   if( $_GET["name"] || $_GET["age"] ) {\r\n      echo "Welcome ". $_GET[''name'']. "&lt;br /&gt;";\r\n      echo "You are ". $_GET[''age'']. " years old.";\r\n      \r\n      exit();\r\n   }\r\n?&gt;\r\n&lt;html&gt;\r\n   &lt;body&gt;\r\n   \r\n      &lt;form action = "&lt;?php $_PHP_SELF ?&gt;" method = "GET"&gt;\r\n         Name: &lt;input type = "text" name = "name" /&gt;\r\n         Age: &lt;input type = "text" name = "age" /&gt;\r\n         &lt;input type = "submit" /&gt;\r\n      &lt;/form&gt;\r\n      \r\n   &lt;/body&gt;\r\n&lt;/html&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>The GET Method</h2>\r\n\r\n<p>The GET method sends the encoded user information appended to the page request. The page and the encoded information are separated by the&nbsp;<strong>?</strong>character.</p>\r\n\r\n<pre>\r\n<code>&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;body&gt;\r\n\r\n&lt;?php\r\necho "My first PHP script!";\r\n?&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n', 0, 'learn how to do post and get request in PHP', 'get,php,request', 'php-get-post-methods', 1, 1, '2019-02-22 15:43:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `sub` int(3) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `icon`, `sub`, `date_created`) VALUES
(1, 'html', 'html5', 0, '2017-02-22 15:37:10'),
(2, 'css', 'css3', 0, '2017-02-22 15:38:27'),
(3, 'bootstrap', 'bootstrap', 0, '2017-02-22 15:38:47'),
(5, 'php', 'php', 0, '2017-02-22 15:39:14'),
(11, 'tutorial', NULL, 1, '2017-04-04 10:24:26'),
(12, 'code snippet', NULL, 1, '2017-04-04 10:25:07'),
(13, 'tutorial', NULL, 2, '2017-04-04 10:27:25'),
(14, 'code snippet', NULL, 2, '2017-04-04 10:27:32'),
(15, 'mysql', 'mysql', 0, '2017-04-04 11:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `doubt`
--

CREATE TABLE `doubt` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `doubt` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply` varchar(3000) DEFAULT NULL,
  `reply_date` datetime DEFAULT NULL,
  `ip_address` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` varchar(700) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(40) NOT NULL,
  `reply` varchar(1000) DEFAULT NULL,
  `reply_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `blog` ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doubt`
--
ALTER TABLE `doubt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `doubt`
--
ALTER TABLE `doubt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
