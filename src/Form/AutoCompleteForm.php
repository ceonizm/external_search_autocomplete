<?php

namespace Drupal\external_search_autocomplete\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\BubbleableMetadata;
use Drupal\Core\Url;

class AutoCompleteForm extends \Drupal\Core\Form\FormBase {

  /**
   * @inheritDoc
   */
  public function getFormId() {
   return 'autocompleteForm';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $settings = $this->config('external_search_autocomplete.settings');
    $uri = $settings->get('external_search_url');
    $form['search_field'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your search'),
      '#disabled' => empty($uri)
    ];

    if( !empty($uri) ) {
      $url = Url::fromUri($uri)->toString(TRUE);
      // TODO: Implement buildForm() method.
      $form['search_field']['#attributes'] = [
          'class' => [
            'ui-autocomplete-input',
            'form-autocomplete'],
          'data-autocomplete-path' => $url->getGeneratedUrl(),
          'data-search-api-autocomplete-search' => 'dummy-external-search'
        ];

      $metadata = BubbleableMetadata::createFromRenderArray($form['search_field']);
      $metadata->addAttachments(['library' => ['core/drupal.autocomplete', 'search_api_autocomplete/search_api_autocomplete']]);
      $metadata->merge($url)->applyTo($form['search_field']);
    }




    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Search'),
      '#disabled' => empty($uri)
    ];
    return $form;
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }
}
