<?php

/* layout/footer.twig */
class __TwigTemplate_05387d6697503792849fd74925c2cca72ba2a7fe65b31c5bed0544ee7c369199 extends Twig_Template
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
        echo "<script src=\"assets/plugins/jQuery/jquery-2.1.1.min.js\"></script>
<script src=\"assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js\"></script>
<script src=\"assets/plugins/bootstrap/js/bootstrap.min.js\"></script>
<script src=\"assets/plugins/iCheck/jquery.icheck.min.js\"></script>
<script src=\"assets/plugins/jquery.transit/jquery.transit.js\"></script>
<script src=\"assets/plugins/TouchSwipe/jquery.touchSwipe.min.js\"></script>
<script src=\"assets/js/main.js\"></script>
<script src=\"assets/plugins/rainyday/rainyday.js\"></script>
<script src=\"assets/js/utility-error404.js\"></script>
<script src=\"assets/plugins/jquery-validation/dist/jquery.validate.min.js\"></script>
<script src=\"assets/js/login.js\"></script>
<script src=\"assets/js/webpage_timeout.js\"></script>
<script src=\"assets/js/currency-lang-switch.js\"></script>
<script src=\"assets/js/toaster_notification.js\"></script>
<script src=\"assets/plugins/blockUI/jquery.blockUI.js\"></script>
<script>
    jQuery(document).ready(function () {
        Main.init();
        Login.init();
    });

    \$(\"form\").submit(function (event) {
        \$.blockUI({
            message: '<i class=\"fa fa-spinner fa-spin\"></i>' + \$('#please_wait_js').html()
        });
        setTimeout(function () {
            \$.unblockUI();
        }, 1000);
    });
</script>";
        // line 31
        if ((($context["http_host"] ?? null) != "localhost")) {
            // line 32
            echo "    <script>
        \$(document).keydown(function (e) {
            if (e.which === 123) {
                return false;
            }
        });
        \$(document).bind(\"contextmenu\", function (e) {
            e.preventDefault();
        });

    </script>";
        }
        // line 44
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            // line 45
            echo "    <!--Start of Tawk.to Script-->
    <script type=\"text/javascript\">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement(\"script\"), s0 = document.getElementsByTagName(\"script\")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5a66c6d5d7591465c706ff79/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->";
        }
        // line 59
        echo "<div id=\"js_validation_messages\" style=\"display: none;\"> 
    <span id=\"this_field_is_required_msg_js\">";
        // line 60
        echo twig_escape_filter($this->env, lang("this_field_is_required_msg_js"), "html", null, true);
        echo "</span>    
    <span id=\"characters_msg_js\">";
        // line 61
        echo twig_escape_filter($this->env, lang("characters_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"enter_valid_email_msg_js\">";
        // line 62
        echo twig_escape_filter($this->env, lang("enter_valid_email_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"enter_digits_only_msg_js\">";
        // line 63
        echo twig_escape_filter($this->env, lang("enter_digits_only_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"invalid_number_msg_js\">";
        // line 64
        echo twig_escape_filter($this->env, lang("invalid_number_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"number_gt_msg_js\">";
        // line 65
        echo twig_escape_filter($this->env, lang("number_gt_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"number_lt_msg_js\">";
        // line 66
        echo twig_escape_filter($this->env, lang("number_lt_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"pls_enter_atleast_msg_js\">";
        // line 67
        echo twig_escape_filter($this->env, lang("pls_enter_atleast_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"pls_enter_atmost_msg_js\">";
        // line 68
        echo twig_escape_filter($this->env, lang("pls_enter_atmost_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"succ_js\">";
        // line 69
        echo twig_escape_filter($this->env, lang("success_js"), "html", null, true);
        echo "</span>
    <span id=\"theme_changed_successfully\">";
        // line 70
        echo twig_escape_filter($this->env, lang("theme_changed_successfully"), "html", null, true);
        echo "</span>
    <span id=\"please_wait_js\">";
        // line 71
        echo twig_escape_filter($this->env, lang("please_wait_js"), "html", null, true);
        echo "</span>
    <span id=\"expand_js\">";
        // line 72
        echo twig_escape_filter($this->env, lang("expand"), "html", null, true);
        echo "</span>
    <span id=\"collapse_js\">";
        // line 73
        echo twig_escape_filter($this->env, lang("collapse"), "html", null, true);
        echo "</span>
    <span id=\"file_not_support\">";
        // line 74
        echo twig_escape_filter($this->env, lang("file_not_support"), "html", null, true);
        echo "</span>
</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "layout/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 74,  137 => 73,  133 => 72,  129 => 71,  125 => 70,  121 => 69,  117 => 68,  113 => 67,  109 => 66,  105 => 65,  101 => 64,  97 => 63,  93 => 62,  89 => 61,  85 => 60,  82 => 59,  67 => 45,  65 => 44,  52 => 32,  50 => 31,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout/footer.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\layout\\footer.twig");
    }
}
