<?php

/* admin/layout/top_bar.twig */
class __TwigTemplate_e9e16b31d3ad78ad38917bfaa068173cdbe108945d98cf447920eb1003e0c230 extends Twig_Template
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
        echo "<!-- start: TOPBAR -->
<header class=\"topbar navbar navbar-inverse navbar-fixed-top inner\">
    <!-- start: TOPBAR CONTAINER -->
    <div class=\"container\">
        <div class=\"navbar-header\">
            <a class=\"sb-toggle-left hidden-md hidden-lg\" href=\"#main-navbar\">
                <i class=\"fa fa-bars\"></i>
            </a>

        </div>
        <div class=\"topbar-tools\">
            <!-- start: TOP NAVIGATION MENU -->
            <ul class=\"nav navbar-right\">

                <!-- dark mode swicher -->
                <li class=\"dropdown current-user\">";
        // line 17
        if (($context["DARK_MODE"] ?? null)) {
            // line 18
            echo "                        <a href=\"javascript:changeSystemMod();\" class=\"dropdown-toggle\" title=\"";
            echo twig_escape_filter($this->env, lang("dark_mode"), "html", null, true);
            echo "\">
                            <i class=\"fa fa-moon-o\"></i>
                        </a>";
        } else {
            // line 22
            echo "                        <a href=\"javascript:changeSystemMod();\" class=\"dropdown-toggle\" title=\"";
            echo twig_escape_filter($this->env, lang("light_mode"), "html", null, true);
            echo "\">
                            <i class=\"fa fa-sun-o\"></i>
                        </a>";
        }
        // line 26
        echo "

                </li>
                <!-- end dark mode swicher -->";
        // line 31
        if (($context["MULTI_LANG_STATUS"] ?? null)) {
            // line 32
            echo "                    <!-- start: LANGUAGE -->
                    <li class=\"dropdown current-user\">
                        <a data-toggle=\"dropdown\" data-hover=\"dropdown\" class=\"dropdown-toggle\" data-close-others=\"true\" href=\"javascript:;\"  title=\"Change System Language\">
                            <img src=\"assets/images/flags/lang/";
            // line 35
            echo twig_escape_filter($this->env, ($context["MLM_LANG_FLAG"] ?? null), "html", null, true);
            echo "\" class=\"img-circle\" alt=\"\">
                            <span class=\"username hidden-xs\">";
            // line 36
            echo twig_escape_filter($this->env, ($context["MLM_LANG_NAME"] ?? null), "html", null, true);
            echo "</span> <i class=\"fa fa-caret-down hidden-xs \"></i>
                        </a>

                        <ul class=\"dropdown-menu dropdown-light animate\" >";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["MLM_LANG_LIST"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["LANGUAGE"]) {
                // line 41
                echo "                                <li onclick=\"switchLanguage('";
                echo twig_escape_filter($this->env, $this->getAttribute($context["LANGUAGE"], "lang_code", array()), "html", null, true);
                echo "');\">
                                    <a href=\"javascript:;\">";
                // line 43
                echo twig_escape_filter($this->env, $this->getAttribute($context["LANGUAGE"], "lang_name", array()), "html", null, true);
                echo " 
                                        <!-- <img src=\"assets/images/flags-iso/flat/16/IN.png\" class=\"pull-right\"> -->
                                    </a>
                                </li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['LANGUAGE'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "                        </ul>
                    </li>
                    <!-- end: LANGUAGE  -->";
        } elseif (        // line 52
($context["GOOGLE_TRANSLATOR"] ?? null)) {
            // line 53
            echo "
                    <li class=\"hidden-xs\">
                        <a  href=\"javascript:;\"  title=\"Google Translate\"  class=\"dropdown-toggle\">
                            <span id=\"google_translate_element\"> </span>
                        </a>
                    </li>";
        }
        // line 63
        if (($context["MULTI_CURRENCY_STATUS"] ?? null)) {
            // line 64
            echo "                    <!-- start: CURRENCY -->
                    <li class=\"dropdown current-user\">
                        <a data-toggle=\"dropdown\" data-hover=\"dropdown\" class=\"dropdown-toggle\" data-close-others=\"true\" href=\"javascript:;\" title=\"Change System Currency\">

                            <i class=\"fa";
            // line 68
            echo twig_escape_filter($this->env, (" " . ($context["MLM_CURRENCY_ICON"] ?? null)), "html", null, true);
            echo "\"></i>
                            <span class=\"username hidden-xs\">";
            // line 69
            echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_CODE"] ?? null), "html", null, true);
            echo "</span> <i class=\"fa fa-caret-down hidden-xs \"></i>
                        </a>


                        <ul class=\"dropdown-menu dropdown-light animate\">";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["MLM_CURRENCY_LIST"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["CURRENCY"]) {
                // line 76
                echo "                                <li onclick=\"switchCurrency('";
                echo twig_escape_filter($this->env, $this->getAttribute($context["CURRENCY"], "currency_code", array()), "html", null, true);
                echo "');\">
                                    <a href=\"javascript:;\">
                                        <i class=\"fa";
                // line 78
                echo twig_escape_filter($this->env, (" " . $this->getAttribute($context["CURRENCY"], "icon", array())), "html", null, true);
                echo "\"></i> -";
                echo twig_escape_filter($this->env, $this->getAttribute($context["CURRENCY"], "currency_name", array()), "html", null, true);
                echo "
                                    </a>
                                </li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['CURRENCY'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            echo "
                        </ul>

                    </li>
                    <!-- end: CURRENCY  -->";
        }
        // line 88
        echo "


                <!-- start: USER DROPDOWN -->
                <li class=\"dropdown current-user \">
                    <a data-toggle=\"dropdown\" data-hover=\"dropdown\" class=\"dropdown-toggle\" data-close-others=\"true\" href=\"javascript:;\">
                        <img src=\"assets/images/users/";
        // line 94
        echo twig_escape_filter($this->env, ($context["LOG_USER_DP"] ?? null), "html", null, true);
        echo "\" width=\"30px;\" height=\"30px;\" class=\"img-circle\" alt=\"";
        echo twig_escape_filter($this->env, ($context["LOG_USER_NAME"] ?? null), "html", null, true);
        echo "\"> <span class=\"username hidden-xs\">";
        echo twig_escape_filter($this->env, ($context["LOG_USER_NAME"] ?? null), "html", null, true);
        echo " </span> <i class=\"fa fa-caret-down  hidden-xs\"></i>
                    </a>

                    <ul class=\"dropdown-menu dropdown-user animated flipInY\">
                        <li>
                            <div class=\"d-flex no-block align-items-center p-3 mb-2 border-bottom\">
                                <div class=\"user_dp\">
                                    <img src=\"assets/images/users/";
        // line 101
        echo twig_escape_filter($this->env, ($context["LOG_USER_DP"] ?? null), "html", null, true);
        echo "\" alt=\"user\">
                                </div>
                                <div class=\"user_details\">
                                    <h4 class=\"m-0\">";
        // line 104
        echo twig_escape_filter($this->env, ($context["LOG_USER_FULLNAME"] ?? null), "html", null, true);
        echo "</h4>
                                    <p class=\"text-muted mb-0\">";
        // line 105
        echo twig_escape_filter($this->env, ($context["LOG_USER_EMAIL"] ?? null), "html", null, true);
        echo "</p>
                                    <a href=\"";
        // line 106
        echo twig_escape_filter($this->env, ($context["LOG_USER_TYPE"] ?? null), "html", null, true);
        echo "/profile-view\" class=\"btn-rounded btn-sm mt-2 btn btn-danger\">";
        echo twig_escape_filter($this->env, lang("profile_view"), "html", null, true);
        echo "</a>
                                </div>
                            </div>
                        </li>";
        // line 110
        if ((($context["LOG_USER_TYPE"] ?? null) == "employee")) {
            // line 111
            echo "                            <li align=\"center\">
                                <a href=\"logout-site\"><i class=\"fa fa-power-off\"></i>";
            // line 112
            echo twig_escape_filter($this->env, lang("log_out"), "html", null, true);
            echo "</a>
                            </li>";
        } else {
            // line 115
            echo "
                            <li>
                                <div class=\"pull-left\"><a href=\"login/automatic_systemlock\" class=\"btn\"><i class=\"fa fa-lock\"></i>";
            // line 117
            echo twig_escape_filter($this->env, lang("lock_screen"), "html", null, true);
            echo "</a>
                                </div>
                            </li>
                            <li>
                                <div class=\"pull-right\"><a href=\"logout-site\" class=\"btn\"><i class=\"fa fa-power-off\"></i>";
            // line 121
            echo twig_escape_filter($this->env, lang("log_out"), "html", null, true);
            echo "</a>
                                </div>  
                            </li>";
        }
        // line 125
        echo "                    </ul>                    
                </li>
                <!-- end: USER DROPDOWN -->
                <li class=\"right-menu-toggle  hidden-xs\">
                    <a href=\"javascript:;\" class=\"sb-toggle-right\">
                        <i class=\"fa fa-globe toggle-icon\"></i> <i class=\"fa fa-caret-right\"></i>";
        // line 131
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            echo "<span class=\"notifications-count badge badge-default animated bounceIn\"> 3</span>";
        }
        // line 132
        echo "                    </a>
                </li>
            </ul>
            <!-- end: TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- end: TOPBAR CONTAINER -->
</header>
<!-- end: TOPBAR -->
<style>
    .navbar-right .dropdown-user {
        width: 315px;
    }
    .dropdown-user .dw-user-box {
        padding: 15px;
    }
    .dropdown-user .dw-user-box .u-text {
        display: inline-block;
        padding-left: 10px;
    }
    .dropdown-user .dw-user-box .u-img {
        width: 80px;
        display: inline-block;
        border-radius: 5px;
        vertical-align: top;
    }
    .u-img img {
        width: 100%;
        border-radius: 5px;
    }

    .navbar-top-links .dropdown-user .dw-user-box .u-img img {
        width: 100%;
        border-radius: 5px;
    }


    .dropdown-menu {
        border: 1px solid rgba(120,130,140,.13);
        border-radius: 0;
        box-shadow: 0 3px 12px rgba(0,0,0,.05)!important;
    }
    .btn-rounded {
        border-radius: 60px;
    }
    .btn-danger{
        background: #ff7676;
        border: 1px solid #ff7676;
    }
    .animate{
        -webkit-animation-name: fadeInDown;
        animation-name: fadeInDown;
        -webkit-animation-duration: 0.4s;
        animation-duration: 0.4s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    .px-3 {
        padding-right: 1rem !important; }


    img {
        vertical-align: middle;
        border-style: none; }
    .m-3 {
        margin: 1rem !important; }



    .align-items-start {
        -ms-flex-align: start !important;
        align-items: flex-start !important; }

    .align-items-end {
        -ms-flex-align: end !important;
        align-items: flex-end !important; }

    .align-items-center {
        -ms-flex-align: center !important;
        align-items: center !important; }

    .align-items-baseline {
        -ms-flex-align: baseline !important;
        align-items: baseline !important; }

    .align-items-stretch {
        -ms-flex-align: stretch !important;
        align-items: stretch !important; }

    .align-content-start {
        -ms-flex-line-pack: start !important;
        align-content: flex-start !important; }

    .align-content-end {
        -ms-flex-line-pack: end !important;
        align-content: flex-end !important; }

    .align-content-center {
        -ms-flex-line-pack: center !important;
        align-content: center !important; }

    .align-content-between {
        -ms-flex-line-pack: justify !important;
        align-content: space-between !important; }

    .align-content-around {
        -ms-flex-line-pack: distribute !important;
        align-content: space-around !important; }

    .align-content-stretch {
        -ms-flex-line-pack: stretch !important;
        align-content: stretch !important; }

    .align-self-auto {
        -ms-flex-item-align: auto !important;
        align-self: auto !important; }

    .align-self-start {
        -ms-flex-item-align: start !important;
        align-self: flex-start !important; }

    .align-self-end {
        -ms-flex-item-align: end !important;
        align-self: flex-end !important; }

    .align-self-center {
        -ms-flex-item-align: center !important;
        align-self: center !important; }

    .align-self-baseline {
        -ms-flex-item-align: baseline !important;
        align-self: baseline !important; }

    .align-self-stretch {
        -ms-flex-item-align: stretch !important;
        align-self: stretch !important; }




    .border-bottom {
        border-bottom: 1px solid #dee2e6 !important; }
    .ml-3,
    .mx-3 {
        margin-left: 1rem !important; }
    .mb-0,
    .my-0 {
        margin-bottom: 0 !important; }

    .mb-0,
    .my-0 {
        margin-bottom: 0 !important; }
    .text-muted {
        color: #8898aa !important; }

    .d-flex {
        display: -ms-flexbox !important;
        display: flex !important; }

    .d-inline-flex {
        display: -ms-inline-flexbox !important;
        display: inline-flex !important; }

    .rounded {
        border-radius: 2px !important; }

    .m-2 {
        margin: 0.5rem !important; }

    .mt-2,
    .my-2 {
        margin-top: 0.5rem !important; }

    .mr-2,
    .mx-2 {
        margin-right: 0.5rem !important; }

    .mb-2,
    .my-2 {
        margin-bottom: 0.5rem !important; }


    .p-3 {
        padding: 1rem!important;
    }

    .mb-2, .my-2 {
        /* margin-bottom: .5rem!important; */
    }
    .align-items-center {
        -ms-flex-align: center!important;
        align-items: center!important;
    }
    .d-flex {
        display: -ms-flexbox!important;
        display: flex!important;
    }
    .border-bottom {
        border-bottom: 1px solid #dee2e6!important;
    }
</style>";
    }

    public function getTemplateName()
    {
        return "admin/layout/top_bar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  236 => 132,  232 => 131,  225 => 125,  219 => 121,  212 => 117,  208 => 115,  203 => 112,  200 => 111,  198 => 110,  190 => 106,  186 => 105,  182 => 104,  176 => 101,  162 => 94,  154 => 88,  147 => 82,  136 => 78,  130 => 76,  126 => 75,  119 => 69,  115 => 68,  109 => 64,  107 => 63,  99 => 53,  97 => 52,  93 => 48,  83 => 43,  78 => 41,  74 => 40,  68 => 36,  64 => 35,  59 => 32,  57 => 31,  52 => 26,  45 => 22,  38 => 18,  36 => 17,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/layout/top_bar.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\layout\\top_bar.twig");
    }
}
