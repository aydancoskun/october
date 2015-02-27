<?php

/* @CoreAdminHome/generalSettings.twig */
class __TwigTemplate_398c882feeb91b93ae8a003860574016c5e05c37326e076b1a69c4f1120e0301 extends Twig_Template
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
        // line 5
        $context["piwik"] = $this->env->loadTemplate("macros.twig");
        // line 6
        $context["ajax"] = $this->env->loadTemplate("ajaxMacros.twig");
        // line 7
        echo "
";
        // line 8
        if ((isset($context["isSuperUser"]) ? $context["isSuperUser"] : $this->getContext($context, "isSuperUser"))) {
            // line 9
            echo "    ";
            echo $context["ajax"]->geterrorDiv();
            echo "
    ";
            // line 10
            echo $context["ajax"]->getloadingDiv();
            echo "

    <h2>";
            // line 12
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_ArchivingSettings")), "html", null, true);
            echo "</h2>
    <table class=\"adminTable\" style='width:900px;'>

    ";
            // line 15
            if ((isset($context["isGeneralSettingsAdminEnabled"]) ? $context["isGeneralSettingsAdminEnabled"] : $this->getContext($context, "isGeneralSettingsAdminEnabled"))) {
                // line 16
                echo "        <tr>
            <td style=\"width:400px;\">";
                // line 17
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_AllowPiwikArchivingToTriggerBrowser")), "html", null, true);
                echo "</td>
            <td style=\"width:220px;\">
                <fieldset>
                    <input id=\"enableBrowserTriggerArchiving-yes\" type=\"radio\" value=\"1\" name=\"enableBrowserTriggerArchiving\"";
                // line 20
                if (((isset($context["enableBrowserTriggerArchiving"]) ? $context["enableBrowserTriggerArchiving"] : $this->getContext($context, "enableBrowserTriggerArchiving")) == 1)) {
                    echo " checked=\"checked\"";
                }
                echo " />
                    <label for=\"enableBrowserTriggerArchiving-yes\">";
                // line 21
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Yes")), "html", null, true);
                echo "</label><br/>
                    <span class=\"form-description\">";
                // line 22
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Default")), "html", null, true);
                echo "</span>
                    <br/><br/>

                    <input id=\"enableBrowserTriggerArchiving-no\" type=\"radio\" value=\"0\" name=\"enableBrowserTriggerArchiving\"";
                // line 25
                if (((isset($context["enableBrowserTriggerArchiving"]) ? $context["enableBrowserTriggerArchiving"] : $this->getContext($context, "enableBrowserTriggerArchiving")) == 0)) {
                    echo " checked=\"checked\"";
                }
                echo " />
                    <label for=\"enableBrowserTriggerArchiving-no\">";
                // line 26
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_No")), "html", null, true);
                echo "</label><br/>
                    <span class=\"form-description\">";
                // line 27
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_ArchivingTriggerDescription", "<a href='?module=Proxy&action=redirect&url=http://piwik.org/docs/setup-auto-archiving/' target='_blank'>", "</a>"));
                echo "</span>
                </fieldset>
            <td>
                ";
                // line 30
                ob_start();
                // line 31
                echo "                    ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_ArchivingInlineHelp")), "html", null, true);
                echo "
                    <br/>
                    ";
                // line 33
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_SeeTheOfficialDocumentationForMoreInformation", "<a href='?module=Proxy&action=redirect&url=http://piwik.org/docs/setup-auto-archiving/' target='_blank'>", "</a>"));
                echo "
                ";
                $context["browserArchivingHelp"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                // line 35
                echo "                ";
                echo $context["piwik"]->getinlineHelp((isset($context["browserArchivingHelp"]) ? $context["browserArchivingHelp"] : $this->getContext($context, "browserArchivingHelp")));
                echo "
            </td>
        </tr>
    ";
            } else {
                // line 39
                echo "        <tr>
            <td style=\"width:400px;\">";
                // line 40
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_AllowPiwikArchivingToTriggerBrowser")), "html", null, true);
                echo "</td>
            <td style=\"width:220px;\">
                <input id=\"enableBrowserTriggerArchiving-disabled\" type=\"radio\" checked=\"checked\" disabled=\"disabled\" />
                <label for=\"enableBrowserTriggerArchiving-disabled\">";
                // line 43
                if (((isset($context["enableBrowserTriggerArchiving"]) ? $context["enableBrowserTriggerArchiving"] : $this->getContext($context, "enableBrowserTriggerArchiving")) == 1)) {
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Yes")), "html", null, true);
                } else {
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_No")), "html", null, true);
                }
                echo "</label><br/>
            </td>
        </tr>
    ";
            }
            // line 47
            echo "
    <tr>
        <td width=\"400px\">
            <label for=\"todayArchiveTimeToLive\">
                ";
            // line 51
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_ReportsContainingTodayWillBeProcessedAtMostEvery")), "html", null, true);
            echo "
            </label>
        </td>
        <td>
            ";
            // line 55
            ob_start();
            // line 56
            echo "            <input size='3' value='";
            echo twig_escape_filter($this->env, (isset($context["todayArchiveTimeToLive"]) ? $context["todayArchiveTimeToLive"] : $this->getContext($context, "todayArchiveTimeToLive")), "html", null, true);
            echo "' id='todayArchiveTimeToLive' ";
            if ((!(isset($context["isGeneralSettingsAdminEnabled"]) ? $context["isGeneralSettingsAdminEnabled"] : $this->getContext($context, "isGeneralSettingsAdminEnabled")))) {
                echo "disabled=\"disabled\"";
            }
            echo "/>
            ";
            $context["timeOutInput"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 58
            echo "
            ";
            // line 59
            echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_NSeconds", (isset($context["timeOutInput"]) ? $context["timeOutInput"] : $this->getContext($context, "timeOutInput"))));
            echo "
        </td>

        ";
            // line 62
            if ((isset($context["isGeneralSettingsAdminEnabled"]) ? $context["isGeneralSettingsAdminEnabled"] : $this->getContext($context, "isGeneralSettingsAdminEnabled"))) {
                // line 63
                echo "            <td width='450px'>
                ";
                // line 64
                ob_start();
                // line 65
                echo "                    ";
                if ((isset($context["showWarningCron"]) ? $context["showWarningCron"] : $this->getContext($context, "showWarningCron"))) {
                    // line 66
                    echo "                        <strong>
                            ";
                    // line 67
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_NewReportsWillBeProcessedByCron")), "html", null, true);
                    echo "<br/>
                            ";
                    // line 68
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_ReportsWillBeProcessedAtMostEveryHour")), "html", null, true);
                    echo "
                            ";
                    // line 69
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_IfArchivingIsFastYouCanSetupCronRunMoreOften")), "html", null, true);
                    echo "<br/>
                        </strong>
                    ";
                }
                // line 72
                echo "                    ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_SmallTrafficYouCanLeaveDefault", (isset($context["todayArchiveTimeToLiveDefault"]) ? $context["todayArchiveTimeToLiveDefault"] : $this->getContext($context, "todayArchiveTimeToLiveDefault")))), "html", null, true);
                echo "
                    <br/>
                    ";
                // line 74
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_MediumToHighTrafficItIsRecommendedTo", 1800, 3600)), "html", null, true);
                echo "
                ";
                $context["archiveTodayTTLHelp"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                // line 76
                echo "                ";
                echo $context["piwik"]->getinlineHelp((isset($context["archiveTodayTTLHelp"]) ? $context["archiveTodayTTLHelp"] : $this->getContext($context, "archiveTodayTTLHelp")));
                echo "
            </td>
        ";
            }
            // line 79
            echo "    </tr>

    ";
            // line 81
            if ((isset($context["isGeneralSettingsAdminEnabled"]) ? $context["isGeneralSettingsAdminEnabled"] : $this->getContext($context, "isGeneralSettingsAdminEnabled"))) {
                // line 82
                echo "        <tr>
            <td colspan=\"3\">

                <h2>";
                // line 85
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_UpdateSettings")), "html", null, true);
                echo "</h2>
            </td>
        </tr>
        <tr>
            <td style=\"width:400px;\">";
                // line 89
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_CheckReleaseGetVersion")), "html", null, true);
                echo "</td>
            <td style=\"width:220px;\">
                <fieldset>
                    <input id=\"enableBetaReleaseCheck-0\" type=\"radio\" value=\"0\" name=\"enableBetaReleaseCheck\"";
                // line 92
                if (((isset($context["enableBetaReleaseCheck"]) ? $context["enableBetaReleaseCheck"] : $this->getContext($context, "enableBetaReleaseCheck")) == 0)) {
                    echo " checked=\"checked\"";
                }
                echo " />
                    <label for=\"enableBetaReleaseCheck-0\">";
                // line 93
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_LatestStableRelease")), "html", null, true);
                echo "</label><br/>
                    <span class=\"form-description\">";
                // line 94
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Recommended")), "html", null, true);
                echo "</span>
                    <br/><br/>

                    <input id=\"enableBetaReleaseCheck-1\" type=\"radio\" value=\"1\" name=\"enableBetaReleaseCheck\"";
                // line 97
                if (((isset($context["enableBetaReleaseCheck"]) ? $context["enableBetaReleaseCheck"] : $this->getContext($context, "enableBetaReleaseCheck")) == 1)) {
                    echo " checked=\"checked\"";
                }
                echo " />
                    <label for=\"enableBetaReleaseCheck-1\">";
                // line 98
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_LatestBetaRelease")), "html", null, true);
                echo "</label><br/>
                    <span class=\"form-description\">";
                // line 99
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_ForBetaTestersOnly")), "html", null, true);
                echo "</span>
                </fieldset>
            <td>
                ";
                // line 102
                ob_start();
                // line 103
                echo "                    ";
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_DevelopmentProcess", "<a href='?module=Proxy&action=redirect&url=http://piwik.org/participate/development-process/' target='_blank'>", "</a>"));
                echo "
                    <br/>
                    ";
                // line 105
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_StableReleases", "<a href='?module=Proxy&action=redirect&url=http://piwik.org/participate/user-feedback/' target='_blank'>", "</a>"));
                echo "
                ";
                $context["checkReleaseHelp"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                // line 107
                echo "                ";
                echo $context["piwik"]->getinlineHelp((isset($context["checkReleaseHelp"]) ? $context["checkReleaseHelp"] : $this->getContext($context, "checkReleaseHelp")));
                echo "
            </td>
        </tr>

        ";
                // line 111
                if ((isset($context["canUpdateCommunication"]) ? $context["canUpdateCommunication"] : $this->getContext($context, "canUpdateCommunication"))) {
                    // line 112
                    echo "
            <tr>
                <td style=\"width:400px;\">";
                    // line 114
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_SendPluginUpdateCommunication")), "html", null, true);
                    echo "</td>
                <td style=\"width:220px;\">
                    <fieldset>
                        <input id=\"enablePluginUpdateCommunication-1\" type=\"radio\"
                               name=\"enablePluginUpdateCommunication\" value=\"1\"
                                ";
                    // line 119
                    if (((isset($context["enableSendPluginUpdateCommunication"]) ? $context["enableSendPluginUpdateCommunication"] : $this->getContext($context, "enableSendPluginUpdateCommunication")) == 1)) {
                        echo " checked=\"checked\"";
                    }
                    echo "/>
                        <label for=\"enablePluginUpdateCommunication-1\">";
                    // line 120
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Yes")), "html", null, true);
                    echo "</label>
                        <br />
                        <br />
                        <input class=\"indented-radio-button\" id=\"enablePluginUpdateCommunication-0\" type=\"radio\"
                               name=\"enablePluginUpdateCommunication\" value=\"0\"
                               ";
                    // line 125
                    if (((isset($context["enableSendPluginUpdateCommunication"]) ? $context["enableSendPluginUpdateCommunication"] : $this->getContext($context, "enableSendPluginUpdateCommunication")) == 0)) {
                        echo " checked=\"checked\"";
                    }
                    echo "/>
                        <label for=\"enablePluginUpdateCommunication-0\">";
                    // line 126
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_No")), "html", null, true);
                    echo "</label>
                        <br />
                        <span class=\"form-description\">";
                    // line 128
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Default")), "html", null, true);
                    echo "</span>
                    </fieldset>
                <td>
                    ";
                    // line 131
                    echo $context["piwik"]->getinlineHelp(call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_SendPluginUpdateCommunicationHelp")));
                    echo "
                </td>
            </tr>

        ";
                }
                // line 136
                echo "
    ";
            }
            // line 138
            echo "    </table>

    ";
            // line 140
            if ((isset($context["isGeneralSettingsAdminEnabled"]) ? $context["isGeneralSettingsAdminEnabled"] : $this->getContext($context, "isGeneralSettingsAdminEnabled"))) {
                // line 141
                echo "        <h2>";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_EmailServerSettings")), "html", null, true);
                echo "</h2>
        <div id='emailSettings'>
            <table class=\"adminTable\" style='width:600px;'>
                <tr>
                    <td>";
                // line 145
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_UseSMTPServerForEmail")), "html", null, true);
                echo "<br/>
                        <span class=\"form-description\">";
                // line 146
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_SelectYesIfYouWantToSendEmailsViaServer")), "html", null, true);
                echo "</span>
                    </td>
                    <td style=\"width:200px;\">
                        <input id=\"mailUseSmtp-1\" type=\"radio\" name=\"mailUseSmtp\" value=\"1\" ";
                // line 149
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "transport", array()) == "smtp")) {
                    echo " checked ";
                }
                echo "/>
                        <label for=\"mailUseSmtp-1\">";
                // line 150
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Yes")), "html", null, true);
                echo "</label>
                        <input class=\"indented-radio-button\" id=\"mailUseSmtp-0\" type=\"radio\" name=\"mailUseSmtp\" value=\"0\"
                               ";
                // line 152
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "transport", array()) == "")) {
                    echo " checked ";
                }
                echo "/>
                        <label for=\"mailUseSmtp-0\">";
                // line 153
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_No")), "html", null, true);
                echo "</label>
                    </td>
                </tr>
            </table>
        </div>
        <div id='smtpSettings'>
            <table class=\"adminTable\" style='width:550px;'>
                <tr>
                    <td><label for=\"mailHost\">";
                // line 161
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_SmtpServerAddress")), "html", null, true);
                echo "</label></td>
                    <td style=\"width:200px;\"><input type=\"text\" id=\"mailHost\" value=\"";
                // line 162
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "host", array()), "html", null, true);
                echo "\"></td>
                </tr>
                <tr>
                    <td><label for=\"mailPort\">";
                // line 165
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_SmtpPort")), "html", null, true);
                echo "</label><br/>
                        <span class=\"form-description\">";
                // line 166
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_OptionalSmtpPort")), "html", null, true);
                echo "</span></td>
                    <td><input type=\"text\" id=\"mailPort\" value=\"";
                // line 167
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "port", array()), "html", null, true);
                echo "\"></td>
                </tr>
                <tr>
                    <td><label for=\"mailType\">";
                // line 170
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_AuthenticationMethodSmtp")), "html", null, true);
                echo "</label><br/>
                        <span class=\"form-description\">";
                // line 171
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_OnlyUsedIfUserPwdIsSet")), "html", null, true);
                echo "</span>
                    </td>
                    <td>
                        <select id=\"mailType\">
                            <option value=\"\" ";
                // line 175
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "type", array()) == "")) {
                    echo " selected=\"selected\" ";
                }
                echo "></option>
                            <option id=\"plain\" ";
                // line 176
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "type", array()) == "Plain")) {
                    echo " selected=\"selected\" ";
                }
                echo " value=\"Plain\">Plain</option>
                            <option id=\"login\" ";
                // line 177
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "type", array()) == "Login")) {
                    echo " selected=\"selected\" ";
                }
                echo " value=\"Login\"> Login</option>
                            <option id=\"cram-md5\" ";
                // line 178
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "type", array()) == "Crammd5")) {
                    echo " selected=\"selected\" ";
                }
                echo " value=\"Crammd5\"> Crammd5</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for=\"mailUsername\">";
                // line 183
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_SmtpUsername")), "html", null, true);
                echo "</label><br/>
                        <span class=\"form-description\">";
                // line 184
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_OnlyEnterIfRequired")), "html", null, true);
                echo "</span></td>
                    <td>
                        <input type=\"text\" id=\"mailUsername\" value=\"";
                // line 186
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "username", array()), "html", null, true);
                echo "\"/>
                    </td>
                </tr>
                <tr>
                    <td><label for=\"mailPassword\">";
                // line 190
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_SmtpPassword")), "html", null, true);
                echo "</label><br/>
                    <span class=\"form-description\">";
                // line 191
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_OnlyEnterIfRequiredPassword")), "html", null, true);
                echo "<br/>
                        ";
                // line 192
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_WarningPasswordStored", "<strong>", "</strong>"));
                echo "</span>
                    </td>
                    <td>
                        <input type=\"password\" id=\"mailPassword\" value=\"";
                // line 195
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "password", array()), "html", null, true);
                echo "\"/>
                    </td>
                </tr>
                <tr>
                    <td><label for=\"mailEncryption\">";
                // line 199
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_SmtpEncryption")), "html", null, true);
                echo "</label><br/>
                        <span class=\"form-description\">";
                // line 200
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_EncryptedSmtpTransport")), "html", null, true);
                echo "</span></td>
                    <td>
                        <select id=\"mailEncryption\">
                            <option value=\"\" ";
                // line 203
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "encryption", array()) == "")) {
                    echo " selected=\"selected\" ";
                }
                echo "></option>
                            <option id=\"ssl\" ";
                // line 204
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "encryption", array()) == "ssl")) {
                    echo " selected=\"selected\" ";
                }
                echo " value=\"ssl\">SSL</option>
                            <option id=\"tls\" ";
                // line 205
                if (($this->getAttribute((isset($context["mail"]) ? $context["mail"] : $this->getContext($context, "mail")), "encryption", array()) == "tls")) {
                    echo " selected=\"selected\" ";
                }
                echo " value=\"tls\">TLS</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    ";
            }
            // line 212
            echo "
    <h2>";
            // line 213
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_BrandingSettings")), "html", null, true);
            echo "</h2>
    <div id='brandSettings'>
        ";
            // line 215
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_CustomLogoHelpText")), "html", null, true);
            echo "
        <table class=\"adminTable\" style=\"width:900px;\">
            <tr>
                <td style=\"width:200px;\">";
            // line 218
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_UseCustomLogo")), "html", null, true);
            echo "</td>
                <td style=\"width:200px;\">
                    <input id=\"useCustomLogo-1\" type=\"radio\" name=\"useCustomLogo\" value=\"1\" ";
            // line 220
            if (($this->getAttribute((isset($context["branding"]) ? $context["branding"] : $this->getContext($context, "branding")), "use_custom_logo", array()) == 1)) {
                echo " checked ";
            }
            echo "/>
                    <label for=\"useCustomLogo-1\">";
            // line 221
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Yes")), "html", null, true);
            echo "</label>
                    <input class=\"indented-radio-button\" id=\"useCustomLogo-0\" type=\"radio\" name=\"useCustomLogo\" value=\"0\" ";
            // line 222
            if (($this->getAttribute((isset($context["branding"]) ? $context["branding"] : $this->getContext($context, "branding")), "use_custom_logo", array()) == 0)) {
                echo " checked ";
            }
            echo " />
                    <label for=\"useCustomLogo-0\" class>";
            // line 223
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_No")), "html", null, true);
            echo "</label>
                </td>
                <td id=\"inlineHelpCustomLogo\">
                    ";
            // line 226
            ob_start();
            echo "\"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_GiveUsYourFeedback")), "html", null, true);
            echo "\"";
            $context["giveUsFeedbackText"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 227
            echo "                    ";
            ob_start();
            // line 228
            echo "                    ";
            echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_CustomLogoFeedbackInfo", (isset($context["giveUsFeedbackText"]) ? $context["giveUsFeedbackText"] : $this->getContext($context, "giveUsFeedbackText")), "<a href='?module=CorePluginsAdmin&action=plugins' target='_blank'>", "</a>"));
            echo "
                    ";
            $context["customLogoHelp"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 230
            echo "                    ";
            echo $context["piwik"]->getinlineHelp((isset($context["customLogoHelp"]) ? $context["customLogoHelp"] : $this->getContext($context, "customLogoHelp")));
            echo "
                </td>
            </tr>
        </table>
    </div>
    <div id='logoSettings'>
        <form id=\"logoUploadForm\" method=\"post\" enctype=\"multipart/form-data\" action=\"index.php?module=CoreAdminHome&format=json&action=uploadCustomLogo\">
            <table class=\"adminTable\" style='width:550px;'>
                ";
            // line 238
            if ((isset($context["fileUploadEnabled"]) ? $context["fileUploadEnabled"] : $this->getContext($context, "fileUploadEnabled"))) {
                // line 239
                echo "                    ";
                if ((isset($context["logosWriteable"]) ? $context["logosWriteable"] : $this->getContext($context, "logosWriteable"))) {
                    // line 240
                    echo "                        <tr>
                            <td>
                                <label for=\"customLogo\">";
                    // line 242
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_LogoUpload")), "html", null, true);
                    echo ":<br/>
                                    <span class=\"form-description\">";
                    // line 243
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_LogoUploadHelp", "JPG / PNG / GIF", 110)), "html", null, true);
                    echo "</span>
                                </label>
                            </td>
                            <td style=\"width:200px;\">
                                <input name=\"customLogo\" type=\"file\" id=\"customLogo\"/>
                                <img src=\"";
                    // line 248
                    echo twig_escape_filter($this->env, (isset($context["pathUserLogo"]) ? $context["pathUserLogo"] : $this->getContext($context, "pathUserLogo")), "html", null, true);
                    echo "?r=";
                    echo twig_escape_filter($this->env, twig_random($this->env), "html", null, true);
                    echo "\" id=\"currentLogo\" height=\"150\"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for=\"customLogo\">";
                    // line 253
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_FaviconUpload")), "html", null, true);
                    echo ":<br/>
                                    <span class=\"form-description\">";
                    // line 254
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_LogoUploadHelp", "JPG / PNG / GIF", 16)), "html", null, true);
                    echo "</span>
                                </label>
                            </td>
                            <td style=\"width:200px;\">
                                <input name=\"customFavicon\" type=\"file\" id=\"customFavicon\"/>
                                <img src=\"";
                    // line 259
                    echo twig_escape_filter($this->env, (isset($context["pathUserFavicon"]) ? $context["pathUserFavicon"] : $this->getContext($context, "pathUserFavicon")), "html", null, true);
                    echo "?r=";
                    echo twig_escape_filter($this->env, twig_random($this->env), "html", null, true);
                    echo "\" id=\"currentFavicon\" width=\"16\" height=\"16\"/>
                            </td>
                        </tr>
                    ";
                } else {
                    // line 263
                    echo "                        <tr>
                            <td>
                                <div style=\"display:inline-block;margin-top:10px;\" id=\"CoreAdminHome_LogoNotWriteable\">
                                    ";
                    // line 266
                    echo call_user_func_array($this->env->getFilter('notification')->getCallable(), array(call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_LogoNotWriteableInstruction", (("<strong>" . (isset($context["pathUserLogoDirectory"]) ? $context["pathUserLogoDirectory"] : $this->getContext($context, "pathUserLogoDirectory"))) . "</strong><br/>"), ((((((isset($context["pathUserLogo"]) ? $context["pathUserLogo"] : $this->getContext($context, "pathUserLogo")) . ", ") . (isset($context["pathUserLogoSmall"]) ? $context["pathUserLogoSmall"] : $this->getContext($context, "pathUserLogoSmall"))) . ", ") . (isset($context["pathUserLogoSVG"]) ? $context["pathUserLogoSVG"] : $this->getContext($context, "pathUserLogoSVG"))) . ""))), array("placeAt" => "#CoreAdminHome_LogoNotWriteable", "noclear" => true, "context" => "warning", "raw" => true)));
                    // line 268
                    echo "

                                </div>
                            </td>
                        </tr>
                    ";
                }
                // line 274
                echo "                ";
            } else {
                // line 275
                echo "                    <tr>
                        <td>
                            <div style=\"display:inline-block;margin-top:10px;\" id=\"CoreAdminHome_FileUploadDisabled\">
                                ";
                // line 278
                echo call_user_func_array($this->env->getFilter('notification')->getCallable(), array(call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_FileUploadDisabled", "file_uploads=1")), array("placeAt" => "#CoreAdminHome_FileUploadDisabled", "noclear" => true, "context" => "warning", "raw" => true)));
                // line 280
                echo "

                            </div>
                        </td>
                    </tr>

                ";
            }
            // line 287
            echo "            </table>
        </form>
    </div>

    <div class=\"ui-confirm\" id=\"confirmTrustedHostChange\">
        <h2>";
            // line 292
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_TrustedHostConfirm")), "html", null, true);
            echo "</h2>
        <input role=\"yes\" type=\"button\" value=\"";
            // line 293
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Yes")), "html", null, true);
            echo "\"/>
        <input role=\"no\" type=\"button\" value=\"";
            // line 294
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_No")), "html", null, true);
            echo "\"/>
    </div>
    <h2 id=\"trustedHostsSection\">";
            // line 296
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_TrustedHostSettings")), "html", null, true);
            echo "</h2>
    <div id='trustedHostSettings'>

        ";
            // line 299
            $this->env->loadTemplate("@CoreHome/_warningInvalidHost.twig")->display($context);
            // line 300
            echo "
        ";
            // line 301
            if ((!(isset($context["isGeneralSettingsAdminEnabled"]) ? $context["isGeneralSettingsAdminEnabled"] : $this->getContext($context, "isGeneralSettingsAdminEnabled")))) {
                // line 302
                echo "            ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_PiwikIsInstalledAt")), "html", null, true);
                echo ": ";
                echo twig_escape_filter($this->env, twig_join_filter((isset($context["trustedHosts"]) ? $context["trustedHosts"] : $this->getContext($context, "trustedHosts")), ", "), "html", null, true);
                echo "
        ";
            } else {
                // line 304
                echo "            <p>";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_PiwikIsInstalledAt")), "html", null, true);
                echo ":</p>
            <strong>";
                // line 305
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_ValidPiwikHostname")), "html", null, true);
                echo "</strong>
            <ul>
                ";
                // line 307
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["trustedHosts"]) ? $context["trustedHosts"] : $this->getContext($context, "trustedHosts")));
                foreach ($context['_seq'] as $context["hostIdx"] => $context["host"]) {
                    // line 308
                    echo "                    <li>
                        <input name=\"trusted_host\" type=\"text\" value=\"";
                    // line 309
                    echo twig_escape_filter($this->env, $context["host"], "html", null, true);
                    echo "\"/>
                        <a href=\"#\" class=\"remove-trusted-host\" title=\"";
                    // line 310
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Delete")), "html", null, true);
                    echo "\">
                            <img alt=\"";
                    // line 311
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Delete")), "html", null, true);
                    echo "\" src=\"plugins/Morpheus/images/ico_delete.png\" />
                        </a>
                    </li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['hostIdx'], $context['host'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 315
                echo "            </ul>
            <div class=\"add-trusted-host-container\">
                <a href=\"#\" class=\"add-trusted-host\"><em>";
                // line 317
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Add")), "html", null, true);
                echo "</em></a>
            </div>
        ";
            }
            // line 320
            echo "    </div>

    <input type=\"submit\" value=\"";
            // line 322
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Save")), "html", null, true);
            echo "\" id=\"generalSettingsSubmit\" class=\"submit\"/>
    <br/>
    <br/>

    ";
            // line 326
            if ((isset($context["isDataPurgeSettingsEnabled"]) ? $context["isDataPurgeSettingsEnabled"] : $this->getContext($context, "isDataPurgeSettingsEnabled"))) {
                // line 327
                echo "    ";
                ob_start();
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("PrivacyManager_DeleteDataSettings")), "html", null, true);
                $context["clickDeleteLogSettings"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                // line 328
                echo "    <h2>";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("PrivacyManager_DeleteDataSettings")), "html", null, true);
                echo "</h2>
    <p>
        ";
                // line 330
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("PrivacyManager_DeleteDataDescription")), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("PrivacyManager_DeleteDataDescription2")), "html", null, true);
                echo "
        <br/>
        <a href='";
                // line 332
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('linkTo')->getCallable(), array(array("module" => "PrivacyManager", "action" => "privacySettings"))), "html", null, true);
                echo "#deleteLogsAnchor'>
            ";
                // line 333
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("PrivacyManager_ClickHereSettings", (("'" . (isset($context["clickDeleteLogSettings"]) ? $context["clickDeleteLogSettings"] : $this->getContext($context, "clickDeleteLogSettings"))) . "'"))), "html", null, true);
                echo "
        </a>
    </p>
    ";
            }
        }
        // line 338
        echo "<h2>";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_OptOutForYourVisitors")), "html", null, true);
        echo "</h2>

