<?php

/* admin/partials/head-css.twig */
class __TwigTemplate_8d21ea43445ee99bff8e1a5d0f336fddff482c5919732afc470ebdb3d0076a0e extends Twig_Template
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
        echo "<!-- preloader css -->
<link rel=\"stylesheet\" href=\"assets/css/preloader.min.css\" type=\"text/css\" />

<!-- Bootstrap Css -->
<link href=\"assets/css/bootstrap.min.css\" id=\"bootstrap-style\" rel=\"stylesheet\" type=\"text/css\" />
<!-- Icons Css -->
<link href=\"assets/css/icons.min.css\" rel=\"stylesheet\" type=\"text/css\" />
<!-- App Css-->
<link href=\"assets/css/app.min.css\" id=\"app-style\" rel=\"stylesheet\" type=\"text/css\" />
<link rel=\"shortcut icon\" href=\"/assets/images/favicon.ico\">";
        // line 13
        echo "
    <!-- preloader css -->";
    }

    public function getTemplateName()
    {
        return "admin/partials/head-css.twig";
    }

    public function getDebugInfo()
    {
        return array (  30 => 13,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/partials/head-css.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\partials\\head-css.twig");
    }
}
