<?php

namespace Zumba\BehatParameterExtension;

use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Extension implements ExtensionInterface {
  /**
   * You can modify the container here before it is dumped to PHP code.
   *
   * @param ContainerBuilder $container
   *
   * @api
   */
  public function process(ContainerBuilder $container) {
  }

  /**
   * Returns the extension config key.
   *
   * @return string
   */
  public function getConfigKey() {
    return 'jcalderonzumba_parameters';
  }

  /**
   * Initializes other extensions.
   *
   * This method is called immediately after all extensions are activated but
   * before any extension `configure()` method is called. This allows extensions
   * to hook into the configuration of other extensions providing such an
   * extension point.
   *
   * @param ExtensionManager $extensionManager
   */
  public function initialize(ExtensionManager $extensionManager) {
  }

  /**
   * Setups configuration for the extension.
   *
   * @param ArrayNodeDefinition $builder
   */
  public function configure(ArrayNodeDefinition $builder) {
    $builder->children()
      ->arrayNode('parameters')
      ->useAttributeAsKey('name', false)
      ->prototype('variable')
      ->end();
  }

  /**
   * Loads extension services into temporary container.
   *
   * @param ContainerBuilder $container
   * @param array            $config
   */
  public function load(ContainerBuilder $container, array $config) {
    foreach ($config['parameters'] as $name => $value) {
      $container->setParameter($name, $value);
    }
  }

}