<?php

/* admin/partials/body.twig */
class __TwigTemplate_a37e37d0def8c3204ae172e51207f83918fba1336a26a363c76ccaf33e1e02d9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<body>";
    }

    public function getTemplateName()
    {
        return "admin/partials/body.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/partials/body.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\partials\\body.twig");
    }
}
