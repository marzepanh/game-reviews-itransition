create table category
(
    id   int auto_increment
        primary key,
    name varchar(255) not null
);

create table doctrine_migration_versions
(
    version        varchar(191) not null
        primary key,
    executed_at    datetime     null,
    execution_time int          null
)
    collate = utf8_unicode_ci;

create table review
(
    id           int auto_increment
        primary key,
    name         varchar(255)  not null,
    text         longtext      not null,
    images       varchar(255)  not null,
    author_grade decimal(2, 1) not null,
    users_grade  decimal(2, 1) not null,
    likes_amount int           not null,
    cover        varchar(255)  not null,
    author       varchar(255)  not null,
    category_id  int           not null,
    is_deleted   tinyint(1)    not null,
    constraint FK_794381C612469DE2
        foreign key (category_id) references category (id)
);

create index IDX_794381C612469DE2
    on review (category_id);

create table tags
(
    id   int auto_increment
        primary key,
    name varchar(255) not null
);

create table review_tags
(
    review_id int not null,
    tags_id   int not null,
    primary key (review_id, tags_id),
    constraint FK_8D08D93E3E2E969B
        foreign key (review_id) references review (id)
            on delete cascade,
    constraint FK_8D08D93E8D7B4FB4
        foreign key (tags_id) references tags (id)
            on delete cascade
);

create index IDX_8D08D93E3E2E969B
    on review_tags (review_id);

create index IDX_8D08D93E8D7B4FB4
    on review_tags (tags_id);

create table user
(
    id          int auto_increment
        primary key,
    email       varchar(180) not null,
    roles       longtext         not null,
    password    varchar(255) not null,
    facebook_id varchar(255) not null,
    constraint UNIQ_8D93D649E7927C74
        unique (email)
);


