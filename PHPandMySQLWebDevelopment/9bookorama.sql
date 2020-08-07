CREATE TABLE customers
(
  customerid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  name CHAR(50) NOT NULL ,
  address CHAR(100) NOT NULL ,
  city CHAR(30) NOT NULL
);
CREATE TABLE orders
(
  orderid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  customerid INT UNSIGNED NOT NULL ,
  amount FLOAT (6,2),   /*宽6位,小数到2位,在创建订单前,可能还无法知道订单总金额,所以不能not null*/
  date DATE NOT NULL
);

CREATE TABLE books (
  isbn CHAR(13) NOT NULL PRIMARY KEY ,  /*只有isbn不能为null,其他的都可以,因为可能知道isbn还不知道其他的*/
  author CHAR(50),
  title CHAR(100),
  price FLOAT(4,2)
);

CREATE TABLE order_items
(
  orderid INT UNSIGNED NOT NULL ,
  isbn CHAR(13) NOT NULL ,
  quantity TINYINT UNSIGNED ,  /*0-255之间的整数*/
  PRIMARY KEY (orderid, isbn)   /*创建多列主键*/
);

CREATE TABLE book_reviews (
  isbn CHAR(13) NOT NULL PRIMARY KEY ,
  review text/*用于更长的文本,如一篇文章*/
);

/*只添加特定的字段*/
INSERT INTO customers (name, city) VALUES ('Tom','Beijing');
INSERT INTO customers
SET name='Mary',
    address='China',
    city='Beijing';

/*一次插入多行,没一行出现在自己的括号里,每组括号用,分开*/
INSERT INTO customers VALUES
  (3, "Julie Smith", "25 Oak Street", "Airport West"),
  (4, "Alan Wong", "1/47 Haines Avenue", "Box Hill"),
  (5, "Michelle Arthur", "357 North Road", "Yarraville");

insert into orders values
  (NULL, 3, 69.98, "2007-04-02"),
  (NULL, 1, 49.99, "2007-04-15"),
  (NULL, 2, 74.98, "2007-04-19"),
  (NULL, 3, 24.99, "2007-05-01")  ON DUPLICATE KEY UPDATE expression;  /*  如果尝试插入任何可能导致重复唯一键的记录行 将会修改重复值*/

insert IGNORE into books values  /*ignore 如果尝试插入任何可能导致重复唯一键的记录行,这些记录行将被自动忽略*/
  ("0-672-31697-8", "Michael Morgan", "Java 2 for Professional Developers", 34.99),
  ("0-672-31745-1", "Thomas Down", "Installing Debian GNU/Linux", 24.99),
  ("0-672-31509-2", "Pruitt, et al.", "Teach Yourself GIMP in 24 Hours", 24.99),
  ("0-672-31769-9", "Thomas Schenk", "Caldera OpenLinux System Administration Unleashed", 49.99);

insert LOW_PRIORITY into order_items values   /*当数据不是从表格中读出时,系统必须等待并且稍后再插入*/
  (1, "0-672-31697-8", 2),
  (2, "0-672-31769-9", 1),
  (3, "0-672-31769-9", 1),
  (3, "0-672-31509-2", 1),
  (4, "0-672-31745-1", 3);

insert DELAYED into book_reviews values  /*插入的数据将被缓存，如果该服务器繁忙,可以继续运行其他查询,而不用等它完成*/
  ("0-672-31697-8", "Morgan's book is clearly written and goes well beyond most of the basic Java books out there.");

SELECT name,city
FROM customers;

select * from customers,orders;  /*笛卡尔乘机*/
select * from customers,orders;  /*完全关联,同上*/
select * from customers CROSS JOIN orders;  /*交叉关联,同上*/
select * from customers,orders WHERE customers.customerid = orders.customerid;  /*内部关联,没where的时候等价于完全关联*/
select * from customers,orders WHERE customers.customerid = orders.customerid;  /*等价关联, 在where中使用了 = */
select * from customers LEFT JOIN orders ON customers.customerid = orders.orderid;  /*左关联,对于不匹配的填充null值*/
select * from customers LEFT JOIN orders USING (customerid);  /*左关联,对于不匹配的填充null值  . 用using,不需要指定连接属性来自哪个表,要求两个表中的列必须有同样的名称*/
SELECT * FROM customers LEFT JOIN orders USING (customerid) where orders.orderid IS NULL ;  /*利用左关联,找出没有订购任何商品的顾客*/

/*关联一个表到表本身的时候,必须使用表别名。  如,查找住在同一个城市的顾客 */
SELECT c1.name, c2.name, c1.city FROM customers as c1, customers as c2 WHERE c1.city = c2.city and c1.name != c2.name;

/*order by 默认是升序*/
SELECT * FROM customers ORDER BY name;
SELECT * FROM customers ORDER BY name desc;

/*计算订单总金额的平均值*/
SELECT AVG(amount) FROM orders;

/*group by 改变了函数的行为。给出了每个顾客的平均订单总金额,  要求group by后边的列名必须出现在select后面。*/
SELECT customerid,avg(amount) from orders GROUP BY customerid;

/*having应用于组*/
SELECT customerid,avg(amount) from orders GROUP BY customerid HAVING avg(amount) > 50;

/*指定输出那些行   起始行号,返回行号   eg从行号2（即第3行）开始,返回3行    属于mysql的扩展,而非ansi sql,与其它大多数rdbms不兼容*/
SELECT name from customers LIMIT 2,3;
SELECT name from customers LIMIT 1;  /*输出第一行*/

/*子查询   子查询返回了单一值,再将其用作输出查询的比较条件 。从而选出金额最大的订单   。 此例无法通过ansi sql连接完成*/
SELECT customerid,amount from orders WHERE amount = (SELECT max(amount) FROM orders);

/*实现功能同上,执行效率比子查询高, 但是用到了limit,只能用于mysql*/
SELECT customerid,amount from orders ORDER BY amount DESC LIMIT 1;

/*子查询操作符 any,in,some,all,exists*/
SELECT customerid, amount from orders where amount > ANY (SELECT amount from orders);



/*关联子查询,查询匹配/不匹配外部行的内部行, 可以在内部查询中使用外部查询的结果
选出没有被订购的图书。 内部查询只from了order_items,但还是引用了books.isbn */
select isbn,title from books where not exists (select * from order_items where order_items.isbn=books.isbn);

/*行子查询: 返回整行,与外部查询的整行进行比较*/
select c1,c2,c3 from t1 where (c1,c2,c3) in (select c1,c2,c3 from t2);

/*使用子查询作为临时表。必须为子查询结果定义一个别名*/
select * from (select customerid,name from customers where city='Box Hill') as box_hill_customers;

/*将价格提升10%*/
UPDATE books
SET price = price * 1.1;

/*修改city行*/
alter table customers modify city char(40) not null;
/*添加一行tax*/
alter table orders add tax float(6,2) after amount;
/*删除一行tax*/
alter table orders drop tax;


/*删除表中所有行*/
DELETE FROM orders;

/*删除指定行*/
DELETE FROM customers WHERE customerid = 5;

