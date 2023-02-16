<?php

/* login/index.twig */
class __TwigTemplate_92aac5dde1ab8f96294eec7983b7a2d1c10d6d0a773eaa5b7d7186d5d618ce8a extends Twig_Template
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
        echo "<!-- MAIN WRAPPER -->
    <div class=\"main-wrapper bg-gray-9\">";
        // line 3
        $this->loadTemplate("shop/layout/header.twig", "login/index.twig", 3)->display($context);
        // line 4
        echo "
        <!-- MOBILE MENU -->
        <div class=\"mobile-header-active mobile-header-wrapper-style\">
            <div class=\"clickalbe-sidebar-wrap\">
                <a class=\"sidebar-close\"><i class=\"icon_close\"></i></a>
                <div class=\"mobile-header-content-area\">

                    <div class=\"mobile-menu-wrap mobile-header-padding-border-2\">
                        <!-- mobile menu start -->
                        <nav>
                            <ul class=\"mobile-menu\">
                                <li><a href=\"#\">Home</a></li>
                                <li><a href=\"#\">About</a></li>
                                <li class=\"menu-item-has-children\"><a href=\"#\">Shop</a>
                                    <ul class=\"dropdown\">
                                        <li><a href=\"#\">Smartphone </a></li>
                                    </ul>
                                </li>
                                <li><a href=\"#\">Contact us</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class=\"mobile-social-icon\">
                        <a class=\"facebook\" href=\"#\"><i class=\"icon-social-facebook\"></i></a>
                        <a class=\"instagram\" href=\"#\"><i class=\"icon-social-instagram\"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MOBILE MENU -->

        <!-- MOBILE VIEW SEARCH AREA -->
        <div class=\"mobile-view-search p-3 pt-0 d-block d-md-block d-lg-block d-xl-none\">
            <div class=\"input-group input-group-sm\">
                <input type=\"text\" class=\"form-control\" placeholder=\"What are you looking for?\"
                    aria-label=\"Recipient's username\" aria-describedby=\"button-addon2\">
                <button class=\"btn btn-outline-secondary\" type=\"button\" id=\"button-addon2\"><i
                        class=\"icon-magnifier\"></i></button>
            </div>
        </div>
        <!-- END MOBILE VIEW SEARCH AREA -->

        <!-- Breadcrumb-area -->
        <div class=\"breadcrumb-area bg-gray\">
            <div class=\"container\">
                <div class=\"breadcrumb-content text-center\">
                    <ul>
                        <li>
                            <a href=\"";
        // line 53
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\">Home</a>
                        </li>
                        <li class=\"active\">Login - Register</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-area -->


        <!-- LOGIN AND REGISTER -->
        <section class=\"login-register-area pt-115 pb-120\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-lg-4 col-md-12 ms-auto me-auto\">
                        <div class=\"login-register-wrapper\">
                            <div class=\"login-register-tab-list nav\">
                                <a class=\"active\" data-bs-toggle=\"tab\" href=\"#lg1\">
                                    <h4> login </h4>
                                </a>
                                <a  data-bs-toggle=\"tab\" href=\"#lg2\">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class=\"tab-content\">
                                <!--login-->
                                <div id=\"lg1\" class=\"tab-pane active\">
                                    <div class=\"login-form-container\">";
        // line 85
        echo "                                        <div class=\"login-register-form\">";
        // line 87
        echo form_open("", "class=\"login_form\" id=\"login_form\" name=\"login_form\"");
        echo "

                                                <div class=\"mb-3\">";
        // line 91
        echo "                                                    <input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\" placeholder=\"";
        echo twig_escape_filter($this->env, lang("user_name"), "html", null, true);
        echo "\" tabindex='1' autocomplete='off'>";
        // line 92
        if ($this->getAttribute(($context["login_error"] ?? null), "username", array(), "any", true, true)) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["login_error"] ?? null), "username", array()), "html", null, true);
            echo " </code>";
        }
        // line 93
        echo "                                                </div>
                                                <div class=\"mb-3\">";
        // line 96
        echo "                                                    <input type=\"password\" class=\"form-control password\" id=\"password\" name=\"password\" placeholder=\"";
        echo twig_escape_filter($this->env, lang("password"), "html", null, true);
        echo "\" tabindex='2'>";
        // line 97
        if ($this->getAttribute(($context["login_error"] ?? null), "password", array(), "any", true, true)) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["login_error"] ?? null), "password", array()), "html", null, true);
            echo " </code>";
        }
        // line 98
        echo "                                                </div>
                                                <div class=\"button-box\">
                                                    <div class=\"login-toggle-btn\">
                                                        <input type=\"checkbox\">
                                                        <label>Keep me logged in</label>
                                                        <a href=\"login-forgot\" >Forgot your password?</a>
                                                    </div>";
        // line 106
        echo "
                                                    <button type=\"submit\" class=\"d-block btn\" id=\"login\" name=\"login\" value=\"Login\">";
        // line 107
        echo twig_escape_filter($this->env, lang("sign_in"), "html", null, true);
        echo " </button>



                                                    <p class=\"mt-3 mb-0\">
                                                        Don't have an account? <span onclick=`\$(\"a[data-bs-toggle='tab']\").click()`> Sign up</span> for one
                                                    </p>
                                                    <!-- <p class=\"mt-1\">
                                                        Or just <a class=\"text-decoration-underline\" href=\"#\">checkout as a guest</a>
                                                    </p> -->
                                                </div>";
        // line 119
        echo form_close();
        echo "

                                        </div>
                                    </div>
                                </div>
                                <!--end login-->

                                <!--register-->
                                <div id=\"lg2\" class=\"tab-pane \">
                                    <div class=\"login-form-container\">
                                        <!-- fb or-->";
        // line 134
        echo "                                        <!-- end fb or-->
                                   
                                        <div class=\"login-register-form\">";
        // line 137
        echo form_open("", "class=\"save_form\" id=\"save_form\" name=\"save_form\"");
        echo "
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"text\" name=\"first_name\" id=\"first_name\" placeholder=\"First Name\">";
        // line 140
        if ($this->getAttribute(($context["login_error"] ?? null), "first_name", array(), "any", true, true)) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["login_error"] ?? null), "first_name", array()), "html", null, true);
            echo " </code>";
        }
        // line 141
        echo "                                             
                                                </div>
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"text\" name=\"last_name\" id=\"last_name\" placeholder=\"Last Name\">";
        // line 145
        if ($this->getAttribute(($context["login_error"] ?? null), "last_name", array(), "any", true, true)) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["login_error"] ?? null), "first_name", array()), "html", null, true);
            echo " </code>";
        }
        // line 146
        echo "                                             
                                                </div>
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"email\" name=\"email\"  id=\"email\" placeholder=\"Your Email\">";
        // line 150
        if ($this->getAttribute(($context["login_error"] ?? null), "email", array(), "any", true, true)) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["login_error"] ?? null), "email", array()), "html", null, true);
            echo " </code>";
        }
        // line 151
        echo "                                              
                                                </div>
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"password\" id=\"password\" name=\"password\" placeholder=\"Password\">";
        // line 155
        if ($this->getAttribute(($context["login_error"] ?? null), "password", array(), "any", true, true)) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["login_error"] ?? null), "password", array()), "html", null, true);
            echo " </code>";
        }
        // line 156
        echo "                                               
                                                </div>";
        // line 161
        echo "                                                <div class=\"button-box\">
                                                    <button type=\"submit\" name=\"add_user\" value=\"add_user\">Sign up</button>
                                                </div>
                                                <p class=\"mt-3 mb-0\">Already have an account? <span onclick=`\$(\"a[data-bs-toggle='tab']\").click()`> Sign In</span> now</p>
                                                <p class=\"mt-1\">";
        // line 167
        echo "                                                </p>";
        // line 168
        echo form_close();
        echo "
                                        </div>
                                    </div>
                                </div>
                                <!--end register-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END LOGIN AND REGISTER -->";
        // line 181
        $this->loadTemplate("shop/layout/footer.twig", "login/index.twig", 181)->display($context);
        // line 182
        echo "       
    </div>
    <!-- END MAIN WRAPPER --> 

