/*
SQLyog Enterprise v13.1.1 (64 bit)
MySQL - 10.6.17-MariaDB-1:10.6.17+maria~ubu2004 : Database - jrn_aplikasi_cloud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jrn_aplikasi_cloud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `jrn_aplikasi_cloud`;

/*Data for the table `accounts` */

insert  into `accounts`(`account_id`,`account_branch_id`,`account_parent_id`,`account_group`,`account_group_sub`,`account_group_sub_name`,`account_code`,`account_name`,`account_side`,`account_show`,`account_tree`,`account_saldo`,`account_info`,`account_user_id`,`account_date_created`,`account_date_updated`,`account_flag`,`account_session`,`account_locked`) values 
(1,1,NULL,1,3,'Kas & Bank','1-10001','Kas',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2023-08-26 21:49:19',NULL,NULL,1),
(2,1,NULL,1,3,'Kas & Bank','1-10002','Bank',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2023-08-26 23:14:40',1,NULL,0),
(3,1,NULL,1,3,'Kas & Bank','1-10003','Giro',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',0,NULL,0),
(4,1,NULL,1,1,'Akun Piutang','1-10100','Piutang Usaha',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-01-28 22:35:10',1,'E2Q6OBTT',1),
(5,1,NULL,1,1,'Akun Piutang','1-10101','Piutang Belum Ditagih',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,'RZT87U00',0),
(6,1,NULL,1,1,'Akun Piutang','1-10102','Cadangan Kerugian Piutang',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(7,1,NULL,1,4,'Persediaan','1-10200','Persediaan Barang',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:14:52',1,'YOQLXM44',0),
(8,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10300','Piutang Lainnya',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(9,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10301','Piutang Karyawan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(10,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10400','Dana Belum Disetorkan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-06-09 02:27:06',1,NULL,0),
(11,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10401','Aset Lancar Lainnya',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(12,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10402','Biaya Dibayar Di Muka',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,'JBW4CYRR',0),
(13,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10403','Uang Muka Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(14,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10500','PPN Masukan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-05-27 11:00:58',1,'RDDQEK44',1),
(15,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10501','Pajak Dibayar Di Muka - PPh 22',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(16,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10502','Pajak Dibayar Di Muka - PPh 23',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(17,1,NULL,1,2,'Aktiva Lancar Lainnya','1-10503','Pajak Dibayar Di Muka - PPh 25',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(18,1,NULL,1,5,'Aktiva Tetap','1-10700','Aset Tetap - Tanah',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(19,1,NULL,1,5,'Aktiva Tetap','1-10701','Aset Tetap - Bangunan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(20,1,NULL,1,5,'Aktiva Tetap','1-10702','Aset Tetap - Building Improvements',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(21,1,NULL,1,5,'Aktiva Tetap','1-10703','Aset Tetap - Kendaraan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(22,1,NULL,1,5,'Aktiva Tetap','1-10704','Aset Tetap - Mesin & Peralatan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(23,1,NULL,1,5,'Aktiva Tetap','1-10705','Aset Tetap - Perlengkapan Kantor',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,'CLRK3CMM',0),
(24,1,NULL,1,5,'Aktiva Tetap','1-10706','Aset Tetap - Aset Sewa Guna Usaha',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(25,1,NULL,1,5,'Aktiva Tetap','1-10707','Aset Tak Berwujud',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(26,1,NULL,1,5,'Aktiva Tetap','1-10708','   Hak Merek Dagang',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(27,1,NULL,1,5,'Aktiva Tetap','1-10709','   Hak Cipta',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(28,1,NULL,1,5,'Aktiva Tetap','1-10710','   Good Will',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(29,1,NULL,1,7,'Depresiasi & Amortisasi','1-10751','Akumulasi Penyusutan - Bangunan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(30,1,NULL,1,7,'Depresiasi & Amortisasi','1-10752','Akumulasi Penyusutan - Building Improvements',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(31,1,NULL,1,7,'Depresiasi & Amortisasi','1-10753','Akumulasi Penyusutan - Kendaraan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:16:45',1,NULL,0),
(32,1,NULL,1,7,'Depresiasi & Amortisasi','1-10754','Akumulasi Penyusutan - Mesin & Peralatan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(33,1,NULL,1,7,'Depresiasi & Amortisasi','1-10755','Akumulasi Penyusutan - Peralatan Kantor',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(34,1,NULL,1,7,'Depresiasi & Amortisasi','1-10756','Akumulasi Penyusutan - Aset Sewa Guna Usaha',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(35,1,NULL,1,7,'Depresiasi & Amortisasi','1-10757','Akumulasi Amortisasi',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(36,1,NULL,1,7,'Depresiasi & Amortisasi','1-10758','   Akumulasi Amortisasi : Hak Merek Dagang',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(37,1,NULL,1,7,'Depresiasi & Amortisasi','1-10759','   Akumulasi Amortisasi : Hak Cipta',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(38,1,NULL,1,7,'Depresiasi & Amortisasi','1-10760','   Akumulasi Amortisasi : Good Will',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(39,1,NULL,1,6,'Aktiva Lainnya','1-10800','Investasi',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(40,1,NULL,2,8,'Akun Hutang','2-20100','Hutang Usaha',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-01-28 22:35:30',1,'CZ69ZOUU',1),
(41,1,NULL,2,8,'Akun Hutang','2-20101','Hutang Belum Ditagih',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,'Z03WC1OO',0),
(42,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20200','Hutang Lain Lain',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(43,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20201','Hutang Gaji',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(44,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20202','Hutang Deviden',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(45,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20203','Pendapatan Diterima Di Muka',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,'RVOJXM00',0),
(46,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20301','Sarana Kantor Terhutang',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(47,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20302','Bunga Terhutang',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(48,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20399','Biaya Terhutang Lainnya',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(49,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20400','Hutang Bank',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(50,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20500','PPN Keluaran',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-05-27 11:01:02',1,'74CM5J99',1),
(51,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20501','Hutang Pajak - PPh 21',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(52,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20502','Hutang Pajak - PPh 22',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(53,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20503','Hutang Pajak - PPh 23',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(54,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20504','Hutang Pajak - PPh 29',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(55,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20599','Hutang Pajak Lainnya',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(56,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20600','Hutang dari Pemegang Saham',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(57,1,NULL,2,10,'Kewajiban Lancar Lainnya','2-20601','Kewajiban Lancar Lainnya',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(58,1,NULL,2,11,'Kewajiban Jangka Panjang','2-20700','Kewajiban Manfaat Karyawan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(59,1,NULL,3,12,'Ekuitas','3-30000','Modal Saham',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:25:22',1,NULL,0),
(60,1,NULL,3,12,'Ekuitas','3-30001','Tambahan Modal Disetor',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:25:30',1,NULL,0),
(61,1,NULL,3,12,'Ekuitas','3-30100','Laba Ditahan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:09:19',1,NULL,0),
(62,1,NULL,3,12,'Ekuitas','3-30200','Dividen',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:10:27',1,NULL,0),
(63,1,NULL,4,14,'Ekuitas','3-30300','Pendapatan Komprehensif Lainnya',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:11:27',1,NULL,0),
(64,1,NULL,3,12,'Ekuitas','3-30999','Ekuitas Saldo Awal',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:11:45',1,'WNOL0UZZ',0),
(65,1,NULL,4,13,'Pendapatan','4-40000','Pendapatan / Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:11:55',1,'KOFQ3044',0),
(66,1,NULL,4,13,'Pendapatan','4-40100','Diskon Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:12:28',1,'GI26RS66',0),
(67,1,NULL,4,13,'Pendapatan','4-40200','Retur Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:12:33',1,'GQEN0GEE',0),
(68,1,NULL,1,14,'Pendapatan Lainnya','4-40201','Pendapatan Belum Ditagih',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2023-02-11 21:52:37',1,'ONZRBVGG',0),
(69,1,NULL,5,15,'Harga Pokok Penjualan','5-50000','Harga Pokok Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:12:55',1,'N4MLY555',0),
(70,1,NULL,5,16,'Harga Pokok Penjualan','5-50100','Diskon Pembelian',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:13:09',1,NULL,0),
(71,1,NULL,5,16,'Harga Pokok Penjualan','5-50200','Retur Pembelian',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:13:17',1,'TOWNL9UU',0),
(72,1,NULL,5,16,'Harga Pokok Penjualan','5-50300','Pengiriman & Pengangkutan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:13:29',1,'3SN3WPJJ',0),
(73,1,NULL,5,16,'Harga Pokok Penjualan','5-50400','Biaya Impor',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:13:36',1,NULL,0),
(74,1,NULL,5,16,'Harga Pokok Penjualan','5-50500','Biaya Produksi',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:13:43',1,'O3BDIVWW',0),
(75,1,NULL,5,16,'Beban','6-60000','Biaya Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(76,1,NULL,5,16,'Beban','6-60001','   Iklan & Promosi',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-01-28 22:39:55',1,NULL,1),
(77,1,NULL,5,16,'Beban','6-60002','   Komisi & Fee',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-01-28 22:39:43',1,NULL,1),
(78,1,NULL,5,16,'Beban','6-60003','   Bensin, Tol dan Parkir - Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-01-28 22:39:49',1,NULL,1),
(79,1,NULL,5,16,'Beban','6-60004','   Perjalanan Dinas - Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(80,1,NULL,5,16,'Beban','6-60005','   Komunikasi - Penjualan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(81,1,NULL,5,16,'Beban','6-60006','   Marketing Lainnya',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(82,1,NULL,5,16,'Beban','6-60100','Biaya Umum & Administratif',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(83,1,NULL,5,16,'Beban','6-60101','   Beban Gaji',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-28 08:19:52',1,NULL,0),
(84,1,NULL,5,16,'Beban','6-60102','   Upah',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(85,1,NULL,5,16,'Beban','6-60103','   Makanan & Transportasi',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(86,1,NULL,5,16,'Beban','6-60104','   Lembur',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(87,1,NULL,5,16,'Beban','6-60105','   Pengobatan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(88,1,NULL,5,16,'Beban','6-60106','   THR & Bonus',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(89,1,NULL,5,16,'Beban','6-60107','   Jamsostek',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(90,1,NULL,5,16,'Beban','6-60108','   Insentif',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(91,1,NULL,5,16,'Beban','6-60109','   Pesangon',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(92,1,NULL,5,16,'Beban','6-60110','   Manfaat dan Tunjangan Lain',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(93,1,NULL,5,16,'Beban','6-60200','   Donasi',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(94,1,NULL,5,16,'Beban','6-60201','   Hiburan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(95,1,NULL,5,16,'Beban','6-60202','   Bensin, Tol dan Parkir - Umum',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(96,1,NULL,5,16,'Beban','6-60203','   Perbaikan & Pemeliharaan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(97,1,NULL,5,16,'Beban','6-60204','   Perjalanan Dinas - Umum',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(98,1,NULL,5,16,'Beban','6-60205','   Makanan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(99,1,NULL,5,16,'Beban','6-60206','   Komunikasi - Umum',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(100,1,NULL,5,16,'Beban','6-60207','   Iuran & Langganan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(101,1,NULL,5,16,'Beban','6-60208','   Asuransi',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(102,1,NULL,5,16,'Beban','6-60209','   Legal & Profesional',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(103,1,NULL,5,16,'Beban','6-60210','   Beban Manfaat Karyawan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(104,1,NULL,5,16,'Beban','6-60211','   Sarana Kantor',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(105,1,NULL,5,16,'Beban','6-60212','   Pelatihan & Pengembangan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(106,1,NULL,5,16,'Beban','6-60213','   Beban Piutang Tak Tertagih',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(107,1,NULL,5,16,'Beban','6-60214','   Pajak dan Perizinan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(108,1,NULL,5,16,'Beban','6-60215','   Denda',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(109,1,NULL,5,16,'Beban','6-60217','   Listrik',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-01-28 22:39:06',1,NULL,1),
(110,1,NULL,5,16,'Beban','6-60218','   Air',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2022-01-28 22:39:14',1,NULL,1),
(111,1,NULL,5,16,'Beban','6-60219','   IPL',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(112,1,NULL,5,16,'Beban','6-60220','   Langganan Software',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2024-07-15 00:33:14',1,NULL,1),
(113,1,NULL,5,16,'Beban','6-60300','   Beban Kantor',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(114,1,NULL,5,16,'Beban','6-60301','   Alat Tulis Kantor & Printing',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(115,1,NULL,5,16,'Beban','6-60302','   Bea Materai',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(116,1,NULL,5,16,'Beban','6-60303','   Keamanan dan Kebersihan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(117,1,NULL,5,16,'Beban','6-60304','   Supplies dan Material',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(118,1,NULL,5,16,'Beban','6-60305','   Pemborong',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(119,1,NULL,5,16,'Beban','6-60400','   Biaya Sewa - Bangunan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(120,1,NULL,5,16,'Beban','6-60401','   Biaya Sewa - Kendaraan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(121,1,NULL,5,16,'Beban','6-60402','   Biaya Sewa - Operasionalnya',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-06-09 02:32:24',1,NULL,0),
(122,1,NULL,5,16,'Beban','6-60403','   Biaya Sewa - Lain - lain',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(123,1,NULL,5,16,'Beban','6-60500','   Penyusutan - Bangunan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(124,1,NULL,5,16,'Beban','6-60501','   Penyusutan - Perbaikan Bangunan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(125,1,NULL,5,16,'Beban','6-60502','   Penyusutan - Kendaraan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(126,1,NULL,5,16,'Beban','6-60503','   Penyusutan - Mesin & Peralatan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(127,1,NULL,5,16,'Beban','6-60504','   Penyusutan - Peralatan Kantor',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(128,1,NULL,5,16,'Beban','6-60599','   Penyusutan - Aset Sewa Guna Usaha',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(129,1,NULL,5,16,'Beban','6-60600','   Amortisasi : Hak Merek Dagang',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(130,1,NULL,5,16,'Beban','6-60601','   Amortisasi : Hak Cipta',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(131,1,NULL,5,16,'Beban','6-60602','   Amortisasi : Good Will',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(132,1,NULL,5,16,'Beban','6-60216','Pengeluaran Barang Rusak',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,'SCKQN7GG',0),
(133,1,NULL,4,14,'Pendapatan Lainnya','7-70000','Pendapatan Bunga - Bank',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(134,1,NULL,4,14,'Pendapatan Lainnya','7-70001','Pendapatan Bunga - Deposito',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(135,1,NULL,4,14,'Pendapatan Lainnya','7-70002','Pembulatan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(136,1,NULL,4,14,'Pendapatan Lainnya','7-70099','Pendapatan Lain - lain',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,'0LUXUMTT',0),
(137,1,NULL,5,17,'Beban Lainnya','8-80000','Beban Bunga',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(138,1,NULL,5,17,'Beban Lainnya','8-80001','Provisi',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(139,1,NULL,3,12,'Beban Lainnya','8-80002','Laba (Rugi) Pelepasan Aset Tetap',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:14:15',1,NULL,0),
(140,1,NULL,5,17,'Beban Lainnya','8-80100','Penyesuaian Persediaan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-04-20 14:20:25',1,'B6INTB99',0),
(141,1,NULL,5,17,'Beban Lainnya','8-80999','Beban Lain - lain',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(142,1,NULL,5,17,'Beban Lainnya','9-90000','Beban Pajak - Kini',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(143,1,NULL,5,17,'Beban Lainnya','9-90001','Beban Pajak - Tangguhan',1,1,1,'0',NULL,1,'2021-03-12 00:00:00','2021-03-12 00:00:00',1,NULL,0),
(144,1,NULL,1,4,'Persediaan','1-10201','Persediaan Barang Setengah Jadi',1,1,1,'0',NULL,1,'2021-03-27 10:55:00','2021-03-27 10:55:03',1,NULL,0),
(145,1,NULL,1,4,'Persediaan','1-10202','Persediaan Barang Jadi',1,1,1,'0',NULL,1,'2021-03-27 10:55:02','2021-03-27 10:55:04',1,NULL,0),
(146,1,NULL,3,12,'Ekuitas','3-30002','Modal Investor',NULL,NULL,NULL,'0',NULL,1,'2021-05-28 22:05:40','2021-05-28 22:05:40',1,NULL,0),
(147,1,NULL,1,3,'Kas & Bank','1-10004','Kas Dua',NULL,NULL,NULL,'0',NULL,1,'2021-06-26 10:09:48','2023-08-26 23:15:54',4,NULL,0),
(148,1,NULL,1,3,'Kas & Bank','1-10005','Bank BCA',NULL,NULL,NULL,'0',NULL,1,'2021-06-26 10:10:07','2021-06-26 10:10:07',1,NULL,0),
(149,1,NULL,4,13,'Pendapatan','4-40001','Pendapatan Jasa',1,1,1,'0',NULL,1,'2023-01-23 21:37:47','2023-01-23 21:37:47',1,'ASADAS33',0),
(150,1,NULL,4,13,'Pendapatan','4-40101','Voucher Penjualan',NULL,NULL,NULL,'0',NULL,2,'2023-02-28 11:38:09','2023-02-28 11:38:09',1,'GI26RS68',0);

/*Data for the table `accounts_groups` */

insert  into `accounts_groups`(`group_id`,`group_group_id`,`group_group_sub_id`,`group_name`) values 
(1,1,1,'Akun Piutang'),
(2,1,2,'Aktiva Lancar Lainnya'),
(3,1,3,'Kas & Bank'),
(4,1,4,'Persediaan'),
(5,1,5,'Aktiva Tetap'),
(6,1,6,'Aktiva Lainnya'),
(7,1,7,'Depresiasi & Amortisasi'),
(8,2,8,'Akun Hutang'),
(9,2,10,'Kewajiban Lancar Lainnya'),
(10,2,11,'Kewajiban Jangka Panjang'),
(11,3,12,'Ekuitas'),
(12,4,13,'Pendapatan'),
(13,4,14,'Pendapatan Lainnya'),
(14,5,15,'Harga Pokok Penjualan'),
(15,5,16,'Beban'),
(16,5,17,'Beban Lainnya');

/*Data for the table `accounts_maps` */

insert  into `accounts_maps`(`account_map_id`,`account_map_branch_id`,`account_map_account_id`,`account_map_for_transaction`,`account_map_type`,`account_map_flag`,`account_map_note`,`account_map_formula`,`account_map_date_created`,`account_map_date_updated`,`account_map_session`) values 
(1,1,69,1,1,1,'Pembelian:COGS','C','2021-03-27 09:01:33','2021-03-27 09:01:32','N4MLY555'),
(2,1,14,1,2,1,'Pembelian:PpnMasukan','D','2020-12-31 09:44:07','2020-12-31 09:44:07','RDDQEK44'),
(3,1,12,1,3,1,'Pembelian:UangMukaPembelian',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','JBW4CYRR'),
(4,1,71,1,4,1,'Pembelian:ReturPembelian',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','TOWNL9UU'),
(5,1,72,1,5,1,'Pembelian:PengirimanPembelian',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','3SN3WPJJ'),
(6,1,65,2,1,1,'Penjualan:PiutangUsaha','D','2020-12-31 09:44:07','2020-12-31 09:44:07','KOFQ3044'),
(7,1,50,2,2,1,'Penjualan:PpnKeluaran','C','2020-12-31 09:44:07','2020-12-31 09:44:07','74CM5J99'),
(8,1,45,2,3,1,'Penjualan:UangMukaPenjualan',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','RVOJXM00'),
(9,1,67,2,4,1,'Penjualan:ReturPenjualan',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','GQEN0GEE'),
(10,1,66,2,5,1,'Penjualan:DiskonPenjualan',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','GI26RS66'),
(11,1,136,2,7,1,'Penjualan:PengirimanPenjualan','D','2020-12-31 09:48:22','2020-12-31 09:48:22','0LUXUMTT'),
(12,1,7,3,1,1,'Persediaan:PersediaanBarang','D','2020-12-31 09:48:22','2020-12-31 09:48:22','YOQLXM44'),
(13,1,140,3,2,1,'Persediaan:PersediaanBarangUmum','D','2020-12-31 09:48:22','2020-12-31 09:48:22','B6INTB99'),
(14,1,132,3,3,1,'Persediaan:PersediaanBarangRusak','D','2020-12-31 09:48:22','2020-12-31 09:48:22','SCKQN7GG'),
(15,1,74,3,4,1,'Persediaan:PersediaanBarangProduksi',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','O3BDIVWW'),
(16,1,68,2,8,1,'Penjualan:PenjualanBelumDiTagih','C','2020-12-31 10:49:44','2020-12-31 10:49:45','ONZRBVGG'),
(17,1,41,1,6,1,'Pembelian:HutangUsahaBelumDiTagih',NULL,'2020-12-31 21:37:14','2020-12-31 21:37:17','Z03WC1OO'),
(18,1,5,2,6,1,'Penjualan:PiutangUsahaBelumDiTagih',NULL,'2020-12-31 21:37:16','2020-12-31 21:37:18','RZT87U00'),
(21,1,64,10,1,1,'Lain:Ekuitas',NULL,'2021-03-27 11:37:32','2021-03-27 11:37:32','WNOL0UZZ'),
(22,1,23,10,2,1,'Lain:AsetTetap',NULL,'2021-03-27 11:37:35','2021-03-27 11:37:37','CLRK3CMM'),
(23,1,40,4,1,1,'HutangUsaha',NULL,'2021-04-09 22:21:43','2021-04-09 22:21:47','CZ69ZOUU'),
(24,1,4,4,2,1,'PiutangUsaha',NULL,'2021-04-09 22:21:45','2021-04-09 22:21:48','E2Q6OBTT'),
(25,1,150,2,9,1,'Penjualan:VoucherPenjualan',NULL,'2023-02-28 11:33:23','2023-02-28 11:33:25','GI26RS68'),
(26,1,1,11,1,1,'Bayar:Cash',NULL,'2023-03-03 09:13:57','2023-03-03 09:13:57','YUCASH12'),
(27,1,2,11,2,1,'Bayar:Bank',NULL,'2023-03-03 09:13:57','2023-03-03 09:13:57','TRNSFER2'),
(28,1,2,11,3,1,'Bayar:EDC',NULL,'2023-03-03 09:13:57','2023-03-03 09:13:57','EDC34WER'),
(29,1,2,11,4,1,'Bayar:QRIS',NULL,'2023-03-03 09:13:57','2023-03-03 09:13:57','QRIS892E'),
(30,1,66,11,5,1,'Bayar:Gratis',NULL,'2023-03-03 09:13:57','2023-03-03 09:13:57','QRIS892R');

/*Data for the table `activities` */

/*Data for the table `app_branch_billings` */

/*Data for the table `app_packages` */

insert  into `app_packages`(`app_package_id`,`app_package_name`,`app_package_description`,`app_package_publish_price`,`app_package_promo_price`,`app_package_flag`,`app_package_date_created`) values 
(1,'Starter',NULL,'0','0',1,'2020-12-29 10:27:48'),
(2,'UMKM',NULL,'0','0',1,'2020-12-29 10:27:48'),
(3,'Enterprise',NULL,'0','0',1,'2020-12-29 10:27:48');

/*Data for the table `app_packages_items` */

insert  into `app_packages_items`(`item_id`,`item_app_package_id`,`maximal_user_data`,`maximal_location_data`,`maximal_product_data`,`maximal_contact_data`,`transaction_buy_sell`,`transaction_operational_cost`,`transaction_cash_bank`,`transaction_receivable_payable`,`transaction_inventory`,`transaction_production`,`support_fixed_asset`,`support_point_of_sale`,`support_approval`) values 
(1,1,'1','1','Unlimited','Unlimited','Yes','Yes','Yes','No','No','No','No','No','No'),
(2,2,'3','5','Unlimited','Unlimited','Yes','Yes','Yes','Yes','Yes','No','Yes','Yes','Yes'),
(3,3,'10','Unlimited','Unlimited','Unlimited','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes');

/*Data for the table `app_vouchers` */

insert  into `app_vouchers`(`app_voucher_id`,`app_voucher_type`,`app_voucher_code`,`app_voucher_total`,`app_voucher_flag`,`app_voucher_date_created`,`app_voucher_user_id`) values 
(1,1,'ABC123','100000',1,'2020-12-29 10:30:09',1);

/*Data for the table `approvals` */

/*Data for the table `balances` */

/*Data for the table `banks` */

/*Data for the table `branchs` */

insert  into `branchs`(`branch_id`,`branch_user_id`,`branch_code`,`branch_name`,`branch_note`,`branch_specialist_id`,`branch_slogan`,`branch_address`,`branch_phone_1`,`branch_phone_2`,`branch_email_1`,`branch_email_2`,`branch_district`,`branch_city`,`branch_province`,`branch_logo`,`branch_logo_sidebar`,`branch_date_created`,`branch_date_updated`,`branch_flag`,`branch_bank_name`,`branch_bank_branch`,`branch_bank_address`,`branch_bank_account_number`,`branch_bank_account_name`,`branch_province_id`,`branch_city_id`,`branch_district_id`,`branch_village_id`,`branch_transaction_with_stock`,`branch_transaction_with_journal`,`branch_session`,`branch_url`,`branch_location_id`,`branch_app_package_id`) values 
(1,1,NULL,'Bisnis Anda',NULL,8,NULL,'Alamat Bisnis','6281225518118',NULL,'demo@demo.com',NULL,NULL,NULL,NULL,'upload/branch/default_logo.png','upload/branch/default_logo.png','2020-04-28 14:51:45','2022-01-17 16:04:45',1,NULL,NULL,NULL,NULL,NULL,33,3374,3374040,NULL,'Yes','Yes','PJE1LPHZ6K4HVOH5WT76',NULL,13,3);

/*Data for the table `branchs_specialists` */

insert  into `branchs_specialists`(`specialist_id`,`specialist_name`,`specialist_name_translate`,`specialist_flag`,`specialist_date_created`) values 
(1,'Default','Standard',0,'2021-03-28 00:00:00'),
(2,'Chemical & Materials','Kimia & Material',1,'2021-03-28 00:00:00'),
(3,'Agriculture, Forestry, Fishing and Hunting','Pertanian, Kehutanan, Perikanan dan Berburu',1,'2021-03-28 00:00:00'),
(4,'Construction & Engineering','Konstruksi & Rekayasa',1,'2021-03-28 00:00:00'),
(5,'Transportation & Warehousing','Transportasi & Pergudangan',1,'2021-03-28 00:00:00'),
(6,'Mining','Pertambangan',1,'2021-03-28 00:00:00'),
(7,'Professional Services - Law Firm, Audit & Consultants','Layanan Profesional - Kantor Hukum, Audit & Konsultan',1,'2021-03-28 00:00:00'),
(8,'Agency, Media & Entertainment','Agensi, Media & Hiburan',1,'2021-03-28 00:00:00'),
(9,'Financial Services - Banks','Layanan Keuangan - Bank',1,'2021-03-28 00:00:00'),
(10,'Financial Services - Insurance & Multifinance','Jasa Keuangan - Asuransi & Pembiayaan',1,'2021-03-28 00:00:00'),
(11,'Financial Services - Technology','Layanan Keuangan - Teknologi',1,'2021-03-28 00:00:00'),
(12,'Technology - Startup & Software','Teknologi - Startup & Software',1,'2021-03-28 00:00:00'),
(13,'Technology - Hardware & Equipments','Teknologi - Perangkat Keras & Peralatan',1,'2021-03-28 00:00:00'),
(14,'Technology - Services & Consultants','Teknologi - Layanan & Konsultan',1,'2021-03-28 00:00:00'),
(15,'Consumer Retail Product / Offline Store','Produk Ritel Konsumen / Toko Offline',1,'2021-03-28 00:00:00'),
(16,'Online Retailer / Seller / Marketplace','Pengecer / Penjual / Pasar Online',1,'2021-03-28 00:00:00'),
(17,'Hotels & Leisure','Hotel & Kenyamanan',1,'2021-03-28 00:00:00'),
(18,'Health Care','Kesehatan',1,'2021-03-28 00:00:00'),
(19,'Education Services','Layanan Pendidikan',1,'2021-03-28 00:00:00'),
(20,'Real Estate / Property','Real Estate / Properti',1,'2021-03-28 00:00:00'),
(21,'Cafe / Coffee Shop','Kafe / Kedai Kopi',1,'2021-03-28 00:00:00'),
(22,'Restaurant','Restoran',1,'2021-03-28 00:00:00'),
(23,'Bakery','Toko Roti',1,'2021-03-28 00:00:00'),
(24,'Tour & Travel','Biro Perjalanan',1,'2021-03-28 00:00:00'),
(25,'Beauty & Salon','Salon kecantikan',1,'2021-03-28 00:00:00'),
(26,'Arts, Entertainment, and Recreation','Seni, Hiburan, dan Rekreasi',1,'2021-03-28 00:00:00'),
(27,'Household Services','Pelayanan Rumah Tangga',1,'2021-03-28 00:00:00'),
(28,'Automotive','Otomotif',1,'2021-03-28 00:00:00'),
(29,'Architecture & Interior Design','Arsitektur & Desain Interior',1,'2021-03-28 00:00:00'),
(30,'Trading - Supplier','Perdagangan - Pemasok',1,'2021-03-28 00:00:00'),
(31,'Trading - Distributor','Perdagangan - Distributor',1,'2021-03-28 00:00:00'),
(32,'Trading - Retail','Perdagangan - Ritel',1,'2021-03-28 00:00:00'),
(33,'Factory/ Manufacturing','Pabrik / Manufaktur',1,'2021-03-28 00:00:00'),
(34,'Non Profit Organization','Organisasi Non Profit',1,'2021-03-28 00:00:00'),
(35,'Export - Import','Ekspor Impor',1,'2021-03-28 00:00:00'),
(36,'Energy, Oil & Gas, Utilities','Energi, Minyak & Gas, Utilitas',1,'2021-03-28 00:00:00'),
(37,'Others','Lainnya',1,'2021-03-29 09:48:06');

/*Data for the table `branchs_specialists_accounts` */

insert  into `branchs_specialists_accounts`(`item_id`,`item_branch_specialist_id`,`item_code`,`item_name`,`item_group`,`item_group_sub`,`item_group_sub_name`,`item_parent_id`,`item_show`,`item_side`,`item_flag`,`item_date_created`,`item_session`) values 
(1,1,'1-10001','Kas',1,3,'Kas & Bank',NULL,1,1,1,'2021-03-12 00:00:00','H764T844'),
(2,1,'1-10002','Bank',1,3,'Kas & Bank',NULL,1,1,1,'2021-03-12 00:00:00','5KPMMUCC'),
(3,1,'1-10003','Giro',1,3,'Kas & Bank',NULL,1,1,1,'2021-03-12 00:00:00','UBE49VBB'),
(4,1,'1-10100','Piutang Usaha',1,1,'Akun Piutang',NULL,1,1,1,'2021-03-12 00:00:00','E2Q6OBTT'),
(5,1,'1-10101','Piutang Belum Ditagih',1,1,'Akun Piutang',NULL,1,1,1,'2021-03-12 00:00:00','RZT87U00'),
(6,1,'1-10102','Cadangan Kerugian Piutang',1,1,'Akun Piutang',NULL,1,1,1,'2021-03-12 00:00:00','ZJRGT144'),
(7,1,'1-10200','Persediaan Bahan Baku',1,4,'Persediaan',NULL,1,1,1,'2021-03-12 00:00:00','YOQLXM44'),
(8,1,'1-10300','Piutang Lainnya',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','OBKQCCRR'),
(9,1,'1-10301','Piutang Karyawan',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','J4RY5O33'),
(10,1,'1-10400','Dana Belum Disetor',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','SUDI7EZZ'),
(11,1,'1-10401','Aset Lancar Lainnya',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','6QM3ZGEE'),
(12,1,'1-10402','Biaya Dibayar Di Muka',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','JBW4CYRR'),
(13,1,'1-10403','Uang Muka',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','IYPAQXX'),
(14,1,'1-10500','PPN Masukan',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','RDDQEK44'),
(15,1,'1-10501','Pajak Dibayar Di Muka - PPh 22',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','3GLTTX00'),
(16,1,'1-10502','Pajak Dibayar Di Muka - PPh 23',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','Z7H6S6CC'),
(17,1,'1-10503','Pajak Dibayar Di Muka - PPh 25',1,2,'Aktiva Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','ZIPRWGMM'),
(18,1,'1-10700','Aset Tetap - Tanah',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','9WOPU3WW'),
(19,1,'1-10701','Aset Tetap - Bangunan',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','9QW2PE44'),
(20,1,'1-10702','Aset Tetap - Building Improvements',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','KT7FHXSS'),
(21,1,'1-10703','Aset Tetap - Kendaraan',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','D3O0F7NN'),
(22,1,'1-10704','Aset Tetap - Mesin & Peralatan',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','QRT1O6VV'),
(23,1,'1-10705','Aset Tetap - Perlengkapan Kantor',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','CLRK3CMM'),
(24,1,'1-10706','Aset Tetap - Aset Sewa Guna Usaha',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','4H7BVT22'),
(25,1,'1-10707','Aset Tak Berwujud',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','6F8ZXEE'),
(26,1,'1-10708','   Hak Merek Dagang',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','WYY3KF66'),
(27,1,'1-10709','   Hak Cipta',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','HSZ4NWKK'),
(28,1,'1-10710','   Good Will',1,5,'Aktiva Tetap',NULL,1,1,1,'2021-03-12 00:00:00','4M9RF144'),
(29,1,'1-10751','Akumulasi Penyusutan - Bangunan',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','GIYIEJ22'),
(30,1,'1-10752','Akumulasi Penyusutan - Building Improvements',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','OPAIDMM'),
(31,1,'1-10753','Akumulasi Penyusutan - Kendaraan',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','P9JOSSVV'),
(32,1,'1-10754','Akumulasi Penyusutan - Mesin & Peralatan',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','Q8SLO5YY'),
(33,1,'1-10755','Akumulasi Penyusutan - Peralatan Kantor',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','OGRXTRQQ'),
(34,1,'1-10756','Akumulasi Penyusutan - Aset Sewa Guna Usaha',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','1R45QTUU'),
(35,1,'1-10757','Akumulasi Amortisasi',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','OB1QZ144'),
(36,1,'1-10758','   Akumulasi Amortisasi : Hak Merek Dagang',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','UZ00ZR66'),
(37,1,'1-10759','   Akumulasi Amortisasi : Hak Cipta',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','KRQ2F4FF'),
(38,1,'1-10760','   Akumulasi Amortisasi : Good Will',1,7,'Depresiasi & Amortisasi',NULL,1,1,1,'2021-03-12 00:00:00','NVN2JEFF'),
(39,1,'1-10800','Investasi',1,6,'Aktiva Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','UJFR71NN'),
(40,1,'2-20100','Hutang Usaha',2,8,'Akun Hutang',NULL,1,1,1,'2021-03-12 00:00:00','CZ69ZOUU'),
(41,1,'2-20101','Hutang Belum Ditagih',2,8,'Akun Hutang',NULL,1,1,1,'2021-03-12 00:00:00','Z03WC1OO'),
(42,1,'2-20200','Hutang Lain Lain',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','YLUNOS33'),
(43,1,'2-20201','Hutang Gaji',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','4Q4L3EDD'),
(44,1,'2-20202','Hutang Deviden',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','F73DD644'),
(45,1,'2-20203','Pendapatan Diterima Di Muka',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','RVOJXM00'),
(46,1,'2-20301','Sarana Kantor Terhutang',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','WYRHCFF'),
(47,1,'2-20302','Bunga Terhutang',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','PX57555'),
(48,1,'2-20399','Biaya Terhutang Lainnya',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','0IBIS0GG'),
(49,1,'2-20400','Hutang Bank',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','LFOHPMNN'),
(50,1,'2-20500','PPN Keluaran',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','74CM5J99'),
(51,1,'2-20501','Hutang Pajak - PPh 21',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','4EZBX0GG'),
(52,1,'2-20502','Hutang Pajak - PPh 22',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','MKEVKDZZ'),
(53,1,'2-20503','Hutang Pajak - PPh 23',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','99LNEEKK'),
(54,1,'2-20504','Hutang Pajak - PPh 29',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','QDPXP9'),
(55,1,'2-20599','Hutang Pajak Lainnya',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','ICW7BS77'),
(56,1,'2-20600','Hutang dari Pemegang Saham',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','EFAHDC99'),
(57,1,'2-20601','Kewajiban Lancar Lainnya',2,10,'Kewajiban Lancar Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','LM4J9PII'),
(58,1,'2-20700','Kewajiban Manfaat Karyawan',2,11,'Kewajiban Jangka Panjang',NULL,1,1,1,'2021-03-12 00:00:00','2S3J1K66'),
(59,1,'3-30000','Modal Saham',3,12,'Ekuitas',NULL,1,1,1,'2021-03-12 00:00:00','3EXUCLEE'),
(60,1,'3-30001','Tambahan Modal Disetor',3,12,'Ekuitas',NULL,1,1,1,'2021-03-12 00:00:00','W5TR0BRR'),
(61,1,'3-30100','Laba Ditahan',3,12,'Ekuitas',NULL,1,1,1,'2021-03-12 00:00:00','3I4TC288'),
(62,1,'3-30200','Dividen',3,12,'Ekuitas',NULL,1,1,1,'2021-03-12 00:00:00','IQLVMMUU'),
(63,1,'3-30300','Pendapatan Komprehensif Lainnya',4,14,'Pendapatan Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','XC5ZPDXX'),
(64,1,'3-30999','Ekuitas Saldo Awal',3,12,'Ekuitas',NULL,1,1,1,'2021-03-12 00:00:00','WNOL0UZZ'),
(65,1,'4-40000','Pendapatan / Penjualan',4,13,'Pendapatan',NULL,1,1,1,'2021-03-12 00:00:00','KOFQ3044'),
(66,1,'4-40100','Diskon Penjualan',4,13,'Pendapatan',NULL,1,1,1,'2021-03-12 00:00:00','GI26RS66'),
(67,1,'4-40200','Retur Penjualan',4,13,'Pendapatan',NULL,1,1,1,'2021-03-12 00:00:00','GQEN0GEE'),
(68,1,'4-40201','Pendapatan Belum Ditagih',1,13,'Pendapatan',NULL,1,1,1,'2021-03-12 00:00:00','ONZRBVGG'),
(69,1,'5-50000','Harga Pokok Penjualan',5,15,'Harga Pokok Penjualan',NULL,1,1,1,'2021-03-12 00:00:00','N4MLY555'),
(70,1,'5-50100','Diskon Pembelian',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','AGEYKUYY'),
(71,1,'5-50200','Retur Pembelian',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','TOWNL9UU'),
(72,1,'5-50300','Pengiriman & Pengangkutan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','3SN3WPJJ'),
(73,1,'5-50400','Biaya Impor',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','RQY64ZHH'),
(74,1,'5-50500','Biaya Produksi',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','O3BDIVWW'),
(75,1,'6-60000','Biaya Penjualan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','G2JULRR'),
(76,1,'6-60001','   Iklan & Promosi',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','9Q4LJOWW'),
(77,1,'6-60002','   Komisi & Fee',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','ZKDZ9N00'),
(78,1,'6-60003','   Bensin, Tol dan Parkir - Penjualan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','JLPUNPII'),
(79,1,'6-60004','   Perjalanan Dinas - Penjualan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','ATVT2KUU'),
(80,1,'6-60005','   Komunikasi - Penjualan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','6L5GEWII'),
(81,1,'6-60006','   Marketing Lainnya',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','C0EX4933'),
(82,1,'6-60100','Biaya Umum & Administratif',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','1JWEEY'),
(83,1,'6-60101','   Beban Gaji',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','HMN1FZ77'),
(84,1,'6-60102','   Upah',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','4V37K977'),
(85,1,'6-60103','   Makanan & Transportasi',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','GBDDG0JJ'),
(86,1,'6-60104','   Lembur',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','8EJ7OW99'),
(87,1,'6-60105','   Pengobatan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','Y21VCNLL'),
(88,1,'6-60106','   THR & Bonus',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','4OOI0C66'),
(89,1,'6-60107','   Jamsostek',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','3XQD0E33'),
(90,1,'6-60108','   Insentif',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','W5PNQ9CC'),
(91,1,'6-60109','   Pesangon',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','11BBNP'),
(92,1,'6-60110','   Manfaat dan Tunjangan Lain',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','3QVAHF11'),
(93,1,'6-60200','   Donasi',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','4DCW3PVV'),
(94,1,'6-60201','   Hiburan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','0EZB9OCC'),
(95,1,'6-60202','   Bensin, Tol dan Parkir - Umum',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','ODB8SKHH'),
(96,1,'6-60203','   Perbaikan & Pemeliharaan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','F744CMII'),
(97,1,'6-60204','   Perjalanan Dinas - Umum',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','ZGWS2Z33'),
(98,1,'6-60205','   Makanan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','95XW2JVV'),
(99,1,'6-60206','   Komunikasi - Umum',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','C7EYGG66'),
(100,1,'6-60207','   Iuran & Langganan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','J6C2KJJ'),
(101,1,'6-60208','   Asuransi',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','1US5SPBB'),
(102,1,'6-60209','   Legal & Profesional',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','CW6YD533'),
(103,1,'6-60210','   Beban Manfaat Karyawan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','FY9FEAWW'),
(104,1,'6-60211','   Sarana Kantor',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','Z4LXDL66'),
(105,1,'6-60212','   Pelatihan & Pengembangan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','IJPE4Z33'),
(106,1,'6-60213','   Beban Piutang Tak Tertagih',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','3L76FSS'),
(107,1,'6-60214','   Pajak dan Perizinan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','UD2OGC44'),
(108,1,'6-60215','   Denda',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','Z36Y96YY'),
(109,1,'6-60217','   Listrik',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','IX3S9766'),
(110,1,'6-60218','   Air',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','OFX17FUU'),
(111,1,'6-60219','   IPL',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','7259A4YY'),
(112,1,'6-60220','   Langganan Software',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','TK9649UU'),
(113,1,'6-60300','   Beban Kantor',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','9NZ8HLWW'),
(114,1,'6-60301','   Alat Tulis Kantor & Printing',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','8N6RW177'),
(115,1,'6-60302','   Bea Materai',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','OC6LS7RR'),
(116,1,'6-60303','   Keamanan dan Kebersihan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','QTZ8XMM'),
(117,1,'6-60304','   Supplies dan Material',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','RC7GLHQQ'),
(118,1,'6-60305','   Pemborong',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','MPFEO811'),
(119,1,'6-60400','   Biaya Sewa - Bangunan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','PSOP6XOO'),
(120,1,'6-60401','   Biaya Sewa - Kendaraan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','7K6Z7LXX'),
(121,1,'6-60402','   Biaya Sewa - Operasional',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','BHYS3ZEE'),
(122,1,'6-60403','   Biaya Sewa - Lain - lain',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','RQ7AU5XX'),
(123,1,'6-60500','   Penyusutan - Bangunan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','MHXRGTT'),
(124,1,'6-60501','   Penyusutan - Perbaikan Bangunan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','G8CEWDGG'),
(125,1,'6-60502','   Penyusutan - Kendaraan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','1IO60U55'),
(126,1,'6-60503','   Penyusutan - Mesin & Peralatan',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','LMEPJC99'),
(127,1,'6-60504','   Penyusutan - Peralatan Kantor',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','FF3DCAOO'),
(128,1,'6-60599','   Penyusutan - Aset Sewa Guna Usaha',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','FFKE0M33'),
(129,1,'6-60600','   Amortisasi : Hak Merek Dagang',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','6ZGFMO99'),
(130,1,'6-60601','   Amortisasi : Hak Cipta',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','XMRZ85II'),
(131,1,'6-60602','   Amortisasi : Good Will',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','9ZG7XWKK'),
(132,1,'6-60216','Pengeluaran Barang Rusak',5,16,'Beban',NULL,1,1,1,'2021-03-12 00:00:00','SCKQN7GG'),
(133,1,'7-70000','Pendapatan Bunga - Bank',4,14,'Pendapatan Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','2KYD04OO'),
(134,1,'7-70001','Pendapatan Bunga - Deposito',4,14,'Pendapatan Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','719B98CC'),
(135,1,'7-70002','Pembulatan',4,14,'Pendapatan Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','7A730Z22'),
(136,1,'7-70099','Pendapatan Lain - lain',4,14,'Pendapatan Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','0LUXUMTT'),
(137,1,'8-80000','Beban Bunga',5,17,'Beban Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','8YZZ2XSS'),
(138,1,'8-80001','Provisi',5,17,'Beban Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','7RFFFN33'),
(139,1,'8-80002','Laba (Rugi) Pelepasan Aset Tetap',3,12,'Ekuitas',NULL,1,1,1,'2021-03-12 00:00:00','Z4E4WDRR'),
(140,1,'8-80100','Penyesuaian Persediaan',5,17,'Beban Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','B6INTB99'),
(141,1,'8-80999','Beban Lain - lain',5,17,'Beban Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','Y07N3VWW'),
(142,1,'9-90000','Beban Pajak - Kini',5,17,'Beban Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','FIQS65WW'),
(143,1,'9-90001','Beban Pajak - Tangguhan',5,17,'Beban Lainnya',NULL,1,1,1,'2021-03-12 00:00:00','5UBCFJUU'),
(144,1,'1-10201','Persediaan Barang Setengah Jadi',1,4,'Persediaan',NULL,1,1,1,'2021-03-27 10:55:00','ZYWPKKJJ'),
(145,1,'1-10202','Persediaan Barang Jadi',1,4,'Persediaan',NULL,1,1,1,'2021-03-27 10:55:02','02VDCV99'),
(146,1,'4-40001','Pendapatan Jasa',4,13,'Pendapatan',NULL,1,1,1,'2021-03-12 00:00:00','KOFQ3045'),
(147,1,'4-40101','Voucher Penjualan',4,14,'Pendapatan Lainnya',NULL,1,1,1,'2023-02-13 23:07:58','GI26RS68');

/*Data for the table `branchs_specialists_accounts_maps` */

insert  into `branchs_specialists_accounts_maps`(`account_map_id`,`account_branch_specialist_id`,`account_map_for_transaction`,`account_map_type`,`account_map_flag`,`account_map_note`,`account_map_formula`,`account_map_date_created`,`account_map_date_updated`,`account_map_session`) values 
(1,1,1,1,1,'Pembelian:COGS','C','2021-03-27 09:01:33','2021-03-27 09:01:32','N4MLY555'),
(2,1,1,2,1,'Pembelian:PpnMasukan','D','2020-12-31 09:44:07','2020-12-31 09:44:07','RDDQEK44'),
(3,1,1,3,1,'Pembelian:UangMukaPembelian',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','JBW4CYRR'),
(4,1,1,4,1,'Pembelian:ReturPembelian',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','TOWNL9UU'),
(5,1,1,5,1,'Pembelian:PengirimanPembelian',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','3SN3WPJJ'),
(6,1,2,1,1,'Penjualan:PiutangUsaha','D','2020-12-31 09:44:07','2020-12-31 09:44:07','KOFQ3044'),
(7,1,2,2,1,'Penjualan:PpnKeluaran','C','2020-12-31 09:44:07','2020-12-31 09:44:07','74CM5J99'),
(8,1,2,3,1,'Penjualan:UangMukaPenjualan',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','RVOJXM00'),
(9,1,2,4,1,'Penjualan:ReturPenjualan',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','GQEN0GEE'),
(10,1,2,5,1,'Penjualan:DiskonPenjualan',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','GI26RS66'),
(11,1,2,7,1,'Penjualan:PengirimanPenjualan','D','2020-12-31 09:48:22','2020-12-31 09:48:22','0LUXUMTT'),
(12,1,3,1,1,'Persediaan:PersediaanBarang','D','2020-12-31 09:48:22','2020-12-31 09:48:22','YOQLXM44'),
(13,1,3,2,1,'Persediaan:PersediaanBarangUmum','D','2020-12-31 09:48:22','2020-12-31 09:48:22','B6INTB99'),
(14,1,3,3,1,'Persediaan:PersediaanBarangRusak','D','2020-12-31 09:48:22','2020-12-31 09:48:22','SCKQN7GG'),
(15,1,3,4,1,'Persediaan:PersediaanBarangProduksi',NULL,'2020-12-31 09:44:07','2020-12-31 09:44:07','O3BDIVWW'),
(16,1,2,8,1,'Penjualan:PenjualanBelumDiTagih','C','2020-12-31 10:49:44','2020-12-31 10:49:45','ONZRBVGG'),
(17,1,1,6,1,'Pembelian:HutangUsahaBelumDiTagih',NULL,'2020-12-31 21:37:14','2020-12-31 21:37:17','Z03WC1OO'),
(18,1,2,6,1,'Penjualan:PiutangUsahaBelumDiTagih',NULL,'2020-12-31 21:37:16','2020-12-31 21:37:18','RZT87U00'),
(21,1,10,1,1,'Lain:Ekuitas',NULL,'2021-03-27 11:37:32','2021-03-27 11:37:32','WNOL0UZZ'),
(22,1,10,2,1,'Lain:AsetTetap',NULL,'2021-03-27 11:37:35','2021-03-27 11:37:37','CLRK3CMM'),
(23,1,4,1,1,'HutangUsaha',NULL,'2021-04-09 22:21:43','2021-04-09 22:21:47','CZ69ZOUU'),
(24,1,4,2,1,'PiutangUsaha',NULL,'2021-04-09 22:21:45','2021-04-09 22:21:48','E2Q6OBTT'),
(25,1,2,9,1,'Penjualan:VoucherPenjualan',NULL,'2023-02-13 23:06:50','2023-02-13 23:07:02','GI26RS68'),
(26,1,11,1,1,'Bayar:Cash',NULL,'2023-03-03 09:06:38','2023-03-03 09:06:38','YUCASH12'),
(27,1,11,2,1,'Bayar:Bank',NULL,'2023-03-03 09:06:38','2023-03-03 09:06:38','TRNSFER2'),
(28,1,11,3,1,'Bayar:EDC',NULL,'2023-03-03 09:06:38','2023-03-03 09:06:38','EDC34WER'),
(29,1,11,4,1,'Bayar:QRIS',NULL,'2023-03-03 09:06:38','2023-03-03 09:06:38','QRIS892E'),
(30,1,11,4,1,'Bayar:Gratis',NULL,'2023-03-03 09:06:38','2023-03-03 09:06:38','GI26RS66');

/*Data for the table `categories` */

insert  into `categories`(`category_id`,`category_type`,`category_branch_id`,`category_parent_id`,`category_code`,`category_name`,`category_url`,`category_icon`,`category_date_created`,`category_date_updated`,`category_user_id`,`category_flag`,`category_count_data`,`category_color`,`category_background`,`category_image`) values 
(1,1,1,0,NULL,'Fruits','fruits',NULL,'2020-07-24 00:00:00','2023-01-24 13:11:06',1,1,4,NULL,NULL,NULL),
(2,1,1,0,NULL,'Food','food',NULL,'2020-07-24 00:00:00','2023-01-24 13:10:47',1,1,7,NULL,NULL,NULL),
(3,1,1,0,'LL','Other','other',NULL,'2020-07-24 00:00:00','2023-01-24 13:10:58',1,1,0,NULL,NULL,NULL),
(15,2,1,0,NULL,'Bisnis','bisnis',NULL,'2020-08-01 15:09:27','2021-03-11 20:38:34',1,1,0,NULL,NULL,NULL),
(16,2,1,0,NULL,'Politik','politik',NULL,'2020-08-01 15:09:27','2020-08-01 15:09:33',1,1,0,NULL,NULL,NULL),
(17,2,1,0,NULL,'Olahraga','olahraga',NULL,'2020-08-01 15:09:27','2020-08-01 15:09:33',1,1,0,NULL,NULL,NULL),
(18,2,1,0,NULL,'Gaya Hidup','gaya-hidup',NULL,'2020-08-01 15:09:27','2020-08-01 15:09:33',1,1,0,NULL,NULL,NULL),
(19,2,1,0,NULL,'Kesehatan','kesehatan',NULL,'2020-08-01 15:09:27','2020-08-01 15:09:33',1,1,0,NULL,NULL,NULL),
(26,2,1,0,NULL,'Teknologi','teknologi','','2021-01-15 23:07:17','2021-01-15 23:07:17',11,1,0,NULL,NULL,NULL),
(27,1,1,0,NULL,'Dessert','dessert',NULL,'2021-04-21 10:50:34','2023-01-24 13:10:37',1,0,0,NULL,NULL,NULL),
(28,1,1,0,NULL,'Snack','snack',NULL,'2021-04-21 10:50:34','2023-01-24 13:11:37',1,1,3,NULL,NULL,NULL),
(29,1,1,0,NULL,'Drink','drink',NULL,'2021-04-21 10:51:36','2023-01-24 13:10:28',1,1,6,NULL,NULL,NULL),
(30,1,1,0,NULL,'Vegetable','vegetable',NULL,'2021-04-21 10:50:34','2023-01-24 13:11:14',1,1,0,NULL,NULL,NULL),
(31,2,1,0,NULL,'Kuliner','kuliner',NULL,'2021-05-10 09:15:19','2021-05-10 09:15:19',1,1,0,NULL,NULL,NULL),
(32,2,1,0,NULL,'Traveling','traveling',NULL,'2021-05-10 09:15:28','2021-05-10 09:15:28',1,1,0,NULL,NULL,NULL),
(33,2,1,0,NULL,'Finance','finance',NULL,'2021-05-10 09:16:04','2021-05-10 09:16:04',1,1,0,NULL,NULL,NULL),
(34,1,0,0,NULL,'Baru','baru',NULL,'2021-05-16 22:05:45','2021-05-16 22:05:45',1,0,0,NULL,NULL,NULL),
(35,2,1,0,NULL,'Trending','trending',NULL,'2021-05-18 09:07:25','2021-05-18 09:07:25',1,1,0,NULL,NULL,NULL),
(36,2,1,0,NULL,'Hot News','hot-news',NULL,'2021-05-18 09:07:34','2021-05-18 09:07:34',1,1,0,NULL,NULL,NULL),
(37,2,1,0,NULL,'Popular','popular',NULL,'2021-05-18 09:07:44','2021-05-18 09:07:44',1,1,0,NULL,NULL,NULL),
(38,3,1,0,NULL,'Whatsapp','whatsapp',NULL,'2021-06-05 20:42:58','2021-06-05 20:43:01',1,1,0,NULL,NULL,NULL),
(39,4,1,0,NULL,'Personal',NULL,NULL,'2023-01-24 14:17:12',NULL,1,1,1,NULL,NULL,NULL),
(40,4,1,0,NULL,'Rumah',NULL,NULL,'2023-01-24 14:17:12',NULL,1,0,0,NULL,NULL,NULL),
(41,4,1,0,NULL,'Agennya','agennya',NULL,'2023-01-24 14:17:12','2023-05-24 22:33:29',1,0,1,NULL,NULL,NULL),
(42,1,1,0,NULL,'Bahan Baku','bahan-baku',NULL,'2023-05-22 21:37:43','2023-05-22 21:37:43',2,1,0,NULL,NULL,NULL);

/*Data for the table `contacts` */

insert  into `contacts`(`contact_id`,`contact_branch_id`,`contact_type`,`contact_type_name`,`contact_category_id`,`contact_code`,`contact_name`,`contact_address`,`contact_phone_1`,`contact_phone_2`,`contact_email_1`,`contact_email_2`,`contact_company`,`contact_image`,`contact_url`,`contact_gender`,`contact_birth_city_id`,`contact_birth_city_name`,`contact_birth_date`,`contact_user_id`,`contact_account_receivable_account_id`,`contact_account_payable_account_id`,`contact_date_created`,`contact_date_updated`,`contact_flag`,`contact_identity_type`,`contact_identity_number`,`contact_fax`,`contact_npwp`,`contact_handphone`,`contact_note`,`contact_visitor`,`contact_parent_id`,`contact_parent_name`,`contact_city_id`,`contact_province_id`,`contact_session`,`contact_ascii`,`contact_termin`,`contact_payable_limit`,`contact_payable_running`,`contact_payable_paid`,`contact_payable_balance`,`contact_receivable_limit`,`contact_receivable_running`,`contact_receivable_paid`,`contact_receivable_balance`,`contact_use_type`,`contact_group_session`) values 
(1,1,'1','-',NULL,'SP01','Supplier 1 Demo','Jln M No 21','628989900148',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,4,40,'2022-01-04 09:54:03','2023-02-05 16:04:10',1,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,83,'14',20000.00,2000000.00,200000.00,1800000.00,0.00,0.00,0.00,0.00,0,NULL),
(2,1,'1','-',NULL,'SP02','Supplier 2 Demo','-','628989900148',NULL,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,4,40,'2022-01-04 12:30:06','2022-01-23 20:01:05',1,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,83,'0',0.00,15000.00,0.00,15000.00,0.00,0.00,0.00,0.00,0,NULL),
(3,1,'2','-',41,'CS01','Customer 1 Demo','-','628989900148',NULL,'joceline.putra@gmail.com',NULL,NULL,NULL,'customer-1-demo',NULL,NULL,NULL,NULL,1,4,40,'2022-01-04 12:42:08','2023-05-23 21:05:46',1,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,67,'0',0.00,0.00,0.00,0.00,0.00,1672600.00,1657000.00,15600.00,0,NULL),
(4,1,'2','-',NULL,'CS02','Customer 2 Demo','-','628989900148',NULL,'sales@umbrella.co.id',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,4,40,'2022-01-04 13:28:57','2023-01-24 20:40:44',1,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,67,'14',0.00,0.00,0.00,0.00,0.00,146000.00,146000.00,0.00,0,NULL),
(5,1,'3','-',NULL,'KR01','Karyawan 1 Demo','-','628989900148',NULL,'-',NULL,NULL,NULL,'karyawan-1-demo',NULL,NULL,NULL,NULL,1,0,0,'2023-02-28 08:53:14','2023-08-07 11:43:24',1,'1','126',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,75,'0',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,1,NULL),
(6,1,'3','-',NULL,'KR02','Karyawan 2 Demo','-','628989900148',NULL,'-',NULL,NULL,NULL,'karyawan-2-demo',NULL,NULL,NULL,NULL,1,4,40,'2023-02-28 08:53:15','2023-08-07 11:42:32',1,'1','123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,75,'0',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,1,NULL);

/*Data for the table `devices` */

/*Data for the table `files` */

/*Data for the table `flows` */

/*Data for the table `journals` */

/*Data for the table `journals_items` */

/*Data for the table `links` */

/*Data for the table `links_hits` */

/*Data for the table `locations` */

insert  into `locations`(`location_id`,`location_branch_id`,`location_user_id`,`location_code`,`location_name`,`location_address`,`location_note`,`location_date_created`,`location_date_updated`,`location_flag`,`location_session`,`location_lat`,`location_lng`,`location_allow_radius`) values 
(1,1,1,'001','Bisnis Anda',NULL,NULL,'2021-05-18 08:54:27','2022-05-06 21:52:04',1,NULL,NULL,NULL,NULL),
(13,1,NULL,NULL,'Bisnis Anda',NULL,NULL,'2024-08-02 14:49:09',NULL,1,'PJE1LPHZ6K4HVOH5WT76',NULL,NULL,NULL);

/*Data for the table `menus` */

insert  into `menus`(`menu_id`,`menu_parent_id`,`menu_name`,`menu_icon`,`menu_link`,`menu_sorting`,`menu_date_created`,`menu_flag`,`menu_user_id`,`menu_session`) values 
(5,39,'Penjualan','fas fa-folder-open','sales/sell',3,'2020-04-29 09:09:43',1,1,NULL),
(6,39,'Retur Jual','fas fa-folder-open','sales/return',4,'2020-04-29 09:09:43',1,1,NULL),
(7,40,'Purchase Order','fas fa-folder-open','purchase/order',2,'2020-04-29 09:09:43',1,1,NULL),
(8,40,'Pembelian','fas fa-folder-open','purchase/buy',3,'2020-04-29 09:09:43',1,1,NULL),
(9,40,'Retur Beli','fas fa-folder-open','purchase/return',4,'2020-04-29 09:09:43',1,1,NULL),
(10,41,'Transfer Stok','fas fa-file-alt','inventory/stock_transfer',1,'2020-04-29 09:09:43',1,1,NULL),
(11,43,'Terima Uang','fas fa-file-alt','finance/cash_in',1,'2020-04-29 09:09:43',1,1,NULL),
(12,43,'Biaya','fas fa-file-alt','finance/cost_out',2,'2020-04-29 09:09:43',1,1,NULL),
(13,40,'Bayar Hutang Beli','fas fa-folder-open','finance/account_payable',5,'2020-04-29 09:09:43',1,1,NULL),
(14,39,'Bayar Piutang Jual','fas fa-folder-open','finance/account_receivable',5,'2020-04-29 09:09:43',1,1,NULL),
(15,43,'Jurnal Umum','fas fa-file-alt','finance/general_journal',5,'2020-04-29 09:09:43',1,1,NULL),
(16,45,'Produk','fas fa-boxes','product/product',1,'2020-04-29 09:26:29',1,1,NULL),
(17,45,'Inventaris','fas fa-hands','asset',2,'2020-04-29 09:26:29',0,1,NULL),
(22,46,'Satuan',NULL,'reference/unit',4,'2020-04-29 09:26:29',1,1,NULL),
(23,45,'Gudang','fas fa-warehouse','product/warehouse',3,'2020-04-29 09:26:29',1,1,NULL),
(27,47,'Supplier','fas fa-user-tie','contact/supplier',1,'2020-04-29 09:26:29',1,1,NULL),
(28,47,'Customer','fas fa-user-tag','contact/customer',2,'2020-04-29 09:26:29',1,1,NULL),
(29,49,'User','fas fa-diagnoses','user',3,'2020-04-29 09:26:29',1,1,NULL),
(30,49,'Akun Perkiraan','fas fa-balance-scale','configuration/account',4,'2020-04-29 09:26:29',1,1,NULL),
(32,41,'Stok Opname','fas fa-file-alt','inventory/stock_opname',2,'2020-05-06 02:56:05',1,1,NULL),
(35,39,'Sales Order','fas fa-folder-open','sales/order',2,'2020-04-29 09:09:43',1,1,NULL),
(36,46,'Ruangan',NULL,'reference/room',7,'2020-07-22 00:00:00',1,1,NULL),
(38,0,'Kasir','fas fa-wallet',NULL,1,'2024-07-26 21:47:36',1,1,NULL),
(39,0,'Penjualan','fas fa-cash-register',NULL,3,'2020-07-25 11:07:13',1,1,NULL),
(40,0,'Pembelian','fas fa-shopping-basket',NULL,2,'2020-07-25 11:07:13',1,1,NULL),
(41,0,'Inventory','fas fa-warehouse',NULL,4,'2020-07-25 11:07:13',1,1,NULL),
(43,0,'Keuangan','fas fa-money-bill-wave',NULL,6,'2020-07-25 11:07:13',1,1,NULL),
(44,0,'Laporan','fas fa-window-restore',NULL,7,'2020-07-25 11:07:13',1,1,NULL),
(45,0,'Produk','fas fa-th',NULL,8,'2020-07-25 11:07:13',1,1,NULL),
(46,0,'Referensi','fas fa-toolbox',NULL,10,'2020-07-25 11:07:13',1,1,NULL),
(47,0,'Kontak','fas fa-id-card',NULL,9,'2020-07-25 11:07:13',1,1,NULL),
(49,0,'Pengaturan','fas fa-cogs',NULL,12,'2020-07-25 11:07:13',1,1,NULL),
(50,0,'Tools','fas fa-object-ungroup',NULL,13,'2020-08-01 15:16:27',0,1,NULL),
(55,43,'Kirim Uang','fas fa-file-alt','finance/cash_out',NULL,'2020-11-08 19:20:15',0,NULL,NULL),
(56,43,'Transfer Uang','fas fa-file-alt','finance/bank_statement',NULL,'2020-11-08 19:28:11',1,NULL,NULL),
(58,47,'Karyawan','fas fa-id-card-alt','contact/employee',3,'2021-02-25 10:56:54',1,1,NULL),
(62,49,'Cabang','fas fa-archway','configuration/branch',2,'2021-02-25 11:27:12',1,1,NULL),
(66,38,'Point Of Sales','fas fa-folder-open','sales/pos',1,'2021-03-09 22:58:44',1,NULL,NULL),
(70,41,'Produksi','fas fa-industry','manufacture/production',NULL,'2021-03-28 19:08:45',1,1,NULL),
(71,50,'Blog','fas fa-newspaper','article/article',3,'2021-04-25 22:52:34',0,1,NULL),
(72,50,'Pesan',NULL,'message',1,'2021-06-07 09:56:16',0,NULL,NULL),
(73,41,'Pemakaian Produk','fas fa-sign-in-alt','inventory/goods_out',NULL,'2021-06-21 08:01:42',1,NULL,NULL),
(74,41,'Pemasukan Bahan','fas fa-truck-moving','inventory/goods_in',NULL,'2021-06-21 08:01:52',0,NULL,NULL),
(78,44,'Bisnis',NULL,'report/finance',1,'2022-01-26 08:45:32',1,1,NULL),
(79,44,'Pembelian',NULL,'report/purchase',2,'2022-01-26 08:49:14',1,1,NULL),
(80,44,'Penjualan',NULL,'report/sales',3,'2022-01-26 08:49:26',1,1,NULL),
(81,44,'Produksi',NULL,'report/production',4,'2022-01-26 08:49:39',1,1,NULL),
(82,44,'Stok',NULL,'report/inventory',5,'2022-01-26 08:49:51',1,1,NULL),
(84,46,'Label',NULL,'reference/label',NULL,'2022-03-15 08:21:15',1,NULL,NULL),
(85,46,'Pajak',NULL,'reference/tax',NULL,'2022-05-26 19:18:42',1,NULL,NULL),
(87,50,'Printer',NULL,'reference/printer',5,'2022-08-05 18:56:16',0,1,NULL),
(89,45,'Voucher','fas fa-filter','product/voucher',4,'2023-02-03 11:07:08',1,NULL,NULL);

/*Data for the table `messages` */

/*Data for the table `mutations` */

/*Data for the table `news` */

/*Data for the table `orders` */

/*Data for the table `orders_items` */

/*Data for the table `print_spoilers` */

/*Data for the table `printers` */

/*Data for the table `products` */

insert  into `products`(`product_id`,`product_branch_id`,`product_category_id`,`product_ref_id`,`product_type`,`product_barcode`,`product_code`,`product_name`,`product_unit`,`product_note`,`product_price_buy`,`product_price_sell`,`product_min_stock_limit`,`product_max_stock_limit`,`product_fee_1`,`product_fee_2`,`product_manufacture`,`product_image`,`product_url`,`product_user_id`,`product_date_created`,`product_date_updated`,`product_flag`,`product_stock`,`product_with_stock`,`product_buy_account_id`,`product_sell_account_id`,`product_inventory_account_id`,`product_visitor`,`product_city_id`,`product_province_id`,`product_square_size`,`product_building_size`,`product_bedroom`,`product_bathroom`,`product_garage`,`product_contact_id`,`product_price_promo`,`product_address`,`product_dimension_size`,`product_latitude`,`product_longitude`,`product_reminder`,`product_reminder_date`,`product_asset_name`,`product_asset_code`,`product_asset_note`,`product_asset_acquisition_date`,`product_asset_acquisition_value`,`product_asset_dep_flag`,`product_asset_dep_method`,`product_asset_dep_period`,`product_asset_dep_percentage`,`product_asset_fixed_account_id`,`product_asset_cost_account_id`,`product_asset_depreciation_account_id`,`product_asset_accumulated_depreciation_account_id`,`product_asset_accumulated_depreciation_value`,`product_asset_accumulated_depreciation_date`) values 
(1,1,28,0,1,'38KWJOH2','20230526121242','Produk A','Pcs',NULL,1000.00,2500.00,'10','0','0','0',NULL,NULL,'produk-a',1,'2023-03-09 12:03:00','2023-03-09 12:03:00',1,0.00,1,69,65,7,'0',NULL,NULL,0,0,'0','0','0',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(2,1,28,0,1,'38KWJOH4','20230526121243','Produk B','Pcs',NULL,2000.00,3500.00,'10','0','0','0',NULL,NULL,'produk-b',1,'2023-03-09 12:03:10','2023-03-09 12:03:10',1,0.00,1,69,65,7,'0',NULL,NULL,0,0,'0','0','0',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,1,28,0,2,'Q7FC5D5A','20230526121244','Jasa Ongkos Kirim','Unit',NULL,5000.00,5000.00,'0','0','0','0',NULL,NULL,'ongkos-kirim',1,'2023-03-09 12:03:22','2023-03-09 12:03:22',1,0.00,0,69,65,7,'0',NULL,NULL,0,0,'0','0','0',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Data for the table `products_items` */

/*Data for the table `products_prices` */

/*Data for the table `products_recipes` */

/*Data for the table `recipients` */

/*Data for the table `recipients_groups` */

/*Data for the table `references` */

insert  into `references`(`ref_id`,`ref_branch_id`,`ref_parent_id`,`ref_type`,`ref_code`,`ref_name`,`ref_note`,`ref_user_id`,`ref_date_created`,`ref_date_updated`,`ref_flag`,`ref_color`,`ref_background`,`ref_icon`,`ref_use_type`) values 
(425,NULL,NULL,6,'INV-K','Kendaraan (Motor, Mobil, Truk)',NULL,NULL,'2020-05-06 02:33:22',NULL,1,NULL,NULL,NULL,NULL),
(426,NULL,NULL,6,'INV-G','Gedung (Bangunan, Rumah)',NULL,NULL,'2020-05-06 02:33:22',NULL,1,NULL,NULL,NULL,NULL),
(427,NULL,NULL,6,'INV-T','Tanah',NULL,NULL,'2020-05-06 02:33:22',NULL,1,NULL,NULL,NULL,NULL),
(428,NULL,NULL,6,'INV-P','Peralatan Kantor (Komputer, Meja, Kursi, AC, Kipas)',NULL,NULL,'2021-03-02 00:19:44','2021-03-02 00:21:01',1,NULL,NULL,NULL,NULL),
(460,1,477,7,'R001','Meja 01',NULL,1,'2021-05-14 22:50:13','2023-09-01 10:43:14',1,NULL,NULL,'fas fa-lock',0),
(461,1,477,7,'R002','Meja 02',NULL,1,'2021-05-14 22:50:18','2023-03-15 12:48:06',1,NULL,NULL,'fas fa-lock',0),
(462,NULL,NULL,8,NULL,'0','Cash(COD)',1,'2022-01-26 17:16:46','2022-01-26 17:16:50',1,NULL,NULL,NULL,NULL),
(463,NULL,NULL,8,NULL,'7','7 Hari',1,'2022-01-26 17:17:53',NULL,1,NULL,NULL,NULL,NULL),
(464,NULL,NULL,8,NULL,'14','14 Hari',1,'2022-01-26 17:18:00',NULL,1,NULL,NULL,NULL,NULL),
(465,NULL,NULL,8,NULL,'30','30 Hari',1,'2022-01-26 17:18:02',NULL,1,NULL,NULL,NULL,NULL),
(466,NULL,NULL,8,NULL,'60','60 Hari',1,'2022-01-26 17:18:04',NULL,1,NULL,NULL,NULL,NULL),
(467,NULL,NULL,8,NULL,'90','90 Hari',1,'2022-01-26 17:18:08',NULL,1,NULL,NULL,NULL,NULL),
(468,NULL,NULL,9,NULL,'Tercetak','fas fa-file',1,'2022-03-15 08:56:23','2022-04-17 22:37:12',1,'white','#ff6fab',NULL,NULL),
(469,NULL,NULL,9,NULL,'Penting','fas fa-star',1,'2022-03-15 09:01:07','2022-03-15 09:29:56',1,'#434141','#ede313',NULL,NULL),
(470,NULL,NULL,9,NULL,'Progress','fas fa-handshake',1,'2022-03-15 09:30:43','2022-03-15 09:30:43',1,'white','#ec8442',NULL,NULL),
(471,NULL,NULL,9,NULL,'Belum Dikirim','fas fa-truck-loading',1,'2022-03-15 09:31:32','2022-03-15 09:31:32',1,'white','#5b74d8',NULL,NULL),
(472,1,477,7,'R002','Meja 03',NULL,NULL,'2023-01-11 14:28:45','2023-03-15 12:47:10',1,NULL,NULL,'fas fa-lock',0),
(473,1,477,7,NULL,'Meja 04',NULL,NULL,'2023-01-11 14:28:48','2023-03-15 12:59:52',1,NULL,NULL,'fas fa-lock',0),
(474,1,478,7,NULL,'Meja 05',NULL,NULL,'2023-01-11 14:28:49',NULL,1,NULL,NULL,'fas fa-lock',0),
(475,1,478,7,NULL,'Meja 06',NULL,NULL,'2023-01-11 14:28:51',NULL,1,NULL,NULL,'fas fa-lock',1),
(476,1,478,7,NULL,'Meja 07',NULL,NULL,'2023-01-15 08:59:53',NULL,1,NULL,NULL,'fas fa-lock',0),
(477,1,NULL,7,NULL,'Non-Smooking',NULL,NULL,'2023-01-15 08:59:53','2023-03-13 10:55:16',1,NULL,NULL,'fas fa-lock',0),
(478,1,NULL,7,NULL,'Smoking Area',NULL,NULL,'2023-01-15 08:59:53',NULL,1,NULL,NULL,'fas fa-lock',0),
(479,1,NULL,7,NULL,'Take Away',NULL,2,'2023-03-09 19:37:59','2023-03-12 22:06:37',1,NULL,NULL,'fas fa-lock',0);

/*Data for the table `surveys` */

/*Data for the table `taxs` */

insert  into `taxs`(`tax_id`,`tax_name`,`tax_percent`,`tax_decimal_0`,`tax_decimal_1`,`tax_flag`,`tax_date_created`,`tax_date_updated`,`tax_session`) values 
(1,'Non Ppn',0.00,0,NULL,2,'2024-08-02 14:49:18',NULL,'DFNQHY1V4KBNYIGGLCO3'),
(2,'Ppn 10%',10.00,0.1,NULL,0,'2024-08-02 14:49:18','2023-06-13 22:09:31','2P6C1O7KYT10258D1NXG'),
(3,'Ppn 11%',11.00,0.11,NULL,1,'2024-08-02 14:49:18','2023-06-27 18:28:34','79F53Q69G0QKDUUE9PKE'),
(4,'Ppn 15%',15.00,0.15,NULL,4,'2024-08-02 14:49:18','2023-08-22 22:55:36','3SJ15C2W5OPAZSOTR53L');

/*Data for the table `tests` */

/*Data for the table `trans` */

/*Data for the table `trans_items` */

/*Data for the table `types` */

insert  into `types`(`type_id`,`type_for`,`type_type`,`type_name`,`type_doc`,`type_flag`,`type_date_created`) values 
(1,1,1,'Purchase Order','PurchaseOrder',1,'2021-05-22 10:16:42'),
(2,1,2,'Sales Order','SalesOrder',1,'2021-05-22 10:16:42'),
(3,1,3,'Penawaran Pembelian','PenawaranBeli',1,'2021-05-22 10:16:42'),
(4,1,4,'Penawaran Penjualan','PenawaranJual',1,'2021-05-22 10:16:42'),
(5,1,5,'CheckUp Medicine','CheckUpMed',1,'2021-05-22 10:16:42'),
(6,1,6,'CheckUp Laboratory','CheckUpLab',1,'2021-05-22 10:16:42'),
(7,2,1,'Pembelian','Pembelian',1,'2021-05-22 10:16:42'),
(8,2,2,'Penjualan','Invoice',1,'2021-05-22 10:16:42'),
(9,2,3,'Retur Pembelian','ReturBeli',1,'2021-05-22 10:16:42'),
(10,2,4,'Retur Penjualan','ReturJual',1,'2021-05-22 10:16:42'),
(11,2,5,'Transfer Stok','TransferStok',1,'2021-05-22 10:16:42'),
(12,2,6,'Stok Opname','StokOpnamePlus',1,'2021-05-22 10:16:42'),
(13,3,1,'Bayar Hutang','BayarHutang',1,'2021-05-22 10:16:42'),
(14,3,2,'Bayar Piutang','BayarPiutang',1,'2021-05-22 10:16:42'),
(15,3,3,'Terima Kas','TerimaUang',1,'2021-05-22 10:16:42'),
(16,3,4,'Biaya','Biaya',1,'2021-05-22 10:16:42'),
(17,3,5,'Transfer Uang','TransferBank',1,'2021-05-22 10:16:42'),
(18,3,6,'Uang Muka Beli','UangMukaBeli',1,'2021-05-22 10:16:42'),
(19,3,7,'Uang Muka Jual','UangMukaJual',1,'2021-05-22 10:16:42'),
(20,3,8,'Jurnal Umum','JurnalUmum',1,'2021-05-22 10:16:42'),
(21,3,9,'Kirim Uang','KirimUang',1,'2021-05-22 10:16:42'),
(22,3,10,'Pembelian',NULL,1,'2021-05-22 10:16:42'),
(23,3,11,'Penjualan',NULL,1,'2021-05-22 10:16:42'),
(24,3,22,'Retur Pembelian',NULL,1,'2021-05-22 10:16:42'),
(25,3,23,'Retur Penjualan',NULL,1,'2021-05-22 10:16:42'),
(26,3,14,'Stok Opname',NULL,1,'2021-05-22 10:16:42'),
(27,3,15,'Stok Opname Minus',NULL,1,'2021-05-22 10:16:42'),
(28,3,16,'Asset Beli',NULL,1,'2021-05-22 10:16:42'),
(29,3,17,'Asset Susut',NULL,1,'2021-05-22 10:16:42'),
(30,3,18,'Asset Jual',NULL,1,'2021-05-22 10:16:42'),
(31,3,19,'Produksi',NULL,1,'2021-05-31 15:36:36'),
(32,2,8,'Produksi','Produksi',1,'2021-06-20 22:21:50'),
(33,2,9,'Pemakaian Barang','PemakaianBarang',1,'2021-06-20 22:22:05'),
(34,3,20,'Pemakaian Barang',NULL,1,'2021-06-20 22:22:25'),
(35,2,7,'Stok Opname Minus','StokOpnameMinus',1,'2021-06-20 22:24:37'),
(36,3,21,'Stok Opname Minus',NULL,1,'2021-06-20 22:24:55'),
(37,1,7,'Prepare','Prepare',1,'2022-02-26 01:29:54'),
(38,3,0,'Saldo Awal','SaldoAwal',1,'2022-07-01 05:53:19'),
(39,1,222,'Order','ORD',1,'2023-02-12 19:09:05'),
(40,5,1,'Supplier','SP',1,'2023-05-25 21:12:39'),
(41,5,2,'Customer','CS',1,'2023-05-25 21:12:39'),
(42,5,3,'Karyawan','KR',1,'2023-05-25 21:12:40');

/*Data for the table `types_paids` */

insert  into `types_paids`(`paid_id`,`paid_name`,`paid_note`,`paid_image`,`paid_flag`,`paid_date_created`) values 
(1,'Cash','Tunai / Cash','upload/type_paid/cash1.png',1,'2023-01-15 18:46:13'),
(2,'Transfer Bank',NULL,'upload/type_paid/tf1.png',1,'2023-01-15 18:46:13'),
(3,'EDC Card','Kartu Debit / Kredit (Electronic Data Center)','upload/type_paid/edc1.png',1,'2023-01-15 18:46:13'),
(4,'Gratis',NULL,'upload/type_paid/free1.png',1,'2023-01-15 18:46:13'),
(5,'QRIS',NULL,'upload/type_paid/qr1.png',1,'2023-01-15 18:46:13'),
(6,'Link Payment','Vendor (Xendit.co)',NULL,0,'2023-01-15 18:46:13'),
(7,'eWallet','Vendor (Xendit.co)',NULL,0,'2023-01-18 14:31:23');

/*Data for the table `units` */

insert  into `units`(`unit_id`,`unit_user_id`,`unit_branch_id`,`unit_name`,`unit_note`,`unit_qty`,`unit_date_created`,`unit_date_updated`,`unit_flag`) values 
(1,1,1,'pcs',NULL,'1','2020-04-29 00:00:00','2021-03-02 00:22:09',1),
(2,1,1,'box',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',0),
(3,1,1,'unit',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(4,1,1,'buah',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(5,1,1,'gram',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(6,1,1,'mg',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(7,1,1,'kg',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(8,1,1,'mm',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(9,1,1,'cm',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(10,1,1,'mtr',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(11,1,1,'km',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(12,1,1,'dos',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1),
(13,1,1,'galon',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',0),
(14,1,1,'coli',NULL,'1','2022-01-04 09:06:29','2022-01-04 09:06:29',1);

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_branch_id`,`user_user_group_id`,`user_type`,`user_code`,`user_username`,`user_fullname`,`user_place_birth`,`user_birth_of_date`,`user_gender`,`user_address`,`user_phone_1`,`user_phone_2`,`user_email_1`,`user_email_2`,`user_password`,`user_theme`,`user_date_created`,`user_date_updated`,`user_flag`,`user_activation`,`user_activation_code`,`user_date_activation`,`user_referal_code`,`user_registration_from_referal`,`user_date_last_login`,`user_session`,`user_otp`,`user_menu_style`,`user_balance`,`user_total_link`,`user_check_price_buy`,`user_check_price_sell`,`user_image`,`user_contact_id`) values 
(1,1,1,NULL,NULL,'root','Root',NULL,NULL,'L','Jogja','6281225518118',NULL,'joe.witaya@gmail.com',NULL,'63a9f0ea7bb98050796b649e85481845','black','2021-04-12 15:10:00','2024-07-12 23:52:07',1,1,'TCFF2LTF7EBSX3AGP6WVVAV7QQKOJN3Q','2020-12-15 11:55:17',NULL,NULL,'2024-07-26 22:07:55','69HC1RGSAUZ6K4FMKOEQ',755471,0,0.00,NULL,0,0,NULL,NULL),
(2,1,2,NULL,NULL,'demo','Demo',NULL,NULL,'L','Alamat','628989900148',NULL,NULL,NULL,'fe01ce2a7fbac8fafaed7c982a04e229','white','2023-02-28 09:01:09','2023-11-04 18:26:45',1,1,NULL,NULL,NULL,NULL,'2024-07-26 21:54:47','GDE9TJ956OYS65Y9UJVQ',436722,0,0.00,NULL,1,0,NULL,NULL),
(3,1,9,NULL,NULL,'kasir','Kasir',NULL,'2023-03-09',NULL,NULL,'628979761512',NULL,NULL,NULL,'c7911af3adbd12a035b289556d96470a','green','2023-03-09 13:33:37',NULL,1,1,NULL,NULL,NULL,NULL,'2024-02-23 17:57:00','7WG8CRMTM7C8OQGUVBGY',623361,0,0.00,NULL,0,0,NULL,NULL);

/*Data for the table `users_balances` */

/*Data for the table `users_groups` */

insert  into `users_groups`(`user_group_id`,`user_group_name`,`user_group_date_created`,`user_group_date_updated`,`user_group_flag`) values 
(1,'Super Administrator','2020-04-28 00:00:00','2021-04-21 10:24:57',1),
(2,'Administrator','2020-04-28 00:00:00','2021-04-21 10:24:57',1),
(3,'Director','2020-04-28 00:00:00','2021-04-21 10:24:57',1),
(4,'Manager','2020-04-28 00:00:00','2021-04-21 10:24:57',1),
(5,'Finance','2020-04-28 00:00:00','2021-04-21 10:24:57',1),
(6,'Purchasing','2020-04-28 00:00:00','2021-04-21 10:24:57',1),
(7,'Sales','2020-04-28 00:00:00','2021-04-21 10:24:57',1),
(8,'Warehouse','2020-04-28 00:00:00','2021-04-21 10:24:57',1),
(9,'Cashier','2021-04-21 10:24:55','2021-04-21 10:24:57',1);

/*Data for the table `users_menus` */

insert  into `users_menus`(`user_menu_id`,`user_menu_user_id`,`user_menu_menu_parent_id`,`user_menu_menu_id`,`user_menu_action`,`user_menu_date_created`,`user_menu_date_updated`,`user_menu_flag`) values 
(1,1,NULL,62,1,'2024-07-26 22:08:29','2024-07-26 22:08:29',1),
(2,1,NULL,29,1,'2024-07-26 22:08:30','2024-07-26 22:08:30',1),
(3,1,NULL,30,1,'2024-07-26 22:08:31','2024-07-26 22:08:31',1),
(4,1,NULL,36,1,'2024-07-26 22:08:33','2024-07-26 22:08:33',1),
(5,1,NULL,22,1,'2024-07-26 22:08:33','2024-07-26 22:08:33',1),
(6,1,NULL,84,1,'2024-07-26 22:08:34','2024-07-26 22:08:34',1),
(7,1,NULL,85,1,'2024-07-26 22:08:34','2024-07-26 22:08:34',1),
(8,1,NULL,58,1,'2024-07-26 22:08:36','2024-07-26 22:08:36',1),
(9,1,NULL,28,1,'2024-07-26 22:08:37','2024-07-26 22:08:37',1),
(10,1,NULL,27,1,'2024-07-26 22:08:38','2024-07-26 22:08:38',1),
(11,1,NULL,89,1,'2024-07-26 22:08:39','2024-07-26 22:08:39',1),
(12,1,NULL,23,1,'2024-07-26 22:08:39','2024-07-26 22:08:39',1),
(13,1,NULL,16,1,'2024-07-26 22:08:40','2024-07-26 22:08:40',1),
(14,1,NULL,82,1,'2024-07-26 22:08:43','2024-07-26 22:08:43',1),
(15,1,NULL,81,1,'2024-07-26 22:08:44','2024-07-26 22:08:44',1),
(16,1,NULL,80,1,'2024-07-26 22:08:45','2024-07-26 22:08:45',1),
(17,1,NULL,79,1,'2024-07-26 22:08:45','2024-07-26 22:08:45',1),
(18,1,NULL,78,1,'2024-07-26 22:08:47','2024-07-26 22:08:47',1),
(19,1,NULL,15,1,'2024-07-26 22:08:48','2024-07-26 22:08:48',1),
(20,1,NULL,12,1,'2024-07-26 22:08:49','2024-07-26 22:08:49',1),
(21,1,NULL,11,1,'2024-07-26 22:08:49','2024-07-26 22:08:49',1),
(22,1,NULL,56,1,'2024-07-26 22:08:50','2024-07-26 22:08:50',1),
(23,1,NULL,32,1,'2024-07-26 22:08:51','2024-07-26 22:08:51',1),
(24,1,NULL,10,1,'2024-07-26 22:08:52','2024-07-26 22:08:52',1),
(25,1,NULL,73,1,'2024-07-26 22:08:53','2024-07-26 22:08:53',1),
(26,1,NULL,70,1,'2024-07-26 22:08:53','2024-07-26 22:08:53',1),
(27,1,NULL,14,1,'2024-07-26 22:08:55','2024-07-26 22:08:55',1),
(28,1,NULL,6,1,'2024-07-26 22:08:55','2024-07-26 22:08:55',1),
(29,1,NULL,5,1,'2024-07-26 22:08:56','2024-07-26 22:08:56',1),
(30,1,NULL,35,1,'2024-07-26 22:08:57','2024-07-26 22:08:57',1),
(31,1,NULL,13,1,'2024-07-26 22:08:58','2024-07-26 22:08:58',1),
(32,1,NULL,9,1,'2024-07-26 22:08:58','2024-07-26 22:08:58',1),
(33,1,NULL,8,1,'2024-07-26 22:08:59','2024-07-26 22:08:59',1),
(34,1,NULL,7,1,'2024-07-26 22:08:59','2024-07-26 22:08:59',1),
(35,3,NULL,66,1,'2024-07-26 22:09:09','2024-07-26 22:09:09',1),
(36,2,NULL,8,1,'2024-07-26 22:09:17','2024-07-26 22:09:17',1),
(37,2,NULL,9,1,'2024-07-26 22:09:20','2024-07-26 22:09:20',1),
(38,2,NULL,13,1,'2024-07-26 22:09:21','2024-07-26 22:09:21',1),
(39,2,NULL,6,1,'2024-07-26 22:09:23','2024-07-26 22:09:23',1),
(40,2,NULL,5,1,'2024-07-26 22:09:24','2024-07-26 22:09:24',1),
(41,2,NULL,14,1,'2024-07-26 22:09:24','2024-07-26 22:09:24',1),
(42,2,NULL,73,1,'2024-07-26 22:09:28','2024-07-26 22:09:28',1),
(43,2,NULL,10,1,'2024-07-26 22:09:29','2024-07-26 22:09:29',1),
(44,2,NULL,32,1,'2024-07-26 22:09:30','2024-07-26 22:09:30',1),
(45,2,NULL,56,1,'2024-07-26 22:09:34','2024-07-26 22:09:34',1),
(46,2,NULL,11,1,'2024-07-26 22:09:34','2024-07-26 22:09:34',1),
(47,2,NULL,12,1,'2024-07-26 22:09:35','2024-07-26 22:09:35',1),
(48,2,NULL,15,1,'2024-07-26 22:09:35','2024-07-26 22:09:35',1),
(49,2,NULL,78,1,'2024-07-26 22:09:40','2024-07-26 22:09:40',1),
(50,2,NULL,79,1,'2024-07-26 22:09:41','2024-07-26 22:09:41',1),
(51,2,NULL,80,1,'2024-07-26 22:09:42','2024-07-26 22:09:42',1),
(52,2,NULL,82,1,'2024-07-26 22:09:43','2024-07-26 22:09:43',1),
(53,2,NULL,16,1,'2024-07-26 22:09:45','2024-07-26 22:09:45',1),
(54,2,NULL,23,1,'2024-07-26 22:09:46','2024-07-26 22:09:46',1),
(55,2,NULL,89,1,'2024-07-26 22:09:47','2024-07-26 22:09:47',1),
(56,2,NULL,27,1,'2024-07-26 22:09:49','2024-07-26 22:09:49',1),
(57,2,NULL,28,1,'2024-07-26 22:09:49','2024-07-26 22:09:49',1),
(58,2,NULL,58,1,'2024-07-26 22:09:50','2024-07-26 22:09:50',1),
(59,2,NULL,29,1,'2024-07-26 22:10:02','2024-07-26 22:10:02',1),
(60,2,NULL,30,1,'2024-07-26 22:10:04','2024-07-26 22:10:04',1);

/*Data for the table `vendors` */

/*Data for the table `vendors_logs` */

/*Data for the table `vouchers` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
