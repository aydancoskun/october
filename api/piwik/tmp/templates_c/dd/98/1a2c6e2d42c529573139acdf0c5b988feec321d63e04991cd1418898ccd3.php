<?php

/* @CoreAdminHome/pluginSettings.twig */
class __TwigTemplate_dd981a2c6e2d42c529573139acdf0c5b988feec321d63e04991cd1418898ccd3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("admin.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "admin.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
<div id=\"pluginsSettings\">
    ";
        // line 6
        $context["piwik"] = $this->env->loadTemplate("macros.twig");
        // line 7
        echo "    ";
        $context["ajax"] = $this->env->loadTemplate("ajaxMacros.twig");
        // line 8
        echo "
    <p>
        ";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_PluginSettingsIntro")), "html", null, true);
        echo "
        ";
        // line 11
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pluginSettings"]) ? $context["pluginSettings"] : $this->getContext($context, "pluginSettings")));
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
        foreach ($context['_seq'] as $context["pluginName"] => $context["settings"]) {
            // line 12
            echo "            <a href=\"#";
            echo twig_escape_filter($this->env, $context["pluginName"], "html_attr");
            echo "\">";
            echo twig_escape_filter($this->env, $context["pluginName"], "html", null, true);
            echo "</a>";
            if ((!$this->getAttribute($context["loop"], "last", array()))) {
                echo ", ";
            }
            // line 13
            echo "        ";
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
        unset($context['_seq'], $context['_iterated'], $context['pluginName'], $context['settings'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "    </p>

    <input type=\"hidden\" name=\"setpluginsettingsnonce\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["nonce"]) ? $context["nonce"] : $this->getContext($context, "nonce")), "html", null, true);
        echo "\">

    ";
        // line 18
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pluginSettings"]) ? $context["pluginSettings"] : $this->getContext($context, "pluginSettings")));
        foreach ($context['_seq'] as $context["pluginName"] => $context["settings"]) {
            // line 19
            echo "
        <h2 id=\"";
            // line 20
            echo twig_escape_filter($this->env, $context["pluginName"], "html_attr");
            echo "\">";
            echo twig_escape_filter($this->env, $context["pluginName"], "html", null, true);
            echo "</h2>

        ";
            // line 22
            if ($this->getAttribute($context["settings"], "getIntroduction", array())) {
                // line 23
                echo "            <p class=\"pluginIntroduction\">
                ";
                // line 24
                echo twig_escape_filter($this->env, $this->getAttribute($context["settings"], "getIntroduction", array()), "html", null, true);
                echo "
            </p>
        ";
            }
            // line 27
            echo "
        <table class=\"adminTable\" id=\"pluginSettings\" data-pluginname=\"";
            // line 28
            echo twig_escape_filter($this->env, $context["pluginName"], "html_attr");
            echo "\">

        ";
            // line 30
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["settings"], "getSettingsForCurrentUser", array()));
            foreach ($context['_seq'] as $context["name"] => $context["setting"]) {
                // line 31
                echo "            ";
                $context["settingValue"] = $this->getAttribute($context["setting"], "getValue", array());
                // line 32
                echo "
            ";
                // line 33
                if ((twig_in_filter($context["pluginName"], twig_get_array_keys_filter((isset($context["firstSuperUserSettingNames"]) ? $context["firstSuperUserSettingNames"] : $this->getContext($context, "firstSuperUserSettingNames")))) && ($context["name"] == $this->getAttribute((isset($context["firstSuperUserSettingNames"]) ? $context["firstSuperUserSettingNames"] : $this->getContext($context, "firstSuperUserSettingNames")), $context["pluginName"], array(), "array")))) {
                    // line 34
                    echo "                <tr>
                    <td colspan=\"3\">
                        <h3 class=\"superUserSettings\">";
                    // line 36
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_SuperAdmin")), "html", null, true);
                    echo "</h3>
                    </td>
                </tr>
            ";
                }
                // line 40
                echo "
            ";
                // line 41
                if ($this->getAttribute($context["setting"], "introduction", array())) {
                    // line 42
                    echo "                <tr>
                    <td colspan=\"3\">
                        <p class=\"settingIntroduction\">
                            ";
                    // line 45
                    echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "introduction", array()), "html", null, true);
                    echo "
                        </p>
                    </td>
                </tr>
            ";
                }
                // line 50
                echo "
            <tr>
                <td class=\"columnTitle\">
                    <span class=\"title\">";
                // line 53
                echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "title", array()), "html", null, true);
                echo "</span>
                    <br />
                    <span class='form-description'>
                        ";
                // line 56
                echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "description", array()), "html", null, true);
                echo "
                    </span>

                </td>
                <td class=\"columnField\">
                    <fieldset>
                        <label>
                            ";
                // line 63
                if ((($this->getAttribute($context["setting"], "uiControlType", array()) == "select") || ($this->getAttribute($context["setting"], "uiControlType", array()) == "multiselect"))) {
                    // line 64
                    echo "                                <select
                                    ";
                    // line 65
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["setting"], "uiControlAttributes", array()));
                    foreach ($context['_seq'] as $context["attr"] => $context["val"]) {
                        // line 66
                        echo "                                        ";
                        echo twig_escape_filter($this->env, $context["attr"], "html_attr");
                        echo "=\"";
                        echo twig_escape_filter($this->env, $context["val"], "html_attr");
                        echo "\"
                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['attr'], $context['val'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 68
                    echo "                                    name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "getKey", array()), "html_attr");
                    echo "\"
                                    ";
                    // line 69
                    if (($this->getAttribute($context["setting"], "uiControlType", array()) == "multiselect")) {
                        echo "multiple";
                    }
                    echo ">

                                    ";
                    // line 71
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["setting"], "availableValues", array()));
                    foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                        // line 72
                        echo "                                        <option value='";
                        echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                        echo "'
                                                ";
                        // line 73
                        if ((twig_test_iterable((isset($context["settingValue"]) ? $context["settingValue"] : $this->getContext($context, "settingValue"))) && twig_in_filter($context["key"], (isset($context["settingValue"]) ? $context["settingValue"] : $this->getContext($context, "settingValue"))))) {
                            // line 74
                            echo "                                                    selected='selected'
                                                ";
                        } elseif (((isset($context["settingValue"]) ? $context["settingValue"] : $this->getContext($context, "settingValue")) == $context["key"])) {
                            // line 76
                            echo "                                                    selected='selected'
                                                ";
                        }
                        // line 77
                        echo ">
                                            ";
                        // line 78
                        echo twig_escape_filter($this->env, $context["value"], "html", null, true);
                        echo "
                                        </option>
                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 81
                    echo "
                                </select>
                            ";
                } elseif (($this->getAttribute($context["setting"], "uiControlType", array()) == "textarea")) {
                    // line 84
                    echo "                                <textarea style=\"width: 376px; height: 250px;\"
                                    ";
                    // line 85
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["setting"], "uiControlAttributes", array()));
                    foreach ($context['_seq'] as $context["attr"] => $context["val"]) {
                        // line 86
                        echo "                                        ";
                        echo twig_escape_filter($this->env, $context["attr"], "html_attr");
                        echo "=\"";
                        echo twig_escape_filter($this->env, $context["val"], "html_attr");
                        echo "\"
                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['attr'], $context['val'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 88
                    echo "                                    name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "getKey", array()), "html_attr");
                    echo "\"
                                    >";
                    // line 90
                    echo twig_escape_filter($this->env, (isset($context["settingValue"]) ? $context["settingValue"] : $this->getContext($context, "settingValue")), "html", null, true);
                    // line 91
                    echo "</textarea>
                            ";
                } elseif (($this->getAttribute($context["setting"], "uiControlType", array()) == "radio")) {
                    // line 93
                    echo "
                                ";
                    // line 94
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["setting"], "availableValues", array()));
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
                    foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                        // line 95
                        echo "
                                    <input
                                        id=\"name-value-";
                        // line 97
                        echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                        echo "\"
                                        ";
                        // line 98
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["setting"], "uiControlAttributes", array()));
                        foreach ($context['_seq'] as $context["attr"] => $context["val"]) {
                            // line 99
                            echo "                                            ";
                            echo twig_escape_filter($this->env, $context["attr"], "html_attr");
                            echo "=\"";
                            echo twig_escape_filter($this->env, $context["val"], "html_attr");
                            echo "\"
                                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['attr'], $context['val'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 101
                        echo "                                        ";
                        if (((isset($context["settingValue"]) ? $context["settingValue"] : $this->getContext($context, "settingValue")) === $context["key"])) {
                            // line 102
                            echo "                                            checked=\"checked\"
                                        ";
                        }
                        // line 104
                        echo "                                        type=\"radio\"
                                        value=\"";
                        // line 105
                        echo twig_escape_filter($this->env, $context["key"], "html_attr");
                        echo "\"
                                        name=\"";
                        // line 106
                        echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "getKey", array()), "html_attr");
                        echo "\" />

                                    <label for=\"name-value-";
                        // line 108
                        echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $context["value"], "html", null, true);
                        echo "</label>

                                    <br />

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
                    unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 113
                    echo "
                            ";
                } else {
                    // line 115
                    echo "
                                <input
                                    ";
                    // line 117
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["setting"], "uiControlAttributes", array()));
                    foreach ($context['_seq'] as $context["attr"] => $context["val"]) {
                        // line 118
                        echo "                                        ";
                        echo twig_escape_filter($this->env, $context["attr"], "html_attr");
                        echo "=\"";
                        echo twig_escape_filter($this->env, $context["val"], "html_attr");
                        echo "\"
                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['attr'], $context['val'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 120
                    echo "                                    ";
                    if (($this->getAttribute($context["setting"], "uiControlType", array()) == "checkbox")) {
                        // line 121
                        echo "                                        value=\"1\"
                                    ";
                    }
                    // line 123
                    echo "                                    ";
                    if ((($this->getAttribute($context["setting"], "uiControlType", array()) == "checkbox") && (isset($context["settingValue"]) ? $context["settingValue"] : $this->getContext($context, "settingValue")))) {
                        // line 124
                        echo "                                        checked=\"checked\"
                                    ";
                    }
                    // line 126
                    echo "                                    type=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "uiControlType", array()), "html_attr");
                    echo "\"
                                    name=\"";
                    // line 127
                    echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "getKey", array()), "html_attr");
                    echo "\"
                                    value=\"";
                    // line 128
                    echo twig_escape_filter($this->env, (isset($context["settingValue"]) ? $context["settingValue"] : $this->getContext($context, "settingValue")), "html_attr");
                    echo "\"
                                >

                            ";
                }
                // line 132
                echo "
                            ";
                // line 133
                if ((($this->getAttribute($context["setting"], "defaultValue", array()) && ($this->getAttribute($context["setting"], "uiControlType", array()) != "checkbox")) && ($this->getAttribute($context["setting"], "uiControlType", array()) != "radio"))) {
                    // line 134
                    echo "                                <br/>
                                <span class='form-description'>
                                    ";
                    // line 136
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Default")), "html", null, true);
                    echo "
                                    ";
                    // line 137
                    if (twig_test_iterable($this->getAttribute($context["setting"], "defaultValue", array()))) {
                        // line 138
                        echo "                                        ";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('truncate')->getCallable(), array(twig_join_filter($this->getAttribute($context["setting"], "defaultValue", array()), ", "), 50)), "html", null, true);
                        echo "
                                    ";
                    } else {
                        // line 140
                        echo "                                        ";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('truncate')->getCallable(), array($this->getAttribute($context["setting"], "defaultValue", array()), 50)), "html", null, true);
                        echo "
                                    ";
                    }
                    // line 142
                    echo "                                </span>
                            ";
                }
                // line 144
                echo "
                        </label>
                    </fieldset>
                </td>
                <td class=\"columnHelp\">
                    ";
                // line 149
                if ($this->getAttribute($context["setting"], "inlineHelp", array())) {
                    // line 150
                    echo "                        <div class=\"ui-widget\">
                            <div class=\"ui-inline-help\">
                                ";
                    // line 152
                    echo twig_escape_filter($this->env, $this->getAttribute($context["setting"], "inlineHelp", array()), "html", null, true);
                    echo "
                            </div>
                        </div>
                    ";
                }
                // line 156
                echo "                </td>
            </tr>

        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['setting'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 160
            echo "
        </table>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['pluginName'], $context['settings'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 164
        echo "
    <hr class=\"submitSeparator\"/>

    ";
        // line 167
        echo $context["ajax"]->geterrorDiv("ajaxErrorPluginSettings");
        echo "
    ";
        // line 168
        echo $context["ajax"]->getloadingDiv("ajaxLoadingPluginSettings");
        echo "

    <input type=\"submit\" value=\"";
        // line 170
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Save")), "html", null, true);
        echo "\" class=\"pluginsSettingsSubmit submit\"/>

</div>
";
    }

    public function getTemplateName()
    {
        return "@CoreAdminHome/pluginSettings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  508 => 170,  503 => 168,  499 => 167,  494 => 164,  485 => 160,  476 => 156,  469 => 152,  465 => 150,  463 => 149,  456 => 144,  452 => 142,  446 => 140,  440 => 138,  438 => 137,  434 => 136,  430 => 134,  428 => 133,  425 => 132,  418 => 128,  414 => 127,  409 => 126,  405 => 124,  402 => 123,  398 => 121,  395 => 120,  384 => 118,  380 => 117,  376 => 115,  372 => 113,  351 => 108,  346 => 106,  342 => 105,  339 => 104,  335 => 102,  332 => 101,  321 => 99,  317 => 98,  313 => 97,  309 => 95,  292 => 94,  289 => 93,  285 => 91,  283 => 90,  278 => 88,  267 => 86,  263 => 85,  260 => 84,  255 => 81,  246 => 78,  243 => 77,  239 => 76,  235 => 74,  233 => 73,  228 => 72,  224 => 71,  217 => 69,  212 => 68,  201 => 66,  197 => 65,  194 => 64,  192 => 63,  182 => 56,  176 => 53,  171 => 50,  163 => 45,  158 => 42,  156 => 41,  153 => 40,  146 => 36,  142 => 34,  140 => 33,  137 => 32,  134 => 31,  130 => 30,  125 => 28,  122 => 27,  116 => 24,  113 => 23,  111 => 22,  104 => 20,  101 => 19,  97 => 18,  92 => 16,  88 => 14,  74 => 13,  65 => 12,  48 => 11,  44 => 10,  40 => 8,  37 => 7,  35 => 6,  31 => 4,  28 => 3,);
    }
}
