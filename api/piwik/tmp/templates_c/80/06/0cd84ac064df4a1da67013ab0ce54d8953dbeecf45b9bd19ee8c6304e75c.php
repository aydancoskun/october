<?php

/* @CoreVisualizations/_dataTableViz_htmlTable.twig */
class __TwigTemplate_80060cd84ac064df4a1da67013ab0ce54d8953dbeecf45b9bd19ee8c6304e75c extends Twig_Template
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
        $context["subtablesAreDisabled"] = ((($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "show_goals_columns", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "show_goals_columns", array()), false)) : (false)) && (($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "disable_subtable_when_show_goals", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "disable_subtable_when_show_goals", array()), false)) : (false)));
        // line 3
        $context["showingEmbeddedSubtable"] = ((!twig_test_empty($this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "show_embedded_subtable", array()))) && ((array_key_exists("idSubtable", $context)) ? (_twig_default_filter((isset($context["idSubtable"]) ? $context["idSubtable"] : $this->getContext($context, "idSubtable")), false)) : (false)));
        // line 5
        if (array_key_exists("error", $context)) {
            // line 6
            echo "    ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message", array()), "html", null, true);
            echo "
";
        } else {
            // line 8
            if ((!(isset($context["showingEmbeddedSubtable"]) ? $context["showingEmbeddedSubtable"] : $this->getContext($context, "showingEmbeddedSubtable")))) {
                // line 9
                echo "<table cellspacing=\"0\" class=\"dataTable\">
        ";
                // line 10
                $this->env->loadTemplate("@CoreHome/_dataTableHead.twig")->display($context);
                // line 11
                echo "
        <tbody>";
            }
            // line 14
            if (((isset($context["showingEmbeddedSubtable"]) ? $context["showingEmbeddedSubtable"] : $this->getContext($context, "showingEmbeddedSubtable")) && ($this->getAttribute((isset($context["dataTable"]) ? $context["dataTable"] : $this->getContext($context, "dataTable")), "getRowsCount", array(), "method") == 0))) {
                // line 15
                echo "            ";
                if ((((!array_key_exists("clientSideParameters", $context)) || (!$this->getAttribute((isset($context["clientSideParameters"]) ? $context["clientSideParameters"] : null), "filter_pattern_recursive", array(), "any", true, true))) || (!$this->getAttribute((isset($context["clientSideParameters"]) ? $context["clientSideParameters"] : $this->getContext($context, "clientSideParameters")), "filter_pattern_recursive", array())))) {
                    // line 16
                    echo "                <tr class=\"nodata\">
                    <td colspan=\"";
                    // line 17
                    echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "columns_to_display", array())), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreHome_CategoryNoData")), "html", null, true);
                    echo "</td>
                </tr>
            ";
                }
                // line 20
                echo "        ";
            } else {
                // line 21
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["dataTable"]) ? $context["dataTable"] : $this->getContext($context, "dataTable")), "getRows", array(), "method"));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["rowId"] => $context["row"]) {
                    // line 22
                    $context["rowHasSubtable"] = (((!(isset($context["subtablesAreDisabled"]) ? $context["subtablesAreDisabled"] : $this->getContext($context, "subtablesAreDisabled"))) && $this->getAttribute($context["row"], "getIdSubDataTable", array(), "method")) && (!(null === $this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "subtable_controller_action", array()))));
                    // line 23
                    $context["isSummaryRow"] = ($context["rowId"] == twig_constant("Piwik\\DataTable::ID_SUMMARY_ROW"));
                    // line 24
                    $context["shouldHighlightRow"] = ((isset($context["isSummaryRow"]) ? $context["isSummaryRow"] : $this->getContext($context, "isSummaryRow")) && $this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "highlight_summary_row", array()));
                    // line 27
                    $context["showRow"] = ((((isset($context["subtablesAreDisabled"]) ? $context["subtablesAreDisabled"] : $this->getContext($context, "subtablesAreDisabled")) || (!(isset($context["rowHasSubtable"]) ? $context["rowHasSubtable"] : $this->getContext($context, "rowHasSubtable")))) || (!(($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "show_expanded", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "show_expanded", array()), false)) : (false)))) || (!(($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "replace_row_with_subtable", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "replace_row_with_subtable", array()), false)) : (false))));
                    // line 32
                    if ((isset($context["showRow"]) ? $context["showRow"] : $this->getContext($context, "showRow"))) {
                        // line 33
                        echo "                <tr ";
                        if ((isset($context["rowHasSubtable"]) ? $context["rowHasSubtable"] : $this->getContext($context, "rowHasSubtable"))) {
                            echo "id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "getIdSubDataTable", array(), "method"), "html", null, true);
                            echo "\"";
                        }
                        // line 34
                        echo "                    class=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "getMetadata", array(0 => "css_class"), "method"), "html", null, true);
                        echo " ";
                        if ((isset($context["rowHasSubtable"]) ? $context["rowHasSubtable"] : $this->getContext($context, "rowHasSubtable"))) {
                            echo "subDataTable";
                        }
                        if ((isset($context["shouldHighlightRow"]) ? $context["shouldHighlightRow"] : $this->getContext($context, "shouldHighlightRow"))) {
                            echo " highlight";
                        }
                        if ((isset($context["isSummaryRow"]) ? $context["isSummaryRow"] : $this->getContext($context, "isSummaryRow"))) {
                            echo " summaryRow";
                        }
                        echo "\"
                    ";
                        // line 35
                        if ((isset($context["rowHasSubtable"]) ? $context["rowHasSubtable"] : $this->getContext($context, "rowHasSubtable"))) {
                            echo "title=\"";
                            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreHome_ClickRowToExpandOrContract")), "html", null, true);
                            echo "\"";
                        }
                        echo ">
                    ";
                        // line 36
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties")), "columns_to_display", array()));
                        $context['loop'] = array(
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        );
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                            // line 37
                            echo "                        <td>
                            ";
                            // line 38
                            $this->env->loadTemplate("@CoreHome/_dataTableCell.twig")->display(array_merge($context, (isset($context["properties"]) ? $context["properties"] : $this->getContext($context, "properties"))));
                            // line 39
                            echo "                        </td>
                    ";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['length'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 41
                        echo "                </tr>
                ";
                    }
                    // line 43
                    echo "
                ";
                    // line 45
                    echo "                ";
                    if (((($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "show_expanded", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["properties"]) ? $context["properties"] : null), "show_expanded", array()), false)) : (false)) && (isset($context["rowHasSubtable"]) ? $context["rowHasSubtable"] : $this->getContext($context, "rowHasSubtable")))) {
                        // line 46
                        echo "                    ";
                        $this->env->loadTemplate("@CoreVisualizations/_dataTableViz_htmlTable.twig")->display(array_merge($context, array("dataTable" => $this->getAttribute($context["row"], "getSubtable", array(), "method"), "idSubtable" => $this->getAttribute($context["row"], "getIdSubDataTable", array(), "method"))));
                        // line 47
                        echo "                ";
                    }
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['rowId'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 50
            if ((!(isset($context["showingEmbeddedSubtable"]) ? $context["showingEmbeddedSubtable"] : $this->getContext($context, "showingEmbeddedSubtable")))) {
                // line 51
                echo "</tbody>
    </table>";
            }
        }
    }

    public function getTemplateName()
    {
        return "@CoreVisualizations/_dataTableViz_htmlTable.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 51,  184 => 50,  168 => 47,  165 => 46,  162 => 45,  159 => 43,  155 => 41,  140 => 39,  138 => 38,  135 => 37,  118 => 36,  110 => 35,  95 => 34,  88 => 33,  86 => 32,  84 => 27,  82 => 24,  80 => 23,  78 => 22,  61 => 21,  58 => 20,  50 => 17,  47 => 16,  44 => 15,  42 => 14,  38 => 11,  36 => 10,  33 => 9,  31 => 8,  25 => 6,  23 => 5,  21 => 3,  19 => 1,);
    }
}
