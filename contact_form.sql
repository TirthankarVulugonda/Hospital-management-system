DROP TABLE IF EXISTS contact_form;
CREATE TABLE contact_form (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  number VARCHAR(10) NOT NULL,
  date DATE NOT NULL,
  doctor VARCHAR(500) NOT NULL,
  slot VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY unique_booking (doctor, date, slot)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
