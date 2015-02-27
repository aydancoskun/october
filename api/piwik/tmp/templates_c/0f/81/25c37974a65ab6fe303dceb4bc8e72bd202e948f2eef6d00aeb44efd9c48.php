<?php

/* @CorePluginsAdmin/pluginOverview.twig */
class __TwigTemplate_0f8125c37974a65ab6fe303dceb4bc8e72bd202e948f2eef6d00aeb44efd9c48 extends Twig_Template
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
        $context["plugins"] = $this->env->loadTemplate("@CorePluginsAdmin/macros.twig");
        // line 2
        echo "
";
        // line 3
        if ((isset($context["isSuperUser"]) ? $context["isSuperUser"] : $this->getContext($context, "isSuperUser"))) {
            // line 4
            echo "    ";
            if (($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "canBeUpdated", array()) && (0 == twig_length_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "missingRequirements", array()))))) {
                // line 5
                echo "        <a class=\"update\"
           href=\"";
                // line 6
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("action" => "updatePlugin", "pluginName" => $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), "nonce" => (isset($context["updateNonce"]) ? $context["updateNonce"] : $this->getContext($context, "updateNonce"))))), "html", null, true);
                echo "\"
           >";
                // line 7
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreUpdater_UpdateTitle")), "html", null, true);
                echo "</a>
    ";
            } elseif ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "isInstalled", array())) {
                // line 9
                echo "        <span class=\"install\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Installed")), "html", null, true);
                echo "</span>
    ";
            } elseif ((0 < twig_length_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "missingRequirements", array())))) {
                // line 11
                echo "    ";
            } else {
                // line 12
                echo "        <a href=\"";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("action" => "installPlugin", "pluginName" => $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), "nonce" => (isset($context["installNonce"]) ? $context["installNonce"] : $this->getContext($context, "installNonce"))))), "html", null, true);
                echo "\"
           class=\"install\">";
                // line 13
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_ActionInstall")), "html", null, true);
                echo "</a>
    ";
            }
        }
        // line 16
        echo "
<h3 class=\"header\" title=\"";
        // line 17
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_MoreDetails")), "html", null, true);
        echo "\">
    <a href=\"javascript:void(0);\" class=\"more\">";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), "html", null, true);
        echo "</a>
</h3>
<p class=\"description\">";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "description", array()), "html", null, true);
        echo "
    <br />
    <a href=\"javascript:void(0);\" title=\"";
        // line 22
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_MoreDetails")), "html", null, true);
        echo "\" class=\"more\">&gt;&gt; ";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_MoreLowerCase")), "html", null, true);
        echo "</a>
</p>

";
        // line 25
        if ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "canBeUpdated", array())) {
            // line 26
            echo "    <p class=\"updateAvailableNotice\" data-activePluginTab=\"changelog\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_PluginUpdateAvailable", $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "currentVersion", array()), $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "latestVersion", array()))), "html", null, true);
            echo "</p>
";
        }
        // line 28
        echo "
";
        // line 29
        echo $context["plugins"]->getmissingRequirementsPleaseUpdateNotice((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")));
    }

    public function getTemplateName()
    {
        return "@CorePluginsAdmin/pluginOverview.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 29,  94 => 28,  88 => 26,  86 => 25,  78 => 22,  73 => 20,  68 => 18,  64 => 17,  61 => 16,  55 => 13,  50 => 12,  47 => 11,  41 => 9,  36 => 7,  32 => 6,  29 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
