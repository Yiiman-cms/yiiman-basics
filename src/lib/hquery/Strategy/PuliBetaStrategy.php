<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\hquery\Strategy;

use YiiMan\YiiBasics\lib\hquery\ClassDiscovery;
use YiiMan\YiiBasics\lib\hquery\Exception\PuliUnavailableException;
use Puli\Discovery\Api\Discovery;
use Puli\GeneratedPuliFactory;

/**
 * Find candidates using Puli.
 * @author David de Boer <david@ddeboer.nl>
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @internal
 * @final
 */
class PuliBetaStrategy implements DiscoveryStrategy
{
    /**
     * @var GeneratedPuliFactory
     */
    protected static $puliFactory;

    /**
     * @var Discovery
     */
    protected static $puliDiscovery;

    /**
     * {@inheritdoc}
     */
    public static function getCandidates($type)
    {
        $returnData = [];
        $bindings = self::getPuliDiscovery()->findBindings($type);

        foreach ($bindings as $binding) {
            $condition = true;
            if ($binding->hasParameterValue('depends')) {
                $condition = $binding->getParameterValue('depends');
            }
            $returnData[] = ['class'     => $binding->getClassName(),
                             'condition' => $condition
            ];
        }

        return $returnData;
    }

    /**
     * Returns the Puli discovery layer.
     * @return Discovery
     * @throws PuliUnavailableException
     */
    private static function getPuliDiscovery()
    {
        if (!isset(self::$puliDiscovery)) {
            $factory = self::getPuliFactory();
            $repository = $factory->createRepository();

            self::$puliDiscovery = $factory->createDiscovery($repository);
        }

        return self::$puliDiscovery;
    }

    /**
     * @return GeneratedPuliFactory
     * @throws PuliUnavailableException
     */
    private static function getPuliFactory()
    {
        if (null === self::$puliFactory) {
            if (!defined('PULI_FACTORY_CLASS')) {
                throw new PuliUnavailableException('Puli Factory is not available');
            }

            $puliFactoryClass = PULI_FACTORY_CLASS;

            if (!ClassDiscovery::safeClassExists($puliFactoryClass)) {
                throw new PuliUnavailableException('Puli Factory class does not exist');
            }

            self::$puliFactory = new $puliFactoryClass();
        }

        return self::$puliFactory;
    }
}
