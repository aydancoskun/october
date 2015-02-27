<?php

/* @VisitsSummary/_sparklines.twig */
class __TwigTemplate_f328f9e34a0b6b31fbbbccf09130d6527da57af684a83a5831719851e018775c extends Twig_Template
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
        echo "<div id='leftcolumn'>
    <div class=\"sparkline\">
        ";
        // line 3
        echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineNbVisits"]) ? $context["urlSparklineNbVisits"] : $this->getContext($context, "urlSparklineNbVisits"))));
        echo "
        ";
        // line 4
        echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_NVisits", (("<strong>" . (isset($context["nbVisits"]) ? $context["nbVisits"] : $this->getContext($context, "nbVisits"))) . "</strong>")));
        if ((isset($context["displayUniqueVisitors"]) ? $context["displayUniqueVisitors"] : $this->getContext($context, "displayUniqueVisitors"))) {
            echo ",
            ";
            // line 5
            echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbUniqueVisitors", (("<strong>" . (isset($context["nbUniqVisitors"]) ? $context["nbUniqVisitors"] : $this->getContext($context, "nbUniqVisitors"))) . "</strong>")));
        }
        // line 6
        echo "    </div>
    ";
        // line 7
        if (((isset($context["nbUsers"]) ? $context["nbUsers"] : $this->getContext($context, "nbUsers")) > 0)) {
            // line 8
            echo "        ";
            // line 9
            echo "        <div class=\"sparkline\">
            ";
            // line 10
            echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineNbUsers"]) ? $context["urlSparklineNbUsers"] : $this->getContext($context, "urlSparklineNbUsers"))));
            echo "
            ";
            // line 11
            echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_NUsers", (("<strong>" . (isset($context["nbUsers"]) ? $context["nbUsers"] : $this->getContext($context, "nbUsers"))) . "</strong>")));
            echo "
        </div>
    ";
        }
        // line 14
        echo "    <div class=\"sparkline\">
        ";
        // line 15
        echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineAvgVisitDuration"]) ? $context["urlSparklineAvgVisitDuration"] : $this->getContext($context, "urlSparklineAvgVisitDuration"))));
        echo "
        ";
        // line 16
        $context["averageVisitDuration"] = call_user_func_array($this->env->getFilter('sumtime')->getCallable(), array((isset($context["averageVisitDuration"]) ? $context["averageVisitDuration"] : $this->getContext($context, "averageVisitDuration"))));
        // line 17
        echo "        ";
        echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_AverageVisitDuration", (("<strong>" . (isset($context["averageVisitDuration"]) ? $context["averageVisitDuration"] : $this->getContext($context, "averageVisitDuration"))) . "</strong>")));
        echo "
    </div>
    <div class=\"sparkline\">
        ";
        // line 20
        echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineBounceRate"]) ? $context["urlSparklineBounceRate"] : $this->getContext($context, "urlSparklineBounceRate"))));
        echo "
        ";
        // line 21
        echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbVisitsBounced", (("<strong>" . (isset($context["bounceRate"]) ? $context["bounceRate"] : $this->getContext($context, "bounceRate"))) . "%</strong>")));
        echo "
    </div>
    <div class=\"sparkline\">
        ";
        // line 24
        echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineActionsPerVisit"]) ? $context["urlSparklineActionsPerVisit"] : $this->getContext($context, "urlSparklineActionsPerVisit"))));
        echo "
        ";
        // line 25
        echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbActionsPerVisit", (("<strong>" . (isset($context["nbActionsPerVisit"]) ? $context["nbActionsPerVisit"] : $this->getContext($context, "nbActionsPerVisit"))) . "</strong>")));
        echo "
    </div>
    ";
        // line 27
        if (((array_key_exists("showActionsPluginReports", $context)) ? (_twig_default_filter((isset($context["showActionsPluginReports"]) ? $context["showActionsPluginReports"] : $this->getContext($context, "showActionsPluginReports")), false)) : (false))) {
            // line 28
            echo "\t<div class=\"sparkline\">
        ";
            // line 29
            echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineAvgGenerationTime"]) ? $context["urlSparklineAvgGenerationTime"] : $this->getContext($context, "urlSparklineAvgGenerationTime"))));
            echo "
\t\t";
            // line 30
            $context["averageGenerationTime"] = call_user_func_array($this->env->getFilter('sumtime')->getCallable(), array((isset($context["averageGenerationTime"]) ? $context["averageGenerationTime"] : $this->getContext($context, "averageGenerationTime"))));
            // line 31
            echo "\t\t";
            echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_AverageGenerationTime", (("<strong>" . (isset($context["averageGenerationTime"]) ? $context["averageGenerationTime"] : $this->getContext($context, "averageGenerationTime"))) . "</strong>")));
            echo "
\t</div>
    ";
        }
        // line 34
        echo "</div>

