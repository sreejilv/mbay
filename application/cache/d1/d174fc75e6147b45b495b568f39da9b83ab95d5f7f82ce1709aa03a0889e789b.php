<?php

/* layout/header.twig */
class __TwigTemplate_993360084375c27f2666d3d1c71e25429d51a1d771497fa181520f5c8ee66e66 extends Twig_Template
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
        echo "<html lang=\"en\" class=\"no-js\">
    <head>
        <title>";
        // line 3
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo " |";
        echo twig_escape_filter($this->env, ($context["COMPANY_NAME"] ?? null), "html", null, true);
        echo "</title>
        <meta charset=\"utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0\">
        <meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
        <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\">
        <meta content=\"\" name=\"description\" />
        <meta content=\"\" name=\"author\" />
        <base href=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "\" />
        <link rel=\"shortcut icon\" href=\"assets/images/logos/";
        // line 11
        echo twig_escape_filter($this->env, ($context["COMPANY_FAV_ICON"] ?? null), "html", null, true);
        echo "\" />
        <script type=\"text/javascript\" src=\"assets/plugins/jQuery/jquery-1.11.1.min.js\"></script>
        <link rel=\"stylesheet\" href=\"assets/plugins/iCheck/skins/all.css\">
        <link rel=\"stylesheet\" href=\"assets/plugins/bootstrap/css/bootstrap.min.css\">
        <link rel=\"stylesheet\" href=\"assets/plugins/font-awesome/css/font-awesome.min.css\">
        <link rel=\"stylesheet\" href=\"assets/css/styles.css\">
        <link rel=\"stylesheet\" href=\"assets/css/styles-responsive.css\">
        <link rel=\"stylesheet\" href=\"assets/plugins/animate.css/animate.min.css\">
        <link rel=\"stylesheet\" href=\"assets/css/print.css\" type=\"text/css\" media=\"print\"/>
        <input type = \"hidden\" name = \"path_root\" id=\"path_root\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "\"/>
        <meta property=\"og:title\" content=\"";
        // line 21
        echo twig_escape_filter($this->env, ($context["COMPANY_NAME"] ?? null), "html", null, true);
        echo "\" />
        <meta property=\"og:image\" itemprop=\"image\" content=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "assets/images/logos/";
        echo twig_escape_filter($this->env, ($context["COMPANY_LOGO"] ?? null), "html", null, true);
        echo "\">
        <meta property=\"og:type\" content=\"website\" />
</head>
<script type=\"text/javascript\">

    \$(document).ready(function () {
        \$.ajaxSetup({
            data: {

                '";
        // line 31
        echo twig_escape_filter($this->env, ($context["CSRF_TOKEN_NAME"] ?? null), "html", null, true);
        echo "': '";
        echo twig_escape_filter($this->env, ($context["CSRF_TOKEN_VALUE"] ?? null), "html", null, true);
        echo "'
            }
        });
    });

</script>";
    }

    public function getTemplateName()
    {
        return "layout/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 31,  59 => 22,  55 => 21,  51 => 20,  39 => 11,  35 => 10,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout/header.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\layout\\header.twig");
    }
}
