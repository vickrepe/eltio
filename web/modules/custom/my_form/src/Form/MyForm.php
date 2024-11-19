<?php

namespace Drupal\my_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use OpenAI\Client;

class MyForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Campo de textarea para el texto generado.
    $form['mensaje'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Mensaje generado'),
        '#description' => $this->t('Este es el texto generado por ChatGPT.'),
        '#disabled' => TRUE,  // Deshabilitamos el campo porque será generado automáticamente.
        '#value' => $form_state->getValue('mensaje') ?? '', // Prellenar si ya existe un valor generado.
        '#prefix' => '<div id="mensaje-wrapper">',
        '#suffix' => '</div>',
      ];

    // Campo de textarea para el prompt.
    $form['prompt'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Prompt para ChatGPT'),
        '#description' => $this->t('Introduce el prompt para generar un texto.'),
        '#required' => TRUE,
    ];


    // Botón de envío con AJAX.
    $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Generar texto'),
        '#ajax' => [
          'callback' => '::ajaxGenerarTexto',
          'wrapper' => 'mensaje-wrapper', // El ID del div que queremos actualizar.
          'method' => 'replace',
          'effect' => 'fade',
        ],
      ];

    return $form;
  }

    /**
   * Callback de AJAX para actualizar el campo 'mensaje' con el texto generado.
   */
  public function ajaxGenerarTexto(array &$form, FormStateInterface $form_state) {
    // Obtener el prompt ingresado.
    $prompt = $form_state->getValue('prompt');

    // Llamar a la API de OpenAI para generar el texto.
    $texto_generado = $this->generarTextoConChatGPT($prompt);

    // Establecer el valor del campo 'mensaje' con el texto generado.
    $form_state->setValue('mensaje', $texto_generado);
    $form['mensaje']['#value'] = $texto_generado;

    // Devolver el campo 'mensaje' actualizado.
    return $form['mensaje'];
  }

    /**
    * Función para enviar el prompt a la API de OpenAI y obtener la respuesta.
    */

  private function generarTextoConChatGPT($prompt) {

    $client = \OpenAI::client('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');

    try {
      // Enviar el prompt y recibir la respuesta.
      $response = $client->completions()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
          ['role' => 'user', 'content' => $prompt], // Usar el prompt dinámico proporcionado por el usuario
        ],
        'max_tokens' => 100,
      ]);

      // Verificar si la respuesta contiene el texto esperado
      if (isset($response['choices'][0]['message']['content'])) {
        return $response['choices'][0]['message']['content'];
      } else {
        return 'No se pudo generar el texto, intente de nuevo.';
      }
    } catch (\Exception $e) {
      \Drupal::logger('my_form')->error('Error al generar el texto con OpenAI: @error', ['@error' => $e->getMessage()]);
      return 'Hubo un error con la API de OpenAI.';
    }
  }

  

    /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
}

}