<div id='rightcolumn'>
    ";
        // line 37
        if (((array_key_exists("showActionsPluginReports", $context)) ? (_twig_default_filter((isset($context["showActionsPluginReports"]) ? $context["showActionsPluginReports"] : $this->getContext($context, "showActionsPluginReports")), false)) : (false))) {
            // line 38
            echo "        ";
            if ((isset($context["showOnlyActions"]) ? $context["showOnlyActions"] : $this->getContext($context, "showOnlyActions"))) {
                // line 39
                echo "            <div class=\"sparkline\">
                ";
                // line 40
                echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineNbActions"]) ? $context["urlSparklineNbActions"] : $this->getContext($context, "urlSparklineNbActions"))));
                echo "
                ";
                // line 41
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbActionsDescription", (("<strong>" . (isset($context["nbActions"]) ? $context["nbActions"] : $this->getContext($context, "nbActions"))) . "</strong>")));
                echo "
            </div>
        ";
            } else {
                // line 44
                echo "            <div class=\"sparkline\">
                ";
                // line 45
                echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineNbPageviews"]) ? $context["urlSparklineNbPageviews"] : $this->getContext($context, "urlSparklineNbPageviews"))));
                echo "
                ";
                // line 46
                echo trim(call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbPageviewsDescription", (("<strong>" . (isset($context["nbPageviews"]) ? $context["nbPageviews"] : $this->getContext($context, "nbPageviews"))) . "</strong>"))));
                echo ",
                ";
                // line 47
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbUniquePageviewsDescription", (("<strong>" . (isset($context["nbUniquePageviews"]) ? $context["nbUniquePageviews"] : $this->getContext($context, "nbUniquePageviews"))) . "</strong>")));
                echo "
            </div>
            ";
                // line 49
                if ((isset($context["displaySiteSearch"]) ? $context["displaySiteSearch"] : $this->getContext($context, "displaySiteSearch"))) {
                    // line 50
                    echo "                <div class=\"sparkline\">
                    ";
                    // line 51
                    echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineNbSearches"]) ? $context["urlSparklineNbSearches"] : $this->getContext($context, "urlSparklineNbSearches"))));
                    echo "
                    ";
                    // line 52
                    echo trim(call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbSearchesDescription", (("<strong>" . (isset($context["nbSearches"]) ? $context["nbSearches"] : $this->getContext($context, "nbSearches"))) . "</strong>"))));
                    echo ",
                    ";
                    // line 53
                    echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbKeywordsDescription", (("<strong>" . (isset($context["nbKeywords"]) ? $context["nbKeywords"] : $this->getContext($context, "nbKeywords"))) . "</strong>")));
                    echo "
                </div>
            ";
                }
                // line 56
                echo "            <div class=\"sparkline\">
                    ";
                // line 57
                echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineNbDownloads"]) ? $context["urlSparklineNbDownloads"] : $this->getContext($context, "urlSparklineNbDownloads"))));
                echo "
                    ";
                // line 58
                echo trim(call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbDownloadsDescription", (("<strong>" . (isset($context["nbDownloads"]) ? $context["nbDownloads"] : $this->getContext($context, "nbDownloads"))) . "</strong>"))));
                echo ",
                    ";
                // line 59
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbUniqueDownloadsDescription", (("<strong>" . (isset($context["nbUniqueDownloads"]) ? $context["nbUniqueDownloads"] : $this->getContext($context, "nbUniqueDownloads"))) . "</strong>")));
                echo "
            </div>
            <div class=\"sparkline\">
                    ";
                // line 62
                echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineNbOutlinks"]) ? $context["urlSparklineNbOutlinks"] : $this->getContext($context, "urlSparklineNbOutlinks"))));
                echo "
                    ";
                // line 63
                echo trim(call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbOutlinksDescription", (("<strong>" . (isset($context["nbOutlinks"]) ? $context["nbOutlinks"] : $this->getContext($context, "nbOutlinks"))) . "</strong>"))));
                echo ",
                    ";
                // line 64
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_NbUniqueOutlinksDescription", (("<strong>" . (isset($context["nbUniqueOutlinks"]) ? $context["nbUniqueOutlinks"] : $this->getContext($context, "nbUniqueOutlinks"))) . "</strong>")));
                echo "
            </div>
            ";
            }
            // line 67
            echo "    ";
        }
        // line 68
        echo "    <div class=\"sparkline\">
            ";
        // line 69
        echo call_user_func_array($this->env->getFunction('sparkline')->getCallable(), array((isset($context["urlSparklineMaxActions"]) ? $context["urlSparklineMaxActions"] : $this->getContext($context, "urlSparklineMaxActions"))));
        echo "
            ";
        // line 70
        echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("VisitsSummary_MaxNbActions", (("<strong>" . (isset($context["maxActions"]) ? $context["maxActions"] : $this->getContext($context, "maxActions"))) . "</strong>")));
        echo "
    </div>
</div>
<div style=\"clear:both;\"></div>

";
        // line 75
        $this->env->loadTemplate("_sparklineFooter.twig")->display($context);
        // line 76
        echo "
";
    }

    public function getTemplateName()
    {
        return "@VisitsSummary/_sparklines.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 76,  215 => 75,  207 => 70,  203 => 69,  200 => 68,  197 => 67,  191 => 64,  187 => 63,  183 => 62,  177 => 59,  173 => 58,  169 => 57,  166 => 56,  160 => 53,  156 => 52,  152 => 51,  149 => 50,  147 => 49,  142 => 47,  138 => 46,  134 => 45,  131 => 44,  125 => 41,  121 => 40,  118 => 39,  115 => 38,  113 => 37,  108 => 34,  101 => 31,  99 => 30,  95 => 29,  92 => 28,  90 => 27,  85 => 25,  81 => 24,  75 => 21,  71 => 20,  64 => 17,  62 => 16,  58 => 15,  55 => 14,  49 => 11,  45 => 10,  42 => 9,  40 => 8,  38 => 7,  35 => 6,  32 => 5,  27 => 4,  23 => 3,  19 => 1,);
    }
}
