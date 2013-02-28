# Overview

Lemon-filling is a tool to build localization into your application, complete with a localizer front-end. It works by breaking up this complex task by having the author think in three categories; **Locale**, **Terms** and **Pages**.

## Locale

Locale is the language or languages your application will support. If it supports English and Deutch, then those are the locales. Also, the **localeid** would probably be 1 and 2, respectively.


## Terms

Terms are any clump of text in your application. It could be a label in a form, or a paragraph in your help section. Terms are referenced by their **term_tag**.

^ term_tag      ^ term      ^
| about_text    | "Our application was designed with all citrus fruit lovers in mind and..."     | 
| l_name    | "Username:"     |
| l_pass    | "Password:"     |

For example, in your template, you could have:

<pre>
<code php>
<label><?php echo $term['l_name'];?></label>
</code>
</pre>

## Pages 

A page is any total 'page' for your application. For example if you have an 'Add Post' page in your app, you would create a page in the admin tool called 'add_post', and then attach any terms that would belong in that page.

# Overall Requirements

  * By passing a query a page-name and locale id, get all the terms for that page
  * Terms returned can be referenced by a tag for easy templating
  * Admin section is dead simple to use

====== Workflow ======
===== Need to create first page =====
  - By default, English is first language
  - Go to Terms, default is first language
  - Hit Add Terms
  - Add all Terms that will appear on page
  - Go to Pages
  - Create new Page
  - Add Terms to that Page, there is first 40char on right

# Admin Area

## Locale

   * List of locales
   * Ability to add new / edit / delete

## Terms

   * Dropdown of current locale selected
   * List of all terms
     * term_tag
     * full term
   * Ability to add new term, and keep adding more with jQuery
   * Ability to edit existing, delete (which deletes for all locales)

## Pages

   * List of pages
   * Ability to add new page, adding terms to it with jQuery
   * Ability to edit page, where terms can be removed/added
   * Ability to delete page, deletes for all locales

# Schema

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

# Working Query

<pre>
<code mysql>
SELECT terms.value,
	   rosetta.value       
FROM locale
RIGHT JOIN rosetta ON locale.locale_id=rosetta.locale_id
INNER JOIN terms ON terms.terms_id=rosetta.terms_id
INNER JOIN page_group ON page_group.terms_id=rosetta.terms_id
INNER JOIN page ON page.page_id=page_group.page_id
WHERE page.value='sign_in' AND locale.locale_id=1
ORDER BY terms.terms_id
</code>
</pre>

# Demo of success

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

mysql> SELECT terms.value,
    ->    rosetta.value       
    -> FROM locale
    -> RIGHT JOIN rosetta ON locale.locale_id=rosetta.locale_id
    -> INNER JOIN terms ON terms.terms_id=rosetta.terms_id
    -> INNER JOIN page_group ON page_group.terms_id=rosetta.terms_id
    -> INNER JOIN page ON page.page_id=page_group.page_id
    -> WHERE page.value='sign_in' AND locale.locale_id=1
    -> ORDER BY terms.terms_id;
+---------------+------------------------------------------+
| value         | value                                    |
+---------------+------------------------------------------+
| lname         | Username:                                |
| lpass         | Password:                                |
| welcome_blurb | Welcome to appland! Please log in below. |
+---------------+------------------------------------------+

mysql> SELECT terms.value,
    ->    rosetta.value       
    -> FROM locale
    -> RIGHT JOIN rosetta ON locale.locale_id=rosetta.locale_id
    -> INNER JOIN terms ON terms.terms_id=rosetta.terms_id
    -> INNER JOIN page_group ON page_group.terms_id=rosetta.terms_id
    -> INNER JOIN page ON page.page_id=page_group.page_id
    -> WHERE page.value='sign_in' AND locale.locale_id=2
    -> ORDER BY terms.terms_id;
+---------------+-------------------------------------------------+
| value         | value                                           |
+---------------+-------------------------------------------------+
| lname         | Benutzername:                                   |
| lpass         | Passwort:                                       |
| welcome_blurb | Welcome to appland Bitte melden Sie sich unten. |
+---------------+-------------------------------------------------+
</code>
</pre>

