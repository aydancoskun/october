<?php

/* @DevicesDetection/detection.twig */
class __TwigTemplate_1e439c835f3b14f961233f08c0e9da44871565b0d8cfc8e1abd1bfa49d83c0a3 extends Twig_Template
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
    <script type=\"text/javascript\">

        function showList(type) {
            var ajaxHandler = new ajaxHelper();
            ajaxHandler.addParams({
                module: 'DevicesDetection',
                action: 'showList',
                type: type
            }, 'GET');
            ajaxHandler.setFormat('html');
            ajaxHandler.setCallback(function(response){
                \$('.itemList').html(response).dialog({
                    modal: true,
                    width: '50%',
                    maxHeight: 400
                });
            });
            ajaxHandler.send(true);
        }

    </script>

    <style type=\"text/css\">

        textarea {
            width: 700px;
            display: block;
        }

        .detection {
            padding-top:10px;
        }
        .detection td {
            width: 50%;
        }

    </style>
    <h2>";
        // line 42
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("DevicesDetection_DeviceDetection")), "html", null, true);
        echo "</h2>

    <h3>";
        // line 44
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("DevicesDetection_UserAgent")), "html", null, true);
        echo "</h3>
    <form action=\"";
        // line 45
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array())), "html", null, true);
        echo "\" method=\"POST\">
        <textarea name=\"ua\">";
        // line 46
        echo twig_escape_filter($this->env, (isset($context["userAgent"]) ? $context["userAgent"] : $this->getContext($context, "userAgent")), "html", null, true);
        echo "</textarea>
        <input type=\"submit\" value=\"";
        // line 47
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Refresh")), "html", null, true);
        echo "\" />
    </form>

    <h3>";
        // line 50
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("UserSettings_ColumnOperatingSystem")), "html", null, true);
        echo "</h3>
    <table class=\"dataTable detection\">
        <tr>
            <td>";
        // line 53
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Name")), "html", null, true);
        echo " <small>(<a href=\"javascript:showList('os');\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Mobile_ShowAll")), "html", null, true);
        echo "</a>)</small></td>
            <td><img src=\"";
        // line 54
        echo twig_escape_filter($this->env, (isset($context["os_logo"]) ? $context["os_logo"] : $this->getContext($context, "os_logo")), "html", null, true);
        echo "\" />";
        echo twig_escape_filter($this->env, (isset($context["os_name"]) ? $context["os_name"] : $this->getContext($context, "os_name")), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>";
        // line 57
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Version")), "html", null, true);
        echo "</td>
            <td>";
        // line 58
        echo twig_escape_filter($this->env, (isset($context["os_version"]) ? $context["os_version"] : $this->getContext($context, "os_version")), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>";
        // line 61
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("UserSettings_OperatingSystemFamily")), "html", null, true);
        echo "  <small>(<a href=\"javascript:showList('osfamilies');\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Mobile_ShowAll")), "html", null, true);
        echo "</a>)</small></td>
            <td><img src=\"";
        // line 62
        echo twig_escape_filter($this->env, (isset($context["os_family_logo"]) ? $context["os_family_logo"] : $this->getContext($context, "os_family_logo")), "html", null, true);
        echo "\" />";
        echo twig_escape_filter($this->env, (isset($context["os_family"]) ? $context["os_family"] : $this->getContext($context, "os_family")), "html", null, true);
        echo "</td>
        </tr>
    </table>

    <h3>";
        // line 66
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("UserSettings_ColumnBrowser")), "html", null, true);
        echo "</h3>
    <table class=\"dataTable detection\">
        <tr>
            <td>";
        // line 69
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Name")), "html", null, true);
        echo " <small>(<a href=\"javascript:showList('browsers');\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Mobile_ShowAll")), "html", null, true);
        echo "</a>)</small></td>
            <td><img src=\"";
        // line 70
        echo twig_escape_filter($this->env, (isset($context["browser_logo"]) ? $context["browser_logo"] : $this->getContext($context, "browser_logo")), "html", null, true);
        echo "\" />";
        echo twig_escape_filter($this->env, (isset($context["browser_name"]) ? $context["browser_name"] : $this->getContext($context, "browser_name")), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>";
        // line 73
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CorePluginsAdmin_Version")), "html", null, true);
        echo "</td>
            <td>";
        // line 74
        echo twig_escape_filter($this->env, (isset($context["browser_version"]) ? $context["browser_version"] : $this->getContext($context, "browser_version")), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>";
        // line 77
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("UserSettings_ColumnBrowserFamily")), "html", null, true);
        echo " <small>(<a href=\"javascript:showList('browserfamilies');\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Mobile_ShowAll")), "html", null, true);
        echo "</a>)</small></td>
            <td><img src=\"";
        // line 78
        echo twig_escape_filter($this->env, (isset($context["browser_family_logo"]) ? $context["browser_family_logo"] : $this->getContext($context, "browser_family_logo")), "html", null, true);
        echo "\" />";
        echo twig_escape_filter($this->env, (isset($context["browser_family"]) ? $context["browser_family"] : $this->getContext($context, "browser_family")), "html", null, true);
        echo "</td>
        </tr>
    </table>

    <h3>";
        // line 82
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("DevicesDetection_Device")), "html", null, true);
        echo "</h3>
    <table class=\"dataTable detection\">
        <tr>
            <td>";
        // line 85
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("DevicesDetection_dataTableLabelTypes")), "html", null, true);
        echo " <small>(<a href=\"javascript:showList('devicetypes');\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Mobile_ShowAll")), "html", null, true);
        echo "</a>)</small></td>
            <td><img src=\"";
        // line 86
        echo twig_escape_filter($this->env, (isset($context["device_type_logo"]) ? $context["device_type_logo"] : $this->getContext($context, "device_type_logo")), "html", null, true);
        echo "\" />";
        echo twig_escape_filter($this->env, (isset($context["device_type"]) ? $context["device_type"] : $this->getContext($context, "device_type")), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>";
        // line 89
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("DevicesDetection_dataTableLabelBrands")), "html", null, true);
        echo " <small>(<a href=\"javascript:showList('brands');\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Mobile_ShowAll")), "html", null, true);
        echo "</a>)</small></td>
            <td><img src=\"";
        // line 90
        echo twig_escape_filter($this->env, (isset($context["device_brand_logo"]) ? $context["device_brand_logo"] : $this->getContext($context, "device_brand_logo")), "html", null, true);
        echo "\" />";
        echo twig_escape_filter($this->env, (isset($context["device_brand"]) ? $context["device_brand"] : $this->getContext($context, "device_brand")), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>";
        // line 93
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("DevicesDetection_dataTableLabelModels")), "html", null, true);
        echo "</td>
            <td>";
        // line 94
        echo twig_escape_filter($this->env, (isset($context["device_model"]) ? $context["device_model"] : $this->getContext($context, "device_model")), "html", null, true);
        echo "</td>
        </tr>
    </table>

    <div style=\"display: none;\" class=\"itemList\"></div>

";
    }

    public function getTemplateName()
    {
        return "@DevicesDetection/detection.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  222 => 94,  218 => 93,  210 => 90,  204 => 89,  196 => 86,  190 => 85,  184 => 82,  175 => 78,  169 => 77,  163 => 74,  159 => 73,  151 => 70,  145 => 69,  139 => 66,  130 => 62,  124 => 61,  118 => 58,  114 => 57,  106 => 54,  100 => 53,  94 => 50,  88 => 47,  84 => 46,  80 => 45,  76 => 44,  71 => 42,  31 => 4,  28 => 3,);
    }
}
