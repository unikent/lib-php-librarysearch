Library Search Simple PHP API
=====================

[![Latest Stable Version](https://poser.pugx.org/unikent/lib-php-librarysearch/v/stable.png)](https://packagist.org/packages/unikent/lib-php-librarysearch)

Add this to your composer require:
 * "unikent/lib-php-librarysearch": "dev-master"

Example Usage:
```
$url = new \unikent\LibrarySearch\URL();
$url->set_search_term("Example");
echo $url->get_search_url();
```
