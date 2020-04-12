use tpm;
INSERT INTO products (upc,
merchant_id,
name,

units_available,
unit_weight,
unit_price,
unit_discount)
VALUES (0002,02,"adidas Shoe",7,8,150.00,0.1),            
       (0003,03,"NewBalance Shoe",9,5,165.00,0.1),
       (0004,04,"Jordans Shoe",7,8,175.00,0.1);
          
use tpm;
select * from products;
    