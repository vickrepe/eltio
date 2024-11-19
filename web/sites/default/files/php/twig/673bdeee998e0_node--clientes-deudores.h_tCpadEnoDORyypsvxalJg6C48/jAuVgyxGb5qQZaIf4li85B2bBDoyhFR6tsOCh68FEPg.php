<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/custom/olivero_custom/templates/node--clientes-deudores.html.twig */
class __TwigTemplate_828a0c4e0425b9bd36274a5e89f1a3e9 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<div class=\"node--clientes-deudores\">
  <h1>";
        // line 2
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "label", [], "any", false, false, true, 2), 2, $this->source), "html", null, true);
        yield "</h1>

  <!-- Mostrar el saldo con una clase condicional -->
  <h2 class=\"";
        // line 5
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_saldo", [], "any", false, false, true, 5), "value", [], "any", false, false, true, 5) < 0)) ? ("saldo-negativo") : ("saldo-positivo")));
        yield "\">
    Saldo: \$";
        // line 6
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_saldo", [], "any", false, false, true, 6), "value", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
        yield "
  </h2>

  <!-- Bloque Editable Fields -->
  <div class=\"editable-fields-block\">
    ";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["editable_fields_block"] ?? null), 11, $this->source), "html", null, true);
        yield "
  </div>

    <!-- Bloque Editable Fields -->
  <div class=\"editable-fields-block\">
    <div class=\"field-group\">
      <div class=\"field-item\">
        ";
        // line 18
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "debe", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
        yield "
      </div>
      <div class=\"field-item\">
        ";
        // line 21
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "pagado", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
        yield "
      </div>
    </div>
    <div class=\"field-observations\">
      ";
        // line 25
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "observaciones", [], "any", false, false, true, 25), 25, $this->source), "html", null, true);
        yield "
    </div>
    ";
        // line 27
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "submit", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
        yield "
  </div>

  <h4>Historial de transacciones del cliente</h4>
  ";
        // line 31
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["transacciones"] ?? null)) > 0)) {
            // line 32
            yield "    <table class=\"styled-table\">
      <thead>
        <tr>
          <th>Debe</th>
          <th>Pagado</th>
          <th>Observaciones</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        ";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["transacciones"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["transaccion"]) {
                // line 43
                yield "          <tr>
            <td>";
                // line 44
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["transaccion"], "debe", [], "any", false, false, true, 44), 44, $this->source), "html", null, true);
                yield "</td>
            <td>";
                // line 45
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["transaccion"], "pagado", [], "any", false, false, true, 45), 45, $this->source), "html", null, true);
                yield "</td>
            <td>";
                // line 46
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["transaccion"], "observaciones", [], "any", false, false, true, 46), 46, $this->source), "html", null, true);
                yield "</td>
            <td>";
                // line 47
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["transaccion"], "fecha", [], "any", false, false, true, 47), 47, $this->source), "html", null, true);
                yield "</td>
          </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['transaccion'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            yield "      </tbody>
    </table>
  ";
        } else {
            // line 53
            yield "    <p>No hay transacciones disponibles.</p>
  ";
        }
        // line 55
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["node", "editable_fields_block", "form", "transacciones"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/olivero_custom/templates/node--clientes-deudores.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  151 => 55,  147 => 53,  142 => 50,  133 => 47,  129 => 46,  125 => 45,  121 => 44,  118 => 43,  114 => 42,  102 => 32,  100 => 31,  93 => 27,  88 => 25,  81 => 21,  75 => 18,  65 => 11,  57 => 6,  53 => 5,  47 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"node--clientes-deudores\">
  <h1>{{ node.label }}</h1>

  <!-- Mostrar el saldo con una clase condicional -->
  <h2 class=\"{{ node.field_saldo.value < 0 ? 'saldo-negativo' : 'saldo-positivo' }}\">
    Saldo: \${{ node.field_saldo.value }}
  </h2>

  <!-- Bloque Editable Fields -->
  <div class=\"editable-fields-block\">
    {{ editable_fields_block }}
  </div>

    <!-- Bloque Editable Fields -->
  <div class=\"editable-fields-block\">
    <div class=\"field-group\">
      <div class=\"field-item\">
        {{ form.debe }}
      </div>
      <div class=\"field-item\">
        {{ form.pagado }}
      </div>
    </div>
    <div class=\"field-observations\">
      {{ form.observaciones }}
    </div>
    {{ form.submit }}
  </div>

  <h4>Historial de transacciones del cliente</h4>
  {% if transacciones|length > 0 %}
    <table class=\"styled-table\">
      <thead>
        <tr>
          <th>Debe</th>
          <th>Pagado</th>
          <th>Observaciones</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        {% for transaccion in transacciones %}
          <tr>
            <td>{{ transaccion.debe }}</td>
            <td>{{ transaccion.pagado }}</td>
            <td>{{ transaccion.observaciones }}</td>
            <td>{{ transaccion.fecha }}</td>
          </tr>
        {% endfor %}
      </tbody>
    </table>
  {% else %}
    <p>No hay transacciones disponibles.</p>
  {% endif %}
</div>
", "themes/custom/olivero_custom/templates/node--clientes-deudores.html.twig", "/var/www/html/web/themes/custom/olivero_custom/templates/node--clientes-deudores.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 31, "for" => 42);
        static $filters = array("escape" => 2, "length" => 31);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['escape', 'length'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
