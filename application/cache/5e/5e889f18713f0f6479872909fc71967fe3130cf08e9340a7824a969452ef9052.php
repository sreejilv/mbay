<?php

/* shop/app.twig */
class __TwigTemplate_60e4564cd4fe0f7d43b297fbbe253d4c2da6f179b4f2c934f4d1539de65af41a extends Twig_Template
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
        $this->loadTemplate("shop/layout/header.twig", "shop/app.twig", 1)->display($context);
        // line 2
        echo "
        <!-- Breadcrumb-area -->
        <div class=\"breadcrumb-area bg-gray\">
            <div class=\"container\">
                <div class=\"breadcrumb-content text-center\">
                    <ul>
                        <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\">Home</a></li>
                        <li class=\"active\">mbay App</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-area -->


        <!-- ABOUT -->
        <section class=\"app-area pt-120 pb-120\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-lg-10 app-header mx-auto\">
                        <div class=\"app-logo\">
                            <img src=\"assets/shop/images/bg/app-home.png\" alt=\"App Logo\">
                        </div>
                        <h1>mbay app on your Home screen</h1>
                        <p>
                            Enjoy mbay like a native app.
                        </p>
                        <p>
                            Fast, more secure, and totally free!
                        </p>
                        <p>
                            Works better with Chrome, Opera, Safari, and Samsung Internet
                        </p>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-lg-10 mx-auto andorid-ios-tab\">

                        <h4>To get mbay right on your home screen follow our guides:</h4>

                        <!--android ios-->
                        <ul class=\"nav nav-tabs mb-3\" id=\"myTab\" role=\"tablist\">
                            <li class=\"nav-item\" role=\"presentation\">
                                <button class=\"nav-link active\" id=\"home-tab\" data-bs-toggle=\"tab\"
                                    data-bs-target=\"#home-tab-pane\" type=\"button\" role=\"tab\"
                                    aria-controls=\"home-tab-pane\" aria-selected=\"true\">
                                    <img class=\"platform-icon\" src=\"assets/shop/images/icon-img/android.svg\" width=\"20px\"
                                        alt=\"Android Icon\">Android
                                </button>
                            </li>
                            <li class=\"nav-item\" role=\"presentation\">
                                <button class=\"nav-link\" id=\"profile-tab\" data-bs-toggle=\"tab\"
                                    data-bs-target=\"#profile-tab-pane\" type=\"button\" role=\"tab\"
                                    aria-controls=\"profile-tab-pane\" aria-selected=\"false\">
                                    <img class=\"platform-icon\" src=\"assets/shop/images/icon-img/apple.svg\" width=\"20px\"
                                        alt=\"Apple Icon\">iOS
                                </button>
                            </li>
                        </ul>
                        <div class=\"tab-content\" id=\"myTabContent\">
                            <div class=\"tab-pane fade show active\" id=\"home-tab-pane\" role=\"tabpanel\"
                                aria-labelledby=\"home-tab\" tabindex=\"0\">
                                <ul class=\"instructions-steps\">
                                    <li data-number=\"1\">
                                        <div class=\"instructions-steps-title\">Load mbay.com in the Chrome Web Browser
                                        </div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                    <li data-number=\"2\">
                                        <div class=\"instructions-steps-title\">Tap the 3 dots in the top right corner
                                        </div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                    <li data-number=\"3\">
                                        <div class=\"instructions-steps-title\">Select \"Add to Home screen\" from the
                                            available options</div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                    <li data-number=\"4\">
                                        <div class=\"instructions-steps-title\">Chrome will open a prompt and you will be
                                            able to add mbay icon to your home screen. Change the App name if you want
                                            to2</div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                    <li data-number=\"5\">
                                        <div class=\"instructions-steps-title\">Launch the app to ensure the install has
                                            been successful. That's it. Enjoy!</div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                </ul>
                            </div>
                            <div class=\"tab-pane fade\" id=\"profile-tab-pane\" role=\"tabpanel\"
                                aria-labelledby=\"profile-tab\" tabindex=\"0\">
                                <ul data-tab=\"ios\" class=\"instructions-steps\">
                                    <li data-number=\"1\">
                                        <div class=\"instructions-steps-title\">Load mbay.com in the Safari Web
                                            Browser</div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                    <li data-number=\"2\">
                                        <div class=\"instructions-steps-title\">Tap the share icon</div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                    <li data-number=\"3\">
                                        <div class=\"instructions-steps-title\">Select \"Add to Home screen\" from the
                                            available options</div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                    <li data-number=\"4\">
                                        <div class=\"instructions-steps-title\">Change the App name if you want to</div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                    <li data-number=\"5\">
                                        <div class=\"instructions-steps-title\">Launch the app to ensure the install has
                                            been successful. That's it. Enjoy!</div>
                                        <img alt=\"\" src=\"#\">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--end android ios-->
                    </div>
                </div>
            </div>
        </section>
        <!-- END ABOUT -->";
        // line 129
        $this->loadTemplate("shop/layout/footer.twig", "shop/app.twig", 129)->display($context);
    }

    public function getTemplateName()
    {
        return "shop/app.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  151 => 129,  29 => 8,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/app.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\app.twig");
    }
}
