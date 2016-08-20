/* rbac data population */
INSERT INTO `auth_item` VALUES 
    ('admin',1,'系统管理员',NULL,NULL,1467380617,1467380617);
INSERT INTO `auth_assignment` VALUES ('admin','1',1467380617);

INSERT INTO lookup (name, code, type, position) VALUES 
    ('正常', 1, 'UserStatus', 1),
    ('冻结', 2, 'UserStatus', 2),
    ('是', 1, 'Visible', 1),
    ('否', 2, 'Visible', 2);
INSERT INTO `user_group` VALUES 
    (1,'员工','staff',0)
    ;

INSERT INTO `user` VALUES (1,'drodata','','8hR6w6ZXxqh_L9D-NfRpi68wn2Pd3gMJ','$2y$13$BnT.whUJcDH9q5vMnox2We3YtYJnv9wyUQb4vZyS6.HfA2NPIzIL.','','drodata@foxmail.com',1,1,1471423631,1471423631,0,0,0,0,'');

