<?php

/* cart/index.twig */
class __TwigTemplate_bf7b97477235938728cf26006b5b7b59f6e98b5f7a0f02fee02bb9ff6c0bf66c extends Twig_Template
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
            $this->loadTemplate("admin/layout/header.twig", "cart/index.twig", 2)->display($context);
        } elseif ((        // line 3
($context["user_type"] ?? null) == "user")) {
            // line 4
            $this->loadTemplate("user/layout/header.twig", "cart/index.twig", 4)->display($context);
        } else {
            // line 7
            $this->loadTemplate("layout/header.twig", "cart/index.twig", 7)->display($context);
            // line 8
            echo "    <body class=\"login\">
        <input type=\"hidden\" name=\"path\" id=\"path\" value=\"";
            // line 9
            echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
            echo "\"/>   
        <div class=\"row\">
            <div class=\"main-login col-sm-offset-1 col-md-10\">
                <div class=\"logo\">
                    <img src=\"assets/images/logos/";
            // line 13
            echo twig_escape_filter($this->env, ($context["COMPANY_LOGO"] ?? null), "html", null, true);
            echo "\" width=\"150px;\" height=\"40px;\">
                </div>";
        }
        // line 16
        echo "            <div id=\"js_messages\" style=\"display: none;\"> 
                <span id=\"add_to_cart_js\">";
        // line 17
        echo twig_escape_filter($this->env, lang("add_to_cart_js"), "html", null, true);
        echo "</span>    
                <span id=\"success_js\">";
        // line 18
        echo twig_escape_filter($this->env, lang("success_js"), "html", null, true);
        echo "</span>
                <span id=\"failed_to_add_js\">";
        // line 19
        echo twig_escape_filter($this->env, lang("failed_to_add_js"), "html", null, true);
        echo "</span>
                <span id=\"failed_js\">";
        // line 20
        echo twig_escape_filter($this->env, lang("failed_js"), "html", null, true);
        echo "</span>                
                <span id=\"added_to_cart_js\">";
        // line 21
        echo twig_escape_filter($this->env, lang("added_to_cart_js"), "html", null, true);
        echo "</span>                
            </div>


            <div class=\"row\">            
                <div class=\"col-md-12\">
                    <div class=\"panel panel-white\">
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-md-12 \">";
        // line 31
        $this->loadTemplate("cart/shopping_cart.twig", "cart/index.twig", 31)->display($context);
        // line 32
        echo "                                </div>
                            </div>
                        </div>
                        <div class=\"panel-body\">";
        // line 38
        if ( !($context["user_type"] ?? null)) {
            // line 39
            $this->loadTemplate("admin/layout/notification.twig", "cart/index.twig", 39)->display($context);
        }
        // line 42
        if (twig_length_filter($this->env, ($context["products"] ?? null))) {
            // line 43
            echo "                                <div class=\"pricing-table pricing-bisque\">";
            // line 44
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["pro"]) {
                echo " 
                                        <div class=\"col-sm-4 col-md-3 featured\" >
                                            <div class=\"thumbnail\" style=\"box-shadow: 0 3px 20px  \">";
                // line 47
                if (twig_length_filter($this->env, $this->getAttribute($context["pro"], "images", array()))) {
                    // line 48
                    $context["flag"] = "true";
                    // line 49
                    echo "
                                                    <div id=\"myCarousel\" class=\"carousel slide\" data-ride=\"carousel\">
                                                        <div class=\"carousel-inner\" role=\"listbox\">";
                    // line 52
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["pro"], "images", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
                        // line 53
                        echo "
                                                                <div class=\"item";
                        // line 54
                        if ((($context["flag"] ?? null) == "true")) {
                            echo " active";
                        }
                        echo "\" >";
                        // line 55
                        $context["flag"] = "false";
                        // line 56
                        if (($context["user_type"] ?? null)) {
                            // line 57
                            echo "                                                                        <a class=\"alert-link show-sv\" href=\"#product_view_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
                            echo "\" data-startFrom=\"right\" title=\"";
                            echo twig_escape_filter($this->env, lang("click_here_for_more_details"), "html", null, true);
                            echo "\">";
                        }
                        // line 59
                        echo "
                                                                        <img src=\"assets/images/products/";
                        // line 60
                        echo twig_escape_filter($this->env, $this->getAttribute($context["img"], "file_name", array()), "html", null, true);
                        echo "\" alt=\"product images\"  style=\"width:100%;height: 225px;\">";
                        // line 61
                        if (($context["user_type"] ?? null)) {
                            // line 62
                            echo "                                                                        </a>";
                        }
                        // line 64
                        echo "                                                                </div>";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 67
                    echo "                                                        </div>
                                                    </div>";
                } else {
                    // line 70
                    if (($context["user_type"] ?? null)) {
                        echo "<a class=\"alert-link show-sv\" href=\"#product_view_";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
                        echo "\" data-startFrom=\"right\" title=\"";
                        echo twig_escape_filter($this->env, lang("click_here_for_more_details"), "html", null, true);
                        echo "\">";
                    }
                    // line 71
                    echo "                                                        <img src=\"assets/images/products/our-products.png\"  style=\"width:100%;height: 225px;\"/>";
                    // line 72
                    if (($context["user_type"] ?? null)) {
                        echo "</a>";
                    }
                }
                // line 75
                echo "

                                                <div class=\"caption\" style=\"text-align: center;\">
                                                    <h3>";
                // line 78
                echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "short_name", array()), "html", null, true);
                echo "</h3>
                                                    <p>";
                // line 80
                echo twig_escape_filter($this->env, lang("code"), "html", null, true);
                echo ":";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "product_code", array()), "html", null, true);
                echo "
                                                    </p>
                                                    <p>";
                // line 83
                echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_LEFT"] ?? null), "html", null, true);
                echo " 
                                                        <strong>";
                // line 85
                echo twig_escape_filter($this->env, twig_round(($this->getAttribute($context["pro"], "product_amount", array()) * ($context["MLM_CURRENCY_VALUE"] ?? null)), ($context["CURRENCY_ROUND"] ?? null), "floor"), "html", null, true);
                echo " 
                                                        </strong>";
                // line 87
                echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_RIGHT"] ?? null), "html", null, true);
                // line 89
                if ($this->getAttribute($context["pro"], "original_product_amount", array())) {
                    echo " 

                                                            <del>
                                                                (<font color=\"red\">";
                    // line 92
                    echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_LEFT"] ?? null), "html", null, true);
                    echo twig_escape_filter($this->env, twig_round(($this->getAttribute($context["pro"], "original_product_amount", array()) * ($context["MLM_CURRENCY_VALUE"] ?? null)), ($context["CURRENCY_ROUND"] ?? null), "floor"), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_RIGHT"] ?? null), "html", null, true);
                    echo "</font>)
                                                            </del>";
                }
                // line 96
                if ($this->getAttribute($context["pro"], "recurring_type", array())) {
                    // line 97
                    echo "                                                            /";
                    echo twig_escape_filter($this->env, lang($this->getAttribute($context["pro"], "recurring_type", array())), "html", null, true);
                }
                // line 100
                echo "                                                    </p>
                                                    <p>";
                // line 102
                echo twig_escape_filter($this->env, lang("pv"), "html", null, true);
                echo " :";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "product_pv", array()), "html", null, true);
                echo "
                                                    </p>
                                                    <p>

                                                    <div class=\"btn-ground text-center\">
                                                        <button type=\"submit\" class=\"btn   btn-blue btn-squared btn-block\" onclick='addToCart(";
                // line 107
                echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
                echo ",";
                echo twig_escape_filter($this->env, ($context["party_id"] ?? null), "html", null, true);
                echo " )'>";
                echo twig_escape_filter($this->env, lang("add_to_cart"), "html", null, true);
                echo "</button>

                                                    </div>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>";
                // line 116
                if (($context["user_type"] ?? null)) {
                    // line 117
                    echo "
                                            <div id=\"product_view_";
                    // line 118
                    echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
                    echo "\" class=\"no-display\">
                                                <p>                                            
                                                <div class=\"col-md-12\">
                                                    <div class=\"preview col-md-5\">
                                                        <div class=\"tabbable tabs-bottom faq prod_img_list\" style=\"border: none; padding: 0px; \">
                                                            <div class=\"tab-content\" style=\"text-align: center;\">";
                    // line 124
                    if (twig_length_filter($this->env, $this->getAttribute($context["pro"], "images", array()))) {
                        // line 125
                        $context["first_image"] = "true";
                        // line 127
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["pro"], "images", array()));
                        $context['loop'] = array(
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        );
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
                            // line 128
                            echo "                                                                        <div class=\"tab-pane";
                            if ((($context["first_image"] ?? null) == "true")) {
                                echo " active";
                            }
                            echo "\" id=\"subview_image_";
                            echo twig_escape_filter($this->env, (($this->getAttribute($context["pro"], "id", array()) . "_") . $this->getAttribute($context["loop"], "index", array())), "html", null, true);
                            echo "\" style=\"padding: 25px;\">
                                                                            <img src=\"assets/images/products/";
                            // line 129
                            echo twig_escape_filter($this->env, $this->getAttribute($context["img"], "file_name", array()), "html", null, true);
                            echo "\" style=\"height: 315px;max-width: 315px;\"/>
                                                                        </div>";
                            // line 131
                            $context["first_image"] = "false";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['length'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                    } else {
                        // line 134
                        echo "                                                                    <div class=\"tab-pane active\" id=\"subview_image_";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
                        echo "\" style=\"padding: 25px;\">
                                                                            <img src=\"assets/images/products/our-products.png\" style=\"width: 100%;max-width: 500px;max-height: 400px;\"/>
                                                                        </div>";
                    }
                    // line 138
                    echo "                                                            </div>
                                                             <ul class=\"nav nav-tabs product-tabs\" style=\"border:0px;\">";
                    // line 140
                    if (twig_length_filter($this->env, $this->getAttribute($context["pro"], "images", array()))) {
                        // line 141
                        $context["first_image"] = "true";
                        // line 143
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["pro"], "images", array()));
                        $context['loop'] = array(
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        );
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
                            // line 144
                            echo "                                                                        <li";
                            if ((($context["first_image"] ?? null) == "true")) {
                                echo " data-toggle=\"tab\" class=\"active\"";
                            }
                            echo " style=\"height: 50px;\">
                                                                            <a href=\"#subview_image_";
                            // line 145
                            echo twig_escape_filter($this->env, (($this->getAttribute($context["pro"], "id", array()) . "_") . $this->getAttribute($context["loop"], "index", array())), "html", null, true);
                            echo "\" data-toggle=\"tab\" style=\"height: 50px;padding: 0px;\">
                                                                                <img src=\"assets/images/products/";
                            // line 146
                            echo twig_escape_filter($this->env, $this->getAttribute($context["img"], "file_name", array()), "html", null, true);
                            echo "\" style=\"width: 50px;height: 50px;\"/>
                                                                            </a>
                                                                        </li>";
                            // line 150
                            $context["first_image"] = "false";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['length'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                    }
                    // line 153
                    echo "                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class=\"details col-md-7\">
                                                        <h3 class=\"product-title\">";
                    // line 158
                    echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "product_name", array()), "html", null, true);
                    echo "</h3>

                                                        <p class=\"product-description\">";
                    // line 160
                    echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "description", array()), "html", null, true);
                    echo "</p>
                                                        <h4 class=\"price\">";
                    // line 161
                    echo twig_escape_filter($this->env, lang("price"), "html", null, true);
                    echo " : <span>";
                    echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_LEFT"] ?? null), "html", null, true);
                    echo twig_escape_filter($this->env, twig_round(($this->getAttribute($context["pro"], "product_amount", array()) * ($context["MLM_CURRENCY_VALUE"] ?? null)), ($context["CURRENCY_ROUND"] ?? null), "floor"), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_RIGHT"] ?? null), "html", null, true);
                    echo "</span></h4>

                                                        <h4 class=\"price\">";
                    // line 163
                    echo twig_escape_filter($this->env, lang("pv"), "html", null, true);
                    echo " : <span>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "product_pv", array()), "html", null, true);
                    echo "</span></h4>                                    
                                                        <h4 class=\"price\">";
                    // line 164
                    echo twig_escape_filter($this->env, lang("quantity"), "html", null, true);
                    echo " : <span>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "quantity", array()), "html", null, true);
                    echo "</span></h4>                                    

                                                        <h4 class=\"price\">";
                    // line 166
                    echo twig_escape_filter($this->env, lang("code"), "html", null, true);
                    echo " : <span>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "product_code", array()), "html", null, true);
                    echo "</span></h4>    
                                                        <br /> 

                                                        <div class=\"action\">
                                                            <button type=\"button\" class=\"btn btn-primary\" onclick='addToCart(";
                    // line 170
                    echo twig_escape_filter($this->env, $this->getAttribute($context["pro"], "id", array()), "html", null, true);
                    echo ",";
                    echo twig_escape_filter($this->env, ($context["party_id"] ?? null), "html", null, true);
                    echo " )' ><span class=\"glyphicon glyphicon-shopping-cart\"></span>";
                    echo twig_escape_filter($this->env, lang("add_to_cart"), "html", null, true);
                    echo "</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pro'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 177
            echo "                                </div>";
        } else {
            // line 180
            echo "                                <h4 align=\"center\">";
            echo twig_escape_filter($this->env, lang("no_products"), "html", null, true);
            echo "</h4>";
        }
        // line 182
        echo "                        </div>
                    </div>
                </div>                                    
            </div>";
        // line 187
        if (((($context["user_type"] ?? null) == "admin") || (($context["user_type"] ?? null) == "employee"))) {
            // line 188
            $this->loadTemplate("admin/layout/footer.twig", "cart/index.twig", 188)->display($context);
        } elseif ((        // line 189
($context["user_type"] ?? null) == "user")) {
            // line 190
            $this->loadTemplate("user/layout/footer.twig", "cart/index.twig", 190)->display($context);
        } else {
            // line 192
            echo "            </div>
            <link rel=\"stylesheet\" href=\"assets/plugins/toastr/toastr.min.css\">\t\t
            <script src=\"assets/plugins/jQuery/jquery-2.1.1.min.js\"></script>
            <script src=\"assets/plugins/toastr/toastr.js\"></script>";
            // line 196
            $this->loadTemplate("layout/footer.twig", "cart/index.twig", 196)->display($context);
        }
        // line 198
        echo "        <link rel=\"stylesheet\" href=\"assets/css/cart.css\">\t
        <script src=\"assets/js/cart.js\"></script>";
        // line 201
        if (($context["user_type"] ?? null)) {
            // line 202
            echo "            <script src=\"assets/js/ui-subview.js\">
            </script>
            <script>
            jQuery(document).ready(function () {
                UISubview.init();
            });
                
            function changeActiveImages(pro_id, image_index){
                \$('.subview_images_' + pro_id).removeClass(\"active\");
                \$('#subview_image_' + pro_id + '_' + image_index).addClass(\"active\");
            }
  
            \$('.prod_img_list').on('mouseenter', '[data-toggle=\"tab\"]', function () {
              \$(this).tab('show');
            });
            </script>";
        }
        // line 219
        echo "
        <style type=\"text/css\">
            
            .product-tabs {
                display: flex;
                justify-content: center;
                flex-direction: row;
                 background-color: white;
            }

        </style>

";
    }

    public function getTemplateName()
    {
        return "cart/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  478 => 219,  460 => 202,  458 => 201,  455 => 198,  452 => 196,  447 => 192,  444 => 190,  442 => 189,  440 => 188,  438 => 187,  433 => 182,  428 => 180,  425 => 177,  409 => 170,  400 => 166,  393 => 164,  387 => 163,  378 => 161,  374 => 160,  369 => 158,  362 => 153,  347 => 150,  342 => 146,  338 => 145,  331 => 144,  314 => 143,  312 => 141,  310 => 140,  307 => 138,  300 => 134,  285 => 131,  281 => 129,  272 => 128,  255 => 127,  253 => 125,  251 => 124,  243 => 118,  240 => 117,  238 => 116,  224 => 107,  214 => 102,  211 => 100,  207 => 97,  205 => 96,  198 => 92,  192 => 89,  190 => 87,  186 => 85,  182 => 83,  175 => 80,  171 => 78,  166 => 75,  161 => 72,  159 => 71,  151 => 70,  147 => 67,  141 => 64,  138 => 62,  136 => 61,  133 => 60,  130 => 59,  123 => 57,  121 => 56,  119 => 55,  114 => 54,  111 => 53,  107 => 52,  103 => 49,  101 => 48,  99 => 47,  92 => 44,  90 => 43,  88 => 42,  85 => 39,  83 => 38,  78 => 32,  76 => 31,  64 => 21,  60 => 20,  56 => 19,  52 => 18,  48 => 17,  45 => 16,  40 => 13,  33 => 9,  30 => 8,  28 => 7,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "cart/index.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\cart\\index.twig");
    }
}
