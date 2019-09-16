<?php
/**
 * Copyright © WinMile (https://winmile.net/)
 * See LICENSE for the license details.
 */

declare(strict_types=1);

namespace WinMile\UkrainianRegions\Setup\Patch\Data;

use Magento\Directory\Setup\DataInstaller;
use Magento\Directory\Setup\DataInstallerFactory;
use Magento\Directory\Setup\Patch\Data\InitializeDirectoryData;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

/**
 * Adds Regions for Ukraine
 */
class AddDataForUkraine implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var DataInstallerFactory
     */
    private $dataInstallerFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param DataInstallerFactory $dataInstallerFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        DataInstallerFactory $dataInstallerFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->dataInstallerFactory = $dataInstallerFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        /** @var DataInstaller $dataInstaller */
        $dataInstaller = $this->dataInstallerFactory->create();
        $dataInstaller->addCountryRegions(
            $this->moduleDataSetup->getConnection(),
            $this->getDataForUkraine()
        );
    }

    /**
     * Ukrainian regions data.
     *
     * @return array
     */
    private function getDataForUkraine()
    {
        return [
            ['UA', 'ARK', 'АР Крим'],
            ['UA', 'VIN', 'Вінницька'],
            ['UA', 'VOL', 'Волинська'],
            ['UA', 'DNI', 'Дніпропетровська'],
            ['UA', 'DON', 'Донецька'],
            ['UA', 'ZHY', 'Житомирська'],
            ['UA', 'ZAK', 'Закарпатська'],
            ['UA', 'ZAP', 'Запорізька'],
            ['UA', 'IVA', 'Івано-Франківська'],
            ['UA', 'KYI', 'Київська'],
            ['UA', 'KIR', 'Кіровоградська'],
            ['UA', 'LUG', 'Луганська'],
            ['UA', 'LVI', 'Львівська'],
            ['UA', 'MYK', 'Миколаївська'],
            ['UA', 'ODE', 'Одеська'],
            ['UA', 'POL', 'Полтавська'],
            ['UA', 'RIV', 'Рівненська'],
            ['UA', 'SUM', 'Сумська'],
            ['UA', 'TER', 'Тернопільська'],
            ['UA', 'KHA', 'Харківська'],
            ['UA', 'KHE', 'Херсонська'],
            ['UA', 'KHM', 'Хмельницька'],
            ['UA', 'CRK', 'Черкаська'],
            ['UA', 'CRV', 'Чернівецька'],
            ['UA', 'CRN', 'Чернігівська']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [InitializeDirectoryData::class];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Rollback all changes, done by this patch
     *
     * @return void
     */
    public function revert()
    {
        $adapter = $this->moduleDataSetup->getConnection();
        foreach ($this->getDataForUkraine() as $region) {
            $adapter->delete('directory_country_region', ['`country_id` = ?' => $region[0], '`code` = ?' => $region[1]]);
        }
    }
}
