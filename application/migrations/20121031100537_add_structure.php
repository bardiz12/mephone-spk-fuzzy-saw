<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Structure extends CI_Migration {

    public function up()
    {
        $sql = "
            CREATE TABLE `hp` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `nama_hp` varchar(255) NOT NULL,
              `harga` int(11) NOT NULL,
              `ram` decimal(10,0) NOT NULL,
              `memori_internal` int(11) NOT NULL,
              `mp_kamera_depan` decimal(10,0) NOT NULL,
              `mp_kamera_belakang` decimal(10,0) NOT NULL,
              `core` int(11) NOT NULL,
              `baterai` int(11) NOT NULL,
              `layar` float NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
        $this->db->query($sql);

        $sql = "
            CREATE TABLE `link_youtube` (
              `id_hp` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `link_youtube` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id_hp`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ";
        $this->db->query($sql);

        $sql = "
        INSERT INTO `hp` (`id`, `nama_hp`, `harga`, `ram`, `memori_internal`, `mp_kamera_depan`, `mp_kamera_belakang`, `core`, `baterai`, `layar`)
        VALUES
            (1,'Vivo V9',4000000,4,64,24,13,8,3260,6.3),
            (2,'OPPO F7',4200000,4,64,25,16,8,3400,6.23),
            (3,'Apple iPhone 5s',1825000,1,32,1,8,2,1560,4),
            (4,'Samsung S7 Edge Dual',5761000,4,32,12,5,8,3600,5.5),
            (5,'Apple iPhone 6s',8450000,2,64,12,5,2,1715,4.7),
            (6,'Xiaomi Redmi Note 5 PRO',3000000,4,64,13,12,8,4000,5.99),
            (7,'Asus Zenfone 5 ZE620KL',5500000,6,64,12,8,8,3300,6.2),
            (8,'Asus Zenfone Max Plus (M1) ZB570TL',2800000,4,64,8,16,8,4130,5.7),
            (9,'Xiami Mi 8 Explorer',10400000,8,128,20,12,8,3000,6.21),
            (10,'Lenovo S5',2980000,4,64,16,13,8,3000,5.7),
            (11,'Motorola Moto C',700000,1,8,5,8,2,2000,5),
            (12,'Huawei Honor 2',1200000,2,16,2,8,4,2300,4.5),
            (13,'ZTE T98',950000,1,16,2,5,4,2000,7),
            (14,'Lava Iris Atom 3',450000,1,8,0,2,2,1200,4),
            (15,'Xiaomi Redmi Note 4',1999500,3,32,8,16,8,4100,5.5),
            (22,'ZTE Axon M',3120000,4,64,0,0,8,3180,5.2),
            (23,'Xiaomi Redmi 4A',1300000,2,16,5,0,8,3120,5),
            (24,'vivo V9 6GB',6950000,6,64,12,0,8,3260,6.3),
            (25,'Xiaomi Redmi 2 Prime',954000,2,16,2,0,4,2200,4.7);
            ";
        $this->db->query($sql);

        $sql = "
            INSERT INTO `link_youtube` (`id_hp`, `link_youtube`)
            VALUES
                (1,NULL),
                (2,NULL),
                (3,NULL),
                (4,NULL),
                (5,NULL),
                (6,NULL),
                (7,NULL),
                (8,NULL),
                (9,NULL),
                (10,NULL),
                (11,NULL),
                (12,NULL),
                (13,NULL),
                (14,NULL),
                (15,NULL),
                (16,NULL),
                (17,NULL),
                (18,NULL),
                (19,NULL),
                (20,NULL),
                (21,NULL),
                (22,NULL),
                (23,NULL),
                (24,NULL),
                (25,NULL);
            ";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('hp');
        $this->dbforge->drop_table('link_youtube');
    }
}
