<?php

/* admin/home/index.twig */
class __TwigTemplate_2e216a8385e760947f814376f46a445c6787ab84067284498196e999a92bd617 extends Twig_Template
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
        $this->loadTemplate("admin/partials/head-main.twig", "admin/home/index.twig", 1)->display($context);
        // line 2
        echo "<head>
    <base href=\"";
        // line 3
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" />
    <?= \$title_meta ?>";
        // line 6
        $this->loadTemplate("admin/partials/head-css.twig", "admin/home/index.twig", 6)->display($context);
        // line 7
        echo "    <link href=\"assets/libs/flatpickr/flatpickr.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- DataTables -->
    <link href=\"assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css\" rel=\"stylesheet\" type=\"text/css\" />

    <link href=\"assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>";
        // line 14
        $this->loadTemplate("admin/partials/body.twig", "admin/home/index.twig", 14)->display($context);
        // line 15
        echo "<!-- <body data-layout=\"horizontal\"> -->

<!-- Begin page -->
<div id=\"layout-wrapper\">";
        // line 20
        $this->loadTemplate("admin/partials/menu.twig", "admin/home/index.twig", 20)->display($context);
        // line 21
        echo "    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class=\"main-content\">

        <div class=\"page-content\">
            <div class=\"container-fluid\">

                <!-- start page title -->
                <?= \$page_title ?>
                 <div class=\"row\">
                    <div class=\"col-xl-3 col-md-6\">
                        <!-- card -->
                        <div class=\"card card-h-100\">
                            <!-- card body -->
                            <div class=\"card-body\">
                                <div class=\"row align-items-center\">
                                    <div class=\"col-6\">
                                        <span class=\"text-muted mb-3 lh-1 d-block text-truncate\">TOTAL ORDERS</span>
                                        <h4 class=\"mb-3\">
                                            <span class=\"counter-value\" data-target=\"865.2\">0</span>k
                                        </h4>
                                    </div>

                                    <div class=\"col-6\">
                                        <div id=\"mini-chart1\" data-colors='[\"#5156be\"]' class=\"apex-charts mb-2\"></div>
                                    </div>
                                </div>
                                <div class=\"text-nowrap\">
                                    <span class=\"badge bg-soft-success text-success\">20.9k Orders</span>
                                    <span class=\"ms-1 text-muted font-size-13\">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class=\"col-xl-3 col-md-6\">
                        <!-- card -->
                        <div class=\"card card-h-100\">
                            <!-- card body -->
                            <div class=\"card-body\">
                                <div class=\"row align-items-center\">
                                    <div class=\"col-6\">
                                        <span class=\"text-muted mb-3 lh-1 d-block text-truncate\">TOTAL SALES</span>
                                        <h4 class=\"mb-3\">
                                            \$<span class=\"counter-value\" data-target=\"6258\">0</span>
                                        </h4>
                                    </div>
                                    <div class=\"col-6\">
                                        <div id=\"mini-chart2\" data-colors='[\"#5156be\"]' class=\"apex-charts mb-2\"></div>
                                    </div>
                                </div>
                                <div class=\"text-nowrap\">
                                    <span class=\"badge bg-soft-danger text-danger\">- \$29</span>
                                    <span class=\"ms-1 text-muted font-size-13\">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col-->

                    <div class=\"col-xl-3 col-md-6\">
                        <!-- card -->
                        <div class=\"card card-h-100\">
                            <!-- card body -->
                            <div class=\"card-body\">
                                <div class=\"row align-items-center\">
                                    <div class=\"col-6\">
                                        <span class=\"text-muted mb-3 lh-1 d-block text-truncate\">TOTAL CUSTOMERS</span>
                                        <h4 class=\"mb-3\">
                                            <span class=\"counter-value\" data-target=\"4.32\">0</span>M
                                        </h4>
                                    </div>
                                    <div class=\"col-6\">
                                        <div id=\"mini-chart3\" data-colors='[\"#5156be\"]' class=\"apex-charts mb-2\"></div>
                                    </div>
                                </div>
                                <div class=\"text-nowrap\">
                                    <span class=\"badge bg-soft-success text-success\">+2.8k Customers</span>
                                    <span class=\"ms-1 text-muted font-size-13\">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class=\"col-xl-3 col-md-6\">
                        <!-- card -->
                        <div class=\"card card-h-100\">
                            <!-- card body -->
                            <div class=\"card-body\">
                                <div class=\"row align-items-center\">
                                    <div class=\"col-6\">
                                        <span class=\"text-muted mb-3 lh-1 d-block text-truncate\">PEOPLE ONLINE</span>
                                        <h4 class=\"mb-3\">
                                            <span class=\"counter-value\" data-target=\"12\">0</span>
                                        </h4>
                                    </div>
                                    <div class=\"col-6\">
                                        <div id=\"mini-chart4\" data-colors='[\"#5156be\"]' class=\"apex-charts mb-2\"></div>
                                    </div>
                                </div>
                                <div class=\"text-nowrap\">
                                    <span class=\"badge bg-soft-success text-success\">+2.95%</span>
                                    <span class=\"ms-1 text-muted font-size-13\">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
                <div class=\"row\">
                    <div class=\"col-xl-8\">
                        <!-- card -->
                        <div class=\"card\">
                            <!-- card body -->
                            <div class=\"card-body\">
                                <div class=\"d-flex flex-wrap align-items-center mb-4\">
                                    <h5 class=\"card-title me-2\">Analytics</h5>
                                    <div class=\"ms-auto\">
                                  
                                    </div>
                                </div>

                                <div class=\"row align-items-center\">
                                    <div class=\"col-xl-12\">
                                        <div>
                                            <div id=\"chart\" data-colors='[\"#5156be\", \"#34c38f\"]' class=\"apex-charts\"></div>
                                        </div>
                                    </div>
                        
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row-->

                    <div class=\"col-xl-4\">
                        <!-- card -->
                        <div class=\"card\">
                            <!-- card body -->
                            <div class=\"card-body\">
                                <div class=\"d-flex flex-wrap align-items-center mb-4\">
                                    <h5 class=\"card-title me-2\">Sales by Locations</h5>
                                    <div class=\"ms-auto\">
                                        <div class=\"dropdown\">
                                            <a class=\"dropdown-toggle text-reset\" href=\"#\" id=\"dropdownMenuButton1\" data-bs-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                <span class=\"text-muted font-size-12\">Sort By:</span> <span class=\"fw-medium\">World<i class=\"mdi mdi-chevron-down ms-1\"></i></span>
                                            </a>

                                            <div class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"dropdownMenuButton1\">
                                                <a class=\"dropdown-item\" href=\"#\">USA</a>
                                                <a class=\"dropdown-item\" href=\"#\">Russia</a>
                                                <a class=\"dropdown-item\" href=\"#\">Australia</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id=\"sales-by-locations\" data-colors='[\"#5156be\"]' style=\"height:196px\"></div>

                                <div class=\"px-2 py-2\">
                                    <p class=\"mb-1\">USA <span class=\"float-end\">75%</span></p>
                                    <div class=\"progress mt-2\" style=\"height: 6px;\">
                                        <div class=\"progress-bar progress-bar-striped bg-primary\" role=\"progressbar\" style=\"width: 75%\" aria-valuenow=\"75\" aria-valuemin=\"0\" aria-valuemax=\"75\">
                                        </div>
                                    </div>

                                    <p class=\"mt-3 mb-1\">Russia <span class=\"float-end\">55%</span></p>
                                    <div class=\"progress mt-2\" style=\"height: 6px;\">
                                        <div class=\"progress-bar progress-bar-striped bg-primary\" role=\"progressbar\" style=\"width: 55%\" aria-valuenow=\"55\" aria-valuemin=\"0\" aria-valuemax=\"55\">
                                        </div>
                                    </div>

                                    <p class=\"mt-3 mb-1\">Australia <span class=\"float-end\">85%</span></p>
                                    <div class=\"progress mt-2\" style=\"height: 6px;\">
                                        <div class=\"progress-bar progress-bar-striped bg-primary\" role=\"progressbar\" style=\"width: 85%\" aria-valuenow=\"85\" aria-valuemin=\"0\" aria-valuemax=\"85\">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <div class=\"row\">
                    <div class=\"col-xl-10\">
                        <!-- card -->
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <div class=\"card\">
                            <div class=\"card-body\">
                                <div class=\"row\">
                                    <div class=\"col-sm\">
                                        <div class=\"mb-4\">";
        // line 218
        echo "                                        </div>
                                    </div>
                                   
                                </div>
                                <!-- end row -->

                                <div class=\"table-responsive\">
                                    <table class=\"table align-middle datatable dt-responsive table-check nowrap\" style=\"border-collapse: collapse; border-spacing: 0 8px; width: 100%;\">
                                        <thead>
                                            <tr class=\"bg-transparent\">
                                               
                                                <th style=\"width: 120px;\"> ID</th>
                                                <th style=\"width: 120px;\">Order ID</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Date Added</th>
                                                <th>Total</th>
                                            
                                            </tr>
                                        </thead>

                                        <tbody>";
        // line 241
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 242
            echo " 
                                            <tr>
                                                <td>";
            // line 244
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "</td>
                                                <td><a href=\"javascript: void(0);\" class=\"text-dark fw-medium\">#MN021";
            // line 245
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "</a> </td>
                                                <td>Aonnie Franco</td>";
            // line 247
            if (($context["i"] == 3)) {
                // line 248
                echo "                                                 <td>
                                                    <div class=\"badge badge-soft-warning font-size-12\">Pending</div>
                                                </td>";
            } else {
                // line 252
                echo "                                                <td>
                                                    <div class=\"badge badge-soft-success font-size-12\">Paid</div>
                                                </td>";
            }
            // line 256
            echo "                                                <td>
                                                    12 Oct, 2020
                                                </td>
                                                <td>
                                                    \$2";
            // line 260
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo ".30
                                                </td>
                                            </tr>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 264
        echo "                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table responsive -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                
                        <!-- end col -->
                    </div>
                    <!-- end row-->

                    <div class=\"col-xl-2\">
                                <!-- card -->
                                <div class=\"card bg-primary text-white shadow-primary card-h-100\">
                                    <!-- card body -->
                                    <div class=\"card-body p-0\">
                                        <div id=\"carouselExampleCaptions\" class=\"carousel slide text-center widget-carousel\" data-bs-ride=\"carousel\">
                                            <div class=\"carousel-inner\">
                                                <div class=\"carousel-item active\">
                                                    <div class=\"text-center p-4\">
                                                        <i class=\"mdi mdi-bitcoin widget-box-1-icon\"></i>
                                                        <div class=\"avatar-md m-auto\">
                                                            <span class=\"avatar-title rounded-circle bg-soft-light text-white font-size-24\">
                                                                <i class=\"mdi mdi-currency-btc\"></i>
                                                            </span>
                                                        </div>
                                                        <h4 class=\"mt-3 lh-base fw-normal text-white\"><b>Bitcoin</b> News</h4>
                                                        <p class=\"text-white-50 font-size-13\">Bitcoin prices fell sharply amid the global sell-off in equities. Negative news
                                                            over the Bitcoin past week has dampened Bitcoin basics
                                                            sentiment for bitcoin. </p>
                                                        <button type=\"button\" class=\"btn btn-light btn-sm\">View details <i class=\"mdi mdi-arrow-right ms-1\"></i></button>
                                                    </div>
                                                </div>
                                                <!-- end carousel-item -->
                                                <div class=\"carousel-item\">
                                                    <div class=\"text-center p-4\">
                                                        <i class=\"mdi mdi-ethereum widget-box-1-icon\"></i>
                                                        <div class=\"avatar-md m-auto\">
                                                            <span class=\"avatar-title rounded-circle bg-soft-light text-white font-size-24\">
                                                                <i class=\"mdi mdi-ethereum\"></i>
                                                            </span>
                                                        </div>
                                                        <h4 class=\"mt-3 lh-base fw-normal text-white\"><b>ETH</b> News</h4>
                                                        <p class=\"text-white-50 font-size-13\">Bitcoin prices fell sharply amid the global sell-off in equities. Negative news
                                                            over the Bitcoin past week has dampened Bitcoin basics
                                                            sentiment for bitcoin. </p>
                                                        <button type=\"button\" class=\"btn btn-light btn-sm\">View details <i class=\"mdi mdi-arrow-right ms-1\"></i></button>
                                                    </div>
                                                </div>
                                                <!-- end carousel-item -->
                                                <div class=\"carousel-item\">
                                                    <div class=\"text-center p-4\">
                                                        <i class=\"mdi mdi-litecoin widget-box-1-icon\"></i>
                                                        <div class=\"avatar-md m-auto\">
                                                            <span class=\"avatar-title rounded-circle bg-soft-light text-white font-size-24\">
                                                                <i class=\"mdi mdi-litecoin\"></i>
                                                            </span>
                                                        </div>
                                                        <h4 class=\"mt-3 lh-base fw-normal text-white\"><b>Litecoin</b> News</h4>
                                                        <p class=\"text-white-50 font-size-13\">Bitcoin prices fell sharply amid the global sell-off in equities. Negative news
                                                            over the Bitcoin past week has dampened Bitcoin basics
                                                            sentiment for bitcoin. </p>
                                                        <button type=\"button\" class=\"btn btn-light btn-sm\">View details <i class=\"mdi mdi-arrow-right ms-1\"></i></button>
                                                    </div>
                                                </div>
                                                <!-- end carousel-item -->
                                            </div>
                                            <!-- end carousel-inner -->

                                            <div class=\"carousel-indicators carousel-indicators-rounded\">
                                                <button type=\"button\" data-bs-target=\"#carouselExampleCaptions\" data-bs-slide-to=\"0\" class=\"active\" aria-current=\"true\" aria-label=\"Slide 1\"></button>
                                                <button type=\"button\" data-bs-target=\"#carouselExampleCaptions\" data-bs-slide-to=\"1\" aria-label=\"Slide 2\"></button>
                                                <button type=\"button\" data-bs-target=\"#carouselExampleCaptions\" data-bs-slide-to=\"2\" aria-label=\"Slide 3\"></button>
                                            </div>
                                            <!-- end carousel-indicators -->
                                        </div>
                                        <!-- end carousel -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                    <!-- end col -->
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->";
        // line 358
        $this->loadTemplate("admin/partials/footer.twig", "admin/home/index.twig", 358)->display($context);
        // line 359
        echo "    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->";
        // line 366
        $this->loadTemplate("admin/partials/right-sidebar.twig", "admin/home/index.twig", 366)->display($context);
        // line 367
        echo "<!-- JAVASCRIPT -->";
        // line 368
        $this->loadTemplate("admin/partials/vendor-scripts.twig", "admin/home/index.twig", 368)->display($context);
        // line 369
        echo "<script src=\"assets/js/app.js\"></script>
