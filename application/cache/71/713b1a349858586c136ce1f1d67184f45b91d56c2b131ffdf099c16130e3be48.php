<?php

/* admin/tree/genealogy.twig */
class __TwigTemplate_902601bf24e00f59b01bf5397f03a85edfc5b26c8795ecdf0ba923fd2a6e971c extends Twig_Template
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
        $this->loadTemplate("admin/layout/header.twig", "admin/tree/genealogy.twig", 1)->display($context);
        // line 2
        echo "<link href=\"assets/css/style.css\" rel=\"stylesheet\" type=\"text/css\">
<input type='hidden' id='type' value='";
        // line 3
        echo twig_escape_filter($this->env, ($context["MLM_PLAN"] ?? null), "html", null, true);
        echo "'/>

<link rel=\"stylesheet\" href=\"assets/css/jquery.webui-popover.css\">
<div id=\"js_messages\" style=\"display: none;\"> 
    <span id=\"pls_wt_js\">";
        // line 7
        echo twig_escape_filter($this->env, lang("please_wait_js"), "html", null, true);
        echo "</span>
    <span id=\"invalid_username_js\">";
        // line 8
        echo twig_escape_filter($this->env, lang("invalid_username_js"), "html", null, true);
        echo "</span>
</div>

<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"panel panel-white\">
            <div class=\"panel-heading\">
                <h4 class=\"panel-title\"><span class=\"text-bold\">";
        // line 15
        echo twig_escape_filter($this->env, lang("genealogy_tree"), "html", null, true);
        echo "</span></h4>
                <div class=\"panel-tools\">
                    <div class=\"dropdown\">
                        <a data-toggle=\"dropdown\" class=\"btn btn-xs dropdown-toggle btn-transparent-grey\"><i class=\"fa fa-cog\"></i></a>
                        <ul class=\"dropdown-menu dropdown-light pull-right\" role=\"menu\">
                            <li><a class=\"panel-collapse collapses\" href=\"#\"><i class=\"fa fa-angle-up\"></i> <span>";
        // line 20
        echo twig_escape_filter($this->env, lang("collapse"), "html", null, true);
        echo "</span> </a></li>
                            <li><a class=\"panel-refresh\" href=\"#\"><i class=\"fa fa-refresh\"></i> <span>";
        // line 21
        echo twig_escape_filter($this->env, lang("refresh"), "html", null, true);
        echo "</span></a></li>
                            <li><a class=\"panel-expand\" href=\"#\"><i class=\"fa fa-expand\"></i> <span>";
        // line 22
        echo twig_escape_filter($this->env, lang("full_screen"), "html", null, true);
        echo "</span></a></li>
                        </ul>
                    </div>
                    <a class=\"btn btn-xs btn-link panel-close\" href=\"#\"><i class=\"fa fa-times\"></i></a>
                </div>
            </div>
            <div class=\"panel-body\">
                <hr>
                <div class=\"alert alert-info\">
                    <button data-dismiss=\"alert\" class=\"close\">
                        ×
                    </button>
                    <strong>";
        // line 34
        echo twig_escape_filter($this->env, lang("notice"), "html", null, true);
        echo "</strong> :-
                    <a href=\"#\" class=\"alert-link\" data-toggle=\"modal\" data-target=\"#search_member_modal\">";
        // line 36
        echo twig_escape_filter($this->env, lang("click_here"), "html", null, true);
        echo "</a>";
        // line 37
        echo twig_escape_filter($this->env, lang("for_searching_a_member"), "html", null, true);
        echo ".
                </div>

                <div id=\"search_member_modal\" style=\"width: 750px;\" class=\"modal extended-modal fade no-display\" tabindex=\"-1\" data-focus-on=\"input:first\">
                    <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">
                            &times;
                        </button>
                        <h4 class=\"modal-title\">";
        // line 45
        echo twig_escape_filter($this->env, lang("search_member"), "html", null, true);
        echo "</h4>
                    </div>

                    <div class=\"modal-body\">";
        // line 49
        echo form_open("", " id=\"search_member_form\" name=\"search_member_form\"");
        echo "
                        <div class=\"form-horizontal\">                                            
                            <div class=\"errorHandler alert alert-danger no-display\">
                                <i class=\"fa fa-remove-sign\"></i>";
        // line 52
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                            </div>                    
                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\">";
        // line 56
        echo twig_escape_filter($this->env, lang("username"), "html", null, true);
        echo ":<span class=\"symbol required\"></span>
                                </label>
                                <div class=\"col-sm-6\">
                                    <input class=\"typeahead form-control\" placeholder=\"";
        // line 59
        echo twig_escape_filter($this->env, lang("username"), "html", null, true);
        echo "\" type=\"text\" name=\"username\" id=\"username\" autocomplete=\"off\">
                                    <div  id=\"full_name\">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default\">";
        // line 68
        echo twig_escape_filter($this->env, lang("cancel"), "html", null, true);
        echo "
                            </button>

                            <button type=\"submit\" class=\"btn btn-primary\" value=\"search_member\" name=\"search_member\">";
        // line 72
        echo twig_escape_filter($this->env, lang("search"), "html", null, true);
        echo " <i class=\"fa fa-arrow-circle-right\"></i>
                            </button> 
                        </div>";
        // line 75
        echo form_close();
        echo "
                    </div>
                </div>


                <div class=\"panel panel-white center\"  id=\"user-tree-panel\">
                    <span class=\"tree-data\">   
                    </span> 
                </div>
            </div>

        </div>
    </div>
