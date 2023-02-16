<?php

/* admin/layout/load_header_script.twig */
class __TwigTemplate_b89b2aea25ce83619115136c1f551fa7fd9cdd50be2c48347951eb931235e59f extends Twig_Template
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
        echo "<script type=\"text/javascript\" src=\"assets/plugins/jQuery/jquery-1.11.1.min.js\"></script>

<link rel='stylesheet' href=\"assets/css/rail-view.css\" type='text/css'>
<link rel=\"stylesheet\" href=\"assets/plugins/bootstrap/css/bootstrap.min.css\">
<link rel=\"stylesheet\" href=\"assets/plugins/font-awesome/css/font-awesome.min.css\">
<link rel=\"stylesheet\" href=\"assets/plugins/iCheck/skins/all.css\">
<link rel=\"stylesheet\" href=\"assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css\">
<link rel=\"stylesheet\" href=\"assets/plugins/animate.css/animate.min.css\">
<!-- end: MAIN CSS -->
<!-- start: CSS REQUIRED FOR SUBVIEW CONTENTS -->
<link rel=\"stylesheet\" href=\"assets/owl.theme.min.css_styles.min.css\">
<link rel=\"stylesheet\" href=\"assets/fullcalendar.min.css_styles.min.css\">
<link rel=\"stylesheet\" href=\"assets/plugins/toastr/toastr.min.css\">
<link rel=\"stylesheet\" href=\"assets/plugins/bootstrap-select/bootstrap-select.min.css\">
<link rel=\"stylesheet\" href=\"assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css\">
<link rel=\"stylesheet\" href=\"assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css\">

<link rel=\"stylesheet\" href=\"assets/css/styles-responsive.css\">
<link rel=\"stylesheet\" href=\"assets/minify/css/print.min.css_styles.min.css\">

<!--<link rel=\"stylesheet\" href=\"assets/css/themes/theme-style2.css\" type=\"text/css\" id=\"skin_color\">-->

<link rel=\"stylesheet\" href=\"assets/plugins/bootstrap-social-buttons/bootstrap-social.css\">";
        // line 25
        if (($context["DARK_MODE"] ?? null)) {
            // line 26
            echo "    <link rel=\"stylesheet\" href=\"assets/css/dark_styles.css\">
    <link rel=\"stylesheet\" href=\"assets/css/themes/dark_theme.css\" type=\"text/css\" id=\"skin_color\">";
        } else {
            // line 29
            echo "    <link rel=\"stylesheet\" href=\"assets/css/styles.css\">
    <link rel=\"stylesheet\" href=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute(($context["THEME"] ?? null), "color_scheama", array()), "html", null, true);
            echo "\" type=\"text/css\" id=\"skin_color\">";
        }
        // line 32
        echo "<!-- end: CSS REQUIRED FOR THIS SUBVIEW CONTENTS-->
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: CORE CSS -->
<script type=\"text/javascript\">

    \$(document).ready(function () {
        \$.ajaxSetup({
            data: {

                '";
        // line 42
        echo twig_escape_filter($this->env, ($context["CSRF_TOKEN_NAME"] ?? null), "html", null, true);
        echo "': '";
        echo twig_escape_filter($this->env, ($context["CSRF_TOKEN_VALUE"] ?? null), "html", null, true);
        echo "'
            }
        });
    });

</script>


<!-- end: CORE CSS -->
";
    }

    public function getTemplateName()
    {
        return "admin/layout/load_header_script.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 42,  56 => 32,  52 => 30,  49 => 29,  45 => 26,  43 => 25,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/layout/load_header_script.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\layout\\load_header_script.twig");
    }
}
