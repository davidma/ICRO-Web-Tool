-- MySQL dump 10.11
--
-- Host: localhost    Database: icroweb
-- ------------------------------------------------------
-- Server version	5.0.77

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL auto_increment,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Unclassified'),(2,'Press Releases'),(3,'Surveys'),(4,'Cave Files'),(5,'Guides & Howtos'),(6,'Templates');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_docs`
--

DROP TABLE IF EXISTS `category_docs`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `category_docs` (
  `category_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `category_docs`
--

LOCK TABLES `category_docs` WRITE;
/*!40000 ALTER TABLE `category_docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cave_docs`
--

DROP TABLE IF EXISTS `cave_docs`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cave_docs` (
  `cave_id` int(11) NOT NULL default '0',
  `doc_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`cave_id`,`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cave_docs`
--

LOCK TABLES `cave_docs` WRITE;
/*!40000 ALTER TABLE `cave_docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `cave_docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caves`
--

DROP TABLE IF EXISTS `caves`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `caves` (
  `cave_id` int(11) NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `county` varchar(20) default NULL,
  `lat` double default NULL,
  `lng` double default NULL,
  `description` text,
  `enabled` tinyint(1) default '0',
  PRIMARY KEY  (`cave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2485 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `caves`
--

LOCK TABLES `caves` WRITE;
/*!40000 ALTER TABLE `caves` DISABLE KEYS */;
INSERT INTO `caves` VALUES (1753,'Aughrim Cave','Cavan',54.1373875,-7.587660833,'The description goes here',0),(1754,'County R. Natural Bridge','Cavan',54.35712222,-6.513355556,'The description goes here',0),(1755,'Gortaree','Cavan',54.266135,-7.872445556,'The description goes here',0),(1756,'Holy Hour Pot','Cavan',54.28195222,-7.878384167,'The description goes here',1),(1757,'Pollboy','Cavan',54.24423556,-7.893834444,'The description goes here',1),(1758,'Polliniska','Cavan',54.20952222,-7.748632778,'The description goes here',1),(1759,'Pollnagollum Slieve Rushen','Cavan',54.164985,-7.649696667,'The description goes here',1),(1760,'Pollnagossan','Cavan',54.26634472,-7.904827222,'The description goes here',1),(1761,'Pollprughlish','Cavan',54.20826361,-7.748180556,'The description goes here',1),(1762,'Shannon Cave','Cavan',54.24051306,-7.855960278,'The description goes here',1),(1763,'Super Star Pot','Cavan',54.27073278,-7.888700833,'The description goes here',0),(1764,'Tory Cave','Cavan',54.16276667,-7.65936,'The description goes here',0),(1765,'White Fathers Cave','Cavan',54.28665861,-7.919827778,'The description goes here',1),(1766,'A12 Cave','Clare',53.04144389,-9.3552175,'The description goes here',0),(1767,'A1c Cave','Clare',53.09085222,-9.275268889,'The description goes here',0),(1768,'A201 Cave','Clare',53.06826111,-9.335918333,'The description goes here',0),(1769,'A202 Cave','Clare',53.06735778,-9.336338056,'The description goes here',0),(1770,'A3b  Cave','Clare',53.0758275,-9.31004,'The description goes here',0),(1771,'A3c Cave','Clare',53.07670306,-9.303948611,'The description goes here',0),(1772,'A3f Cave','Clare',53.07499417,-9.312252778,'The description goes here',0),(1773,'A7 Cave','Clare',53.04169806,-9.348665,'The description goes here',0),(1774,'Addergoole Cave (1)','Clare',52.96843639,-8.905660278,'The description goes here',0),(1775,'Addergoole Cave (2)','Clare',52.96934611,-8.904190833,'The description goes here',0),(1776,'Addergoole Cave (3)','Clare',52.96753806,-8.905641667,'The description goes here',0),(1777,'Aghaglinny Cave','Clare',53.12356861,-9.240535278,'The description goes here',0),(1778,'Aillwee Cave','Clare',53.08922028,-9.144020833,'The description goes here',1),(1779,'Alice And Gwendoline Caves','Clare',52.82044111,-9.005673333,'The description goes here',0),(1780,'Animal Den Cave','Clare',53.06555972,-9.328375833,'The description goes here',0),(1781,'B10b Cave','Clare',53.05067417,-9.317479167,'The description goes here',0),(1782,'B12 Cave','Clare',53.0474075,-9.328414167,'The description goes here',0),(1783,'B13 Cave','Clare',53.04642583,-9.3277875,'The description goes here',0),(1784,'B14 Cave','Clare',53.04613472,-9.329716944,'The description goes here',0),(1785,'B14a Cave','Clare',53.04555917,-9.332979722,'The description goes here',0),(1786,'B19 Cave','Clare',53.04606806,-9.335679444,'The description goes here',0),(1787,'B19a Cave','Clare',53.04588667,-9.335823056,'The description goes here',0),(1788,'B1c Cave','Clare',53.07947444,-9.297018611,'The description goes here',0),(1789,'B1e Cave','Clare',53.080305,-9.286746389,'The description goes here',0),(1790,'B2 Cave','Clare',53.0765175,-9.287976667,'The description goes here',0),(1791,'B20 Cave','Clare',53.04667,-9.338083889,'The description goes here',0),(1792,'B8d Cave','Clare',53.10505167,-9.324515556,'The description goes here',0),(1793,'Badger Hole','Clare',52.96399306,-9.1020175,'The description goes here',0),(1794,'Badger Hole','Clare',53.00681083,-9.057521389,'The description goes here',0),(1795,'Ballyallia Cave','Clare',52.88330056,-8.967613056,'The description goes here',0),(1796,'Ballycahill Cave','Clare',53.09088472,-9.139139167,'The description goes here',0),(1797,'Ballyconry Cave','Clare',53.031355,-9.152923333,'The description goes here',0),(1798,'Ballyganner South Cave','Clare',52.99895833,-9.148485278,'The description goes here',0),(1799,'Ballymahony Cave','Clare',53.02726333,-9.211985278,'The description goes here',1),(1800,'Ballymihill Cave','Clare',53.05985167,-9.123553889,'The description goes here',0),(1801,'Barntick Cave','Clare',52.80279306,-8.999186944,'The description goes here',0),(1802,'Bat\'s Cave','Clare',52.8103925,-9.003810278,'The description goes here',0),(1803,'Black Head Caves','Clare',53.15342361,-9.264117222,'The description goes here',0),(1804,'Boulder Pot','Clare',52.96140028,-9.100612222,'The description goes here',0),(1805,'Boulder Pot','Clare',53.04142806,-9.206418889,'The description goes here',0),(1806,'Buccaneers\' Hole','Clare',53.04073667,-9.203715833,'The description goes here',1),(1807,'Bullock Pot','Clare',53.06632889,-9.249034444,'The description goes here',1),(1808,'Caher Valley Cave','Clare',53.12597417,-9.268091944,'The description goes here',0),(1809,'Calf Swallet','Clare',53.05658611,-9.218028056,'The description goes here',0),(1810,'Carran Mine Cave','Clare',53.03038639,-9.083884722,'The description goes here',0),(1811,'Cashlaungarr Cave','Clare',53.01498972,-9.077389722,'The description goes here',0),(1812,'Cave Of The Wild Horses','Clare',53.04466806,-9.160733611,'The description goes here',1),(1813,'Chamber Hole','Clare',52.9635275,-9.103791389,'The description goes here',0),(1814,'Clooncoose Cave','Clare',53.00925333,-9.075756944,'The description goes here',0),(1815,'Commons North Cave','Clare',52.99665028,-9.078273611,'The description goes here',0),(1816,'Commons North Terrace Cave','Clare',52.99654278,-9.080207222,'The description goes here',0),(1817,'Coolagh River Cave (polldonagh North)','Clare',53.05709361,-9.305742778,'The description goes here',1),(1818,'Coskeam Cave','Clare',53.06446694,-9.030590278,'The description goes here',0),(1819,'Cow Skull Cave','Clare',53.06963667,-9.317311667,'The description goes here',0),(1820,'Cregg Lodge Swallet','Clare',53.04323694,-9.347669444,'The description goes here',0),(1821,'Croagh South Cave','Clare',53.05768417,-9.198371111,'The description goes here',0),(1822,'Cullaun -02 Cave','Clare',53.07837139,-9.222970278,'The description goes here',0),(1823,'Cullaun 1 Cave','Clare',53.06624694,-9.222328611,'The description goes here',1),(1824,'Cullaun 2 Cave','Clare',53.06167917,-9.220856667,'The description goes here',1),(1825,'Cullaun 3','Clare',53.06020222,-9.215892778,'The description goes here',1),(1826,'Cullaun 4','Clare',53.06004389,-9.2138,'The description goes here',1),(1827,'Cullaun 5','Clare',53.05499944,-9.215000556,'The description goes here',1),(1828,'Cullaun 5a','Clare',53.05458222,-9.211856944,'The description goes here',0),(1829,'Cullaun Zero Cave','Clare',53.06703694,-9.224141111,'The description goes here',1),(1830,'Cullaun-01 Cave','Clare',53.07343667,-9.222233889,'The description goes here',0),(1831,'Danes Hole','Clare',0,0,'The description goes here',0),(1832,'Deelin Beg Resurgence','Clare',53.06370278,-9.086212222,'The description goes here',0),(1833,'Dig Beyond Hell','Clare',53.01881639,-9.4078575,'The description goes here',0),(1834,'Doolin Road Sink','Clare',53.02387111,-9.351685833,'The description goes here',0),(1835,'Doonyvarden Cave','Clare',53.06043889,-9.201430833,'The description goes here',1),(1836,'Drummoher Pothole East','Clare',52.96231306,-9.118345,'The description goes here',0),(1837,'Drummoher Pothole East-one','Clare',52.96249417,-9.118200833,'The description goes here',0),(1838,'Drummoher Pothole West','Clare',52.96220639,-9.120128056,'The description goes here',0),(1839,'E2 Cave','Clare',53.08953583,-9.263886111,'The description goes here',1),(1840,'Elderbush Cave','Clare',52.80400972,-9.004108056,'The description goes here',0),(1841,'Elmvale Risings','Clare',52.97310556,-9.107756944,'The description goes here',0),(1842,'F3c Cave','Clare',53.03325639,-9.266413889,'The description goes here',0),(1843,'Fahee Cave','Clare',53.04928972,-9.039920833,'The description goes here',0),(1844,'Fairweather Cave','Clare',53.06521222,-9.327320833,'The description goes here',0),(1845,'Fanore Cave','Clare',53.12338861,-9.274588611,'The description goes here',0),(1846,'Faunarooska 3 Cave','Clare',53.08558583,-9.280336944,'The description goes here',0),(1847,'Faunarooska Cave','Clare',53.08476944,-9.281059167,'The description goes here',1),(1848,'Fergus River Cave','Clare',52.97743944,-9.1151625,'The description goes here',1),(1849,'Forestry Sink','Clare',53.07224139,-9.207279722,'The description goes here',0),(1850,'Formoyle East Cave','Clare',53.12646028,-9.238975278,'The description goes here',1),(1851,'Fox Skull Cave','Clare',52.81989444,-9.006550833,'The description goes here',0),(1852,'Foxholes Dig','Clare',53.04647583,-9.323315556,'The description goes here',0),(1853,'Glen Of Clab Cave','Clare',53.06603861,-9.046142222,'The description goes here',0),(1854,'Glencurran Cave','Clare',53.01322861,-9.083305556,'The description goes here',1),(1855,'Gleninagh South Cave','Clare',53.12860944,-9.204675833,'The description goes here',0),(1856,'Glensleade Cave','Clare',53.05665528,-9.147781667,'The description goes here',0),(1857,'Goat Cave','Clare',53.06343472,-9.341586944,'The description goes here',0),(1858,'Goat Hole','Clare',53.09021861,-9.275698056,'The description goes here',0),(1859,'Gortlecka Cave','Clare',52.99773611,-9.016191667,'The description goes here',1),(1860,'Gragan West Cave','Clare',53.07557111,-9.206776111,'The description goes here',1),(1861,'Green Stream Cave','Clare',53.07933667,-9.2076275,'The description goes here',1),(1862,'Hammer Pot','Clare',53.04123333,-9.207904167,'The description goes here',0),(1863,'Hawthorn Swallet','Clare',53.08519917,-9.282862778,'The description goes here',1),(1864,'Hawthorn Swallet Resurgence','Clare',53.078955,-9.295212222,'The description goes here',0),(1865,'Hell Complex','Clare',53.01871778,-9.408599444,'The description goes here',1),(1866,'Hot Tip Cave','Clare',53.02189694,-9.405722222,'The description goes here',0),(1867,'Hy-brazil','Clare',53.01199639,-9.414638333,'The description goes here',0),(1868,'Ivy Cave','Clare',53.06434528,-9.32446,'The description goes here',0),(1869,'Jacko\'s Hole','Clare',0,0,'The description goes here',0),(1870,'Jam Pot Cave (2)','Clare',53.06301583,-9.221938889,'The description goes here',0),(1871,'Jam Pot Swallet','Clare',53.06355944,-9.221506667,'The description goes here',0),(1872,'Kilcorney Cave (2)','Clare',53.0390025,-9.161177778,'The description goes here',0),(1873,'Kilcorney Cave (3)','Clare',53.03899528,-9.161923056,'The description goes here',0),(1874,'Kilcorney Cave (4)','Clare',53.04340472,-9.161296111,'The description goes here',0),(1875,'Kilcorney Cave (5)','Clare',53.04340472,-9.161296111,'The description goes here',0),(1876,'Kilcorney Cave (6)','Clare',53.04312917,-9.161885278,'The description goes here',0),(1877,'Killeany Rising','Clare',53.05115361,-9.247999167,'The description goes here',0),(1878,'Kilmoon Stream Cave','Clare',53.03793778,-9.290702778,'The description goes here',0),(1879,'Kilweelran Cave','Clare',53.09140694,-9.121987222,'The description goes here',0),(1880,'Kilweelran Lower Cave','Clare',53.08676889,-9.127836667,'The description goes here',0),(1881,'Lackglass Cave (1)','Clare',53.04021639,-9.383805,'The description goes here',0),(1882,'Lackglass Cave (2)','Clare',53.04021639,-9.383805,'The description goes here',0),(1883,'Lackglass Cave (3)','Clare',53.04021639,-9.383805,'The description goes here',0),(1884,'Lake Caves','Clare',52.95226972,-9.096809444,'The description goes here',0),(1885,'Lighthouse Cave','Clare',53.15376222,-9.266070556,'The description goes here',0),(1886,'Lismorahaun House Cave','Clare',53.07188306,-9.250687222,'The description goes here',1),(1887,'Loop Cave','Clare',53.06353806,-9.340396667,'The description goes here',0),(1888,'Lough Aleenaun Cave','Clare',53.00592667,-9.124536944,'The description goes here',0),(1889,'Lysaght\'s Cave','Clare',53.06405,-9.342799444,'The description goes here',0),(1890,'Maze Holes','Clare',53.08897444,-9.122670278,'The description goes here',1),(1891,'Mermaid\'s Hole','Clare',53.02017806,-9.406709722,'The description goes here',1),(1892,'Mill Cave','Clare',53.08621861,-9.129016389,'The description goes here',0),(1893,'Mill Sink','Clare',53.08548861,-9.130191111,'The description goes here',0),(1894,'Milner\'s Brown Hole','Clare',53.02383278,-9.401612222,'The description goes here',0),(1895,'Moheraroon Cave','Clare',53.00967,-9.108692778,'The description goes here',0),(1896,'Monocline Hole (1)','Clare',52.99837611,-9.076231389,'The description goes here',0),(1897,'Monocline Hole (2)','Clare',52.99837611,-9.076231389,'The description goes here',0),(1898,'Moonmilk Cave','Clare',53.06521389,-9.327171667,'The description goes here',1),(1899,'Mosquito Hole','Clare',53.03977028,-9.165373056,'The description goes here',0),(1900,'Moyree School Cave','Clare',52.95383111,-8.935113333,'The description goes here',0),(1901,'Mutt\'s Ave','Clare',53.05843583,-9.22166,'The description goes here',0),(1902,'Noaff East Resurgence','Clare',52.83407222,-9.0298775,'The description goes here',0),(1903,'Noaff East Sink','Clare',52.83072917,-9.042261389,'The description goes here',0),(1904,'Nooan Cave','Clare',52.96257222,-9.100195556,'The description goes here',0),(1905,'Nooan Pothole','Clare',52.96251417,-9.106444444,'The description goes here',0),(1906,'Pol An Tober','Clare',53.09243667,-9.269941944,'The description goes here',0),(1907,'Pol Dorian','Clare',53.04210806,-9.344205,'The description goes here',0),(1908,'Pol Na Grianloch','Clare',53.06111444,-9.363889722,'The description goes here',0),(1909,'Pol-an-ionain','Clare',53.04182333,-9.345537778,'The description goes here',1),(1910,'Polberneens','Clare',53.07068889,-9.155465278,'The description goes here',0),(1911,'Poll An Chaisc','Clare',53.059925,-9.317910278,'The description goes here',1),(1912,'Poll An Sceagh','Clare',53.04736083,-9.324535556,'The description goes here',0),(1913,'Poll Ballaghaline','Clare',53.02018861,-9.405815833,'The description goes here',0),(1914,'Poll Ballycahill','Clare',53.08896667,-9.132968889,'The description goes here',0),(1915,'Poll Ballyconnoe South','Clare',53.03099556,-9.2422,'The description goes here',0),(1916,'Poll Ballykeel South','Clare',53.00059333,-9.218983889,'The description goes here',0),(1917,'Poll Ballynahown','Clare',53.06827111,-9.318911111,'The description goes here',1),(1918,'Poll Boreen','Clare',53.0409425,-9.209983333,'The description goes here',0),(1919,'Poll Cahercloggaun East','Clare',53.05799694,-9.255206944,'The description goes here',0),(1920,'Poll Cahercloggaun West','Clare',53.05716167,-9.257718333,'The description goes here',0),(1921,'Poll Cahercloggaun West-one','Clare',53.05615306,-9.259627778,'The description goes here',1),(1922,'Poll Cahermaan','Clare',53.04009472,-9.213836111,'The description goes here',1),(1923,'Poll Cloghaun','Clare',53.05048139,-9.318666111,'The description goes here',0),(1924,'Poll Dearg','Clare',53.04054333,-9.205052222,'The description goes here',1),(1925,'Poll Eile','Clare',53.134395,-9.236364722,'The description goes here',0),(1926,'Poll Gorm','Clare',53.10926972,-9.085269444,'The description goes here',1),(1927,'Poll Kilmoon East','Clare',53.04976972,-9.268389167,'The description goes here',1),(1928,'Poll Leagh','Clare',53.13659028,-9.0239475,'The description goes here',0),(1929,'Poll Na B\'feidir','Clare',53.05969583,-9.139957222,'The description goes here',0),(1930,'Poll Na Fhia','Clare',53.07637472,-9.301103333,'The description goes here',0),(1931,'Poll Na Gceim','Clare',53.07387083,-9.299983611,'The description goes here',1),(1932,'Poll Na Luchnacrua','Clare',53.14498694,-9.050301111,'The description goes here',0),(1933,'Poll Rannagh East','Clare',53.05756889,-9.058913056,'The description goes here',0),(1934,'Poll Salach','Clare',53.13404667,-9.2778925,'The description goes here',0),(1935,'Poll Uaigneach','Clare',53.02979917,-9.059276111,'The description goes here',0),(1936,'Pollaber','Clare',53.07045167,-9.316739722,'The description goes here',1),(1937,'Pollalpha','Clare',53.06954528,-9.317458056,'The description goes here',0),(1938,'Pollaphuca','Clare',52.85779778,-9.06028,'The description goes here',1),(1939,'Pollapooka (1)','Clare',53.09193972,-9.274405556,'The description goes here',0),(1940,'Pollapooka (2)','Clare',53.09083472,-9.276910556,'The description goes here',0),(1941,'Pollapooka (3)','Clare',53.21186528,-9.277811667,'The description goes here',0),(1942,'Pollballiny','Clare',53.08337861,-9.285047222,'The description goes here',1),(1943,'Pollballyelly','Clare',53.09146194,-9.277078333,'The description goes here',1),(1944,'Pollballygoonaun','Clare',52.9995475,-9.233253889,'The description goes here',1),(1945,'Pollbegob North','Clare',53.08221556,-9.284565,'The description goes here',0),(1946,'Pollbegob North','Clare',53.05508472,-9.283906944,'The description goes here',0),(1947,'Pollcahermacnaughten','Clare',53.05233278,-9.203293333,'The description goes here',1),(1948,'Pollcan','Clare',53.01289806,-9.383824722,'The description goes here',0),(1949,'Pollcraghreagh','Clare',53.05908583,-9.254194444,'The description goes here',1),(1950,'Pollcraghreagh Road Swallet','Clare',53.06098972,-9.252609167,'The description goes here',0),(1951,'Pollderreen','Clare',53.07976111,-9.287178056,'The description goes here',0),(1952,'Polldonough West','Clare',53.05862056,-9.3139925,'The description goes here',0),(1953,'Polldubh','Clare',53.07388806,-9.290136111,'The description goes here',1),(1954,'Pollgowlaun','Clare',53.03326667,-9.273867778,'The description goes here',0),(1955,'Pollnagollum-ballyshanny','Clare',53.00505917,-9.212853056,'The description goes here',1),(1956,'Pollnagollum-poulelva ','Clare',53.0780625,-9.252656944,'The description goes here',1),(1957,'Pollnagrinn','Clare',53.06340361,-9.320254167,'The description goes here',0),(1958,'Pollteergonean (1)','Clare',53.02724389,-9.394270278,'The description goes here',0),(1959,'Pollteergonean (2)','Clare',53.02724389,-9.394270278,'The description goes here',0),(1960,'Poul An Arachnid','Clare',53.04212333,-9.382076667,'The description goes here',0),(1961,'Poulacapple Pot','Clare',53.08170306,-9.213513889,'The description goes here',0),(1962,'Poulagrompaun','Clare',52.88291583,-9.034599444,'The description goes here',0),(1963,'Poulawillin','Clare',53.03989528,-9.198026944,'The description goes here',1),(1964,'Poulawillin Cave','Clare',53.94254472,-9.144698056,'The description goes here',0),(1965,'Poulbaun','Clare',53.08795722,-8.983688611,'The description goes here',0),(1966,'Poulcarra Cave','Clare',53.04618944,-9.013901389,'The description goes here',0),(1967,'Poulcarry Caves','Clare',53.02110778,-9.125080556,'The description goes here',0),(1968,'Poulcraveen','Clare',53.02614833,-9.395725278,'The description goes here',1),(1969,'Poulgorm','Clare',53.05636583,-9.131069722,'The description goes here',0),(1970,'Poullnagarsuin','Clare',53.07163444,-9.315433056,'The description goes here',0),(1971,'Poulnaboe','Clare',52.97264722,-9.127840833,'The description goes here',1),(1972,'Poulnabrone Cave','Clare',53.05575139,-9.138958333,'The description goes here',0),(1973,'Poulnacally','Clare',52.93726111,-8.950968056,'The description goes here',1),(1974,'Poulnadatig','Clare',52.83296333,-9.033412222,'The description goes here',1),(1975,'Poulnagalloor-roxton','Clare',52.9231675,-9.105143889,'The description goes here',0),(1976,'Poulnagolloor','Clare',52.83294778,-9.0351925,'The description goes here',1),(1977,'Poulnagordon Cave (1)','Clare',52.81449694,-8.8585575,'The description goes here',0),(1978,'Poulnagordon Cave (2)','Clare',52.78763139,-8.858176667,'The description goes here',1),(1979,'Poulnagree','Clare',53.07626028,-9.311545278,'The description goes here',1),(1980,'Poulnagun','Clare',53.04647583,-9.323315556,'The description goes here',1),(1981,'Poulomega','Clare',53.06673889,-9.319311944,'The description goes here',1),(1982,'Poulsallagh Cave','Clare',53.05931611,-9.363981944,'The description goes here',0),(1983,'Poultalloon','Clare',53.0441575,-9.280600278,'The description goes here',1),(1984,'Rathborney River Sink','Clare',53.09006667,-9.167925278,'The description goes here',0),(1985,'Ratty River Cave (1)','Clare',52.76450583,-8.771058889,'The description goes here',0),(1986,'Ratty River Cave (2)','Clare',52.76432611,-8.771055556,'The description goes here',0),(1987,'Reef Caves','Clare',53.01825444,-9.409776389,'The description goes here',1),(1988,'Reyfad Hole','Clare',53.06501,-9.202602222,'The description goes here',0),(1989,'Rine Cave','Clare',52.81417778,-8.865373333,'The description goes here',0),(1990,'Robbers\' Den Cave','Clare',53.06555472,-9.328823333,'The description goes here',1),(1991,'Rob\'s Cave','Clare',52.97012361,-8.896467222,'The description goes here',0),(1992,'Rubbish Cave','Clare',53.059215,-9.3251975,'The description goes here',0),(1993,'S1b Cave','Clare',53.06011417,-9.364902222,'The description goes here',0),(1994,'S6 Cave','Clare',53.09059194,-9.3157125,'The description goes here',0),(1995,'S9 Cave','Clare',53.04461278,-9.376639444,'The description goes here',0),(1996,'Scalp  Na Struther','Clare',53.056345,-9.364484722,'The description goes here',0),(1997,'School House Sink','Clare',53.05009722,-9.320891389,'The description goes here',0),(1998,'Seven Streams Of Teeskagh Cave','Clare',53.01132222,-9.065528333,'The description goes here',0),(1999,'Sheshodonnell West Cave (1)','Clare',53.00965889,-9.100200556,'The description goes here',0),(2000,'Sheshodonnell West Cave (2)','Clare',53.00633472,-9.100115833,'The description goes here',0),(2001,'Sheshodonnell West Cave (3)','Clare',53.00633472,-9.100115833,'The description goes here',0),(2002,'Skeleton Cave','Clare',53.10563028,-9.147591944,'The description goes here',0),(2003,'Spur Holes','Clare',53.08451167,-9.128971667,'The description goes here',0),(2004,'St Brendan\'s Dig','Clare',53.03270222,-9.276236111,'The description goes here',0),(2005,'St Catherine\'s 2 Cave','Clare',53.02737639,-9.351646389,'The description goes here',1),(2006,'St Coleman Macduagh\'s Cave','Clare',53.08447889,-9.002115278,'The description goes here',0),(2007,'St. Catherine\'s 1 - Doolin Cave','Clare',53.02848806,-9.3487,'The description goes here',1),(2008,'The Catacombs','Clare',52.81754722,-9.007831389,'The description goes here',1),(2009,'The Glen One Cave','Clare',52.81691583,-9.008113333,'The description goes here',0),(2010,'The Glen Two Cave','Clare',52.81438,-9.010427778,'The description goes here',1),(2011,'The Green Groove','Clare',53.07540667,-9.205279167,'The description goes here',1),(2012,'The Toomeens','Clare',52.87838111,-8.794910556,'The description goes here',1),(2013,'Through And Through Cave','Clare',53.06520722,-9.327768333,'The description goes here',0),(2014,'Toberdhu South','Clare',53.08971083,-9.230008611,'The description goes here',0),(2015,'Tom\'s Cave','Clare',52.97020556,-8.897510833,'The description goes here',0),(2016,'Tullycommon Cave','Clare',53.02070306,-9.061586667,'The description goes here',0),(2017,'Upper Coolagh Valley Cave','Clare',53.06827,-9.294443889,'The description goes here',0),(2018,'Urchin Cave','Clare',53.0227125,-9.405152778,'The description goes here',1),(2019,'Vigo Cave','Clare',52.96067611,-9.101188889,'The description goes here',1),(2020,'Wall In The Hole','Clare',53.04083833,-9.202525833,'The description goes here',0),(2021,'Whelan\'s Quarry Cave','Clare',52.86430083,-9.038225,'The description goes here',0),(2022,'Woodpecker\'s Hole','Clare',53.02420417,-9.400580833,'The description goes here',0),(2023,'Yellow Cave','Clare',53.06537167,-9.329115833,'The description goes here',0),(2024,'Ballincollig Cave','Cork',51.87952833,-8.599638611,'The description goes here',0),(2025,'Balls Rock Cave','Cork',53.77044083,-9.412711389,'The description goes here',0),(2026,'Ballyfin Cave','Cork',51.92307889,-8.1456375,'The description goes here',0),(2027,'Beaumont Cave','Cork',51.84036472,-8.118123333,'The description goes here',1),(2028,'Blarney Castle Cave','Cork',51.89096,-8.431342778,'The description goes here',0),(2029,'Broomfield Quarry Cave East','Cork',51.92269583,-8.176160278,'The description goes here',0),(2030,'Broomfield Quarry Cave West','Cork',51.92305667,-8.175289722,'The description goes here',0),(2031,'Carrigacrump Cave Central','Cork',51.83962639,-8.143627222,'The description goes here',0),(2032,'Carrigacrump Cave East','Cork',51.83963639,-8.142597222,'The description goes here',0),(2033,'Carrigacrump Cave South','Cork',51.83963639,-8.142597222,'The description goes here',1),(2034,'Carrigacrump Cave West','Cork',51.8395175,-8.144482778,'The description goes here',0),(2035,'Carrigacrump Dressing Room Cave','Cork',51.83993278,-8.142960833,'The description goes here',0),(2036,'Carrigacrump Lake Cave','Cork',51.84015028,-8.141481667,'The description goes here',1),(2037,'Carrigacrump Water Pot (1)','Cork',51.83963639,-8.142597222,'The description goes here',0),(2038,'Carrigacrump Water Pot (2)','Cork',51.83963639,-8.142597222,'The description goes here',0),(2039,'Carrigagour Caves','Cork',51.91090861,-8.261137778,'The description goes here',0),(2040,'Carrigshane Cave','Cork',51.90993083,-8.145624167,'The description goes here',0),(2041,'Carrigtwohill Quarry Cave (1)','Cork',51.91457222,-8.254473889,'The description goes here',1),(2042,'Carrigtwohill Quarry Cave (2)','Cork',51.914455,-8.254560556,'The description goes here',0),(2043,'Carrigtwohill Sink','Cork',51.91457194,-8.254575556,'The description goes here',0),(2044,'Carrigtwohill Village Cave','Cork',51.91092694,-8.261021667,'The description goes here',0),(2045,'Castletownroche Cave 1','Cork',52.168595,-8.460270278,'The description goes here',0),(2046,'Castletownroche Cave 2','Cork',52.16968278,-8.462459444,'The description goes here',0),(2047,'Castletownroche Cave 3','Cork',52.16878194,-8.463005278,'The description goes here',0),(2048,'Castletownroche Cave 4','Cork',52.16743917,-8.461676111,'The description goes here',0),(2049,'Castletownroche Cave 5','Cork',52.16734944,-8.461675278,'The description goes here',0),(2050,'Castletownroche Cave 6','Cork',52.16654389,-8.46079,'The description goes here',0),(2051,'Castletownroche Cave 7','Cork',52.16438889,-8.460329444,'The description goes here',0),(2052,'Castletownroche Cave 8','Cork',52.16429972,-8.460182222,'The description goes here',0),(2053,'Cloyne Caves','Cork',51.86431889,-8.114658333,'The description goes here',1),(2054,'Coleman Cave','Cork',51.88051028,-8.648386667,'The description goes here',0),(2055,'Donnelaroskas Cave','Cork',52.14951222,-8.494507222,'The description goes here',1),(2056,'Dromrhahan Cave','Cork',51.9073075,-8.328333889,'The description goes here',0),(2057,'Giant\'s Cave','Cork',51.89835222,-8.2362375,'The description goes here',0),(2058,'Goat Hole','Cork',52.13861083,-8.822924722,'The description goes here',0),(2059,'Gortmore Cave East','Cork',52.14884528,-8.515931111,'The description goes here',0),(2060,'Gortmore Cave West','Cork',52.14884528,-8.515931111,'The description goes here',1),(2061,'Kilcolman Castle Cave','Cork',52.14884528,-8.515931111,'The description goes here',0),(2062,'Killura Cave','Cork',52.14884528,-8.515931111,'The description goes here',0),(2063,'Killavullen Cave 1','Cork',51.92127889,-8.025458333,'The description goes here',0),(2064,'Killavullen Cave 2','Cork',51.92127889,-8.025458333,'The description goes here',0),(2065,'Killavullen Cave 3 ','Cork',51.92127889,-8.025458333,'The description goes here',0),(2066,'Killavullen Cave 4','Cork',51.92127889,-8.025458333,'The description goes here',0),(2067,'Knockane Cross Cave (1)','Cork',52.24441111,-8.565014167,'The description goes here',0),(2068,'Knockane Cross Cave (2)','Cork',51.92421889,-8.049356667,'The description goes here',0),(2069,'Knockane Cross Cave (3)','Cork',52.16736917,-8.244791111,'The description goes here',0),(2070,'Knockane Cross Cave (4)','Cork',51.87948139,-8.652394444,'The description goes here',1),(2071,'Mammoth Cave','Cork',51.91539028,-8.250118611,'The description goes here',1),(2072,'Middleton College Cave North','Cork',51.90986222,-8.036016111,'The description goes here',1),(2073,'Middleton College Cave Sink','Cork',51.85152639,-8.036056389,'The description goes here',0),(2074,'Middleton College Cave South','Cork',51.83276306,-8.357573333,'The description goes here',1),(2075,'Midleton Quarry Cave North','Cork',53.7772625,-9.405659167,'The description goes here',0),(2076,'Midleton Quarry Cave South','Cork',51.91955583,-8.20074,'The description goes here',0),(2077,'Mogeely Cave','Cork',51.88545806,-8.617377778,'The description goes here',1),(2078,'Moorepark Cave','Cork',52.15379028,-8.288547778,'The description goes here',1),(2079,'Ovens Cave','Cork',51.87913722,-8.651271389,'The description goes here',1),(2080,'Pluais Sciathan Leathair','Cork',51.91481972,-8.252135556,'The description goes here',1),(2081,'Poll Chait','Cork',52.21340472,-8.805374167,'The description goes here',0),(2082,'Poulnafahoe','Cork',52.25771167,-8.805151111,'The description goes here',0),(2083,'Poulnaharka Rising','Cork',52.08943111,-8.038655278,'The description goes here',0),(2084,'Poulnaharka Sink','Cork',52.08943111,-8.038655278,'The description goes here',0),(2085,'Shanagarry Cave','Cork',51.90969139,-8.0370475,'The description goes here',1),(2086,'Shanbally Cave','Cork',51.84085139,-8.357637222,'The description goes here',0),(2087,'Water Rock Sink','Cork',51.920305,-8.2042025,'The description goes here',0),(2088,'White Horse Cave','Cork',51.88562306,-8.615056389,'The description goes here',0),(2089,'Ballynacarrick Cave','Donegal',54.55938556,-8.093489722,'The description goes here',0),(2090,'Flautists Cave','Donegal',54.84018889,-8.312030833,'The description goes here',0),(2091,'Owey Island Cave','Donegal',55.05352806,-8.454505278,'The description goes here',0),(2092,'Pollnapaste','Donegal',54.84018889,-8.312030833,'The description goes here',0),(2093,'The Den','Donegal',54.84018889,-8.312030833,'The description goes here',0),(2094,'The Pullans','Donegal',54.84018889,-8.312030833,'The description goes here',1),(2095,'Loughshinny Cave','Dublin',53.55397389,-6.079911944,'The description goes here',0),(2096,'Hermits Cave (naul)','Dublin',53.58771278,-6.289816667,'The description goes here',0),(2097,'Portrane Caves','Dublin',53.48516667,-6.104115833,'The description goes here',0),(2098,'An Uillin Cave','Galway',53.51922306,-9.724737778,'The description goes here',0),(2099,'Ballyglunin Cave','Galway',53.42565917,-8.799514167,'The description goes here',1),(2100,'Ballymaglancy Cave','Galway',53.53674917,-9.338553889,'The description goes here',1),(2101,'Ballymaglancy Resurgence Cave','Galway',53.54215556,-9.337215833,'The description goes here',0),(2102,'Bealogai','Galway',53.4841875,-9.724069444,'The description goes here',0),(2103,'Blackwater Oxbow Cave','Galway',53.05030861,-8.817157222,'The description goes here',0),(2104,'Blackwater Resurgence Cave','Galway',53.04931111,-8.818480278,'The description goes here',0),(2105,'Blind Sound Cave','Galway (aran Isles)',53.12245472,-9.757360833,'The description goes here',0),(2106,'Cave','Galway',0,0,'The description goes here',0),(2107,'Clonbur Pigeon Hole','Galway',53.54096778,-9.362822778,'The description goes here',0),(2108,'Coole Cave','Galway',53.098345,-8.822545556,'The description goes here',1),(2109,'Coole Lough Sink','Galway',53.08441556,-8.848396667,'The description goes here',0),(2110,'Coole River Sink 3','Galway',53.10254278,-8.826208611,'The description goes here',1),(2111,'Cross Rift','Galway',53.47268667,-9.647543889,'The description goes here',0),(2112,'Doline Hole','Galway',53.47412361,-9.647599444,'The description goes here',0),(2113,'Doo Lough Sink','Galway',53.08197222,-8.863271667,'The description goes here',0),(2114,'Dun Eoghanachta Cave','Galway (aran Isles)',53.14006167,-9.781991111,'The description goes here',0),(2115,'Fairy Mills Cave','Galway',53.54235306,-8.841986389,'The description goes here',0),(2116,'Gnathaigh Na Dobharchu','Galway',53.10244472,-8.827401389,'The description goes here',0),(2117,'John Quinn\'s Cave','Galway',53.12071056,-8.956056667,'The description goes here',0),(2118,'Kelly\'s Cave','Galway',53.47496306,-9.645372778,'The description goes here',0),(2119,'Kinvara East Springs','Galway',53.14170111,-8.926485278,'The description goes here',0),(2120,'Knockahillion Cave','Galway',53.51682056,-9.704286389,'The description goes here',0),(2121,'Liskeevy Bridge Cave','Galway',53.59460667,-8.920503889,'The description goes here',0),(2122,'Lug Na Cumar','Galway',53.10304139,-8.832041111,'The description goes here',0),(2123,'Moran\'s Cave','Galway',53.11575306,-8.9121875,'The description goes here',1),(2124,'Murphy\'s Well','Galway',53.11579028,-8.895461389,'The description goes here',0),(2125,'Newry Hole','Galway',53.27235472,-8.993012222,'The description goes here',0),(2126,'Oonavoher','Galway (aran Isles)',53.08602333,-9.600647778,'The description goes here',0),(2127,'Padraig\'s Den','Galway',53.537605,-9.696070278,'The description goes here',0),(2128,'Piper\'s Cave','Galway (aran Isles)',53.06112556,-9.511714722,'The description goes here',0),(2129,'Poll A Puthe Kittleon','Galway',53.11909111,-8.956319444,'The description goes here',0),(2130,'Poll An Fuisce','Galway',0,0,'The description goes here',0),(2131,'Poll An Tabac','Galway (aran Isles)',53.12501667,-9.766429167,'The description goes here',0),(2132,'Poll Bliath Gairdin','Galway',53.12108556,-8.954123056,'The description goes here',0),(2133,'Poll Fiach Dubh 1','Galway',53.51552028,-9.793186111,'The description goes here',0),(2134,'Poll Fiach Dubh 2','Galway',53.51552028,-9.793186111,'The description goes here',0),(2135,'Poll Sean','Galway',53.49500778,-9.721494444,'The description goes here',0),(2136,'Pollaloughabo','Galway',53.11927861,-8.944075833,'The description goes here',1),(2137,'Pollawee','Galway',53.12107,-8.956064444,'The description goes here',0),(2138,'Polldeelin','Galway',53.09881889,-8.818971667,'The description goes here',1),(2139,'Polldeelin Spring','Galway',53.09907917,-8.82032,'The description goes here',1),(2140,'Pollduagh Cave','Galway',53.05067944,-8.8284975,'The description goes here',1),(2141,'Pollhoish','Galway',53.13560361,-8.92486,'The description goes here',0),(2142,'Pollnadingdong','Galway',53.40889222,-8.752584722,'The description goes here',0),(2143,'Pollnadirk','Galway',53.10985611,-8.895935278,'The description goes here',0),(2144,'Pollnadympna','Galway',53.16586056,-8.551709444,'The description goes here',1),(2145,'Pollnanaher','Galway',53.12173167,-8.940694167,'The description goes here',0),(2146,'Pollnapasty','Galway',53.10657222,-8.878397222,'The description goes here',0),(2147,'Pollnasneachta','Galway',53.39868222,-9.225970556,'The description goes here',0),(2148,'Pollonora Holes','Galway',53.10381,-8.824889167,'The description goes here',0),(2149,'Pouluiscemore','Galway',53.10422278,-8.830122778,'The description goes here',0),(2150,'Priest\'s Hole','Galway',53.54160694,-9.305520278,'The description goes here',0),(2151,'Reidh Na H\'uanach','Galway (aran Isles)',53.08356806,-9.582646944,'The description goes here',0),(2152,'Rhinolophus Retreat','Galway',53.39868222,-9.225970556,'The description goes here',0),(2153,'Ridge Rift Cave','Galway',53.54851389,-9.868514722,'The description goes here',0),(2154,'Rising Of The Waters','Galway',53.54226028,-9.286683889,'The description goes here',0),(2155,'Runaway Cave','Galway',0,0,'The description goes here',0),(2156,'Scalp Dubh','Galway',53.10233194,-8.830683611,'The description goes here',1),(2157,'School House Sink','Galway',0,0,'The description goes here',0),(2158,'Skelpnahooey','Galway',53.11808111,-8.9364325,'The description goes here',0),(2159,'Teach Aille','Galway',53.53643,-9.285753056,'The description goes here',0),(2160,'Terryland /cooley\'s Cave','Galway',53.28347972,-9.057741667,'The description goes here',0),(2161,'The Pigeon Hole','Galway',53.54248889,-9.307055833,'The description goes here',1),(2162,'Western Way Cave','Galway',53.49800944,-9.635715833,'The description goes here',0),(2163,'Wolves Hole','Galway',53.54074167,-9.302476667,'The description goes here',1),(2164,'Ballybeggan Pot','Kerry',52.2752025,-9.679697222,'The description goes here',0),(2165,'Ballynahallia Cave','Kerry',52.22122806,-9.416155556,'The description goes here',1),(2166,'Blocky Cave','Kerry',52.24953722,-9.445903056,'The description goes here',0),(2167,'Cleady River Cave 1','Kerry',51.89426222,-9.537616667,'The description goes here',0),(2168,'Cleady River Cave 2','Kerry',51.89693833,-9.539160833,'The description goes here',0),(2169,'Clogher Cave','Kerry',52.26058278,-9.566364444,'The description goes here',1),(2170,'Cloghermore Cave','Kerry',52.25470167,-9.602769444,'The description goes here',1),(2171,'Cottage Cave','Kerry',52.22776222,-9.388116667,'The description goes here',0),(2172,'Crag Cave','Kerry',52.24567417,-9.4457775,'The description goes here',1),(2173,'Crag Cave Jk (old)','Kerry',52.24567417,-9.4457775,'The description goes here',1),(2174,'Crag Lower Cave','Kerry',52.23967278,-9.444118611,'The description goes here',1),(2175,'Crag Quarry Cave','Kerry',52.24815194,-9.448933056,'The description goes here',0),(2176,'Devanes Quary Cave','Kerry',52.217585,-9.412674444,'The description goes here',0),(2177,'Edenburn Cave','Kerry',52.22263833,-9.581126667,'The description goes here',0),(2178,'Fortlands Cave','Kerry',52.25516833,-9.697978889,'The description goes here',0),(2179,'Gentleman\'s Cave','Kerry',52.27804278,-9.669547778,'The description goes here',1),(2180,'Kilbeg Bay Caves','Kerry',52.01768111,-9.515622778,'The description goes here',1),(2181,'Kilmurry Cave','Kerry',52.228695,-9.385218611,'The description goes here',1),(2182,'Lisodigue Cave','Kerry',52.29755083,-9.809543889,'The description goes here',1),(2183,'Marsh Edge Caves','Kerry',52.10935333,-9.515809167,'The description goes here',0),(2184,'Music Hole Rising','Kerry',52.22774528,-9.389579722,'The description goes here',0),(2185,'Poulakeol-pollsalach','Kerry',52.26626028,-9.611975278,'The description goes here',1),(2186,'Pouldermot-poulclashcannon','Kerry',52.27424694,-9.606258056,'The description goes here',1),(2187,'Rift Cave','Kerry',52.24952806,-9.446635,'The description goes here',0),(2188,'Tubrid House Caves','Kerry',51.87169056,-9.612350833,'The description goes here',1),(2189,'Dunmore Cave','Kilkenny',52.73361417,-7.246644444,'The description goes here',1),(2190,'Holdensrath Cave','Kilkenny',52.6566225,-7.293631667,'The description goes here',0),(2191,'Kellymount Cave','Kilkenny',52.68949167,-7.0468675,'The description goes here',0),(2192,'Kilbrickan Cave','Kilkenny',52.54950583,-7.340314722,'The description goes here',0),(2193,'Poll Chnoc An Spa','Kilkenny',52.74257389,-7.495833333,'The description goes here',1),(2194,'Clopook Cave','Laois',53.86278944,-7.114477222,'The description goes here',0),(2195,'Lugacurrren Cave','Laois',53.8534075,-7.109356667,'The description goes here',0),(2196,'Poulastore Cave','Laois',53.05618972,-7.176301389,'The description goes here',0),(2197,'Arch Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2198,'Avalanche Pot','Leitrim',54.35964806,-8.288388889,'The description goes here',0),(2199,'Badger Pot','Leitrim',54.32911889,-8.2820275,'The description goes here',0),(2200,'Badgers Holes','Leitrim',54.26615167,-8.185065278,'The description goes here',0),(2201,'Barracashlaun Cave','Leitrim',54.32919694,-8.246368333,'The description goes here',0),(2202,'Barracashlaun Resurgence','Leitrim',54.32229389,-8.239258056,'The description goes here',0),(2203,'Barracashlaun Rift','Leitrim',54.32766778,-8.247281389,'The description goes here',0),(2204,'Boggaun Cave','Leitrim',54.27109583,-8.182938333,'The description goes here',0),(2205,'Brockagh Cave','Leitrim',54.27368889,-8.121089722,'The description goes here',0),(2206,'Cave Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2207,'Cock Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2208,'Colleen Pot','Leitrim',54.37962472,-8.177725,'The description goes here',0),(2209,'Corracloona Cave','Leitrim',54.33393861,-7.989986667,'The description goes here',1),(2210,'Curraghan','Leitrim',54.29190556,-8.290987778,'The description goes here',0),(2211,'Cushlaw Cave','Leitrim',54.33530333,-8.323576667,'The description goes here',0),(2212,'Dave\'s Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2213,'Ditch Pot (1)','Leitrim',54.33530333,-8.323576667,'The description goes here',0),(2214,'Ditch Pot (2)','Leitrim',54.33530333,-8.323576667,'The description goes here',0),(2215,'Ditch Pot (3)','Leitrim',54.33530333,-8.323576667,'The description goes here',0),(2216,'Dowd\'s Folly','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2217,'Fenagh Cave','Leitrim',54.32911528,-8.283564722,'The description goes here',1),(2218,'Fringe Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2219,'Frog Pot','Leitrim',54.33808056,-8.291313056,'The description goes here',0),(2220,'Fuzzy Pot','Leitrim',54.36590639,-8.300740278,'The description goes here',0),(2221,'Glenboy Cave','Leitrim',54.28878056,-8.121901667,'The description goes here',0),(2222,'Glenboy Pig Cave','Leitrim',54.28851056,-8.122361667,'The description goes here',0),(2223,'Glendade Cave','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2224,'Gurteen Cave','Leitrim',54.32998417,-8.295867222,'The description goes here',0),(2225,'Hole In The Heart Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2226,'Largy Rifts','Leitrim',54.35964417,-8.289927222,'The description goes here',0),(2227,'Lily\'s Hole','Leitrim',54.35645972,-8.449865,'The description goes here',0),(2228,'Little Hole','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2229,'Meenagraun Pot','Leitrim',54.39053,-8.211637778,'The description goes here',0),(2230,'Mini Hole','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2231,'No Name Pot','Leitrim',54.33807306,-8.294387778,'The description goes here',0),(2232,'Odd Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2233,'Peakadaw Cave (sink)','Leitrim',54.36573306,-8.298123611,'The description goes here',0),(2234,'Peakadaw Cavern (spring)','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2235,'Pear Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2236,'Peatcutter\'s Cave Upper','Leitrim',54.35785139,-8.288376389,'The description goes here',0),(2237,'Peatcutter\'s Cave Lower','Leitrim',54.35785139,-8.288376389,'The description goes here',0),(2238,'Pillar Cave','Leitrim',54.39930306,-8.228619167,'The description goes here',0),(2239,'Poll An Mhada Bhui','Leitrim',54.31658028,-8.265039444,'The description goes here',0),(2240,'Poll An Si Mhor (1)','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2241,'Poll An Si Mhor (2)','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2242,'Poll An Si Mhor (3)','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2243,'Poll An Si Mhor (4)','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2244,'Poll An Si Mhor (5)','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2245,'Poll Duine Brean','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2246,'Black Hole','Leitrim',53.94338361,-9.522431389,'The description goes here',0),(2247,'Poll Mor','Leitrim',54.36214167,-8.152268056,'The description goes here',0),(2248,'Poll Na Leprechauns','Leitrim',54.34256472,-8.29442,'The description goes here',1),(2249,'Poll Na Mbear','Leitrim',54.36548722,-8.288429722,'The description goes here',0),(2250,'Pollacaintrie','Leitrim',54.36590639,-8.300740278,'The description goes here',0),(2251,'Pollacherry','Leitrim',54.35707528,-8.231461389,'The description goes here',0),(2252,'Pollahorta','Leitrim',54.3782925,-8.166947222,'The description goes here',0),(2253,'Pollatheriff','Leitrim',54.37980694,-8.176033056,'The description goes here',0),(2254,'Polldingdang','Leitrim',54.35989056,-8.156413056,'The description goes here',0),(2255,'Polldinna','Leitrim',54.38615389,-8.196377222,'The description goes here',0),(2256,'Polldonon','Leitrim',54.17535917,-8.302268056,'The description goes here',0),(2257,'Pollnacrioc','Leitrim',54.37202583,-8.362331111,'The description goes here',0),(2258,'Pollnagort','Leitrim',54.34344778,-8.300576667,'The description goes here',0),(2259,'Pollnagot','Leitrim',54.06505389,-7.975545833,'The description goes here',0),(2260,'Pollnagrod','Leitrim',54.38632889,-8.1993025,'The description goes here',0),(2261,'Pollnawathawee','Leitrim',54.34982583,-8.262177222,'The description goes here',0),(2262,'Polticoghlan','Leitrim',54.07475,-7.954153056,'The description goes here',1),(2263,'Ramsons Pot ','Leitrim',54.36662917,-8.155669167,'The description goes here',1),(2264,'Rattle Holes','Leitrim',54.27758556,-8.080727222,'The description goes here',0),(2265,'Round Pot','Leitrim',54.33530333,-8.323576667,'The description goes here',0),(2266,'Rte Rift (1)','Leitrim',54.37920778,-8.363933333,'The description goes here',0),(2267,'Rte Rift (2)','Leitrim',54.37920778,-8.363933333,'The description goes here',0),(2268,'Rte Rift (3)','Leitrim',54.37920778,-8.363933333,'The description goes here',0),(2269,'Rte Rift (4)','Leitrim',54.37920778,-8.363933333,'The description goes here',0),(2270,'Rte Rift (5)','Leitrim',54.37920778,-8.363933333,'The description goes here',0),(2271,'Rte Rift (6)','Leitrim',54.37651278,-8.363909444,'The description goes here',0),(2272,'Rte Rift (7)','Leitrim',54.37651278,-8.363909444,'The description goes here',0),(2273,'Sheamore Hill Caves','Leitrim',53.9759,-6.491911111,'The description goes here',0),(2274,'Sheenaun Caves','Leitrim',54.39843556,-8.151632222,'The description goes here',0),(2275,'Sheepfold Cave','Leitrim',54.37442972,-8.166931389,'The description goes here',1),(2276,'Singing Blackbird Cave','Leitrim',54.24037583,-8.180195556,'The description goes here',0),(2277,'Skeanada Sink','Leitrim',54.23766667,-8.189385556,'The description goes here',0),(2278,'Skull Cave','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2279,'Snake Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2280,'Sramore Cave','Leitrim',54.30272667,-8.343904722,'The description goes here',0),(2281,'Sulphur Pot','Leitrim',54.37362056,-8.167389722,'The description goes here',0),(2282,'Teampall Shetric','Leitrim',54.33361056,-8.282058333,'The description goes here',1),(2283,'The Cove (dromahair)','Leitrim',54.24283306,-8.299846111,'The description goes here',0),(2284,'Toadstool Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2285,'Tree Pot','Leitrim',54.33530333,-8.323576667,'The description goes here',0),(2286,'Truskmore Barytes Cave','Leitrim',54.36018222,-8.4137575,'The description goes here',0),(2287,'Violet Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2288,'Watch Pot (1)','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2289,'Watch Pot (2)','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2290,'Waterfall Pot','Leitrim',54.37601028,-8.191558611,'The description goes here',0),(2291,'Whistling Eel Cave','Leitrim',54.23675111,-8.200116667,'The description goes here',0),(2292,'Wild Cat\'s Hole','Leitrim',54.35438028,-8.231446389,'The description goes here',1),(2293,'Wriggle Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2294,'Yellow Pot','Leitrim',54.34428667,-8.323646944,'The description goes here',0),(2295,'Zero Pot','Leitrim',54.32998806,-8.294330278,'The description goes here',0),(2296,'Grange Hill Cave','Limerick',52.59674028,-8.320962222,'The description goes here',0),(2297,'Killuragh Cave','Limerick',52.51692583,-8.526608333,'The description goes here',0),(2298,'Knockadoon Cave','Limerick',52.60515389,-8.391872222,'The description goes here',0),(2299,'Poll Na Bruidhne','Limerick',52.47311111,-8.806868056,'The description goes here',0),(2300,'Pouleyon','Limerick',52.60408806,-8.328543611,'The description goes here',0),(2301,'Poulturagh','Limerick',52.52412111,-8.525221111,'The description goes here',0),(2302,'Red Cellar Cave','Limerick',52.52314944,-8.541415556,'The description goes here',0),(2303,'Pollna Gcolm An Longfoirt','Longford',0,0,'The description goes here',0),(2304,'Aille River Cave','Mayo',53.74298056,-10.92770556,'The description goes here',1),(2305,'Black And Tan Cave','Mayo',53.54720889,-9.286079722,'The description goes here',0),(2306,'Bunnadober Cave','Mayo',53.59598722,-9.261883333,'The description goes here',1),(2307,'Bunnadober Lake Cave','Mayo',53.60492167,-9.266681667,'The description goes here',0),(2308,'Captain Webb\'s Hole','Mayo',53.54347667,-9.282195,'The description goes here',0),(2309,'Church Cave','Mayo',53.53914083,-9.284326667,'The description goes here',0),(2310,'Drumsheel Upper Cave','Mayo',53.55259833,-9.286243056,'The description goes here',0),(2311,'Horse Discovery','Mayo',53.53825556,-9.283093333,'The description goes here',1),(2312,'Kelly\'s Cave','Mayo',53.54431889,-9.2790525,'The description goes here',0),(2313,'Knockbeg Cave','Mayo',53.54754472,-9.337385833,'The description goes here',0),(2314,'Lady\'s Buttery','Mayo',53.53960278,-9.283133889,'The description goes here',1),(2315,'Pollalariff North Pot','Mayo',53.58127694,-9.293153056,'The description goes here',0),(2316,'Pollnacathraig','Mayo',53.54456278,-9.281473611,'The description goes here',0),(2317,'Pollnadorragh','Mayo ',53.54194833,-9.273852222,'The description goes here',0),(2318,'Pollalahan','Mayo',53.78112472,-8.340541667,'The description goes here',0),(2319,'Pollnagot','Mayo',53.56872028,-9.332015833,'The description goes here',0),(2320,'Pollpather','Mayo',53.54642361,-9.275495278,'The description goes here',0),(2321,'Pollpuisin','Mayo',53.56944222,-9.331736667,'The description goes here',0),(2322,'Spindle Hole','Mayo',53.54363194,-9.284462778,'The description goes here',0),(2323,'St Swithin\'s Cave','Mayo',53.74987778,-10.92092222,'The description goes here',1),(2324,'Finn Mccoole\'s Cave','Monaghan',53.99752667,-6.730546667,'The description goes here',0),(2325,'Creevy Cave','Monaghan',53.99834417,-6.722897222,'The description goes here',0),(2326,'Kilmactrasna Cave','Monaghan',53.96602583,-6.725409722,'The description goes here',0),(2327,'Tiragarvan Cave','Monaghan',53.99155778,-6.7612225,'The description goes here',0),(2328,'Lugadaorris Cave','Monaghan',53.98709806,-6.764404167,'The description goes here',1),(2329,'Puthewarntagh','Monaghan',53.98705111,-6.759831944,'The description goes here',0),(2330,'Quarry Rising Cave','Monaghan',53.99751056,-6.729022222,'The description goes here',0),(2331,'Mount Briscoe Cave','Offaly',53.31053611,-7.253175556,'The description goes here',0),(2332,'Ballynahoogh Cave','Roscommon',53.92916417,-8.237312778,'The description goes here',0),(2333,'Estersnow Cave','Roscommon',53.9353825,-8.227299444,'The description goes here',0),(2334,'Lissananny Cave','Roscommon',53.8010275,-8.48382,'The description goes here',0),(2335,'Oweynagat','Roscommon',53.79728778,-8.310625,'The description goes here',0),(2336,'Pollawaddy','Roscommon',53.85100861,-8.649261667,'The description goes here',0),(2337,'Pollnagollum Frenchpark','Roscommon',53.86904167,-8.410725,'The description goes here',0),(2338,'Pollnagran','Roscommon',53.85613,-8.403152222,'The description goes here',1),(2339,'Ailtnaseabhach Cave 1','Sligo',54.12219389,-8.255235556,'The description goes here',0),(2340,'Ailtnaseabhach Cave (2)','Sligo',54.12608667,-8.282179167,'The description goes here',0),(2341,'Ailtnaseabhach Cave (3)','Sligo',54.12105583,-8.282145,'The description goes here',0),(2342,'Ailtnaseabhach Cave (4)','Sligo',54.12219389,-8.255235556,'The description goes here',0),(2343,'Angela\'s Doubt','Sligo',54.06681833,-8.271086389,'The description goes here',0),(2344,'Ballinlig Cave (1)','Sligo',54.06949944,-8.277213611,'The description goes here',0),(2345,'Ballinlig Cave (2)','Sligo',54.06949944,-8.277213611,'The description goes here',0),(2346,'Ballinlig Cave (3)','Sligo',54.06949944,-8.277213611,'The description goes here',0),(2347,'Ballinlig Cave (4)','Sligo',54.06945972,-8.294015278,'The description goes here',0),(2348,'Barytes Pot','Sligo',54.35854333,-8.4200475,'The description goes here',0),(2349,'Bone Hole Cave','Sligo',54.12139694,-8.249571944,'The description goes here',1),(2350,'Bricklieve Cave (a) (chapel Cave)','Sligo',54.06390028,-8.356593056,'The description goes here',0),(2351,'Bricklieve Cave (b)','Sligo',54.03866611,-8.382325,'The description goes here',0),(2352,'Bricklieve Cave (c)','Sligo',54.05845444,-8.374871111,'The description goes here',0),(2353,'Bricklieve Cave (d)','Sligo',54.04584361,-8.385443889,'The description goes here',0),(2354,'Brock\'s Cave','Sligo',54.13190333,-8.251929722,'The description goes here',0),(2355,'Carrickard Cave','Sligo',54.06415667,-8.255796389,'The description goes here',0),(2356,'Carrowmore Caverns','Sligo',54.13691611,-8.2605275,'The description goes here',1),(2357,'Carrownadargny Swallet','Sligo',54.12696806,-8.249146389,'The description goes here',0),(2358,'Carrownadargny-pollnagollum','Sligo',54.12831639,-8.248695833,'The description goes here',0),(2359,'Choked Rift Cave','Sligo',54.36554889,-8.420580556,'The description goes here',0),(2360,'Churdhe Mhor','Sligo',54.12219389,-8.255235556,'The description goes here',0),(2361,'Cormackeaghs Cave','Sligo',54.40577917,-8.370481944,'The description goes here',0),(2362,'Croghmine Cave','Sligo',54.06323167,-8.268008611,'The description goes here',0),(2363,'Curraghan Cave','Sligo',54.28148111,-8.292449722,'The description goes here',0),(2364,' Deerpark Caves','Sligo',54.28014833,-8.383479722,'The description goes here',0),(2365,'Dermot And Grainne\'s Cave','Sligo',54.3720925,-8.424647778,'The description goes here',1),(2366,'Dragonfly Pot','Sligo',54.12912083,-8.250689167,'The description goes here',0),(2367,'Finn Mccoole\'s Pot','Sligo',54.35465167,-8.452921389,'The description goes here',0),(2368,'Foyoge\'s Bridge Cave','Sligo',54.08935472,-8.234556667,'The description goes here',0),(2369,'Jumar Pot','Sligo',54.12883,-8.260782778,'The description goes here',0),(2370,'Kesh Cave (1)','Sligo',54.05909667,-8.449703611,'The description goes here',0),(2371,'Kesh Cave (2)','Sligo',54.05819833,-8.449693889,'The description goes here',1),(2372,'Kesh Cave (3)','Sligo',54.0573,-8.449684167,'The description goes here',0),(2373,'Kesh Cave (4)','Sligo',54.05461056,-8.448128333,'The description goes here',0),(2374,'Kesh Cave (5)','Sligo',54.05461056,-8.448128333,'The description goes here',1),(2375,'Kesh Cave (6)','Sligo',54.05461056,-8.448128333,'The description goes here',0),(2376,'Kesh Cave (7)','Sligo',54.05461056,-8.448128333,'The description goes here',1),(2377,'Knocknarea Cave (1)','Sligo',54.26065167,-8.585395,'The description goes here',0),(2378,'Knocknarea Cave (2)','Sligo',54.26064417,-8.586929444,'The description goes here',0),(2379,'Knocknarea Cave (3)','Sligo',54.26243333,-8.588489444,'The description goes here',0),(2380,'Knocknarea Cave (4)','Sligo',54.26242583,-8.590023889,'The description goes here',0),(2381,'Knocknarea Cave (5)','Sligo',54.25974583,-8.586916667,'The description goes here',0),(2382,'Knocknarea Cave (6)','Sligo',54.25884778,-8.586904167,'The description goes here',0),(2383,'Knocknarea Cave (7)','Sligo',54.264245,-8.585446111,'The description goes here',0),(2384,'Lecarrow Cave(pollabrock)','Sligo',54.01531306,-6.800181389,'The description goes here',1),(2385,'Moylough Cave','Sligo',54.22260806,-8.990525556,'The description goes here',0),(2386,'Lecarrrow Cave Rising','Sligo',54.0152825,-6.797131111,'The description goes here',1),(2387,'Muckelty Hill Cave (1)','Sligo',54.07996694,-8.690565833,'The description goes here',0),(2388,'Muckelty Hill Cave (2)','Sligo',54.07996694,-8.690565833,'The description goes here',0),(2389,'Muckelty Hill Cave (3)','Sligo',54.07996694,-8.690565833,'The description goes here',0),(2390,'Muckelty Hill Cave (4)','Sligo',54.07996694,-8.690565833,'The description goes here',0),(2391,'Muckelty Hill Cave (5)','Sligo',54.07996694,-8.690565833,'The description goes here',0),(2392,'Muckelty Hill Cave (6)','Sligo',54.07996694,-8.690565833,'The description goes here',0),(2393,'Patricia\'s Rift','Sligo',54.06860806,-8.274152778,'The description goes here',0),(2394,'Polldonin','Sligo',54.26528417,-8.303078056,'The description goes here',0),(2395,'Polliska','Sligo',54.13476778,-8.2568425,'The description goes here',0),(2396,'Poulagaddy','Sligo',54.06679222,-8.433596667,'The description goes here',0),(2397,'School Cave','Sligo',54.07066056,-8.432109444,'The description goes here',0),(2398,'Tap Cave-natural Bridge','Sligo',54.12077056,-8.248497778,'The description goes here',1),(2399,'Tonapubble','Sligo',54.25581222,-8.457976389,'The description goes here',0),(2400,'Treanmore Cave','Sligo',54.06774694,-8.257345833,'The description goes here',0),(2401,'Bricklieve Cave (e)','Sligo',53.93988028,-9.522364722,'The description goes here',0),(2402,'Tully Cave','Sligo',54.27119722,-8.373112778,'The description goes here',0),(2403,'Ballagh Cave','Tipperary',52.58998472,-7.985975833,'The description goes here',0),(2404,'Ballintaggart Quarry Cave','Tipperary',52.57250778,-7.484512222,'The description goes here',1),(2405,'Bee Cave','Tipperary',52.58998472,-7.985975833,'The description goes here',0),(2406,'Bull\'s Hole Cave','Tipperary',52.50624306,-7.497069167,'The description goes here',1),(2407,'Burncourt Quarry Cave','Tipperary',52.31281889,-8.081810833,'The description goes here',1),(2408,'Cloolagheen Swallet','Tipperary',52.28800417,-8.097445556,'The description goes here',0),(2409,'Desmond Cave','Tipperary',52.30317917,-8.111405278,'The description goes here',1),(2410,'Garrymore Cave','Tipperary',52.29969139,-8.091607778,'The description goes here',0),(2411,'Lios Carrigeen','Tipperary',52.26375056,-8.084210556,'The description goes here',1),(2412,'Mitchelstown Cave','Tipperary',52.30336139,-8.108766944,'The description goes here',1),(2413,'Mullinahone Tunnel Cave','Tipperary',52.50537556,-7.5044425,'The description goes here',0),(2414,'Pollskeheenarinky','Tipperary',52.26914639,-8.078361389,'The description goes here',1),(2415,'Poulacapple Cave','Tipperary',52.49887861,-7.457396944,'The description goes here',0),(2416,'Priesttown Cave','Tipperary',52.50739389,-7.560383889,'The description goes here',1),(2417,'Roaring Well (1)','Tipperary',52.32664583,-7.902456667,'The description goes here',1),(2418,'Roaring Well (2)','Tipperary',52.32664583,-7.902456667,'The description goes here',0),(2419,'Ballynahemery Cave','Waterford',52.11767806,-7.758534167,'The description goes here',0),(2420,'Ballynamintra Cave','Waterford',52.10582167,-7.761663056,'The description goes here',1),(2421,'Ballynamuck Cave','Waterford',52.10147417,-7.641729444,'The description goes here',0),(2422,'Bewley Cave East','Waterford',52.10726611,-7.815365278,'The description goes here',0),(2423,'Bewley West Cave (1)','Waterford',52.10816944,-7.818280556,'The description goes here',1),(2424,'Bewley West Cave (2)','Waterford',52.10816944,-7.818280556,'The description goes here',1),(2425,'Bewley West Cave (3)','Waterford',52.10816944,-7.818280556,'The description goes here',0),(2426,'Bridgewater Cave','Waterford',52.11346,-7.761330278,'The description goes here',0),(2427,'Cappagh Quarry Cave','Waterford',52.11433139,-7.748188056,'The description goes here',0),(2428,'Carrigmurrish Cave','Waterford',52.10382944,-7.754230556,'The description goes here',1),(2429,'Crotty\'s Cave','Waterford',52.26732778,-7.5276075,'The description goes here',0),(2430,'Dronana Cave','Waterford',52.10355556,-7.861935278,'The description goes here',0),(2431,'Glenbeg Cave','Waterford',52.13931056,-8.030081111,'The description goes here',0),(2432,'Kilgreany Cave','Waterford',52.10102139,-7.743885,'The description goes here',0),(2433,'Lismore Cave','Waterford',52.1410925,-7.932805278,'The description goes here',0),(2434,'Oonaglour Cave','Waterford',52.10970722,-7.772297222,'The description goes here',1),(2435,'Shandon Cave','Waterford',52.09944583,-7.625256111,'The description goes here',0),(2436,'Pollnagat','Westmeath',53.61065417,-7.332193889,'The description goes here',0),(2437,'Rock Of Curry Caves Lower','Westmeath',53.73193222,-7.329514167,'The description goes here',0),(2438,'Rock Of Curry Cave Upper','Westmeath',53.73370361,-7.324940278,'The description goes here',0),(2439,'Fore Cave','Westmeath',53.68012417,-7.230456389,'The description goes here',0),(2440,'Powerscourt Deerpark Cave','Wicklow',53.13661861,-5.970066944,'The description goes here',0),(2441,'Aghaboy Rising','Fermanagh',53.1901,-6.109310556,'The description goes here',1),(2442,'Aghaboy Springs','Fermanagh',53.19266639,-6.078747222,'The description goes here',1),(2443,'Aghatirourke Pot','Fermanagh',53.17529056,-6.042609444,'The description goes here',1),(2444,'Badger Cave','Fermanagh',53.17453722,-6.045979167,'The description goes here',1),(2445,'Badger Pot','Fermanagh',53.17459056,-6.046500278,'The description goes here',1),(2446,'Black Pot','Fermanagh',53.1838375,-6.064076944,'The description goes here',1),(2447,'Bmc Pot','Fermanagh',53.18230028,-6.055768889,'The description goes here',1),(2448,'Cascades','Fermanagh',53.16071222,-7.627289444,'The description goes here',1),(2449,'Coral Pot','Fermanagh',53.18156111,-6.055084167,'The description goes here',1),(2450,'Dig Swallet','Fermanagh',53.18337056,-6.064098056,'The description goes here',1),(2451,'Florence Court Risings','Fermanagh',53.183005,-6.035196667,'The description goes here',1),(2452,'Goat Pot','Fermanagh',53.17597611,-6.035667778,'The description goes here',1),(2453,'Gortalughany Rising','Fermanagh',53.18896417,-6.055512222,'The description goes here',1),(2454,'Hammer Pot','Fermanagh',53.12514194,-5.987490556,'The description goes here',1),(2455,'Long Pot','Fermanagh',53.18298611,-6.066987778,'The description goes here',1),(2456,'Marble Arch System','Fermanagh',54.25772,-7.814158,'The description goes here',1),(2457,'Monastir','Fermanagh',53.14162472,-6.005700833,'The description goes here',1),(2458,'Peter Bryant\'s Bullock Hole','Fermanagh',53.18230528,-6.068230278,'The description goes here',1),(2459,'Pigeon Pot I','Fermanagh',53.17671861,-6.046941944,'The description goes here',1),(2460,'Pigeon Pot Ii','Fermanagh',53.17614361,-6.048583611,'The description goes here',1),(2461,'Pigeon Pot Iii','Fermanagh',53.17647056,-6.047701111,'The description goes here',1),(2462,'Polliniska','Fermanagh',53.18323972,-6.071554167,'The description goes here',1),(2463,'Pollmyalla I','Fermanagh',53.1770375,-6.0308325,'The description goes here',1),(2464,'Pollmyalla Ii','Fermanagh',53.17716306,-6.030273333,'The description goes here',1),(2465,'Pollmyalla Iii','Fermanagh',53.17775444,-6.029618056,'The description goes here',1),(2466,'Pollnadad','Fermanagh',53.1843025,-6.076697778,'The description goes here',1),(2467,'Pollnagollum Aghaboy','Fermanagh',53.18869444,-6.109073333,'The description goes here',1),(2468,'Pollnagossan','Fermanagh',53.08999194,-5.981518611,'The description goes here',1),(2469,'Pollnaskeoge','Fermanagh',53.08272083,-5.982008333,'The description goes here',1),(2470,'Pollnasumera','Fermanagh',53.15131056,-6.009885833,'The description goes here',1),(2471,'Pollnatagha','Fermanagh',53.18335194,-6.071265,'The description goes here',1),(2472,'Pollprughlisk','Fermanagh',53.18348806,-6.073009167,'The description goes here',1),(2473,'Pollthanaclanawley','Fermanagh',53.18299389,-6.063038056,'The description goes here',1),(2474,'Quarry Crowbar Caves','Fermanagh',53.19461611,-6.0859925,'The description goes here',1),(2475,'Sheep Pot','Fermanagh',53.17474944,-6.040854167,'The description goes here',1),(2476,'Small Pot','Fermanagh',53.18304806,-6.063065556,'The description goes here',1),(2477,'Sruh Croppa (cats Hole)','Fermanagh',0,0,'The description goes here',1),(2478,'Sumera Rising','Fermanagh',53.19582333,-6.081703611,'The description goes here',1),(2479,'Syringopora Pot','Fermanagh',53.18232722,-6.05303,'The description goes here',1),(2480,'Tea Pot','Fermanagh',53.18196778,-6.065163611,'The description goes here',1),(2481,'Tullyhona Rising','Fermanagh',53.17191861,-6.000855278,'The description goes here',1),(2482,'Polldave','Clare',0,0,'The description goes here',0),(2483,'Poll Derry','Cavan',54.194824,-7.87468,'The description goes here',1),(2484,'Pollonora','Galway',53.069071,-8.817043,'The description goes here',1);
/*!40000 ALTER TABLE `caves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `counties`
--

DROP TABLE IF EXISTS `counties`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `counties` (
  `name` varchar(30) default NULL,
  `region_id` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `counties`
--

LOCK TABLES `counties` WRITE;
/*!40000 ALTER TABLE `counties` DISABLE KEYS */;
INSERT INTO `counties` VALUES ('Antrim',1),('Armagh',1),('Carlow',3),('Cavan',1),('Clare',2),('Cork',2),('Derry',1),('Donegal',1),('Down',1),('Dublin',3),('Fermanagh',1),('Galway',2),('Kerry',2),('Kildare',3),('Kilkenny',3),('Laois',3),('Leitrim',1),('Limerick',2),('Longford',3),('Louth',3),('Mayo',2),('Meath',3),('Monaghan',1),('Offaly',3),('Roscommon',2),('Sligo',1),('Tipperary',2),('Tyrone',1),('Waterford',3),('Westmeath',3),('Wexford',3),('Wicklow',3);
/*!40000 ALTER TABLE `counties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  `content` mediumblob NOT NULL,
  PRIMARY KEY  (`doc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL,
  `region` varchar(20) default NULL,
  PRIMARY KEY  (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (0,'No Region Defined'),(1,'Northern Region'),(2,'South-Western Region'),(3,'Eastern Region');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rescue_docs`
--

DROP TABLE IF EXISTS `rescue_docs`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rescue_docs` (
  `rescue_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rescue_docs`
--

LOCK TABLES `rescue_docs` WRITE;
/*!40000 ALTER TABLE `rescue_docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `rescue_docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rescue_log`
--

DROP TABLE IF EXISTS `rescue_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rescue_log` (
  `rescue_log_id` int(11) NOT NULL auto_increment,
  `rescue_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY  (`rescue_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rescue_log`
--

LOCK TABLES `rescue_log` WRITE;
/*!40000 ALTER TABLE `rescue_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `rescue_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rescues`
--

DROP TABLE IF EXISTS `rescues`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rescues` (
  `rescue_id` int(11) NOT NULL auto_increment,
  `cave_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `date` datetime default NULL,
  `status` int(3) default NULL,
  `comments` longtext,
  `type` int(3) default NULL,
  PRIMARY KEY  (`rescue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rescues`
--

LOCK TABLES `rescues` WRITE;
/*!40000 ALTER TABLE `rescues` DISABLE KEYS */;
/*!40000 ALTER TABLE `rescues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL auto_increment,
  `role` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Site Administrator'),(2,'Warden'),(3,'Core Team Member'),(4,'General Member'),(5,'Training Officer'),(6,'Equipment Officer'),(7,'First Aid Officer'),(8,'Callout Officer'),(9,'Public Relations Officer'),(10,'Reserve Warden'),(101,'Rigger'),(102,'Advanced Rigger'),(103,'Stretcher Handler'),(104,'Rock Breaker'),(105,'First Aider'),(106,'Medic'),(107,'Doctor'),(108,'Drug Admin'),(109,'Comms Operator'),(110,'Media Liason'),(111,'Incident Manager');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `status` (
  `status_id` tinyint(4) NOT NULL default '0',
  `status` varchar(20) default NULL,
  PRIMARY KEY  (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (0,'Available'),(1,'Not Available'),(2,'Standby requested'),(3,'On Standby'),(4,'Callout requested'),(5,'Called Out'),(6,'On Route'),(7,'OnSite - Undeployed'),(8,'OnSite - Overground'),(9,'OnSite - Underground');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_log`
--

DROP TABLE IF EXISTS `system_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `system_log` (
  `log_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY  (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `system_log`
--

LOCK TABLES `system_log` WRITE;
/*!40000 ALTER TABLE `system_log` DISABLE KEYS */;
INSERT INTO `system_log` VALUES (1,1,'2012-03-16 21:38:48','User admin logged in'),(3909,1,'2012-03-16 21:40:21','Created new training course Dummy Course');
/*!40000 ALTER TABLE `system_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training`
--

DROP TABLE IF EXISTS `training`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `training` (
  `training_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `valid_from` datetime default NULL,
  `valid_to` datetime default NULL,
  PRIMARY KEY  (`training_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `training`
--

LOCK TABLES `training` WRITE;
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
/*!40000 ALTER TABLE `training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_courses`
--

DROP TABLE IF EXISTS `training_courses`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `training_courses` (
  `course_id` int(11) NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `role_id` int(11) NOT NULL,
  `validity` int(11) NOT NULL,
  `tier` int(11) NOT NULL,
  PRIMARY KEY  (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `training_courses`
--

LOCK TABLES `training_courses` WRITE;
/*!40000 ALTER TABLE `training_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `training_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL default '0',
  `role_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,1);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user_status` (
  `user_id` int(11) NOT NULL default '0',
  `status_id` tinyint(4) default '0',
  `rescue_id` int(11) NOT NULL default '0',
  `team_id` int(11) NOT NULL default '0',
  `eta` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user_status`
--

LOCK TABLES `user_status` WRITE;
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` VALUES (1,0,0,0,0);
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `home_phone` varchar(20) default NULL,
  `mobile_phone` varchar(20) default NULL,
  `work_phone` varchar(20) default NULL,
  `other_phone` varchar(20) default NULL,
  `address_line1` varchar(45) default NULL,
  `address_line2` varchar(45) default NULL,
  `town` varchar(45) default NULL,
  `county` varchar(45) default NULL,
  `postcode` varchar(10) default NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `regdate` datetime default NULL,
  `last_login` datetime default NULL,
  `active` int(2) default NULL,
  `lat` float default NULL,
  `lng` float default NULL,
  `ffs_num` varchar(15) default NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `K_USERNAME` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'System','Administrator','','1234','','','Dundrum Road','','Dundrum','Dublin','','no-reply@icro.ie','admin','d033e22ae348aeb5660fc2140aec35850c4da997',NULL,'2012-03-16 21:40:36',1,53.2892,-6.24367,'');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-03-16 21:42:38
