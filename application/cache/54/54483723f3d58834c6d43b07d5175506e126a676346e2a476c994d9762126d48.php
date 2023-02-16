<?php

/* admin/layout/notification.twig */
class __TwigTemplate_ace37bd89a1f52812e662afa8672c47e2c199ca194e2205615bbc768bf94b776 extends Twig_Template
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
        if (($context["FLASH_MESSAGE_DETAILS"] ?? null)) {
            echo "\t
 <div class=\"row\"  id=\"message_box\">
    <div class=\"col-md-12\">";
            // line 4
            if ((($context["FLASH_MESSAGE_TYPE"] ?? null) == "danger")) {
                // line 5
                echo "\t\t<div class=\"alert alert-block alert-danger fade in\"  id='message_box'>
\t\t\t<button data-dismiss=\"alert\" class=\"close\" type=\"button\">
\t\t\t\t&times;
\t\t\t</button><i class=\"fa fa-times\"></i>
\t\t\t<!-- <h4 class=\"alert-heading\"><i class=\"fa fa-times\"></i> Error!</h4> -->";
            } elseif ((            // line 10
($context["FLASH_MESSAGE_TYPE"] ?? null) == "info")) {
                // line 11
                echo "\t\t\t
\t\t<div class=\"alert alert-block alert-info fade in\"  id='message_box'>
\t\t\t<button data-dismiss=\"alert\" class=\"close\" type=\"button\">
\t\t\t\t&times;
\t\t\t</button><i class=\"fa fa-info\"></i>
\t\t\t<!-- <h4 class=\"alert-heading\"><i class=\"fa fa-info\"></i> Info!</h4> -->";
            } elseif ((            // line 17
($context["FLASH_MESSAGE_TYPE"] ?? null) == "warning")) {
                // line 18
                echo "
\t\t<div class=\"alert alert-block alert-warning fade in\"  id='message_box'>
\t\t\t<button data-dismiss=\"alert\" class=\"close\" type=\"button\">
\t\t\t\t&times;
\t\t\t</button><i class=\"fa fa-exclamation\"></i>
\t\t\t<!-- <h4 class=\"alert-heading\"><i class=\"fa fa-exclamation\"></i> Warning!</h4> -->";
            } else {
                // line 25
                echo "\t\t\t
\t\t<div class=\"alert alert-block alert-success fade in\" id='message_box' >
\t\t\t<button data-dismiss=\"alert\" class=\"close\" type=\"button\">
\t\t\t\t&times;
\t\t\t</button><i class=\"fa fa-check\"></i>
\t\t    <!-- <h4 class=\"alert-heading\"><i class=\"fa fa-check\"></i> Success!</h4> -->";
            }
            // line 33
            echo twig_escape_filter($this->env, ($context["FLASH_MESSAGE_DETAILS"] ?? null), "html", null, true);
            echo "
\t\t\t  
\t\t</div>
     </div>
</div>";
        }
        // line 40
        echo "
<script>
    jQuery(document).ready(function ()
    {
        \$('#message_box').fadeIn('fast').delay(2000).fadeOut('slow');
       
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "admin/layout/notification.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 40,  59 => 33,  51 => 25,  43 => 18,  41 => 17,  34 => 11,  32 => 10,  26 => 5,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/layout/notification.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\layout\\notification.twig");
    }
}
