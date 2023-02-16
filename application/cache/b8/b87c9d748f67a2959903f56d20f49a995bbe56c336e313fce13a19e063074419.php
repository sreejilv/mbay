<?php

/* admin/partials/vendor-scripts.twig */
class __TwigTemplate_58eded3e87cd0996768340720d6f58efe3eb2829cac5ff3e1c73e1a0d4146c2f extends Twig_Template
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
        echo "<script src=\"assets/libs/jquery/jquery.min.js\"></script>
<script src=\"assets/libs/bootstrap/js/bootstrap.bundle.min.js\"></script>
<script src=\"assets/libs/metismenu/metisMenu.min.js\"></script>
<script src=\"assets/libs/simplebar/simplebar.min.js\"></script>
<script src=\"assets/libs/node-waves/waves.min.js\"></script>
<script src=\"assets/libs/feather-icons/feather.min.js\"></script>
<!-- pace js -->
<script src=\"assets/libs/pace-js/pace.min.js\"></script>
<!-- apexcharts -->
<script src=\"assets/libs/apexcharts/apexcharts.min.js\"></script>

<!-- Plugins js-->

";
    }

    public function getTemplateName()
    {
        return "admin/partials/vendor-scripts.twig";
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
        return new Twig_Source("", "admin/partials/vendor-scripts.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\partials\\vendor-scripts.twig");
    }
}