<script>";
        // line 199
        echo "</script>
<script src=\"http://code.jquery.com/jquery-3.2.1.min.js\"></script>
<script src=\"http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js\"></script>
<script src=\"http://cdn.syncfusion.com/js/assets/external/jsrender.min.js\"></script>
<script src=\"http://cdn.syncfusion.com/16.4.0.52/js/web/ej.web.all.min.js\"></script>
<script>
    var valSingleStep = function () {

    var form = \$('#save_form');
    var errorHandler2 = \$('.errorHandler', form);
    var successHandler2 = \$('.successHandler', form);
    form.validate({
        errorElement: \"span\", // contain the error msg in a small tag
        errorClass: 'help-block',
        errorPlacement: function (error, element) { // render error placement for each input type
            if (element.attr(\"type\") == \"radio\" || element.attr(\"type\") == \"checkbox\") {// for chosen elements, need to insert the error after the chosen container
                error.insertAfter(\$(element).closest('.form-group').children('div').children().last());
            } else if (element.hasClass(\"ckeditor\")) {
                error.insertAfter(\$(element).closest('.input-group'));
            } else {
               error.insertAfter(\$(element).closest('.form-group').children('div').children().last());

            }
        },
        ignore: \"\",
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                //valiEmail: true,
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6,
                //passwordFormat: true
            }
        },
        messages: {
            first_name: {
                required:\"first_name_req_js\",//\$('#first_name_req_js').html(),
            },
            last_name: {
                 required:\"first_name_req_js\",
            },
            email: {
                //valiEmail: \$('#invalid_email_js').html(),
                  required:\"first_name_req_js\",
                email: \"first_name_req_js\",
                //validOtpEmail:\$('#otp_valid_email_js').html()
            },
            password: {
               // passwordFormat: \$('#passwaord_validation_js').html(),
                required:\"first_name_req_js\",
            }
        },
        invalidHandler: function (event, validator) { //display error alert on form submit
            successHandler2.hide();
            errorHandler2.show();
        },
        highlight: function (element) {
            \$(element).closest('.help-block').removeClass('valid'); // display OK icon
            \$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
            // add the Bootstrap error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            \$(element).closest('.form-group').removeClass('has-error');
            // set error class to the control group
        },
        success: function (label, element) {
            label.addClass('help-block valid');
            // mark the current input as valid and display OK icon
            \$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
        },
        submitHandler: function (form) {
            successHandler2.show();
            errorHandler2.hide();
            // submit form//\$('#form2').submit();

            form.submit();
        }
    });
};
</script>

<script>
\$(document).ready(function() {
 valSingleStep();
});

 </script> 
";
    }

    public function getTemplateName()
    {
        return "login/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  254 => 199,  248 => 182,  246 => 181,  231 => 168,  229 => 167,  223 => 161,  220 => 156,  214 => 155,  209 => 151,  203 => 150,  198 => 146,  192 => 145,  187 => 141,  181 => 140,  176 => 137,  172 => 134,  159 => 119,  146 => 107,  143 => 106,  135 => 98,  129 => 97,  125 => 96,  122 => 93,  116 => 92,  112 => 91,  107 => 87,  105 => 85,  75 => 53,  24 => 4,  22 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "login/index.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\login\\index.twig");
    }
}