</div>";
        // line 92
        $this->loadTemplate("admin/layout/footer.twig", "admin/tree/genealogy.twig", 92)->display($context);
        echo "    
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js\"></script> 
<script src=\"assets/js/sponsor_tree.js\"></script>
<script src=\"assets/js/jquery.webui-popover.js\"></script> 

<link href=\"assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"assets/plugins/bootstrap-modal/css/bootstrap-modal.css\" rel=\"stylesheet\" type=\"text/css\"/>
<script src=\"assets/js/typeahead.js\"></script>

<script>
    \$(window).load(function () {
        load(";
        // line 103
        echo twig_escape_filter($this->env, ($context["user_id"] ?? null), "html", null, true);
        echo ");
        searchMember();
    });

    function initPopover() {
        var container = \$('#tree_overflow'), scrollTo = \$('#tree_root_user');
        container.animate({scrollLeft: (scrollTo.offset().left - container.offset().left) - \$('#user-tree-panel').width() / 2});
        \$(\"html,body\").animate({scrollTop: 0}, \"slow\");
        \$('a.show-pop').webuiPopover('destroy').webuiPopover({
            trigger: 'hover',
            title: '',
            content: '',
            //  width:auto,                     
            multi: false,
            closeable: false,
            style: '',
            delay: 100,
            padding: true,
            backdrop: false
        });
    }
</script>

<script type=\"text/javascript\">

    function load(user_id) {
        var el = \$('#user-tree-panel');
        var type = \$(\"#type\").val();
        var type_name = 'father';
        if (user_id != 0) {";
        // line 136
        echo "                \$.ajax({
                    type: 'POST',
                    url: 'admin/tree/getUserTree',
                    data: {'user_id': user_id, 'type': type_name},
                    beforeSend: function () {

                        el.block({
                            overlayCSS: {
                                backgroundColor: '#000'
                            },
                            message: '<i class=\"fa fa-spinner fa-pulse fa-3x\"></i>',
                            css: {
                                border: 'none',
                                color: '#fff',
                                background: 'none'
                            }
                        });
                    },
                    success: function (data) {

                        \$('.tree-data').html(data.tree);

                        \$('.tree').tree_structure({
                            'add_option': false,
                            'edit_option': false,
                            'delete_option': false,
                            'confirm_before_delete': false,
                            'animate_option': [true, 1],
                            'fullwidth_option': true,
                            'align_option': 'center',
                            'draggable_option': false
                        },";
        // line 167
        echo twig_escape_filter($this->env, ($context["node_size"] ?? null), "html", null, true);
        echo " , data.user_width);

                        initPopover();
                        el.unblock();
                    },
                    error: function (xhr) { // if error occured
                        //alert(\"Error occured.please try again\");
                    },
                    complete: function () {
                        el.unblock();
                    },
                    dataType: 'json'
                });
            }

        }
</script>




<script>

    (function () {

        var settings = {
            trigger: 'hover',
            title: '',
            content: '',
            //  width:auto,                     
            multi: false,
            closeable: false,
            style: '',
            delay: 100,
            padding: true,
            backdrop: false
        };

        function initPopover() {
            \$('a.show-pop').webuiPopover('destroy').webuiPopover(settings);
        }
        initPopover();
    })();



    //container.animate({scrollRight: scrollTo.offset().top - container.offset().top + container.scrollTop()});


</script>
<script>
    
    
    var searchMember = function () {
        \$.validator.addMethod(\"validUser\", function () {
            var isSuccess = false;
            \$.ajax({url: \"register/validate_sponsor\",
                data: {username: \$(\"#username\").val()},
                async: false,
                success:
                        function (msg) {
                            isSuccess = msg === \"yes\" ? true : false
                            if (isSuccess) {
                            \$.ajax({url: \"register/get_full_name\",
                                data: {username: \$(\"#username\").val()},
                                async: false,
                                success:
                                        function (msg) {
                                            \$(\"#full_name\").html(msg);
                                        }
                            });
                        }
                            
                        }
            });
            return isSuccess;
        }, \$('#invalid_username_js').html());

        var form22 = \$('#search_member_form');
        var errorHandler2 = \$('.errorHandler', form22);
        var successHandler2 = \$('.successHandler', form22);
        form22.validate({
            errorElement: \"span\", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                error.insertAfter(element);
            },
            ignore: \"hidden\",
            rules: {
                username: {
                    required: true,
                    validUser: true,
                }
            },
            messages: {
                username: {
                    required: \$('#invalid_username_js').html()
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
            },
            highlight: function (element) {
                \$(element).closest('.help-block').removeClass('valid');// display OK icon
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
                \$('#search_member_modal').modal('toggle');
                \$.blockUI({
                    message: '<i class=\"fa fa-spinner fa-spin\"></i>' + \$('#pls_wt_js').html()
                });
                \$.ajax({
                    url: \"admin/tree/validate_username\",
                    data: {username: \$('#username').val()},
                    success: function (result) {
                        \$.unblockUI();
                        load(result);
                    }
                });                
            }
        });
    }

    \$('input.typeahead').typeahead({
        source: function (query, process) {
            var url = \"admin/member/get_usernames\";
            return \$.get(url, {query: query}, function (data) {
                data = \$.parseJSON(data);
                return process(data);
            });
        }
    });
</script>

";
    }

    public function getTemplateName()
    {
        return "admin/tree/genealogy.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  235 => 167,  202 => 136,  170 => 103,  156 => 92,  140 => 75,  135 => 72,  129 => 68,  118 => 59,  112 => 56,  106 => 52,  100 => 49,  94 => 45,  83 => 37,  80 => 36,  76 => 34,  61 => 22,  57 => 21,  53 => 20,  45 => 15,  35 => 8,  31 => 7,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/tree/genealogy.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\tree\\genealogy.twig");
    }
}
