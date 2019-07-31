Installation
------------

### Via composer

Please go to the Magento2 root directory and run the following commands in the shell:

```
composer config repositories.module-ukrainian-regions vcs https://github.com/winmile/module-ukrainian-regions.git
composer require winmile/module-ukrainian-regions
bin/magento module:enable WinMile/UkrainianRegions
bin/magento setup:upgrade
```

Uninstall
------------

```
bin/magento module:uninstall WinMile/UkrainianRegions
bin/magento setup:upgrade
```
