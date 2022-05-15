<?php
//create DB
$query = "create database blog;";

if($conn->query($query) === true){
    //use db
    $query = "use blog";
    if($conn->query($query) === true) {
        //create table user
        $query = "
            create table user
            (
                id       int auto_increment primary key,
                username varchar(255)  not null,
                password varchar(255)  not null,
                type     int default 0 null comment '0 - normal user 1 - admin -1 - disabled',
                constraint username_username_uindex
                    unique (username)
            );";
        if($conn->query($query) === true){
            //create table post
            $query = "
                create table post
                (
                    id                int auto_increment primary key,
                    title             varchar(255)                        not null,
                    content           text                                null,
                    owner_id          int                                 not null,
                    created_time      timestamp default CURRENT_TIMESTAMP not null,
                    last_updated_time timestamp default CURRENT_TIMESTAMP not null,
                    constraint blog_id_uindex
                        unique (id),
                    constraint blog_username_id_fk
                        foreign key (owner_id) references user (id)
                );";
            if($conn->query($query) === true){
                //insert user
                $query = "INSERT INTO user (username, password, type) VALUES 
                ('admin', '". password_hash("admin123", PASSWORD_DEFAULT) ."', 1),
                ('abc', '". password_hash("123", PASSWORD_DEFAULT) ."', 0)";

                if($conn->query($query) === true) {
                    $query = "INSERT INTO post (title, content, owner_id, created_time, last_updated_time) VALUES ('title', 'abc', 2, DEFAULT, DEFAULT)";

                    if ($conn->query($query) === false) {
                        echo $conn->errno;
                    }
                }
            }
        }
    }
} else{
    echo $conn->errno;
}