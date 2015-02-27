<?php

/* @CorePluginsAdmin/installPlugin.twig */
class __TwigTemplate_6c3fe3f38ff32e7fbe5cd40b297c6f86a7a3a9927803f1c8dadd909f2dc78d5f extends Twig_Template
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
    <div style=\"max-width:980px;\">

        <h2>";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_InstallingPlugin", $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()))), "html", null, true);
        echo "</h2>

        <div>

            ";
        // line 11
        if ($this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "isTheme", array())) {
            // line 12
            echo "
                <p>";
            // line 13
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_StepDownloadingThemeFromMarketplace")), "html", null, true);
            echo "</p>

                <p>";
            // line 15
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_StepUnzippingTheme")), "html", null, true);
            echo "</p>

                <p>";
            // line 17
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_StepThemeSuccessfullyInstalled", $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "latestVersion", array()))), "html", null, true);
            echo "</p>

                <p><strong><a href=\"";
            // line 19
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("action" => "activate", "pluginName" => $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), "nonce" => (isset($context["nonce"]) ? $context["nonce"] : $this->getContext($context, "nonce"))))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_ActionActivateTheme")), "html", null, true);
            echo "</a></strong>

                    |
                    <a href=\"";
            // line 22
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("action" => "browseThemes"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_BackToExtendPiwik")), "html", null, true);
            echo "</a></p>

            ";
        } else {
            // line 25
            echo "
                <p>";
            // line 26
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_StepDownloadingPluginFromMarketplace")), "html", null, true);
            echo "</p>

                <p>";
            // line 28
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_StepUnzippingPlugin")), "html", null, true);
            echo "</p>

                <p>";
            // line 30
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_StepPluginSuccessfullyInstalled", $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "latestVersion", array()))), "html", null, true);
            echo "</p>

                <p><strong><a href=\"";
            // line 32
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("action" => "activate", "pluginName" => $this->getAttribute((isset($context["plugin"]) ? $context["plugin"] : $this->getContext($context, "plugin")), "name", array()), "nonce" => (isset($context["nonce"]) ? $context["nonce"] : $this->getContext($context, "nonce"))))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_ActionActivatePlugin")), "html", null, true);
            echo "</a></strong>

                    |
                    <a href=\"";
            // line 35
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("action" => "browsePlugins"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_BackToExtendPiwik")), "html", null, true);
            echo "</a></p>

            ";
        }
        // line 38
        echo "        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "@CorePluginsAdmin/installPlugin.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 38,  105 => 35,  97 => 32,  92 => 30,  87 => 28,  82 => 26,  79 => 25,  71 => 22,  63 => 19,  58 => 17,  53 => 15,  48 => 13,  45 => 12,  43 => 11,  36 => 7,  31 => 4,  28 => 3,);
    }
}
