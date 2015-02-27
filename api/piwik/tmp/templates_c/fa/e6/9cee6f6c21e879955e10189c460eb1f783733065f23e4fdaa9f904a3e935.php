<?php

/* @CorePluginsAdmin/pluginDetails.twig */
class __TwigTemplate_fae69cee6f6c21e879955e10189c460eb1f783733065f23e4fdaa9f904a3e935 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["pluginsMacro"] = $this->env->loadTemplate("@CorePluginsAdmin/macros.twig");
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
    <div class=\"pluginDetails\">
        ";
        // line 6
        if ((isset($context["errorMessage"]) ? $context["errorMessage"] : $this->getContext($context, "errorMessage"))) {
            // line 7
            echo "            ";
            echo twig_escape_filter($this->env, (isset($context["errorMessage"]) ? $context["errorMessage"] : $this->getContext($context, "errorMessage")), "html", null, true);
            echo "
        ";
        } elseif ((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin"))) {
            // line 9
            echo "
            ";
            // line 10
            $context["latestVersion"] = $this->getAttribute($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "versions", array()), (twig_length_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "versions", array())) - 1), array(), "array");
            // line 11
            echo "
            <div class=\"header\">
                <div class=\"intro\" style=\"width:75%;float:left;\">
                    <h2>";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), "html", null, true);
            echo "</h2>
                    <p class=\"description\">
                        ";
            // line 16
            if ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "featured", array())) {
                // line 17
                echo "                            ";
                echo $context["pluginsMacro"]->getfeaturedIcon("left");
                echo "
                        ";
            }
            // line 19
            echo "                        ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "description", array()), "html", null, true);
            echo "
                    </p>
                </div>
                <div class=\"width:25%;float:left;\">

                    ";
            // line 24
            if ((isset($context["isSuperUser"]) ? $context["isSuperUser"] : $this->getContext($context, "isSuperUser"))) {
                // line 25
                echo "                        ";
                if (($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "canBeUpdated", array()) && (0 == twig_length_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "missingRequirements", array()))))) {
                    // line 26
                    echo "                            <a class=\"install update\"
                               href=\"";
                    // line 27
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("action" => "updatePlugin", "pluginName" => $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), "nonce" => (isset($context["updateNonce"]) ? $context["updateNonce"] : $this->getContext($context, "updateNonce"))))), "html", null, true);
                    echo "\"
                                    >";
                    // line 28
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreUpdater_UpdateTitle")), "html", null, true);
                    echo "</a>
                        ";
                } elseif ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "isInstalled", array())) {
                    // line 30
                    echo "                        ";
                } elseif ((0 < twig_length_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "missingRequirements", array())))) {
                    // line 31
                    echo "                        ";
                } else {
                    // line 32
                    echo "                            <a href=\"";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("action" => "installPlugin", "pluginName" => $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), "nonce" => (isset($context["installNonce"]) ? $context["installNonce"] : $this->getContext($context, "installNonce"))))), "html", null, true);
                    echo "\"
                               class=\"install\">";
                    // line 33
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_ActionInstall")), "html", null, true);
                    echo "</a>
                        ";
                }
                // line 35
                echo "                    ";
            }
            // line 36
            echo "                </div>
            </div>

            <div class=\"content\">
                <div style=\"width:75%;float:left;\">

                    <div id=\"pluginDetailsTabs\">
                        <ul>
                            <li><a href=\"#tabs-description\">";
            // line 44
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Description")), "html", null, true);
            echo "</a></li>
                            ";
            // line 45
            if ($this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "faq", array())) {
                // line 46
                echo "                                <li><a href=\"#tabs-faq\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Faq")), "html", null, true);
                echo "</a></li>
                            ";
            }
            // line 48
            echo "                            <li><a href=\"#tabs-changelog\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Changelog")), "html", null, true);
            echo "</a></li>
                            ";
            // line 49
            if (twig_length_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "screenshots", array()))) {
                // line 50
                echo "                                <li><a href=\"#tabs-screenshots\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Screenshots")), "html", null, true);
                echo "</a></li>
                            ";
            }
            // line 52
            echo "                            ";
            if ($this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "support", array())) {
                // line 53
                echo "                                <li><a href=\"#tabs-support\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Support")), "html", null, true);
                echo "</a></li>
                            ";
            }
            // line 55
            echo "                        </ul>

                        <div id=\"tabs-description\">
                            ";
            // line 58
            echo $context["pluginsMacro"]->getmissingRequirementsPleaseUpdateNotice((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")));
            echo "
                            ";
            // line 59
            echo $this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "description", array());
            echo "
                        </div>

                        ";
            // line 62
            if ($this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "faq", array())) {
                // line 63
                echo "                            <div id=\"tabs-faq\">
                                ";
                // line 64
                echo $this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "faq", array());
                echo "
                            </div>
                        ";
            }
            // line 67
            echo "
                        <div id=\"tabs-changelog\">
                            ";
            // line 69
            echo $context["pluginsMacro"]->getmissingRequirementsPleaseUpdateNotice((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")));
            echo "
                            ";
            // line 70
            if ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "canBeUpdated", array())) {
                // line 71
                echo "                                <p class=\"updateAvailableNotice\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_PluginUpdateAvailable", $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "currentVersion", array()), $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "latestVersion", array()))), "html", null, true);
                echo "
                                    ";
                // line 72
                if ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "repositoryChangelogUrl", array())) {
                    echo "<a target=\"_blank\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "repositoryChangelogUrl", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_ViewRepositoryChangelog")), "html", null, true);
                    echo "</a>";
                }
                // line 73
                echo "                                </p>
                            ";
            }
            // line 75
            echo "
                            ";
            // line 76
            if ($this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "changelog", array())) {
                // line 77
                echo "                                ";
                echo $this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "changelog", array());
                echo "
                            ";
            }
            // line 79
            echo "
                            <h3>";
            // line 80
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_History")), "html", null, true);
            echo "</h3>

                            <ul>
                                ";
            // line 83
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "versions", array())));
            foreach ($context['_seq'] as $context["_key"] => $context["version"]) {
                // line 84
                echo "                                    <li>
                                        ";
                // line 85
                ob_start();
                // line 86
                echo "                                            <strong>
                                                ";
                // line 87
                if ($this->getAttribute($context["version"], "repositoryChangelogUrl", array())) {
                    // line 88
                    echo "                                                    <a target=\"_blank\" title=\"";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Changelog")), "html", null, true);
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["version"], "repositoryChangelogUrl", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["version"], "name", array()), "html", null, true);
                    echo "</a>
                                                ";
                } else {
                    // line 90
                    echo "                                                    ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["version"], "name", array()), "html", null, true);
                    echo "
                                                ";
                }
                // line 92
                echo "                                            </strong>
                                        ";
                $context["versionName"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                // line 94
                echo "                                        ";
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_PluginVersionInfo", (isset($context["versionName"]) ? $context["versionName"] : $this->getContext($context, "versionName")), $this->getAttribute($context["version"], "release", array())));
                echo "
                                        </li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['version'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 97
            echo "                            </ul>
                        </div>

                        ";
            // line 100
            if (twig_length_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "screenshots", array()))) {
                // line 101
                echo "                            <div id=\"tabs-screenshots\">
                                <div class=\"thumbnails\">
                                    ";
                // line 103
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "screenshots", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["screenshot"]) {
                    // line 104
                    echo "                                        <div class=\"thumbnail\">
                                            <a href=\"";
                    // line 105
                    echo twig_escape_filter($this->env, $context["screenshot"], "html", null, true);
                    echo "\" target=\"_blank\"><img src=\"";
                    echo twig_escape_filter($this->env, $context["screenshot"], "html", null, true);
                    echo "?w=400\" width=\"400\" alt=\"\"></a>
                                            <p>
                                                ";
                    // line 107
                    echo twig_escape_filter($this->env, strtr(twig_last($this->env, twig_split_filter($this->env, $context["screenshot"], "/")), array("_" => " ", ".png" => "", ".jpg" => "", ".jpeg" => "")), "html", null, true);
                    echo "
                                            </p>
                                        </div>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['screenshot'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 111
                echo "                                </div>
                            </div>
                        ";
            }
            // line 114
            echo "
                        ";
            // line 115
            if ($this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "support", array())) {
                // line 116
                echo "                            <div id=\"tabs-support\">

                                ";
                // line 118
                echo $this->getAttribute($this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "readmeHtml", array()), "support", array());
                echo "

                            </div>
                        ";
            }
            // line 122
            echo "                    </div>

                </div>
                <div class=\"metadata\" style=\"width:25%;float:left;\">
                    <p><br /></p>
                    <dl>
                        <dt>";
            // line 128
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Version")), "html", null, true);
            echo "</dt>
                        <dd>";
            // line 129
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "latestVersion", array()), "html", null, true);
            echo "</dd>
                        <dt>";
            // line 130
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_PluginKeywords")), "html", null, true);
            echo "</dt>
                        <dd>";
            // line 131
            echo twig_escape_filter($this->env, twig_join_filter($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "keywords", array()), ", "), "html", null, true);
            echo "</dd>
                        <dt>";
            // line 132
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_LastUpdated")), "html", null, true);
            echo "</dt>
                        <dd>";
            // line 133
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "lastUpdated", array()), "html", null, true);
            echo "</dd>
                        <dt>";
            // line 134
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Downloads")), "html", null, true);
            echo "</dt>
                        <dd title=\"";
            // line 135
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_NumDownloadsLatestVersion", twig_number_format_filter($this->env, $this->getAttribute((isset($context["latestVersion"]) ? $context["latestVersion"] : $this->getContext($context, "latestVersion")), "numDownloads", array())))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "numDownloads", array()), "html", null, true);
            echo "</dd>
                        <dt>";
            // line 136
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Developer")), "html", null, true);
            echo "</dt>
                        <dd>";
            // line 137
            echo $context["pluginsMacro"]->getpluginDeveloper($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "owner", array()));
            echo "</dd>
                        <dt>";
            // line 138
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Authors")), "html", null, true);
            echo "</dt>
                        <dd>";
            // line 139
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "authors", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["author"]) {
                if ($this->getAttribute($context["author"], "name", array())) {
                    // line 140
                    echo "
                                ";
                    // line 141
                    ob_start();
                    // line 142
                    echo "                                    ";
                    if ($this->getAttribute($context["author"], "homepage", array())) {
                        // line 143
                        echo "                                        <a target=\"_blank\" href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["author"], "homepage", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["author"], "name", array()), "html", null, true);
                        echo "</a>
                                    ";
                    } elseif ($this->getAttribute($context["author"], "email", array())) {
                        // line 145
                        echo "                                        <a href=\"mailto:";
                        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($context["author"], "email", array()), "url"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["author"], "name", array()), "html", null, true);
                        echo "</a>
                                    ";
                    } else {
                        // line 147
                        echo "                                        ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["author"], "name", array()), "html", null, true);
                        echo "
                                    ";
                    }
                    // line 149
                    echo "
                                    ";
                    // line 150
                    if (($this->getAttribute($context["loop"], "index", array()) < twig_length_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "authors", array())))) {
                        // line 151
                        echo "                                        ,
                                    ";
                    }
                    // line 153
                    echo "                                ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    // line 154
                    echo "
                            ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['author'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 156
            echo "                        </dd>
                        <dt>";
            // line 157
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Websites")), "html", null, true);
            echo "</dt>
                        <dd>
                            ";
            // line 159
            if ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "homepage", array())) {
                // line 160
                echo "                                <a target=\"_blank\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "homepage", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_PluginWebsite")), "html", null, true);
                echo "</a>,
                            ";
            }
            // line 162
            echo "                            <a target=\"_blank\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "repositoryUrl", array()), "html", null, true);
            echo "\">GitHub</a></dd>
                        ";
            // line 163
            if ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "activity", array())) {
                // line 164
                echo "                            <dt>";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Activity")), "html", null, true);
                echo "</dt>
                            <dd>
                                ";
                // line 166
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "activity", array()), "numCommits", array()), "html", null, true);
                echo " commits

                                ";
                // line 168
                if (($this->getAttribute($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "activity", array()), "numContributors", array()) > 1)) {
                    // line 169
                    echo "                                    ";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_ByXDevelopers", $this->getAttribute($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "activity", array()), "numContributors", array()))), "html", null, true);
                    echo "
                                ";
                }
                // line 171
                echo "                                ";
                if ($this->getAttribute($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "activity", array()), "lastCommitDate", array())) {
                    // line 172
                    echo "                                    ";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_LastCommitTime", $this->getAttribute($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "activity", array()), "lastCommitDate", array()))), "html", null, true);
                    echo "
                                ";
                }
                // line 173
                echo "</dd>
                        ";
            }
            // line 175
            echo "                    </dl>
                    <br />
                </div>
            </div>
            <script type=\"text/javascript\">
                \$(function() {

                    var active = 0;
                    ";
            // line 183
            if ((isset($context["activeTab"]) ? $context["activeTab"] : $this->getContext($context, "activeTab"))) {
                // line 184
                echo "                        var \$activeTab = \$('#tabs-";
                echo twig_escape_filter($this->env, twig_escape_filter($this->env, (isset($context["activeTab"]) ? $context["activeTab"] : $this->getContext($context, "activeTab")), "js"), "html", null, true);
                echo "');
                        if (\$activeTab) {
                            active = \$activeTab.index() - 1;
                        }
                    ";
            }
            // line 189
            echo "
                    \$( \"#pluginDetailsTabs\" ).tabs({active: active >= 0 ? active : 0});

                    \$('.pluginDetails a').each(function (index, a) {
                        var link = \$(a).attr('href');

                        if (link && 0 === link.indexOf('http')) {
                            \$(a).attr('target', '_blank');
                        }
                    });
                });
            </script>
        ";
        }
        // line 202
        echo "    </div>

