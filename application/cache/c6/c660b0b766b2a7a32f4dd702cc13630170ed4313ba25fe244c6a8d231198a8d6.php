<?php

/* admin/partials/menu.twig */
class __TwigTemplate_645ef3630e5dec6cd39f07508c85f95d221267f40bf27e53efcc5cb57013e07c extends Twig_Template
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
        $this->loadTemplate("admin/partials/topbar.twig", "admin/partials/menu.twig", 1)->display($context);
        // line 2
        $this->loadTemplate("admin/partials/sidebar.twig", "admin/partials/menu.twig", 2)->display($context);
    }

    public function getTemplateName()
    {
        return "admin/partials/menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/partials/menu.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\partials\\menu.twig");
    }
}
