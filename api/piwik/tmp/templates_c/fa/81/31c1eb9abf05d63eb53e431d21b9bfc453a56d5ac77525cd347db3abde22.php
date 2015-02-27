<?php

/* @Installation/systemCheckPage.twig */
class __TwigTemplate_fa8131c1eb9abf05d63eb53e431d21b9bfc453a56d5ac77525cd347db3abde22 extends Twig_Template
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
        if ((isset($context["isSuperUser"]) ? $context["isSuperUser"] : $this->getContext($context, "isSuperUser"))) {
            // line 5
            echo "    <h2 piwik-enriched-headline>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheck")), "html", null, true);
            echo "</h2>
    <p style=\"margin-left:1em;\">
        ";
            // line 7
            if ($this->getAttribute((isset($context["infos"]) ? $context["infos"] : $this->getContext($context, "infos")), "has_errors", array())) {
                // line 8
                echo "            <img src=\"plugins/Morpheus/images/error.png\"/>
            ";
                // line 9
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheckSummaryThereWereErrors", "<strong>", "</strong>", "<strong><em>", "</em></strong>"));
                echo " ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SeeBelowForMoreInfo")), "html", null, true);
                echo "
        ";
            } elseif ($this->getAttribute((isset($context["infos"]) ? $context["infos"] : $this->getContext($context, "infos")), "has_warnings", array())) {
                // line 11
                echo "            <img src=\"plugins/Morpheus/images/warning.png\"/>
            ";
                // line 12
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheckSummaryThereWereWarnings")), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SeeBelowForMoreInfo")), "html", null, true);
                echo "
        ";
            } else {
                // line 14
                echo "            <img src=\"plugins/Morpheus/images/ok.png\"/>
            ";
                // line 15
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheckSummaryNoProblems")), "html", null, true);
                echo "
        ";
            }
            // line 17
            echo "    </p>
    ";
            // line 18
            $this->env->loadTemplate("@Installation/_systemCheckSection.twig")->display($context);
        }
    }

    public function getTemplateName()
    {
        return "@Installation/systemCheckPage.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 18,  69 => 17,  64 => 15,  61 => 14,  54 => 12,  51 => 11,  44 => 9,  41 => 8,  39 => 7,  33 => 5,  31 => 4,  28 => 3,);
    }
}
