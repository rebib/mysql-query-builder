# MySQL Query Builder for PHP

## Installation
You can install this plugin with Composer.

```sh
$ composer require rebib/mysql-querybuilder
```

## Example
You can install this plugin with Composer.

```php
        $selectBuilder = QueryBuilder::select();
        $selectBuilder->setTable('TableA');
        $andQuery      = QueryCreator::getAndQuery();
        $andQuery->add(
            QueryCreator::getEqualQuery()->add(
                'status', 1));
        $orQuery = QueryCreator::getOrQuery();
        $orQuery->add(
              QueryCreator::getEqualQuery()->add(
                'name', 'Sam')
            );
        $orQuery->add(
              QueryCreator::getEqualQuery()->add(
                'sex', 'm')
            );
        $andQuery->add($orQuery);
        $selectBuilder->getWhereQueryBuilder()->addQuery($andQuery);
        $query         = $selectBuilder->buildQuery();
        $parameters    = $selectBuilder->buildQueryParameters();
```

Query

```output
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
