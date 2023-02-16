<?php

/* login/forgot_password.twig */
class __TwigTemplate_00f2f1ae9fcbf733c06847fc5509616e5d2a3140abc8b63ca467ea83e652ca38 extends Twig_Template
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
        $this->loadTemplate("layout/header.twig", "login/forgot_password.twig", 1)->display($context);
        // line 2
        echo "<style type=\"text/css\">
    .dropdown-subview:after {
        right: auto !important;
        left: 105px !important;
    }
    .dropdown-subview:before {
        right: auto !important;
        left: 104px !important;
    }
    .nav>li>a:focus, .nav>li>a:hover {
        background-color:transparent;
    }
    .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
        background-color:transparent;
    }
</style>
<body class=\"login\">
    <input type=\"hidden\" name=\"path\" id=\"path\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "\"/>
    <div id=\"js_messages\" style=\"display: none;\"> 
        <span id=\"email_req_js\">";
        // line 21
        echo twig_escape_filter($this->env, lang("email_req_js"), "html", null, true);
        echo "</span>
        <span id=\"email_inv_js\">";
        // line 22
        echo twig_escape_filter($this->env, lang("email_inv_js"), "html", null, true);
        echo "</span>
    </div>
    <div class=\"row\">
        <div class=\"main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4\">
            <div class=\"logo\">
                <img src=\"assets/images/logos/";
        // line 27
        echo twig_escape_filter($this->env, ($context["COMPANY_LOGO"] ?? null), "html", null, true);
        echo "\">
            </div>

            <div class=\"box-login\">

                <div class=\"row\">
                    <div  class=\"col-xs-6 col-sm-6 col-lg-7\">
                        <h3>";
        // line 34
        echo twig_escape_filter($this->env, lang("forgot_password_heading"), "html", null, true);
        echo "?</h3>                         
                    </div>        
                    <div class=\"col-xs-6 col-sm-6 col-lg-5\" style=\"hover:none;\">
                        <p>
                        <div class=\"topbar-tools pull-right\"  style=\"color:black !important;hover:none!important;\">
                            <ul class=\"nav navbar-right\">";
        // line 41
        if (($context["MULTI_LANG_STATUS"] ?? null)) {
            // line 42
            echo "                                    <li class=\"dropdown current-user\">
                                        <a data-toggle=\"dropdown\" data-hover=\"dropdown\" class=\"dropdown-toggle\" data-close-others=\"true\" href=\"javascript:;\"  title=\"Change Language\"
                                           style=\"color: gray;\" 
                                           >
                                            <img src=\"assets/images/flags/lang/";
            // line 46
            echo twig_escape_filter($this->env, ($context["MLM_LANG_FLAG"] ?? null), "html", null, true);
            echo "\" class=\"img-circle\" alt=\"\">
                                            <span class=\"username hidden-xs\"><small>";
            // line 47
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, ($context["MLM_LANG_NAME"] ?? null)), "html", null, true);
            echo "</small></span> <i class=\"fa fa-caret-down hidden-xs \"></i>
                                        </a>

                                        <ul class=\"dropdown-menu dropdown-light dropdown-subview\" >";
            // line 51
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["MLM_LANG_LIST"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["LANGUAGE"]) {
                // line 52
                echo "                                                <li onclick=\"switchLanguage('";
                echo twig_escape_filter($this->env, $this->getAttribute($context["LANGUAGE"], "lang_code", array()), "html", null, true);
                echo "');\">
                                                    <a href=\"javascript:;\" >";
                // line 54
                echo twig_escape_filter($this->env, $this->getAttribute($context["LANGUAGE"], "lang_name", array()), "html", null, true);
                echo " 

                                                    </a>
                                                </li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['LANGUAGE'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 59
            echo "                                        </ul>
                                    </li>";
        } elseif (        // line 62
($context["GOOGLE_TRANSLATOR"] ?? null)) {
            // line 63
            echo "
                                    <li class=\"hidden-xs\">
                                        <a  href=\"javascript:;\"  title=\"Google Translate\"  class=\"dropdown-toggle\">
                                            <span id=\"google_translate_element\"> </span>
                                        </a>
                                    </li>";
        }
        // line 70
        echo " 

                            </ul>
                        </div>
                        </p>
                    </div>
                </div>
                <br>
                <p>";
        // line 79
        echo twig_escape_filter($this->env, lang("enter_your_username_or_email"), "html", null, true);
        echo "
                </p>";
        // line 81
        $this->loadTemplate("admin/layout/notification.twig", "login/forgot_password.twig", 81)->display($context);
        // line 82
        echo form_open("", "class=\"forgot_form\" id=\"forgot_form\" name=\"forgot_form\"");
        echo "
                <div class=\"errorHandler alert alert-danger no-display\">
                    <i class=\"fa fa-remove-sign\"></i>";
        // line 84
        echo twig_escape_filter($this->env, lang("you_have_some_form_errors"), "html", null, true);
        echo "
                </div>
                <fieldset>
                    <div class=\"form-group\">
                        <span class=\"input-icon\">
                            <input type=\"text\" class=\"form-control\" name=\"email\" id=\"email\" placeholder=\"";
        // line 89
        echo twig_escape_filter($this->env, lang("login_identity_label"), "html", null, true);
        echo "\" tabindex='1'>
                            <i class=\"fa fa-envelope\"></i> </span>
                    </div>
                    <div class=\"form-actions\">
                        <a class=\"btn btn-light-grey go-back\" href=\"login-site\">
                            <i class=\"fa fa-chevron-circle-left\"></i>";
        // line 94
        echo twig_escape_filter($this->env, lang("login"), "html", null, true);
        echo "
                        </a>
                        <button type=\"submit\" class=\"btn btn-green pull-right\" name=\"for_pass\" id=\"for_pass\" value=\"Submit\">";
        // line 97
        echo twig_escape_filter($this->env, lang("submit"), "html", null, true);
        echo " <i class=\"fa fa-arrow-circle-right\"></i>
                        </button>
                    </div>
                </fieldset>";
        // line 101
        echo form_close();
        echo "
                <div class=\"copyright\">";
        // line 103
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " &copy; by";
        echo twig_escape_filter($this->env, ($context["COMPANY_NAME"] ?? null), "html", null, true);
        echo ".
                </div>

            </div>
        </div>
    </div>";
        // line 109
        $this->loadTemplate("layout/footer.twig", "login/forgot_password.twig", 109)->display($context);
        echo "   
    <script src=\"assets/js/forgot_pass.js\">
    </script>
    <script>
        jQuery(document).ready(function () {
            runForgotValidator();
        });
    </script>


";
    }

    public function getTemplateName()
    {
        return "login/forgot_password.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 109,  177 => 103,  173 => 101,  167 => 97,  162 => 94,  154 => 89,  146 => 84,  141 => 82,  139 => 81,  135 => 79,  125 => 70,  117 => 63,  115 => 62,  112 => 59,  102 => 54,  97 => 52,  93 => 51,  87 => 47,  83 => 46,  77 => 42,  75 => 41,  67 => 34,  57 => 27,  49 => 22,  45 => 21,  40 => 19,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "login/forgot_password.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\login\\forgot_password.twig");
    }
}
