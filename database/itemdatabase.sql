DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Review;

-- CREATE TABLE ITEM --
CREATE TABLE Item (
    Item_id INTEGER PRIMARY KEY AUTOINCREMENT,
    Name VARCHAR(100) DEFAULT '' NOT NULL,
    Manufacturer VARCHAR(100) DEFAULT '' NOT NULL,
    Description TEXT,
    Image VARCHAR(100)
);

-- CREATE TABLE REVIEW --
CREATE TABLE Review (
    Review_id INTEGER PRIMARY KEY AUTOINCREMENT,
    Username VARCHAR(30) DEFAULT '' NOT NULL,
    Rating FLOAT,
    date DATETIME,
    reviewText TEXT,
    Item_id INTEGER REFERENCES Item(Item_id)
);

-- INSERT DATA INTO ITEM TABLE --
INSERT INTO Item VALUES (null, 'Mens Gel-1130', 'ASICS', 'Sneakers' , 'men-gels-1130.jpeg');
INSERT INTO Item VALUES (null, 'New Balance 9060', 'New Balance', 'Sneakers' , 'sunglasses.jpg');
INSERT INTO Item VALUES (null, 'Mens Gel-1130', 'ASICS', 'Sneakers' , 'men-gels-1130.jpeg');
INSERT INTO Item VALUES (null, 'Mens Gel-1130', 'ASICS', 'Sneakers' , 'men-gels-1130.jpeg');

-- INSERT DATA INTO REVIEW TABLE --