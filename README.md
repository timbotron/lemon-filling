# Lemon-filling

## Overview

Lemon-filling is a tool to build localization (multi-language) support into your small to medium-sized application. With Lemon-filling, you can create terms, define those terms in various locales, and group terms together into pages. Via MySQL query in your application, ask for a page, specify the locale you desire, and all terms on that page will be returned. Comes with web-based admin area to create and manage your localized content.

Lemon-filling is suitable for web-based and traditional applications. It is open-source and free to use.

A demo of the admin area of Lemon-filling can be [found here](http://lab.citracode.com/lemon-filling/)

### Locale

Locale is the language or languages your application will support. If it supports English and Deutch, then those are the locales. Also, the **localeid** would probably be 1 and 2, respectively.


### Terms

Terms are any clump of text in your application. It could be a label in a form, or a paragraph in your help section. Terms are referenced by their **term_tag**.

<table>
  <tr><th>term_tag</th><th>term</th></tr>
  <tr><td>about_text</td><td>"Our application was designed with all citrus fruit lovers in mind and..."</td></tr> 
  <tr><td>l_name</td><td>"Username:"</td></tr>
  <tr><td>l_pass</td><td>"Password:"</td></tr>
</table>

### Pages 

A page is any total 'page' for your application. For example if you have an 'Add Post' page in your app, you would create a page in the admin tool called 'add_post', and then attach any terms that would belong in that page.

## Overall Requirements

  * By passing a query a page-name and locale id, get all the terms for that page
  * Terms returned can be referenced by a tag for easy templating
  * Admin section is dead simple to use

## Schema

<pre>
<code mysql>
CREATE TABLE IF NOT EXISTS locale (
    locale_id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
    value VARCHAR(90) NOT NULL,
    PRIMARY KEY(locale_id)
) 
ENGINE=InnoDB
CHARACTER SET utf8 
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS terms (
    terms_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    value VARCHAR(90) NOT NULL,
    PRIMARY KEY(terms_id)
) 
ENGINE=InnoDB
CHARACTER SET utf8 
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS rosetta (
    rosetta_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    locale_id SMALLINT UNSIGNED NOT NULL,
    terms_id INT UNSIGNED NOT NULL,
    value VARCHAR(19999) NOT NULL,
    PRIMARY KEY(rosetta_id),
    INDEX rlocale_index (locale_id ASC),
    INDEX rterms_index (terms_id ASC)
) 
ENGINE=InnoDB
CHARACTER SET utf8 
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS page (
    page_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    value VARCHAR(90) NOT NULL,
    PRIMARY KEY(page_id)
) 
ENGINE=InnoDB
CHARACTER SET utf8 
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS page_group (
  page_group_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
	page_id INT UNSIGNED NOT NULL,
    terms_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(page_group_id),
    INDEX pgpage_index (page_id ASC),
    INDEX pgterms_index (terms_id ASC)
) 
ENGINE=InnoDB
CHARACTER SET utf8 
COLLATE utf8_general_ci;
</code>
</pre>

## Working Query

<pre>
<code mysql>
SET @given_locale_id = 1;
SELECT terms_value, MAX( rosetta_value ) rosetta_value
FROM (
 
  SELECT T.value terms_value, T.terms_id, R.value rosetta_value, R.locale_id
  FROM terms T
  LEFT JOIN rosetta R ON T.terms_id = R.terms_id
  UNION
  SELECT T.value, T.terms_id, '', @given_locale_id
  FROM terms T        
 
)A
WHERE locale_id =@given_locale_id AND terms_id IN (SELECT terms_id FROM page_group INNER JOIN page ON page.page_id=page_group.page_id WHERE page.value='sign_in')
GROUP BY terms_value;
</code>
</pre>

## Demo of success

<pre>
<code>
mysql> SELECT * FROM locale;
+-----------+---------+
| locale_id | value   |
+-----------+---------+
|         1 | English |
|         2 | Deutch  |
+-----------+---------+

mysql> SELECT * FROM terms;
+----------+---------------+
| terms_id | value         |
+----------+---------------+
|        1 | lname         |
|        2 | lpass         |
|        3 | welcome_blurb |
+----------+---------------+

mysql> SELECT * FROM rosetta;
+------------+-----------+----------+-------------------------------------------------+
| rosetta_id | locale_id | terms_id | value                                           |
+------------+-----------+----------+-------------------------------------------------+
|          1 |         1 |        1 | Username:                                       |
|          2 |         2 |        1 | Benutzername:                                   |
|          3 |         1 |        2 | Password:                                       |
|          4 |         2 |        2 | Passwort:                                       |
|          5 |         1 |        3 | Welcome to appland! Please log in below.        |
|          6 |         2 |        3 | Welcome to appland Bitte melden Sie sich unten. |
+------------+-----------+----------+-------------------------------------------------+

mysql> SELECT * FROM page;
+---------+----------+
| page_id | value    |
+---------+----------+
|       1 | sign_in  |
|       2 | overview |
+---------+----------+

mysql> SELECT * FROM page_group;
+---------------+---------+----------+
| page_group_id | page_id | terms_id |
+---------------+---------+----------+
|             1 |       1 |        1 |
|             2 |       1 |        2 |
|             3 |       1 |        3 |
+---------------+---------+----------+

---QUERY---
SET @given_locale_id = 1;
SELECT terms_value, MAX( rosetta_value ) rosetta_value
FROM (
 
  SELECT T.value terms_value, T.terms_id, R.value rosetta_value, R.locale_id
  FROM terms T
  LEFT JOIN rosetta R ON T.terms_id = R.terms_id
  UNION
  SELECT T.value, T.terms_id, '', @given_locale_id
  FROM terms T        
 
)A
WHERE locale_id =@given_locale_id AND terms_id IN (SELECT terms_id FROM page_group INNER JOIN page ON page.page_id=page_group.page_id WHERE page.value='sign_in')
GROUP BY terms_value;
---END QUERY---

+---------------+------------------------------------------+
| value         | value                                    |
+---------------+------------------------------------------+
| lname         | Username:                                |
| lpass         | Password:                                |
| welcome_blurb | Welcome to appland! Please log in below. |
+---------------+------------------------------------------+

</code>
</pre>

## Author
* Tim Habersack
* tim@hithlonde.com
* http://tim.hithlonde.com

## License

This is released as an open-source tool. The specific license will be added once I figure out what CodeIgniters license change means.
