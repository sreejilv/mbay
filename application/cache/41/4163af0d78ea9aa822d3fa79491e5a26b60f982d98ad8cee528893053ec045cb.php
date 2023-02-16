<?php

/* admin/member/order_history.twig */
class __TwigTemplate_a7ab298e74fff9741f7817831ab019c1ba90c5b6372e1e18e2ee7fabc04d482a extends Twig_Template
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
        $this->loadTemplate("admin/layout/header.twig", "admin/member/order_history.twig", 1)->display($context);
        // line 2
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/jquery.dataTables.css\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/shCore.css\">
<script type=\"text/javascript\" language=\"javascript\" src=\"assets/js/jquery.dataTables.js\">
</script>
<script type=\"text/javascript\" language=\"javascript\" src=\"assets/js/shCore.js\">
</script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css\"/>
<script type=\"text/javascript\" language=\"javascript\" src=\"assets/js/lead_datatable.js\">
</script>
<script type=\"text/javascript\" language=\"javascript\" class=\"init\">

    \$(document).ready(function () {
        var oTable = \$('#order_history_list').DataTable({
            \"processing\": true,
            \"serverSide\": true,
            \"ajax\": \"admin/member/order_history_list\",
            \"dataType\": \"json\",
            \"order\": [[ 3, \"desc\" ]],
            \"type\": \"POST\",
            \"data\": {'";
        // line 21
        echo twig_escape_filter($this->env, ($context["CSRF_TOKEN_NAME"] ?? null), "html", null, true);
        echo "': '";
        echo twig_escape_filter($this->env, ($context["CSRF_TOKEN_VALUE"] ?? null), "html", null, true);
        echo "'},
            \"lengthMenu\": [[10, 50,100,500,1000], [10,50,100,500,1000]],
        });
    });
</script>
<div id=\"js_messages\" style=\"display: none;\"> 
    <span id=\"are_you_sure_js\">";
        // line 27
        echo twig_escape_filter($this->env, lang("are_you_sure_js"), "html", null, true);
        echo "</span>
    <span id=\"confirm_this_order_js\">";
        // line 28
        echo twig_escape_filter($this->env, lang("confirm_this_order_js"), "html", null, true);
        echo "</span>
    <span id=\"confirm_it_js\">";
        // line 29
        echo twig_escape_filter($this->env, lang("confirm_it_js"), "html", null, true);
        echo "</span>
    <span id=\"cancel_it_js\">";
        // line 30
        echo twig_escape_filter($this->env, lang("cancel_it_js"), "html", null, true);
        echo "</span>
    <span id=\"order_safe_js\">";
        // line 31
        echo twig_escape_filter($this->env, lang("order_safe_js"), "html", null, true);
        echo "</span>
    <span id=\"canceled_js\">";
        // line 32
        echo twig_escape_filter($this->env, lang("canceled_js"), "html", null, true);
        echo "</span>
    <span id=\"delete_this_order_js\">";
        // line 33
        echo twig_escape_filter($this->env, lang("delete_this_order_js"), "html", null, true);
        echo "</span>
    <span id=\"delete_it_js\">";
        // line 34
        echo twig_escape_filter($this->env, lang("delete_it_js"), "html", null, true);
        echo "</span>
</div>       
<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"panel panel-white\">
            <div class=\"panel-heading\">
                <h4 class=\"panel-title\"><span class=\"text-bold\">";
        // line 40
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</span></h4>
                <div class=\"panel-tools\">
                    <div class=\"dropdown\">
                        <a data-toggle=\"dropdown\" class=\"btn btn-xs dropdown-toggle btn-transparent-grey\"><i class=\"fa fa-cog\"></i></a>
                        <ul class=\"dropdown-menu dropdown-light pull-right\" role=\"menu\">
                            <li><a class=\"panel-collapse collapses\" href=\"#\"><i class=\"fa fa-angle-up\"></i> <span>";
        // line 45
        echo twig_escape_filter($this->env, lang("collapse"), "html", null, true);
        echo "</span> </a></li>
                            <li><a class=\"panel-refresh\" href=\"#\"><i class=\"fa fa-refresh\"></i> <span>";
        // line 46
        echo twig_escape_filter($this->env, lang("refresh"), "html", null, true);
        echo "</span></a></li>
                            <li><a class=\"panel-expand\" href=\"#\"><i class=\"fa fa-expand\"></i> <span>";
        // line 47
        echo twig_escape_filter($this->env, lang("full_screen"), "html", null, true);
        echo "</span></a></li>
                        </ul>
                    </div>
                    <a class=\"btn btn-xs btn-link panel-close\" href=\"#\"><i class=\"fa fa-times\"></i></a>
                </div>
            </div>
            <div class=\"panel-body\">
                <hr>
                <div class=\"table-responsive\">
                    <table class=\"table table-hover table-striped\" id=\"order_history_list\">
                        <thead>
                            <tr>
                                <th>";
        // line 59
        echo twig_escape_filter($this->env, lang("sl.no"), "html", null, true);
        echo "</th>
                                <th>";
        // line 60
        echo twig_escape_filter($this->env, lang("user_name"), "html", null, true);
        echo "</th>
                                <th>";
        // line 61
        echo twig_escape_filter($this->env, lang("order_id"), "html", null, true);
        echo "</th>                              
                                <th>";
        // line 62
        echo twig_escape_filter($this->env, lang("date_and_time"), "html", null, true);
        echo "</th>
                                <th>";
        // line 63
        echo twig_escape_filter($this->env, lang("product_details"), "html", null, true);
        echo "</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>                                    
    </div>
</div>";
        // line 72
        $this->loadTemplate("admin/layout/footer.twig", "admin/member/order_history.twig", 72)->display($context);
        // line 73
        echo "
<link href=\"assets/plugins/sweetalert/lib/sweet-alert.css\" rel=\"stylesheet\" />
<script src=\"assets/plugins/sweetalert/lib/sweet-alert.min.js\"></script>
<script src=\"assets/js/pending_orders.js\"></script>
<style>
    table.dataTable thead th{border-bottom:1px #111}
    table.dataTable.no-footer{border-bottom:1px #dfe1e5 solid}
</style>";
    }

    public function getTemplateName()
    {
        return "admin/member/order_history.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 73,  148 => 72,  137 => 63,  133 => 62,  129 => 61,  125 => 60,  121 => 59,  106 => 47,  102 => 46,  98 => 45,  90 => 40,  81 => 34,  77 => 33,  73 => 32,  69 => 31,  65 => 30,  61 => 29,  57 => 28,  53 => 27,  42 => 21,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/member/order_history.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\member\\order_history.twig");
    }
}
