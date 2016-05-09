<?php
if (!pdo_fieldexists('water_super_orders', 'detail')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_orders') . ' ADD  `detail` varchar( 500 ) NOT NULL AFTER `transid`;');
}
 if(!pdo_fieldexists('water_super_employees', 'cityid')) {
	pdo_query("ALTER TABLE ".tablename('water_super_employees')." ADD   `cityid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('water_super_employees', 'areaid')) {
	pdo_query("ALTER TABLE ".tablename('water_super_employees')." ADD  `areaid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('water_super_employees', 'city')) {
	pdo_query("ALTER TABLE ".tablename('water_super_employees')." ADD   `city` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('water_super_employees', 'area')) {
	pdo_query("ALTER TABLE ".tablename('water_super_employees')." ADD  `area` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('water_super_goods', 'danwei')) {
	pdo_query("ALTER TABLE ".tablename('water_super_goods')." ADD   `danwei` varchar(10) NOT NULL DEFAULT '件';");
} 
if(!pdo_fieldexists('water_super_orders', 'detail')) {
	pdo_query("ALTER TABLE ".tablename('water_super_orders')." ADD      `detail` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('water_super_shop', 'pczjs')) {
	pdo_query("ALTER TABLE ".tablename('water_super_shop')." ADD      `pczjs` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('water_super_shop', 'pfwfw')) {
	pdo_query("ALTER TABLE ".tablename('water_super_shop')." ADD   `pfwfw` varchar(500) NOT NULL;");
}
 if(!pdo_fieldexists('water_super_shop', 'pxctp1')) {
	pdo_query("ALTER TABLE ".tablename('water_super_shop')." ADD    `pxctp1` varchar(500) NOT NULL;");
}
 if(!pdo_fieldexists('water_super_shop', 'pxctp2')) {
	pdo_query("ALTER TABLE ".tablename('water_super_shop')." ADD   `pxctp2` varchar(500) NOT NULL;");
}
 if(!pdo_fieldexists('water_super_shop', 'iswww')) {
	pdo_query("ALTER TABLE ".tablename('water_super_shop')." ADD   `iswww` varchar(10) NOT NULL;");
}
if (!pdo_fieldexists('water_super_shop', 'smsyzmb')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . " ADD  `smsyzmb` varchar( 100 ) NOT NULL DEFAULT 'index' ;");
}
if (!pdo_fieldexists('water_super_shop', 'template')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . " ADD  `template` varchar( 50 ) NOT NULL DEFAULT 'index' ;");
}
if (!pdo_fieldexists('water_super_shop', 'imglb1')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `imglb1` varchar( 200 ) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'imglb2')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `imglb2` varchar( 200 ) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'imglb3')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `imglb3` varchar( 200 ) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'imgurl1')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `imgurl1` varchar( 500 ) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'imgurl2')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `imgurl2` varchar( 500 ) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'imgurl3')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `imgurl3` varchar( 500 ) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'yjfkurl')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `yjfkurl` varchar(100) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'recharge')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . " ADD  `recharge` varchar(100) NOT NULL DEFAULT '100-1#300-4#500-5' ;");
}
if (!pdo_fieldexists('water_super_shop', 'isygdj')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `isygdj` int(11) NOT NULL DEFAULT 0 ;');
}
if (!pdo_fieldexists('water_super_shop', 'utopayordermid')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `utopayordermid` varchar(200) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'smspwd')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `smspwd` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'smsuid')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `smsuid` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'smsdx')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `smsdx` int( 2 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'mbxx')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `mbxx` int( 2 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'fuwuname')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `fuwuname` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'ddzt0')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `ddzt0` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'ddzt1')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `ddzt1` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'ddzt2')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `ddzt2` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'ddzt3')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `ddzt3` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'ddzt4')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `ddzt4` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_shop', 'ddzt5')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD  `ddzt5` varchar( 50 ) AFTER `kefuwx`;');
}
if (!pdo_fieldexists('water_super_goods', 'isjj')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_goods') . ' ADD  `isjj` int(11) NOT NULL DEFAULT 1 AFTER `goodsphoto`;');
}

if (!pdo_fieldexists('water_super_shop', 'confirmfee')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . " ADD    `confirmfee` varchar(50) NOT NULL DEFAULT 'confirmfee';");
}
if (!pdo_fieldexists('water_super_shop', 'pfwfwurl')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD    `pfwfwurl` varchar(300) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'pczjsurl')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD    `pczjsurl` varchar(300) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'pxctp1url')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD    `pxctp1url` varchar(300) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'pxctp2url')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD    `pxctp2url` varchar(300) NOT NULL;');
}
if (!pdo_fieldexists('water_super_goods', 'scprice')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_goods') . ' ADD   `scprice` float NOT NULL;');
}
if (!pdo_fieldexists('water_super_goods', 'biaoqian')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_goods') . ' ADD    `biaoqian` varchar(100) NOT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'smsreg')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD     `smsreg` int(2) NOT NULL DEFAULT 0 ;');
}
if (!pdo_fieldexists('water_super_shop', 'MEMBER_CODE')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD     `MEMBER_CODE` varchar(32) DEFAULT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'FEYIN_KEY')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD      `FEYIN_KEY` varchar(32) DEFAULT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'DEVICE_NO')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD      `DEVICE_NO` varchar(32) DEFAULT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'qnscode')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD     `qnscode` varchar(100) DEFAULT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'qnym')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD     `qnym` varchar(100) DEFAULT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'qnak')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD     `qnak` varchar(200) DEFAULT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'qnsk')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . ' ADD     `qnsk` varchar(200) DEFAULT NULL;');
}
if (!pdo_fieldexists('water_super_shop', 'iskd')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_shop') . " ADD      `iskd` int(2) DEFAULT '0';");
}
if (!pdo_fieldexists('water_super_orders', 'shouhrdz')) {
    pdo_query('ALTER TABLE ' . tablename('water_super_orders') . " ADD    `shouhrdz` varchar(1000) DEFAULT NULL;");
}
$sql = "
CREATE TABLE IF NOT EXISTS `ims_water_super_pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) DEFAULT NULL,
  `state` int(2) DEFAULT NULL,
  `imgurl` varchar(200) DEFAULT NULL,
  `uniacid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
";
pdo_query($sql);