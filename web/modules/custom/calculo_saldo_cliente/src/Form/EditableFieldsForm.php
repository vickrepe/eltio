<?php

namespace Drupal\calculo_saldo_cliente\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

class EditableFieldsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'editable_fields_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // Obtiene el nodo actual.
    $node = \Drupal::routeMatch()->getParameter('node');
    if (!$node || $node->getType() !== 'clientes_deudores') {
      return ['#markup' => $this->t('Este formulario solo está disponible para Clientes Deudores.')];
    }
  
    // Campo "Debe".
    $form['debe'] = [
      '#type' => 'number',
      '#title' => $this->t('Debe'),
      '#placeholder' => $this->t('Ingrese importe'),
      '#default_value' => '',
      '#step' => '0.01',
      '#required' => FALSE,
    ];
  
    // Campo "Pagado".
    $form['pagado'] = [
      '#type' => 'number',
      '#title' => $this->t('Pagado'),
      '#placeholder' => $this->t('Ingrese importe'),
      '#default_value' => '',
      '#step' => '0.01',
      '#required' => FALSE,
    ];

    // Campo "Observaciones".
    $form['observaciones'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Observaciones'),
      '#placeholder' => $this->t('Ingrese observaciones'),
      '#default_value' => '',
      '#rows' => 2,
      '#required' => FALSE,
    ];
  
    // Botón de guardar.
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Guardar'),
    ];
  
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Verifica que al menos uno de los campos "Debe" o "Pagado" tenga un valor.
    $debe = $form_state->getValue('debe');
    $pagado = $form_state->getValue('pagado');
    if (empty($debe) && empty($pagado)) {
      $form_state->setErrorByName('debe', $this->t('Debe ingresar un importe en al menos uno de los campos.'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Obtén el nodo actual (cliente deudor).
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node && $node->getType() === 'clientes_deudores') {
      // Obtén el saldo actual del cliente.
      $saldo_actual = $node->get('field_saldo')->value ?? 0;
  
      // Captura los valores ingresados.
      $debe = $form_state->getValue('debe');
      $pagado = $form_state->getValue('pagado');
      $observaciones = $form_state->getValue('observaciones');
      $fecha = date('Y-m-d H:i:s'); // Fecha actual.
  
      // Actualiza el saldo con la nueva lógica.
      if (!empty($debe)) {
        $saldo_actual -= $debe; // Restar "Debe".
      }
      if (!empty($pagado)) {
        $saldo_actual += $pagado; // Sumar "Pagado".
      }
  
      // Guarda el nuevo saldo en el nodo.
      $node->set('field_saldo', $saldo_actual);
  
      // Registra la transacción como un nuevo valor en el campo multivalor "Transacciones".
      $transacciones = $node->get('field_transacciones')->getValue() ?: [];
  
      // Crear una nueva transacción basada en los valores ingresados.
      $nueva_transaccion = [
        'value' => json_encode([
          'debe' => !empty($debe) ? $debe : '',
          'pagado' => !empty($pagado) ? $pagado : '',
          'observaciones' => !empty($observaciones) ? $observaciones : '',
          'fecha' => $fecha,
        ]),
      ];
  
      // Agregar la nueva transacción al array.
      $transacciones[] = $nueva_transaccion;
  
      // Establecer el nuevo valor del campo transacciones.
      $node->set('field_transacciones', $transacciones);
  
      // Guarda el nodo actualizado.
      $node->save();
  
      // Mensaje de confirmación.
      \Drupal::messenger()->addMessage($this->t('Transacción guardada correctamente. Saldo actualizado.'));
  
      // Redirige al nodo actual.
      $form_state->setRedirect('entity.node.canonical', ['node' => $node->id()]);
    }
  }
  
}
