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
    Rating INT,
    date DATE,
    reviewText TEXT,
    Item_id INTEGER REFERENCES Item(Item_id)
);

-- INSERT DATA INTO ITEM TABLE --
INSERT INTO Item VALUES (null, 'Mens Gel-1130', 'ASICS', 'Spanning across decades of design evolution, the GEL-1130™ sneaker pays homage to the ninth iteration of the GEL-1000™ series. The stability running shoe from 2008 was originally inspired by the GEL-KAYANO® 14 sneaker, featuring similar aesthetics as the hero trainer. Its traditional materials have been repurposed with synthetic leather paneling to evolve the shoe with a more modern aesthetic.' , 'men-gels-1130.jpeg');
INSERT INTO Item VALUES (null, 'New Balance 9060', 'New Balance', 'The 9060 is a new expression of the refined style and innovation-led design that have made the 99X series home to some of the most iconic models in New Balance history. The 9060 reinterprets familiar elements sourced from classic 99X models with a warped sensibility inspired by the proudly futuristic, visible tech aesthetic of the Y2K era.' , '9060.jpg');
INSERT INTO Item VALUES (null, 'Chuck 70 low Top', 'Converse', 'A fresh take on the premium Chuck 70 in trending spring colour on poly-canvas. Updated OrthoLite insole cushioning gives you all day support. Heritage details like a glossy, egret midsole and vintage license plate brings out the shoe''s iconic style.' , 'converse.jpg');
INSERT INTO Item VALUES (null, 'Court Corough Low Recraft', 'NIKE', 'Run (don''t walk) to your new favorite Borough. Made for the long haul, this "recrafted" legend uses a combination of durable materials on the upper and outsole to achieve a classic look made in a whole new way. A redesigned toe box and midfoot give your feet a little extra room so you can run, jump and play just a bit longer and a little bit harder.' , 'court-corough.jpg');


-- INSERT DATA INTO REVIEW TABLE --

INSERT INTO Review VALUES (null, 'Natalie', 5, '2023-09-04', 'Can confirm these Asics are comfortable, go with everything and doesnt break the bank. My new essentials!', 1);
INSERT INTO Review VALUES (null, 'Johny', 5, '2023-04-21', 'Amazing service amazing shoes and at an amazing price', 1);
INSERT INTO Review VALUES (null, 'Jason', 5, '2024-01-14', 'Fits as expected and super comfy! I would recommend', 1);
INSERT INTO Review VALUES (null, 'Lily', 5, '2024-10-23', 'Was happy with the product and service.', 1);
INSERT INTO Review VALUES (null, 'Paul', 4, '2024-03-15', 'nice looking, but a little bit big, i have struggled to get a good fit, send back half size small, they are not that big, only slightly', 1);

INSERT INTO Review VALUES (null, 'Zeno', 5, '2024-08-17', 'Very comfortable, and fits true to size, pairs well with some flare jeans', 2);
INSERT INTO Review VALUES (null, 'Joey', 4, '2023-12-03', 'Purchased for my 16 yr old son. States that they are very comfortable', 2);
INSERT INTO Review VALUES (null, 'Jack', 5, '2024-04-09', 'They run true to size and are hella comfortable def recommend', 2);
INSERT INTO Review VALUES (null, 'Daniel', 5, '2023-11-11', 'Very nice and comfortable shoe especially for lifestyle new balances', 2);
INSERT INTO Review VALUES (null, 'Bruney', 4, '2023-02-26', 'Very comfortable shoe for my size which is a big guy over 350. But not like the other shoe i have which is discontinue', 2);
INSERT INTO Review VALUES (null, 'Momo', 5, '2024-03-03', 'Purchased the shoes for my niece and she loves them', 2);

INSERT INTO Review VALUES (null, 'AlexNg', 5, '2024-05-12', 'Teen with narrow foot loves these. Great colour - goes with everything but still different enough to not be like everyone else.', 3);
INSERT INTO Review VALUES (null, 'Austin', 5, '2024-07-27', 'These shoes are both comfortable and stylish and work well with a large range of clothing styles.', 3);

INSERT INTO Review VALUES (null, 'Dennis', 5, '2024-06-12', 'The colour contrast of my kids shoes are really cool and he says it feels comfy. My kid loves them and even wears them to school.', 4);
INSERT INTO Review VALUES (null, 'Joshua', 5, '2023-11-22', 'Love the colour and the customer service was impeccable!', 4);
INSERT INTO Review VALUES (null, 'Aileen', 5, '2024-01-23', 'Great pair of shoes, my son loves it, it''s comfortable and nice to wear for on the go, or for everyday shoes', 4);
INSERT INTO Review VALUES (null, 'Ritchel', 4, '2024-03-14', 'My daughter really loves her new shoes, so bright!!', 4);