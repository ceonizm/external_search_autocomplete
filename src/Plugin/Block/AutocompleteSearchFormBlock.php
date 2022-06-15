<?php

namespace Drupal\external_search_autocomplete\Plugin\Block;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\external_search_autocomplete\Form\AutoCompleteForm;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Class AutocompleteSearchFormBlock
 *
 * @Block(
 *   id = "autocomplete_form_block",
 *   admin_label = "Autocomplete Form block"
 * )
 * @package Drupal\external_search_autocomplete\Plugin\Block
 */
class AutocompleteSearchFormBlock extends \Drupal\Core\Block\BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * @inheritDoc
   */
  public function build() {
    // TODO: Implement build() method.
    $form = $this->formBuilder->getForm(new AutoCompleteForm());
    return $form;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   *
   * @return \Drupal\external_search_autocomplete\Plugin\Block\AutocompleteSearchFormBlock
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    // TODO: Implement create() method.
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->setFormBuilder($container->get('form_builder'));

    return $instance;
  }

  /**
   * @param \Drupal\Core\Form\FormBuilderInterface $formBuilder
   *
   * @return AutocompleteSearchFormBlock
   */
  public function setFormBuilder(\Drupal\Core\Form\FormBuilderInterface $formBuilder): AutocompleteSearchFormBlock {
    $this->formBuilder = $formBuilder;
    return $this;
}

  /**
   * @return \Drupal\Core\Form\FormBuilderInterface
   */
  public function getFormBuilder(): \Drupal\Core\Form\FormBuilderInterface {
    return $this->formBuilder;
  }
}
