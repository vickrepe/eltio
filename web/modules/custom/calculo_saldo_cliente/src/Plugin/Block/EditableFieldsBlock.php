<?php

namespace Drupal\calculo_saldo_cliente\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an Editable Fields Block.
 *
 * @Block(
 *   id = "editable_fields_block",
 *   admin_label = @Translation("Editable Fields Block"),
 * )
 */
class EditableFieldsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\calculo_saldo_cliente\Form\EditableFieldsForm');
    return $form;
  }
}
