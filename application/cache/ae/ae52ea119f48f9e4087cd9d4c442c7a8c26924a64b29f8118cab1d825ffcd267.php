<?php

/* register/packages.twig */
class __TwigTemplate_0837b421c663c9169bca2b5db980b11777287b1e358a9230a4b2c47e4771e149 extends Twig_Template
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
        if (((($context["user_type"] ?? null) == "admin") || (($context["user_type"] ?? null) == "employee"))) {
            // line 2
            $this->loadTemplate("admin/layout/header.twig", "register/packages.twig", 2)->display($context);
        } elseif ((        // line 3
($context["user_type"] ?? null) == "user")) {
            // line 4
            $this->loadTemplate("user/layout/header.twig", "register/packages.twig", 4)->display($context);
        } else {
            // line 6
            $this->loadTemplate("layout/header.twig", "register/packages.twig", 6)->display($context);
            // line 7
            echo "    <body class=\"login\">
        <div class=\"row\">
            <div class=\"main-login col-sm-offset-1 col-md-10\">
                <div class=\"logo\">
                    <img src=\"assets/images/logos/";
            // line 11
            echo twig_escape_filter($this->env, ($context["COMPANY_LOGO"] ?? null), "html", null, true);
            echo "\">
                </div>";
        }
        // line 14
        echo "
            <div id=\"js_messages\" style=\"display: none;\">
                <span id=\"failed_product_added_js\">";
        // line 16
        echo twig_escape_filter($this->env, lang("failed_product_added_js"), "html", null, true);
        echo "</span>
                <span id=\"product_added_js\">";
        // line 17
        echo twig_escape_filter($this->env, lang("reg_pack_selected"), "html", null, true);
        echo "</span>
                <span id=\"failed_js\">";
        // line 18
        echo twig_escape_filter($this->env, lang("failed_js"), "html", null, true);
        echo "</span>
                <span id=\"success_js\">";
        // line 19
        echo twig_escape_filter($this->env, lang("success_js"), "html", null, true);
        echo "</span>
                <span id=\"please_select_a_reg_pack\">";
        // line 20
        echo twig_escape_filter($this->env, lang("please_select_a_reg_pack"), "html", null, true);
        echo "</span>
                <span id=\"warning_js\">";
        // line 21
        echo twig_escape_filter($this->env, lang("warning_js"), "html", null, true);
        echo "</span>
            </div>";
        // line 24
        if ( !($context["user_type"] ?? null)) {
            // line 25
            $this->loadTemplate("admin/layout/notification.twig", "register/packages.twig", 25)->display($context);
        }
        // line 27
        echo "
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"panel panel-white\">
                        <div class=\"panel-heading\">

                            <div class=\"row\">
                                <div  class=\"col-xs-6 col-sm-6 col-lg-6\">
                                    <h4 class=\"panel-title\"><span class=\"text-bold\">";
        // line 35
        echo twig_escape_filter($this->env, lang("select_a_register_package"), "html", null, true);
        echo "</span></h4>
                                </div>";
        // line 38
        if ( !($context["user_type"] ?? null)) {
            // line 39
            echo "
                                    <style type=\"text/css\">
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

                                    <div class=\"col-xs-6 col-sm-6 col-lg-6\" style=\"hover:none;\">
                                        <p>
                                        <div class=\"topbar-tools pull-right\"  style=\"color:black !important;hover:none!important;\">
                                            <ul class=\"nav navbar-right\">";
            // line 63
            if (($context["MULTI_LANG_STATUS"] ?? null)) {
                // line 64
                echo "                                                    <li class=\"dropdown current-user\">
                                                        <a data-toggle=\"dropdown\" data-hover=\"dropdown\" class=\"dropdown-toggle\" data-close-others=\"true\" href=\"javascript:;\"  title=\"Change Language\"
                                                           style=\"color: gray;\"
                                                           >
                                                            <img src=\"assets/images/flags/lang/";
                // line 68
                echo twig_escape_filter($this->env, ($context["MLM_LANG_FLAG"] ?? null), "html", null, true);
                echo "\" class=\"img-circle\" alt=\"\">
                                                            <span class=\"username hidden-xs\"><small>";
                // line 69
                echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, ($context["MLM_LANG_NAME"] ?? null)), "html", null, true);
                echo "</small></span> <i class=\"fa fa-caret-down hidden-xs \"></i>
                                                        </a>

                                                        <ul class=\"dropdown-menu dropdown-light dropdown-subview\" >";
                // line 73
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["MLM_LANG_LIST"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["LANGUAGE"]) {
                    // line 74
                    echo "                                                                <li onclick=\"switchLanguage('";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["LANGUAGE"], "lang_code", array()), "html", null, true);
                    echo "');\">
                                                                    <a href=\"javascript:;\" >";
                    // line 76
                    echo twig_escape_filter($this->env, $this->getAttribute($context["LANGUAGE"], "lang_name", array()), "html", null, true);
                    echo "

                                                                    </a>
                                                                </li>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['LANGUAGE'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 81
                echo "                                                        </ul>
                                                    </li>";
            } elseif (            // line 83
($context["GOOGLE_TRANSLATOR"] ?? null)) {
                // line 84
                echo "
                                                    <li class=\"hidden-xs\">
                                                        <a  href=\"javascript:;\"  title=\"Google Translate\"  class=\"dropdown-toggle\">
                                                            <span id=\"google_translate_element\"> </span>
                                                        </a>
                                                    </li>";
            }
            // line 91
            echo "                                            </ul>
                                        </div>
                                        </p>
                                    </div>";
        }
        // line 96
        echo "                            </div>
                        </div>
                        <div class=\"panel-body\">";
        // line 100
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["pro"]) {
            // line 101
            echo "                                <div class=\"col-sm-4 col-md-3 featured\" >

                                    <div class=\"thumbnail package_single\">";
            // line 104
            if (twig_length_filter($this->env, $this->getAttribute($context["pro"], "images", array()))) {
                // line 105
                $context["flag"] = "true";
                // line 106
                echo "                                            <div id=\"myCarousel\" class=\"carousel slide\" data-ride=\"carousel\">
                                                <div class=\"carousel-inner\" role=\"listbox\">";
                // line 108
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["pro"], "images", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
                    // line 109
                    echo "
                                                        <div class=\"item";
                    // line 110
                    if ((($context["flag"] ?? null) == "true")) {
                        echo " active";
                    }
                    echo "\" >";
                    // line 111
                    $context["flag"] = "false";
                    // line 112
                    echo "                                                            <img src=\"assets/images/products/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["img"], "file_name", array()), "html", null, true);
                    echo "\" alt=\"product images\">
                                                        </div>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 116
                echo "                                                </div>
                                            </div>";
            } else {
                // line 119
                echo "                                            <img src=\"assets/images/products/our-products.png\">";
            }
            // line 121
            echo "

                                        <div class=\"caption\" style=\"text-align: center;\">
                                            <h3>";
            // line 124
            echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "short_name", array()), "html", null, true);
            echo "</h3>";
            // line 148
            echo "                                            <p>
                                            <div class='add_btn' id='add_btn_";
            // line 149
            echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
            echo "'";
            if ((($context["product_id"] ?? null) == $this->getAttribute($context["pro"], "id", array()))) {
                echo " style='display:none;'";
            }
            echo ">
                                                <button type=\"submit\" onclick='addToCart(";
            // line 150
            echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
            echo ")' class=\"btn   btn-blue btn-squared btn-block\">";
            // line 151
            echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_LEFT"] ?? null), "html", null, true);
            echo "
                                                    <strong>";
            // line 153
            echo twig_escape_filter($this->env, twig_round(($this->getAttribute($context["pro"], "product_amount", array()) * ($context["MLM_CURRENCY_VALUE"] ?? null)), ($context["CURRENCY_ROUND"] ?? null), "floor"), "html", null, true);
            echo "
                                                    </strong>";
            // line 155
            echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_RIGHT"] ?? null), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, lang("add_cart")), "html", null, true);
            echo "

                                                </button>
                                            </div>
                                            <div class='added_btn' id='added_btn_";
            // line 159
            echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
            echo "'";
            if ((($context["product_id"] ?? null) != $this->getAttribute($context["pro"], "id", array()))) {
                echo " style='display:none;'";
            }
            echo ">
                                                <button type=\"submit\" class=\"btn  btn-success btn-squared btn-block\">";
            // line 161
            echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_LEFT"] ?? null), "html", null, true);
            echo "
                                                    <strong>";
            // line 163
            echo twig_escape_filter($this->env, twig_round(($this->getAttribute($context["pro"], "product_amount", array()) * ($context["MLM_CURRENCY_VALUE"] ?? null)), ($context["CURRENCY_ROUND"] ?? null), "floor"), "html", null, true);
            echo "
                                                    </strong>";
            // line 165
            echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_RIGHT"] ?? null), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, lang("selected")), "html", null, true);
            echo " <i class=\"fa fa-check\"></i>
                                                </button>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pro'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 174
        echo "
                            <div class=\"form\">
                                <input type=\"hidden\" id=\"encode_id\" value=\"";
        // line 176
        echo twig_escape_filter($this->env, ($context["encode_id"] ?? null), "html", null, true);
        echo "\"/>
                                <input type=\"hidden\" id=\"encode_leg\" value=\"";
        // line 177
        echo twig_escape_filter($this->env, ($context["encode_leg"] ?? null), "html", null, true);
        echo "\"/>
                                <input type=\"hidden\" id=\"tree_reg\" value=\"";
        // line 178
        echo twig_escape_filter($this->env, ($context["tree_reg"] ?? null), "html", null, true);
        echo "\"/>
                                <div class=\"form-group\">
                                    <div class=\"col-sm-12\" style=\"min-height: 46px;\">
                                        <button type=\"button\" class=\"btn btn-info  pull-right\"  onclick='proceedToReg(\"enroll\")'>";
        // line 182
        if (($context["basic_flag"] ?? null)) {
            // line 183
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, lang("continue_to_reg")), "html", null, true);
        } else {
            // line 185
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, lang("continue_to_single_reg")), "html", null, true);
        }
        // line 187
        echo "                                            <i class=\"fa fa-arrow-circle-right\"></i>
                                        </button>
                                    </div>
                                </div>";
        // line 192
        if ( !($context["basic_flag"] ?? null)) {
            // line 193
            echo "                                    <div class=\"form-group\">
                                        <div class=\"col-sm-12\" style=\"min-height: 46px;\">
                                            <button type=\"button\" class=\"btn btn-info pull-right\"  onclick='proceedToReg(\"enroll-multi\")'>";
            // line 196
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, lang("continue_to_multiple_reg")), "html", null, true);
            echo "  <i class=\"fa fa-arrow-circle-right\"></i>
                                            </button>
                                        </div>
                                    </div>


                                    <div class=\"form-group\">
                                        <div class=\"col-sm-12\" style=\"min-height: 46px;\">
                                            <button type=\"button\" class=\"btn btn-info pull-right\"  onclick='proceedToReg(\"enroll-advanced\")'>";
            // line 205
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, lang("continue_to_advanced_reg")), "html", null, true);
            echo "  <i class=\"fa fa-arrow-circle-right\"></i>
                                            </button>
                                        </div>
                                    </div>";
        }
        // line 210
        echo "                            </div>

                        </div>
                    </div>
                </div>
            </div>";
        // line 216
        if (((($context["user_type"] ?? null) == "admin") || (($context["user_type"] ?? null) == "employee"))) {
            // line 217
            $this->loadTemplate("admin/layout/footer.twig", "register/packages.twig", 217)->display($context);
        } elseif ((        // line 218
($context["user_type"] ?? null) == "user")) {
            // line 219
            $this->loadTemplate("user/layout/footer.twig", "register/packages.twig", 219)->display($context);
        } else {
            // line 221
            echo "            </div>
        </div>";
            // line 223
            $this->loadTemplate("layout/footer.twig", "register/packages.twig", 223)->display($context);
            // line 224
            echo "        <link rel=\"stylesheet\" href=\"assets/plugins/toastr/toastr.min.css\">
        <script src=\"assets/plugins/toastr/toastr.js\"></script>";
        }
        // line 227
        echo "    <script src=\"assets/js/register_cart.js\">
    </script>
    <script>
        jQuery(document).ready(function () {
            \$(\"html,body\").animate({scrollTop: 100}, \"slow\");
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "register/packages.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  369 => 227,  365 => 224,  363 => 223,  360 => 221,  357 => 219,  355 => 218,  353 => 217,  351 => 216,  344 => 210,  337 => 205,  326 => 196,  322 => 193,  320 => 192,  315 => 187,  312 => 185,  309 => 183,  307 => 182,  301 => 178,  297 => 177,  293 => 176,  289 => 174,  274 => 165,  270 => 163,  266 => 161,  258 => 159,  249 => 155,  245 => 153,  241 => 151,  238 => 150,  230 => 149,  227 => 148,  224 => 124,  219 => 121,  216 => 119,  212 => 116,  203 => 112,  201 => 111,  196 => 110,  193 => 109,  189 => 108,  186 => 106,  184 => 105,  182 => 104,  178 => 101,  174 => 100,  170 => 96,  164 => 91,  156 => 84,  154 => 83,  151 => 81,  141 => 76,  136 => 74,  132 => 73,  126 => 69,  122 => 68,  116 => 64,  114 => 63,  90 => 39,  88 => 38,  84 => 35,  74 => 27,  71 => 25,  69 => 24,  65 => 21,  61 => 20,  57 => 19,  53 => 18,  49 => 17,  45 => 16,  41 => 14,  36 => 11,  30 => 7,  28 => 6,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "register/packages.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\register\\packages.twig");
    }
}