<script>
 var options = {
          series: [{
          name: 'Order',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Sales',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Customers',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '\$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return \"\$ \" + val + \" thousands\"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector(\"#chart\"), options);
        chart.render();
</script> 
<script src=\"assets/libs/flatpickr/flatpickr.min.js\"></script>

<!-- Required datatable js -->
<script src=\"assets/libs/datatables.net/js/jquery.dataTables.min.js\"></script>
<script src=\"assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js\"></script>
<!-- Responsive examples -->
<script src=\"assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js\"></script>
<script src=\"assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js\"></script>
<script src=\"assets/js/pages/dashboard.init.js\"></script>
<script src=\"assets/js/pages/invoices-list.init.js\"></script>
<script src=\"assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js\"></script>
<script src=\"assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js\"></script>
<!-- dashboard init -->


<!-- App js -->";
        // line 441
        echo "<script>

\$(document).ready(function () {
    mapdata();
});
</script>
</body>

</html>";
    }

    public function getTemplateName()
    {
        return "admin/home/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  488 => 441,  416 => 369,  414 => 368,  412 => 367,  410 => 366,  404 => 359,  402 => 358,  309 => 264,  300 => 260,  294 => 256,  289 => 252,  284 => 248,  282 => 247,  278 => 245,  274 => 244,  270 => 242,  266 => 241,  243 => 218,  46 => 21,  44 => 20,  39 => 15,  37 => 14,  30 => 7,  28 => 6,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/home/index.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\home\\index.twig");
    }
}
