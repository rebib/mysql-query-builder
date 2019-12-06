# MySQL Query Builder for PHP

## Installation
You can install this plugin with Composer.

```sh
$ composer require rebib/mysql-querybuilder
```

## Example
Build one query with [ X AND ( Y OR Z ) ].

```php
$selectBuilder = QueryBuilder::select();
$selectBuilder->setTable('TableA');
//AND QUERY
$andQuery      = QueryCreator::getAndQuery();
$andQuery->add(
    QueryCreator::getEqualQuery()->add(
        'status', 1));
//OR QUERY
$orQuery       = QueryCreator::getOrQuery();
$orQuery->add(
    QueryCreator::getEqualQuery()->add(
        'name', 'Sam')
);
$orQuery->add(
    QueryCreator::getEqualQuery()->add(
        'sex', 'm')
);
//ADD OrQuery to AndQuery   
$andQuery->add($orQuery);
$selectBuilder->getWhereQueryBuilder()->addQuery($andQuery);
//OUTPUT QUERY & PARAMS
$query         = $selectBuilder->buildQuery();
$parameters    = $selectBuilder->getQueryParameters();
```

Query

```SQL
SELECT *
FROM (TableA)
WHERE ((status = ?) AND ((name = ?) OR (sex = ?)))
```

Parameters
```output
[0] => 1
[1] => Sam
[2] => m
```
