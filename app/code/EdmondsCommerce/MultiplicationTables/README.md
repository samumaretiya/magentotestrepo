## EdmondsCommerce_MultiplicationTables ##

### Upload by copying code

1. Log into Magento server (or switch to) as a user who has permissions to write to the Magento file system.
2. Download the "Ready to paste" package from your customer's area, unzip it and upload the 'app' folder to your Magento install dir.


## Enable the extension

1. Log in to the Magento server as, or switch to, a user who has permissions to write to the Magento file system.
2. Go to your Magento install dir:
```
cd <your Magento install dir> 
```

3. Enable the extension:
```
php bin/magento module:enable EdmondsCommerce_MultiplicationTables
```

4. And finally, update the database:
```
php bin/magento setup:upgrade
php bin/magento cache:flush
php bin/magento setup:static-content:deploy
```

## How to configure it?
1. Click on Stores -> Configuration on Admin Panel.
2. Click on Edmonds Commerce -> Multiplication Tables.
3. Module Enabled / Disabled manage by Field "Enable Module".
4. Product Detail Page Tab Title manage by Field "Tab Title".


## How to run Unit test via command line?
1.
```
cd <your Magento install dir> 
```

2.
```
php vendor/phpunit/phpunit/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/EdmondsCommerce/MultiplicationTables
```