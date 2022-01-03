DROP TABLE if exists module_sessions;
CREATE TABLE module_sessions
(
    id CHAR(40) NOT NULL PRIMARY KEY,
    expire INTEGER,
    app varchar(40) not null,
    data BLOB,
    created_at datetime
)