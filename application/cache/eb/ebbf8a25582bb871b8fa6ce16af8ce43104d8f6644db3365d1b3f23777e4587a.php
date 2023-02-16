<?php

/* shop/layout/footer.twig */
class __TwigTemplate_b06ec9f4e3996ee134db635c089d89fcafde3920605662f1049fe9aa430c31d8 extends Twig_Template
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
        echo "<footer class=\"footer-area pt-85 pb-90\">
            <div class=\"container\">
                <div class=\"footer-top text-center\">
                    <div class=\"footer-menu footer-menu-mrg footer-menu-hover-border\">
                        <nav>
                            <ul>
                                <li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop\">shop</a></li>
                                <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "about-us\">about</a></li>
                                <li><a href=\"#\">Warrenty </a></li>
                                <li><a href=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "contact\">Contact</a></li>
                                <li><a href=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "app\">mbay App</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class=\"footer-middle footer-middle-mrg\">
                    <div class=\"row\">
                        <div class=\"col-lg-3 col-md-3\">
                            <div class=\"social-style-3-wrap xs-center\">
                                <span>follow us</span>
                                <div class=\"social-style-1\">
                                    <a href=\"#\"><i class=\"icon-social-twitter\"></i></a>
                                    <a href=\"#\"><i class=\"icon-social-facebook\"></i></a>
                                    <a href=\"#\"><i class=\"icon-social-instagram\"></i></a>
                                    <a href=\"#\"><i class=\"icon-social-youtube\"></i></a>
                                    <a href=\"#\"><i class=\"icon-social-pinterest\"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-lg-6 col-md-6\">
                            <div class=\"contact-info-wrap-2 text-center\">
                                <div class=\"footer-logo footer-logo-mrg\">
                                    <a href=\"#\"><img src=\"assets/shop/images/logo/mbay.svg\" alt=\"logo\"></a>
                                </div>
                                <p>Muscat, Oman</p>
                                <p>+968 123456789</p>
                                <p>hello@domain.com</p>
                            </div>
                        </div>
                        <div class=\"col-lg-3 col-md-3\">
                            <div class=\"language-style-2-wrap language-style-2-right\">
                                <span>Need Help?</span>
                                <div class=\"language-style-2\">
                                    <a href=\"#\">WhatsApp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"footer-bottom copyright text-center\">
                    <p>Copyright © 2022 mbay</p>
                </div>
            </div>
        </footer>
        </div>
    <!-- END MAIN WRAPPER -->

    <!-- BASE JS -->
    <script src=\"assets/shop/js/vendor/jquery-v3.6.0.min.js\"></script>
    <script src=\"assets/shop/js/vendor/popper.min.js\"></script>
    <script src=\"assets/shop/js/vendor/bootstrap.min.js\"></script>

    <!-- PAGE JS -->
    <script src=\"assets/shop/js/plugins/slick.js\"></script>
    <script src=\"assets/shop/js/plugins/wow.js\"></script>
    <script src=\"assets/shop/js/plugins/jquery-ui.js\"></script>
    <script src=\"assets/shop/js/plugins/sticky-sidebar.js\"></script>

    <!-- MAIN JS -->
    <script src=\"assets/shop/js/main.js\"></script>

</body>

</html>";
    }

    public function getTemplateName()
    {
        return "shop/layout/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 11,  36 => 10,  31 => 8,  27 => 7,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/layout/footer.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\layout\\footer.twig");
    }
}
