CREATE TABLE IF NOT EXISTS  `ci_session` (
    session_id varchar(40) DEFAULT '0' NOT NULL,
    ip_address varchar(16) DEFAULT '0' NOT NULL,
    user_agent varchar(120) NOT NULL,
    last_activity int(10) unsigned DEFAULT 0 NOT NULL,
    user_data text NOT NULL,
    PRIMARY KEY (session_id),
    KEY `last_activity_idx` (`last_activity`)
);


CREATE TABLE `sms_send` (
    `ss_idx` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `ss_hp` varchar(255) NOT NULL DEFAULT '' COMMENT '핸드폰 번호',
    `ss_create_date` datetime NOT NULL DEFAULT current_timestamp COMMENT '생성 일자',
    PRIMARY KEY(`ss_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT 'sms';


CREATE TABLE `fax_file_list` (
	`ffl_idx` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`ss_idx` int(11) unsigned NOT NULL,
	`ffl_name` varchar(255) NOT NULL DEFAULT '' COMMENT '파일 이름',
	`ffl_path` varchar(255) NOT NULL DEFAULT '' COMMENT '파일 경로',
	`ffl_create_date` datetime NOT NULL DEFAULT current_timestamp COMMENT '생성 일자',
	PRIMARY KEY(`ffl_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT 'fax 파일 목록';

