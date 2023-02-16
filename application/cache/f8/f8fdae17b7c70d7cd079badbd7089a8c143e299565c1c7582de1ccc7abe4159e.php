<?php

/* admin/layout/footer.twig */
class __TwigTemplate_5fb9fa2335b3ef6f7341e4fb53bd11a48bd6689f3cb0bdcbffa1d1df30ba0134 extends Twig_Template
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

<!-- end:  MAIN CONTENT -->
</div>
<div class=\"subviews\">
    <div class=\"subviews-container\"></div>
</div>
</div>
<!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<!-- start: FOOTER -->
<footer class=\"inner\">
    <div class=\"footer-inner\">
        <div class=\"pull-left\">";
        // line 16
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " &copy; by";
        echo twig_escape_filter($this->env, ($context["COMPANY_NAME"] ?? null), "html", null, true);
        echo ".
        </div>
        <div class=\"pull-right\">
            <span class=\"go-top\"><i class=\"fa fa-chevron-up\"></i></span>
        </div>
    </div>
</footer>

</div>";
        // line 27
        $this->loadTemplate("admin/layout/load_footer_script.twig", "admin/layout/footer.twig", 27)->display($context);
        // line 28
        echo "
<div id=\"js_validation_messages\" style=\"display: none;\"> 
    <span id=\"this_field_is_required_msg_js\">";
        // line 30
        echo twig_escape_filter($this->env, lang("this_field_is_required_msg_js"), "html", null, true);
        echo "</span>    
    <span id=\"characters_msg_js\">";
        // line 31
        echo twig_escape_filter($this->env, lang("characters_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"enter_valid_email_msg_js\">";
        // line 32
        echo twig_escape_filter($this->env, lang("enter_valid_email_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"enter_digits_only_msg_js\">";
        // line 33
        echo twig_escape_filter($this->env, lang("enter_digits_only_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"invalid_number_msg_js\">";
        // line 34
        echo twig_escape_filter($this->env, lang("invalid_number_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"number_gt_msg_js\">";
        // line 35
        echo twig_escape_filter($this->env, lang("number_gt_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"number_lt_msg_js\">";
        // line 36
        echo twig_escape_filter($this->env, lang("number_lt_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"pls_enter_atleast_msg_js\">";
        // line 37
        echo twig_escape_filter($this->env, lang("pls_enter_atleast_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"pls_enter_atmost_msg_js\">";
        // line 38
        echo twig_escape_filter($this->env, lang("pls_enter_atmost_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"succ_js\">";
        // line 39
        echo twig_escape_filter($this->env, lang("success_js"), "html", null, true);
        echo "</span>
    <span id=\"theme_changed_successfully\">";
        // line 40
        echo twig_escape_filter($this->env, lang("theme_changed_successfully"), "html", null, true);
        echo "</span>
    <span id=\"please_wait_js\">";
        // line 41
        echo twig_escape_filter($this->env, lang("please_wait_js"), "html", null, true);
        echo "</span>
    <span id=\"operation_blocked_msg\">";
        // line 42
        echo twig_escape_filter($this->env, lang("operation_blocked_msg"), "html", null, true);
        echo "</span>
    <span id=\"operation_blocked\">";
        // line 43
        echo twig_escape_filter($this->env, lang("operation_blocked"), "html", null, true);
        echo "</span>
    <span id=\"expand_js\">";
        // line 44
        echo twig_escape_filter($this->env, lang("expand"), "html", null, true);
        echo "</span>
    <span id=\"collapse_js\">";
        // line 45
        echo twig_escape_filter($this->env, lang("collapse"), "html", null, true);
        echo "</span>
    <span id=\"empty_js\">";
        // line 46
        echo twig_escape_filter($this->env, lang("empty"), "html", null, true);
        echo "</span>
    <span id=\"failed_js\">";
        // line 47
        echo twig_escape_filter($this->env, lang("failed_js"), "html", null, true);
        echo "</span>
</div>
<script>
    jQuery(document).ready(function () {
        Main.init();

        jQuery.extend(jQuery.validator.messages, {
            required: \$('#this_field_is_required_msg_js').html(),
            email: \$('#enter_valid_email_msg_js').html(),
            digits: \$('#enter_digits_only_msg_js').html(),
            number: \$('#invalid_number_msg_js').html(),
            min: \$('#number_gt_msg_js').html() + ' {0}.',
            max: \$('#number_lt_msg_js').html() + ' {0}.',
            minlength: \$('#pls_enter_atleast_msg_js').html() + ' {0} ' + \$('#characters_msg_js').html(),
            maxlength: \$('#pls_enter_atmost_msg_js').html() + ' {0} ' + \$('#characters_msg_js').html()
        });
    });

    if (\$(\"#active_menu_id\").length) {
        var container = \$('.main-navigation'),
                scrollTo = \$('#active_menu_id');
        container.animate({scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop() - \$(window).height() / 4});
    }


    \$(\"form\").submit(function(event) {
        \$.blockUI({
            message: '<i class=\"fa fa-spinner fa-spin\"></i>' + \$('#please_wait_js').html()
        });
        setTimeout(function () {
            \$.unblockUI();
        }, 1000);
    });
    
    var changeSystemMod = function () {
        \$.ajax({
            type: 'POST',
            url: 'admin/home/change_theme_mode',
            data: {},

            beforeSend: function () {
            },
            success: function (data) {                
            },
            error: function (xhr) {
                //alert(\"Error occured.please try again\");
            },
            complete: function () {
                location.reload();
            },
            dataType: 'json'
        });
    };
    
</script>";
        // line 102
        if ((($context["MULTI_LANG_STATUS"] ?? null) == 0)) {
            // line 103
            if ((($context["GOOGLE_TRANSLATOR"] ?? null) == 1)) {
                // line 104
                echo "        <script type=\"text/javascript\" src=\"//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit\"></script>
        <script type=\"text/javascript\">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en', autoDisplay: false}, 'google_translate_element');
            }
        </script>";
            }
        }
        // line 112
        if ((($context["http_host"] ?? null) != "localhost")) {
            // line 113
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
        // line 124
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            // line 125
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
        // line 139
        echo "

</body>
<!-- end: BODY -->
</html>
";
    }

    public function getTemplateName()
    {
        return "admin/layout/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  223 => 139,  208 => 125,  206 => 124,  194 => 113,  192 => 112,  183 => 104,  181 => 103,  179 => 102,  122 => 47,  118 => 46,  114 => 45,  110 => 44,  106 => 43,  102 => 42,  98 => 41,  94 => 40,  90 => 39,  86 => 38,  82 => 37,  78 => 36,  74 => 35,  70 => 34,  66 => 33,  62 => 32,  58 => 31,  54 => 30,  50 => 28,  48 => 27,  35 => 16,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/layout/footer.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\layout\\footer.twig");
    }
}
