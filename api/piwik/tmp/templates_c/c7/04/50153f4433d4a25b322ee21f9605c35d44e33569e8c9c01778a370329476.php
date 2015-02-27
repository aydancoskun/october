<?php

/* @CorePluginsAdmin/pluginMetadata.twig */
class __TwigTemplate_c70450153f4433d4a25b322ee21f9605c35d44e33569e8c9c01778a370329476 extends Twig_Template
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
<hr class=\"metadataSeparator\"/>
<ul class=\"metadata\">
    <li class=\"odd\">";
        // line 5
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Version")), "html", null, true);
        echo ": <strong>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "latestVersion", array()), "html", null, true);
        echo "</strong></li>
    <li class=\"even\">";
        // line 6
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Updated")), "html", null, true);
        echo ": <strong>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "lastUpdated", array()), "html", null, true);
        echo "</strong></li>
    <li class=\"odd\">";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Downloads")), "html", null, true);
        echo ": <strong>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "numDownloads", array()), "html", null, true);
        echo "</strong></li>
    <li class=\"even\">";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Developer")), "html", null, true);
        echo ": <strong>";
        echo $context["plugins"]->getpluginDeveloper($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "owner", array()));
        echo "</strong></li>
</ul>";
    }

    public function getTemplateName()
    {
        return "@CorePluginsAdmin/pluginMetadata.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 8,  38 => 7,  32 => 6,  26 => 5,  21 => 2,  19 => 1,);
    }
}