";
    }

    public function getTemplateName()
    {
        return "@CorePluginsAdmin/pluginDetails.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  539 => 202,  524 => 189,  515 => 184,  513 => 183,  503 => 175,  499 => 173,  493 => 172,  490 => 171,  484 => 169,  482 => 168,  477 => 166,  471 => 164,  469 => 163,  464 => 162,  456 => 160,  454 => 159,  449 => 157,  446 => 156,  435 => 154,  432 => 153,  428 => 151,  426 => 150,  423 => 149,  417 => 147,  409 => 145,  401 => 143,  398 => 142,  396 => 141,  393 => 140,  382 => 139,  378 => 138,  374 => 137,  370 => 136,  364 => 135,  360 => 134,  356 => 133,  352 => 132,  348 => 131,  344 => 130,  340 => 129,  336 => 128,  328 => 122,  321 => 118,  317 => 116,  315 => 115,  312 => 114,  307 => 111,  297 => 107,  290 => 105,  287 => 104,  283 => 103,  279 => 101,  277 => 100,  272 => 97,  262 => 94,  258 => 92,  252 => 90,  242 => 88,  240 => 87,  237 => 86,  235 => 85,  232 => 84,  228 => 83,  222 => 80,  219 => 79,  213 => 77,  211 => 76,  208 => 75,  204 => 73,  196 => 72,  191 => 71,  189 => 70,  185 => 69,  181 => 67,  175 => 64,  172 => 63,  170 => 62,  164 => 59,  160 => 58,  155 => 55,  149 => 53,  146 => 52,  140 => 50,  138 => 49,  133 => 48,  127 => 46,  125 => 45,  121 => 44,  111 => 36,  108 => 35,  103 => 33,  98 => 32,  95 => 31,  92 => 30,  87 => 28,  83 => 27,  80 => 26,  77 => 25,  75 => 24,  66 => 19,  60 => 17,  58 => 16,  53 => 14,  48 => 11,  46 => 10,  43 => 9,  37 => 7,  35 => 6,  31 => 4,  25 => 3,  22 => 2,  20 => 1,);
    }
}
