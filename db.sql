CREATE DATABASE IF NOT EXISTS electricty_today;
USE electricty_today;

CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    date_published DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
