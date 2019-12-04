<?php

namespace Rherault\UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlfileLoader;
use Symfony\Component\Config\FileLocator;
use Rherault\UserBundle\DependencyInjection\Configuration;

class RheraultUserExtension extends Extension {

    /**
     * Loads a specific configuration
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.yaml');
        $loader->load('routes.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('rherault_user.user_class', $config['user_class']);
        $container->setParameter('rherault_user.email_from', $config['email_from']);

    }
}