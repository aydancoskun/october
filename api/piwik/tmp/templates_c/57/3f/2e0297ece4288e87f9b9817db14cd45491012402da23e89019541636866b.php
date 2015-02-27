<?php

/* @CoreHome/_dataTable.twig */
class __TwigTemplate_573f2e0297ece4288e87f9b9817db14cd45491012402da23e89019541636866b extends Twig_Template
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
        if ($this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "show_visualization_only", array())) {
            // line 2
            echo "    ";
            $this->env->resolveTemplate((isset($context["visualizationTemplate"]) ? $context["visualizationTemplate"] : $this->getContext($context, "visualizationTemplate")))->display($context);
        } else {
            // line 5
            $context["summaryRowId"] = twig_constant("Piwik\\DataTable::ID_SUMMARY_ROW");
            // line 6
            $context["isSubtable"] = ($this->getAttribute((isset($context["javascriptVariablesToSet"]) ? $context["javascriptVariablesToSet"] : null), "idSubtable", array(), "any", true, true) && ($this->getAttribute((isset($context["javascriptVariablesToSet"]) ? $context["javascriptVariablesToSet"] : $this->getContext($context, "javascriptVariablesToSet")), "idSubtable", array()) != 0));
            // line 7
            echo "<div class=\"dataTable ";
            echo twig_escape_filter($this->env, (isset($context["visualizationCssClass"]) ? $context["visualizationCssClass"] : $this->getContext($context, "visualizationCssClass")), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "datatable_css_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "datatable_css_class", array()), "")) : ("")), "html", null, true);
            echo " ";
            if ((isset($context["isSubtable"]) ? $context["isSubtable"] : $this->getContext($context, "isSubtable"))) {
                echo "subDataTable";
            }
            echo "\"
     data-table-type=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "datatable_js_type", array()), "html", null, true);
            echo "\"
     data-report=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "report_id", array()), "html", null, true);
            echo "\"
     data-props=\"";
            // line 10
            if (twig_test_empty((isset($context["clientSideProperties"]) ? $context["clientSideProperties"] : $this->getContext($context, "clientSideProperties")))) {
                echo "{}";
            } else {
                echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["clientSideProperties"]) ? $context["clientSideProperties"] : $this->getContext($context, "clientSideProperties"))), "html", null, true);
            }
            echo "\"
     data-params=\"";
            // line 11
            if (twig_test_empty((isset($context["clientSideParameters"]) ? $context["clientSideParameters"] : $this->getContext($context, "clientSideParameters")))) {
                echo "{}";
            } else {
                echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["clientSideParameters"]) ? $context["clientSideParameters"] : $this->getContext($context, "clientSideParameters"))), "html", null, true);
            }
            echo "\">
    <div class=\"reportDocumentation\">
        ";
            // line 13
            if ((!twig_test_empty((($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "documentation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "documentation", array()))) : (""))))) {
                echo "<p>";
                echo $this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "documentation", array());
                echo "</p>";
            }
            // line 14
            echo "        ";
            if (array_key_exists("reportLastUpdatedMessage", $context)) {
                echo "<span class='helpDate'>";
                echo twig_escape_filter($this->env, (isset($context["reportLastUpdatedMessage"]) ? $context["reportLastUpdatedMessage"] : $this->getContext($context, "reportLastUpdatedMessage")), "html", null, true);
                echo "</span>";
            }
            // line 15
            echo "    </div>
    <div class=\"dataTableWrapper\">
        ";
            // line 17
            if (array_key_exists("error", $context)) {
                // line 18
                echo "            ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message", array()), "html", null, true);
                echo "
        ";
            } else {
                // line 20
                echo "            ";
                if ((twig_test_empty((isset($context["dataTable"]) ? $context["dataTable"] : $this->getContext($context, "dataTable"))) || ((array_key_exists("dataTableHasNoData", $context)) ? (_twig_default_filter((isset($context["dataTableHasNoData"]) ? $context["dataTableHasNoData"] : $this->getContext($context, "dataTableHasNoData")), false)) : (false)))) {
                    // line 21
                    echo "                <div class=\"pk-emptyDataTable\">
                ";
                    // line 22
                    if ((array_key_exists("showReportDataWasPurgedMessage", $context) && (isset($context["showReportDataWasPurgedMessage"]) ? $context["showReportDataWasPurgedMessage"] : $this->getContext($context, "showReportDataWasPurgedMessage")))) {
                        // line 23
                        echo "                    ";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreHome_DataForThisReportHasBeenPurged", (isset($context["deleteReportsOlderThan"]) ? $context["deleteReportsOlderThan"] : $this->getContext($context, "deleteReportsOlderThan")))), "html", null, true);
                        echo "
                ";
                    } else {
                        // line 25
                        echo "                    ";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreHome_ThereIsNoDataForThisReport")), "html", null, true);
                        echo "
                ";
                    }
                    // line 27
                    echo "                </div>
            ";
                } else {
                    // line 29
                    echo "                ";
                    $this->env->resolveTemplate((isset($context["visualizationTemplate"]) ? $context["visualizationTemplate"] : $this->getContext($context, "visualizationTemplate")))->display($context);
                    // line 30
                    echo "            ";
                }
                // line 31
                echo "
            ";
                // line 32
                if ($this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "show_footer", array())) {
                    // line 33
                    echo "                ";
                    $this->env->loadTemplate("@CoreHome/_dataTableFooter.twig")->display($context);
                    // line 34
                    echo "            ";
                }
                // line 35
                echo "            ";
                $this->env->loadTemplate("@CoreHome/_dataTableJS.twig")->display($context);
                // line 36
                echo "        ";
            }
            // line 37
            echo "    </div>
</div>";
        }
    }

    public function getTemplateName()
    {
        return "@CoreHome/_dataTable.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 37,  134 => 36,  131 => 35,  128 => 34,  125 => 33,  123 => 32,  120 => 31,  117 => 30,  114 => 29,  110 => 27,  104 => 25,  98 => 23,  96 => 22,  93 => 21,  90 => 20,  84 => 18,  82 => 17,  78 => 15,  71 => 14,  65 => 13,  56 => 11,  48 => 10,  44 => 9,  40 => 8,  29 => 7,  27 => 6,  25 => 5,  21 => 2,  19 => 1,);
    }
}
