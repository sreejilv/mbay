<?php

/* admin/layout/header.twig */
class __TwigTemplate_d47f23f00d61a87f1905adc9219939f2bc71d9361733d3fa4efe653874153832 extends Twig_Template
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
        echo "<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.2 Author: ClipTheme -->
<!--[if IE 8]><html class=\"ie8\" lang=\"en\"><![endif]-->
<!--[if IE 9]><html class=\"ie9\" lang=\"en\"><![endif]-->
<!--[if !IE]><!-->
<html lang=\"en\">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>";
        // line 10
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo " |";
        echo twig_escape_filter($this->env, ($context["COMPANY_NAME"] ?? null), "html", null, true);
        echo "</title>
        <!-- start: META -->
        <meta charset=\"utf-8\" />
        <base href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "\" />
        <link rel=\"shortcut icon\" href=\"assets/images/logos/";
        // line 14
        echo twig_escape_filter($this->env, ($context["COMPANY_FAV_ICON"] ?? null), "html", null, true);
        echo "\" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content=\"IE=edge,IE=9,IE=8,chrome=1\" /><![endif]-->
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0\">
        <meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
        <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\">
        <meta content=\"\" name=\"description\" />
        <meta content=\"\" name=\"author\" />
        <!-- end: META -->";
        // line 22
        $this->loadTemplate("admin/layout/load_header_script.twig", "admin/layout/header.twig", 22)->display($context);
        // line 23
        echo "    </head>
    <!-- end: HEAD -->
    <div id=\"js_validation_messages\" style=\"display: none;\"> 
        <span id=\"no_data_in_datatable_js\">";
        // line 26
        echo twig_escape_filter($this->env, lang("no_data_in_datatable_js"), "html", null, true);
        echo "</span>    
        <span id=\"no_matching_recods_js\">";
        // line 27
        echo twig_escape_filter($this->env, lang("no_matching_recods_js"), "html", null, true);
        echo "</span>    
        <span id=\"next_js\">";
        // line 28
        echo twig_escape_filter($this->env, lang("next"), "html", null, true);
        echo "</span>    
        <span id=\"previous_js\">";
        // line 29
        echo twig_escape_filter($this->env, lang("previous"), "html", null, true);
        echo "</span> 
        <span id=\"showing_js\">";
        // line 30
        echo twig_escape_filter($this->env, lang("showing"), "html", null, true);
        echo "</span>  
        <span id=\"to_js\">";
        // line 31
        echo twig_escape_filter($this->env, lang("to"), "html", null, true);
        echo "</span>  
        <span id=\"of_js\">";
        // line 32
        echo twig_escape_filter($this->env, lang("of"), "html", null, true);
        echo "</span>  
        <span id=\"entries_js\">";
        // line 33
        echo twig_escape_filter($this->env, lang("entries"), "html", null, true);
        echo "</span>
        <span id=\"processing_js\">";
        // line 34
        echo twig_escape_filter($this->env, lang("processing"), "html", null, true);
        echo "</span>
        <span id=\"search_js\">";
        // line 35
        echo twig_escape_filter($this->env, lang("search"), "html", null, true);
        echo "</span>
        <span id=\"show_js\">";
        // line 36
        echo twig_escape_filter($this->env, lang("show"), "html", null, true);
        echo "</span>
        <span id=\"no_matching_js\">";
        // line 37
        echo twig_escape_filter($this->env, lang("no_matching"), "html", null, true);
        echo "</span>     
        <span id=\"filtered_js\">";
        // line 38
        echo twig_escape_filter($this->env, lang("filtered"), "html", null, true);
        echo "</span>
        <span id=\"total_entries_js\">";
        // line 39
        echo twig_escape_filter($this->env, lang("total_entries"), "html", null, true);
        echo "</span>     
        <span id=\"left_axis_js\">";
        // line 40
        echo twig_escape_filter($this->env, lang("left_axis_js"), "html", null, true);
        echo "</span>     
        <span id=\"right_axis_js\">";
        // line 41
        echo twig_escape_filter($this->env, lang("right_axis_js"), "html", null, true);
        echo "</span>     
        <span id=\"file_not_support\">";
        // line 42
        echo twig_escape_filter($this->env, lang("file_not_support"), "html", null, true);
        echo "</span>     
    </div>
    <!-- start: BODY -->
<style type=\"text/css\">

/*#preloader { position: fixed; left: 0; top: 0; z-index: 9999; width: 100%; height: 100%; overflow: visible; background: #333 url('http://files.mimoymima.com/images/loading.gif') no-repeat center center; }*/

/*.loader,
.loader:before,
.loader:after {
  background: #b9b9b9;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader {
  color: #b9b9b9;
  text-indent: -9999em;
  margin: 88px auto;
  position: fixed;
  font-size: 11px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.loader:after {
  left: 1.5em;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
*/

.spinner {

  width: 50px;
  height: 50px;
  margin: 100px auto;
  background-color: white;

  border-radius: 100%;  
  -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
  animation: sk-scaleout 1.0s infinite ease-in-out;

}

.spinner{
    background: #e9e9e9;
    display: none;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    opacity: 0.5;
    height: 100%;
    z-index: 20;
}

@-webkit-keyframes sk-scaleout {
  0% { -webkit-transform: scale(0) }
  100% {
    -webkit-transform: scale(1.0);
    opacity: 0;
  }
}

@keyframes sk-scaleout {
  0% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 100% {
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
    opacity: 0;
  }
}
</style>
   
    <div id=\"preloader\" class=\"spinner\">
</div>

    <body class=\"";
        // line 159
        echo twig_escape_filter($this->env, $this->getAttribute(($context["THEME"] ?? null), "body_class", array()), "html", null, true);
        echo "\">
        <div class=\"main-wrapper\">

            <input type = \"hidden\" name = \"LOG_USER_TYPE\" id=\"LOG_USER_TYPE\" value=\"";
        // line 162
        echo twig_escape_filter($this->env, ($context["LOG_USER_TYPE"] ?? null), "html", null, true);
        echo "\"/>
            <input type = \"hidden\" name = \"path_root\" id=\"path_root\" value=\"";
        // line 163
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "\"/>";
        // line 164
        $this->loadTemplate("admin/layout/top_bar.twig", "admin/layout/header.twig", 164)->display($context);
        // line 165
        $this->loadTemplate("admin/layout/menu.twig", "admin/layout/header.twig", 165)->display($context);
        // line 166
        $this->loadTemplate("admin/layout/page_right.twig", "admin/layout/header.twig", 166)->display($context);
        // line 167
        $this->loadTemplate("admin/layout/main_container.twig", "admin/layout/header.twig", 167)->display($context);
        // line 168
        $this->loadTemplate("admin/layout/notification.twig", "admin/layout/header.twig", 168)->display($context);
        // line 169
        echo "

";
    }

    public function getTemplateName()
    {
        return "admin/layout/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  266 => 169,  264 => 168,  262 => 167,  260 => 166,  258 => 165,  256 => 164,  253 => 163,  249 => 162,  243 => 159,  123 => 42,  119 => 41,  115 => 40,  111 => 39,  107 => 38,  103 => 37,  99 => 36,  95 => 35,  91 => 34,  87 => 33,  83 => 32,  79 => 31,  75 => 30,  71 => 29,  67 => 28,  63 => 27,  59 => 26,  54 => 23,  52 => 22,  42 => 14,  38 => 13,  30 => 10,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/layout/header.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\layout\\header.twig");
    }
}
