<?php

/* admin/layout/page_right.twig */
class __TwigTemplate_f866361bb7ea237e7bae0ac5143f38db2931dd099766e56e051bfb483e407a64 extends Twig_Template
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
        echo "
<!-- start: PAGESLIDE RIGHT -->
<div id=\"pageslide-right\" class=\"pageslide slide-fixed inner\">
    <div class=\"right-wrapper\">
        <ul class=\"nav nav-tabs nav-justified\" id=\"sidebar-tab\">
            <li class=\"active\">
                <a href=\"#users\" role=\"tab\" data-toggle=\"tab\"><i class=\"fa fa-bookmark\"></i></a>
            </li>
            <li>
                <a href=\"#notifications\" role=\"tab\" data-toggle=\"tab\"><i class=\"fa fa-bars\"></i></a>
            </li>";
        // line 13
        if ((($context["LOG_USER_TYPE"] ?? null) != "employee")) {
            // line 14
            echo "                <li>
                    <a href=\"#settings\" role=\"tab\" data-toggle=\"tab\"><i class=\"fa fa-gear\"></i></a>
                </li>";
        }
        // line 18
        echo "
        </ul>





        <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"users\">
                <div class=\"users-list site-summery\">
                </div>

            </div>
            <div class=\"tab-pane\" id=\"notifications\">
                <div class=\"notifications\">
                    <div class=\"pageslide-title\">";
        // line 34
        echo twig_escape_filter($this->env, lang("latest_transactions"), "html", null, true);
        echo "
                    </div>
                    <ul class=\"pageslide-list user-transactions\">
                    </ul>
                </div>
            </div>";
        // line 42
        if ((($context["LOG_USER_TYPE"] ?? null) != "employee")) {
            // line 43
            echo "
                <div class=\"tab-pane\" id=\"settings\">

                    <!-- ------";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute(($context["THEME"] ?? null), "layout", array()), "html", null, true);
            echo " -->

                    <div id=\"style_select\">
                        <div id=\"style_selector_container\">

                            <div class=\"pageslide-title\">";
            // line 52
            echo twig_escape_filter($this->env, lang("style_selector"), "html", null, true);
            echo "
                            </div>
                            <div class=\"box-title\">";
            // line 55
            echo twig_escape_filter($this->env, lang("choose_ur_layout_style"), "html", null, true);
            echo "
                            </div>
                            <div class=\"input-box\">
                                <div class=\"input\">
                                    <select name=\"layout\" id=\"layout_2\" class=\"form-control\">
                                        <option value=\"default\"";
            // line 60
            if (($this->getAttribute(($context["THEME"] ?? null), "layout", array()) != "layout-boxed")) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo twig_escape_filter($this->env, lang("wide"), "html", null, true);
            echo "</option>
                                        <option value=\"boxed\"";
            // line 61
            if (($this->getAttribute(($context["THEME"] ?? null), "layout", array()) == "layout-boxed")) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo twig_escape_filter($this->env, lang("boxed"), "html", null, true);
            echo "</option>
                                    </select>
                                </div>
                            </div>

                            <div class=\"box-title\">";
            // line 67
            echo twig_escape_filter($this->env, lang("choose_ur_header_style"), "html", null, true);
            echo "
                            </div>
                            <div class=\"input-box\">
                                <div class=\"input\">
                                    <select name=\"header\"  id=\"header_2\" class=\"form-control\">
                                        <option value=\"fixed\"";
            // line 72
            if (($this->getAttribute(($context["THEME"] ?? null), "header", array()) == "header-fixed")) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, lang("fixed"), "html", null, true);
            echo "</option>
                                        <option value=\"default\"";
            // line 73
            if (($this->getAttribute(($context["THEME"] ?? null), "header", array()) == "header-default")) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, lang("default"), "html", null, true);
            echo "</option>
                                    </select>
                                </div>
                            </div>
                            <div class=\"box-title\">";
            // line 78
            echo twig_escape_filter($this->env, lang("choose_ur_footer_style"), "html", null, true);
            echo "
                            </div>
                            <div class=\"input-box\">
                                <div class=\"input\">
                                    <select name=\"footer\" id=\"footer_2\" class=\"form-control\">
                                        <option value=\"default\"";
            // line 83
            if (($this->getAttribute(($context["THEME"] ?? null), "footer", array()) == "footer-default")) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, lang("default"), "html", null, true);
            echo "</option>
                                        <option value=\"fixed\"  selected";
            // line 84
            if (($this->getAttribute(($context["THEME"] ?? null), "footer", array()) == "footer-fixed")) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, lang("fixed"), "html", null, true);
            echo "</option>
                                    </select>
                                </div>
                            </div>
                            <div class=\"box-title\">";
            // line 89
            echo twig_escape_filter($this->env, lang("available_theme_colors"), "html", null, true);
            echo "
                            </div>
                            <div class=\"images icons-color\">
                                <a href=\"javascript:;\" id=\"default\"><img src=\"assets/images/color-1.png\" alt=\"\" ></a>
                                <a href=\"javascript:;\" id=\"style2\"><img src=\"assets/images/color-2.png\" alt=\"\"></a>
                                <a href=\"javascript:;\" id=\"style3\"><img src=\"assets/images/color-3.png\" alt=\"\"></a>
                                <a href=\"javascript:;\" id=\"style4\"><img src=\"assets/images/color-4.png\" alt=\"\"></a>
                                <a href=\"javascript:;\" id=\"style5\"><img src=\"assets/images/color-5.png\" alt=\"\"></a>
                                <a href=\"javascript:;\" id=\"style6\"><img src=\"assets/images/color-6.png\" alt=\"\"></a>
                                <a href=\"javascript:;\" id=\"style7\"><img src=\"assets/images/color-7.png\" alt=\"\"></a>
                                <a href=\"javascript:;\" id=\"style8\"><img src=\"assets/images/color-8.png\" alt=\"\"></a>
                                <a href=\"javascript:;\" id=\"style9\"><img src=\"assets/images/color-9.png\" alt=\"\"></a>
                                <a href=\"javascript:;\" id=\"style10\"><img src=\"assets/images/color-10.png\" alt=\"\"></a>
                            </div>
                            <br>
                            <div class=\"style-options\">";
            // line 105
            if (($context["PRESET_DEMO_STATUS"] ?? null)) {
                // line 106
                echo "                                    <a  class=\"badge label-default box-title\" onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\">";
                // line 107
                echo twig_escape_filter($this->env, lang("save_style"), "html", null, true);
                echo "
                                    </a>";
            } else {
                // line 110
                echo "                        
                                    <a  class=\"badge label-default save_style box-title\">";
                // line 112
                echo twig_escape_filter($this->env, lang("save_style"), "html", null, true);
                echo "
                                    </a>";
            }
            // line 115
            echo "

                            </div>
                        </div>
                        <div class=\"style-toggle open\"></div>
                    </div>
                </div>";
        }
        // line 125
        echo "
        </div>



    </div>
</div>
<!-- end: PAGESLIDE RIGHT -->";
    }

    public function getTemplateName()
    {
        return "admin/layout/page_right.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  209 => 125,  200 => 115,  195 => 112,  192 => 110,  187 => 107,  185 => 106,  183 => 105,  165 => 89,  154 => 84,  146 => 83,  138 => 78,  127 => 73,  119 => 72,  111 => 67,  99 => 61,  91 => 60,  83 => 55,  78 => 52,  70 => 46,  65 => 43,  63 => 42,  55 => 34,  38 => 18,  33 => 14,  31 => 13,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/layout/page_right.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\layout\\page_right.twig");
    }
}
