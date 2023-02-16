<?php

/* login/lock_screen.twig */
class __TwigTemplate_83675f30f8bfaf7f29ba05a38305326c918d728cea5c7d21e90c229b734481c0 extends Twig_Template
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
        $this->loadTemplate("layout/header.twig", "login/lock_screen.twig", 1)->display($context);
        // line 2
        echo "<style type=\"text/css\">
    /*//for language change   */
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
<body class=\"lock-screen\">
    <input type=\"hidden\" name=\"path\" id=\"path\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "\"/>        


    <div id=\"js_messages\" style=\"display: none;\"> 
        <span id=\"password_req_js\">";
        // line 24
        echo twig_escape_filter($this->env, lang("password_req_js"), "html", null, true);
        echo "</span>
    </div>
    <div class=\"main-ls animated flipInX\">
        <div class=\"logo\">
            <img src=\"assets/images/logos/";
        // line 28
        echo twig_escape_filter($this->env, ($context["COMPANY_LOGO"] ?? null), "html", null, true);
        echo "\">
        </div>
        <div class=\"box-ls\">
            <img alt=\"\" src=\"assets/images/users/";
        // line 31
        echo twig_escape_filter($this->env, ($context["image"] ?? null), "html", null, true);
        echo "\" width=\"150px;\" height=\"150px;\"/>
            <div class=\"user-info\">
                <div class=\"row\">
                    <div  class=\"col-xs-6 col-sm-6 col-lg-6\">
                        <h1><i class=\"fa fa-lock\"></i>";
        // line 35
        echo twig_escape_filter($this->env, ($context["user_name"] ?? null), "html", null, true);
        echo "</h1>
                    </div>        
                    <div class=\"col-xs-6 col-sm-6 col-lg-6\" style=\"hover:none;\">
                        <p>
                        <div class=\"topbar-tools pull-right\"  style=\"color:black !important;hover:none!important;\">
                            <ul class=\"nav navbar-right\">";
        // line 42
        if (($context["MULTI_LANG_STATUS"] ?? null)) {
            // line 43
            echo "                                    <li class=\"dropdown current-user\">
                                        <a data-toggle=\"dropdown\" data-hover=\"dropdown\" class=\"dropdown-toggle\" data-close-others=\"true\" href=\"javascript:;\"  title=\"Change Language\"
                                           style=\"color: gray;\" 
                                           >
                                            <img src=\"assets/images/flags/lang/";
            // line 47
            echo twig_escape_filter($this->env, ($context["MLM_LANG_FLAG"] ?? null), "html", null, true);
            echo "\" class=\"img-circle\" alt=\"\">
                                            <span class=\"username hidden-xs\"><small>";
            // line 48
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, ($context["MLM_LANG_NAME"] ?? null)), "html", null, true);
            echo "</small></span> <i class=\"fa fa-caret-down hidden-xs \"></i>
                                        </a>

                                        <ul class=\"dropdown-menu dropdown-light dropdown-subview\" >";
            // line 52
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["MLM_LANG_LIST"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["LANGUAGE"]) {
                // line 53
                echo "                                                <li onclick=\"switchLanguage('";
                echo twig_escape_filter($this->env, $this->getAttribute($context["LANGUAGE"], "lang_code", array()), "html", null, true);
                echo "');\">
                                                    <a href=\"javascript:;\" >";
                // line 55
                echo twig_escape_filter($this->env, $this->getAttribute($context["LANGUAGE"], "lang_name", array()), "html", null, true);
                echo " 

                                                    </a>
                                                </li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['LANGUAGE'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "                                        </ul>
                                    </li>";
        } elseif (        // line 63
($context["GOOGLE_TRANSLATOR"] ?? null)) {
            // line 64
            echo "
                                    <li class=\"hidden-xs\">
                                        <a  href=\"javascript:;\"  title=\"Google Translate\"  class=\"dropdown-toggle\">
                                            <span id=\"google_translate_element\"> </span>
                                        </a>
                                    </li>";
        }
        // line 71
        echo " 

                            </ul>
                        </div>
                        </p>
                    </div>
                </div>


                <span>";
        // line 80
        echo twig_escape_filter($this->env, ($context["user_full_name"] ?? null), "html", null, true);
        echo "</span>
                <span><em>";
        // line 81
        echo twig_escape_filter($this->env, lang("lock_lang"), "html", null, true);
        echo "</em></span>";
        // line 82
        $this->loadTemplate("admin/layout/notification.twig", "login/lock_screen.twig", 82)->display($context);
        // line 83
        echo form_open("", "class=\"lock_form\" id=\"lock_form\" name=\"lock_form\"");
        echo "
                <input type=\"hidden\" name=\"username\" id='username' value='";
        // line 84
        echo twig_escape_filter($this->env, ($context["user_name"] ?? null), "html", null, true);
        echo "'>
                <div class=\"input-group\">
                    <input type=\"password\" placeholder=\"";
        // line 86
        echo twig_escape_filter($this->env, lang("password"), "html", null, true);
        echo "\"  name='password' id='password' class=\"form-control\" tabindex='1'>
                    <span class=\"input-group-btn\">
                        <button class=\"btn btn-green\" type=\"submit\" name='lock_submit' id='lock_submit' value=\"unlock\">
                            <i class=\"fa fa-chevron-right\"></i>
                        </button> 
                    </span>
                </div>
                <div class=\"relogin\">
                    <a href=\"login-site\">";
        // line 95
        echo twig_escape_filter($this->env, lang("login_anthor_account"), "html", null, true);
        echo "
                    </a>
                </div>";
        // line 99
        echo form_close();
        echo "
            </div>
        </div>
        <div class=\"copyright\">";
        // line 103
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " &copy; by";
        echo twig_escape_filter($this->env, ($context["COMPANY_NAME"] ?? null), "html", null, true);
        echo ".
        </div>

    </div>";
        // line 107
        $this->loadTemplate("layout/footer.twig", "login/lock_screen.twig", 107)->display($context);
        // line 108
        echo "    <style>
        .help-block {
            color:#a94442;
        }
    </style>
    <script src=\"assets/js/lock_site.js\">
    </script>
    <script>
        \$(document).ready(function () {
            validateLockScreen();
        });
    </script>


";
    }

    public function getTemplateName()
    {
        return "login/lock_screen.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 108,  185 => 107,  177 => 103,  171 => 99,  166 => 95,  155 => 86,  150 => 84,  146 => 83,  144 => 82,  141 => 81,  137 => 80,  126 => 71,  118 => 64,  116 => 63,  113 => 60,  103 => 55,  98 => 53,  94 => 52,  88 => 48,  84 => 47,  78 => 43,  76 => 42,  68 => 35,  61 => 31,  55 => 28,  48 => 24,  41 => 20,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "login/lock_screen.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\login\\lock_screen.twig");
    }
}