<p>";
        // line 340
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_OptOutExplanation")), "html", null, true);
        echo "
    ";
        // line 341
        ob_start();
        echo twig_escape_filter($this->env, (isset($context["piwikUrl"]) ? $context["piwikUrl"] : $this->getContext($context, "piwikUrl")), "html", null, true);
        echo "index.php?module=CoreAdminHome&action=optOut&language=";
        echo twig_escape_filter($this->env, (isset($context["language"]) ? $context["language"] : $this->getContext($context, "language")), "html", null, true);
        $context["optOutUrl"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 342
        echo "    ";
        ob_start();
        // line 343
        echo "        <iframe style=\"border: 0; height: 200px; width: 600px;\" src=\"";
        echo twig_escape_filter($this->env, (isset($context["optOutUrl"]) ? $context["optOutUrl"] : $this->getContext($context, "optOutUrl")), "html", null, true);
        echo "\"></iframe>
    ";
        $context["iframeOptOut"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 345
        echo "    <code>";
        echo twig_escape_filter($this->env, (isset($context["iframeOptOut"]) ? $context["iframeOptOut"] : $this->getContext($context, "iframeOptOut")));
        echo "</code>
    <br/>
    ";
        // line 347
        echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("CoreAdminHome_OptOutExplanationBis", (("<a href='" . (isset($context["optOutUrl"]) ? $context["optOutUrl"] : $this->getContext($context, "optOutUrl"))) . "' target='_blank'>"), "</a>"));
        echo "
</p>

";
    }

    public function getTemplateName()
    {
        return "@CoreAdminHome/generalSettings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  853 => 347,  847 => 345,  841 => 343,  838 => 342,  832 => 341,  828 => 340,  822 => 338,  814 => 333,  810 => 332,  803 => 330,  797 => 328,  792 => 327,  790 => 326,  783 => 322,  779 => 320,  773 => 317,  769 => 315,  759 => 311,  755 => 310,  751 => 309,  748 => 308,  744 => 307,  739 => 305,  734 => 304,  726 => 302,  724 => 301,  721 => 300,  719 => 299,  713 => 296,  708 => 294,  704 => 293,  700 => 292,  693 => 287,  684 => 280,  682 => 278,  677 => 275,  674 => 274,  666 => 268,  664 => 266,  659 => 263,  650 => 259,  642 => 254,  638 => 253,  628 => 248,  620 => 243,  616 => 242,  612 => 240,  609 => 239,  607 => 238,  595 => 230,  589 => 228,  586 => 227,  580 => 226,  574 => 223,  568 => 222,  564 => 221,  558 => 220,  553 => 218,  547 => 215,  542 => 213,  539 => 212,  527 => 205,  521 => 204,  515 => 203,  509 => 200,  505 => 199,  498 => 195,  492 => 192,  488 => 191,  484 => 190,  477 => 186,  472 => 184,  468 => 183,  458 => 178,  452 => 177,  446 => 176,  440 => 175,  433 => 171,  429 => 170,  423 => 167,  419 => 166,  415 => 165,  409 => 162,  405 => 161,  394 => 153,  388 => 152,  383 => 150,  377 => 149,  371 => 146,  367 => 145,  359 => 141,  357 => 140,  353 => 138,  349 => 136,  341 => 131,  335 => 128,  330 => 126,  324 => 125,  316 => 120,  310 => 119,  302 => 114,  298 => 112,  296 => 111,  288 => 107,  283 => 105,  277 => 103,  275 => 102,  269 => 99,  265 => 98,  259 => 97,  253 => 94,  249 => 93,  243 => 92,  237 => 89,  230 => 85,  225 => 82,  223 => 81,  219 => 79,  212 => 76,  207 => 74,  201 => 72,  195 => 69,  191 => 68,  187 => 67,  184 => 66,  181 => 65,  179 => 64,  176 => 63,  174 => 62,  168 => 59,  165 => 58,  155 => 56,  153 => 55,  146 => 51,  140 => 47,  129 => 43,  123 => 40,  120 => 39,  112 => 35,  107 => 33,  101 => 31,  99 => 30,  93 => 27,  89 => 26,  83 => 25,  77 => 22,  73 => 21,  67 => 20,  61 => 17,  58 => 16,  56 => 15,  50 => 12,  45 => 10,  40 => 9,  38 => 8,  35 => 7,  33 => 6,  31 => 5,  28 => 3,);
    }
}
