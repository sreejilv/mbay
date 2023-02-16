<?php

/* admin/partials/footer.twig */
class __TwigTemplate_8c2f34e17abf465ed7f0040d7d0120f362afb28d573ca793ed45114befcb252d extends Twig_Template
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
        echo "<footer class=\"footer\">
    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-sm-6\">
                <script>document.write(new Date().getFullYear())</script> © Minia.
            </div>
            <div class=\"col-sm-6\">
                <div class=\"text-sm-end d-none d-sm-block\">
                    Design & Develop by <a href=\"#!\" class=\"text-decoration-underline\">Themesbrand</a>
                </div>
            </div>
        </div>
    </div>
</footer>";
    }

    public function getTemplateName()
    {
        return "admin/partials/footer.twig";
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
        return new Twig_Source("", "admin/partials/footer.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\partials\\footer.twig");
    }
}
