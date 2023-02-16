<?php

/* shop/login_register.twig */
class __TwigTemplate_8465750614a8313d0893b68c9cd2a1ed7155b0b5f6aadb63e55177f7977d20a4 extends Twig_Template
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
        echo "<!doctype html>
<html class=\"no-js\" lang=\"en\">

<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
    <title>Mbay Online Shopping</title>
    <meta name=\"robots\" content=\"noindex, follow\" />
    <meta name=\"description\" content=\"\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no\" />

    <!-- Favicon -->
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"assets/shop/images/favicon.png\">

    <!-- All CSS is here
\t============================================ -->

    <link rel=\"stylesheet\" href=\"assets/shop/css/vendor/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/vendor/signericafat.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/vendor/cerebrisans.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/vendor/simple-line-icons.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/vendor/elegant.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/vendor/linear-icon.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/nice-select.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/easyzoom.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/slick.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/animate.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/magnific-popup.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/jquery-ui.css\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/style.css\">

    <!-- Custom CSS -->
    <link rel=\"stylesheet\" href=\"assets/shop/css/custom_style.css\">

</head>

<body>";
        // line 39
        $this->loadTemplate("shop/layout/header.twig", "shop/login_register.twig", 39)->display($context);
        // line 40
        echo "
        <!-- Breadcrumb-area -->
        <div class=\"breadcrumb-area bg-gray\">
            <div class=\"container\">
                <div class=\"breadcrumb-content text-center\">
                    <ul>
                        <li>
                            <a href=\"#\">Home</a>
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
                                <a data-bs-toggle=\"tab\" href=\"#lg2\">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class=\"tab-content\">
                                <!--login-->
                                <div id=\"lg1\" class=\"tab-pane active\">
                                    <div class=\"login-form-container\">
                                        <button type=\"button\"
                                            class=\"btn btn-outline-secondary d-flex w-100 mb-2 align-items-center justify-content-center facebook text-white\">
                                            <i class=\"icon-social-facebook me-1\"></i>Sign in with Facebook</button>
                                        <p class=\"orvia\"><span>Or via email</span></p>
                                        <div class=\"login-register-form\">
                                            <form action=\"#\" method=\"post\">
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"text\" name=\"user-name\"
                                                        placeholder=\"Your Email/Phone Number\">
                                                </div>
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"password\"
                                                        name=\"user-password\" placeholder=\"Password\">
                                                </div>
                                                <div class=\"button-box\">
                                                    <div class=\"login-toggle-btn\">
                                                        <input type=\"checkbox\">
                                                        <label>Keep me logged in</label>
                                                        <a href=\"#\">Forgot your password?</a>
                                                    </div>
                                                    <button class=\"d-block btn\" type=\"submit\">Sign In</button>
                                                    <p class=\"mt-3 mb-0\">
                                                        Don't have an account?  Sign up for one
                                                    </p>
                                                    <p class=\"mt-1\">
                                                        Or just <a class=\"text-decoration-underline\" href=\"#\">checkout as a guest</a>
                                                    </p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--end login-->

                                <!--register-->
                                <div id=\"lg2\" class=\"tab-pane\">
                                    <div class=\"login-form-container\">
                                        <!-- fb or-->
                                        <button type=\"button\"
                                            class=\"btn btn-outline-secondary d-flex w-100 mb-2 align-items-center justify-content-center facebook text-white\">
                                            <i class=\"icon-social-facebook me-1\"></i>Sign up with Facebook</button>
                                        <p class=\"orvia\"><span>Or via email</span></p>
                                        <!-- end fb or-->
                                        <div class=\"login-register-form\">
                                            <form action=\"#\" method=\"post\">
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"text\" name=\"user-name\" placeholder=\"Full Name\">
                                                </div>
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"text\" name=\"user-name\" placeholder=\"Your Email\">
                                                </div>
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"password\" name=\"user-password\" placeholder=\"Password\">
                                                </div>
                                                <div class=\"mb-3\">
                                                    <input class=\"form-control shadow-none\" type=\"number\" name=\"user-password\" placeholder=\"Mobile Number (we’ll send you a verification code)\">
                                                </div>

                                                <div class=\"button-box\">
                                                    <button type=\"submit\">Sign up</button>
                                                </div>
                                                <p class=\"mt-3 mb-0\">Already have an account?  Sign in now</p>
                                                <p class=\"mt-1\">
                                                    Or just <a class=\"text-decoration-underline\" href=\"#\">checkout as a guest</a>
                                                </p>
                                            </form>
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
        // line 154
        $this->loadTemplate("shop/layout/footer.twig", "shop/login_register.twig", 154)->display($context);
        // line 155
        echo "
    </div>

    <!-- All JS is here
============================================ -->

    <script src=\"assets/shop/js/vendor/modernizr-3.11.7.min.js\"></script>
    <script src=\"assets/shop/js/vendor/jquery-v3.6.0.min.js\"></script>
    <script src=\"assets/shop/js/vendor/jquery-migrate-v3.3.2.min.js\"></script>
    <script src=\"assets/shop/js/vendor/popper.min.js\"></script>
    <script src=\"assets/shop/js/vendor/bootstrap.min.js\"></script>
    <script src=\"assets/shop/js/plugins/slick.js\"></script>
    <script src=\"assets/shop/js/plugins/jquery.syotimer.min.js\"></script>
    <script src=\"assets/shop/js/plugins/jquery.nice-select.min.js\"></script>
    <script src=\"assets/shop/js/plugins/wow.js\"></script>
    <script src=\"assets/shop/js/plugins/jquery-ui.js\"></script>
    <script src=\"assets/shop/js/plugins/magnific-popup.js\"></script>
    <script src=\"assets/shop/js/plugins/sticky-sidebar.js\"></script>
    <script src=\"assets/shop/js/plugins/easyzoom.js\"></script>
    <script src=\"assets/shop/js/plugins/scrollup.js\"></script>
    <script src=\"assets/shop/js/plugins/ajax-mail.js\"></script>
    <!-- Main JS -->
    <script src=\"assets/shop/js/main.js\"></script>

</body>

</html>";
    }

    public function getTemplateName()
    {
        return "shop/login_register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 155,  173 => 154,  59 => 40,  57 => 39,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/login_register.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\login_register.twig");
    }
}
