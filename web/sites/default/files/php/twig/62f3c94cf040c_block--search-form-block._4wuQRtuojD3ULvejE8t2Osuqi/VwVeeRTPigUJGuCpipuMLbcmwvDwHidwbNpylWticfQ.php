<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/contrib/bootstrap_barrio/templates/block/block--search-form-block.html.twig */
class __TwigTemplate_92c4bbbc7ad25302b2a12f6ef124fb59c9c31be0fc28fc2b0102512df01e3c88 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@bootstrap_barrio/block/block.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("@bootstrap_barrio/block/block.html.twig", "themes/contrib/bootstrap_barrio/templates/block/block--search-form-block.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 19
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 20
        echo "  <div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [0 => "content", 1 => "container-inline"], "method", false, false, true, 20), 20, $this->source), "html", null, true);
        echo ">
    ";
        // line 21
        $this->displayParentBlock("content", $context, $blocks);
        echo "
  </div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/bootstrap_barrio/templates/block/block--search-form-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 21,  52 => 20,  48 => 19,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"@bootstrap_barrio/block/block.html.twig\" %}
{#
/**
 * @file
 * Bartik's theme implementation for a search form block. Extends Barrio's
 * search form block template.
 *
 * Available variables:
 * - content: The content of this block.
 * - content_attributes: A list of HTML attributes applied to the main content
 *   tag that appears in the template.
 *
 * @see template_preprocess_block()
 * @see search_preprocess_block()
 *
 * @ingroup themeable
 */
#}
{% block content %}
  <div{{ content_attributes.addClass('content', 'container-inline') }}>
    {{ parent() }}
  </div>
{% endblock %}
", "themes/contrib/bootstrap_barrio/templates/block/block--search-form-block.html.twig", "C:\\xampp\\htdocs\\drupal2\\web\\themes\\contrib\\bootstrap_barrio\\templates\\block\\block--search-form-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 20);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                []
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
