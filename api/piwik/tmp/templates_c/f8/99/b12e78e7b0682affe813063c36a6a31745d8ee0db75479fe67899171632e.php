<?php

/* @MobileMessaging/index.twig */
class __TwigTemplate_f899b12e78e7b0682affe813063c36a6a31745d8ee0db75479fe67899171632e extends Twig_Template
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
        echo "    ";
        if ((isset($context["accountManagedByCurrentUser"]) ? $context["accountManagedByCurrentUser"] : $this->getContext($context, "accountManagedByCurrentUser"))) {
            // line 5
            echo "        <h2 piwik-enriched-headline
            feature-name=\"";
            // line 6
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_SettingsMenu")), "html", null, true);
            echo "\"
                >";
            // line 7
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_SMSAPIAccount")), "html", null, true);
            echo "</h2>
        ";
            // line 8
            if ((isset($context["credentialSupplied"]) ? $context["credentialSupplied"] : $this->getContext($context, "credentialSupplied"))) {
                // line 9
                echo "            ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_CredentialProvided", (isset($context["provider"]) ? $context["provider"] : $this->getContext($context, "provider")))), "html", null, true);
                echo "
            ";
                // line 10
                echo twig_escape_filter($this->env, (isset($context["creditLeft"]) ? $context["creditLeft"] : $this->getContext($context, "creditLeft")), "html", null, true);
                echo "
            <br/>
            ";
                // line 12
                echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_UpdateOrDeleteAccount", "<a id='displayAccountForm'>", "</a>", "<a id='deleteAccount'>", "</a>"));
                echo "
        ";
            } else {
                // line 14
                echo "            ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_PleaseSignUp")), "html", null, true);
                echo "
        ";
            }
            // line 16
            echo "        <div id='accountForm' ";
            if ((isset($context["credentialSupplied"]) ? $context["credentialSupplied"] : $this->getContext($context, "credentialSupplied"))) {
                echo "style='display: none;'";
            }
            echo ">
            <br/>
            ";
            // line 18
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_SMSProvider")), "html", null, true);
            echo "
            <select id='smsProviders'>
                ";
            // line 20
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["smsProviders"]) ? $context["smsProviders"] : $this->getContext($context, "smsProviders")));
            foreach ($context['_seq'] as $context["smsProvider"] => $context["description"]) {
                // line 21
                echo "                    <option value='";
                echo twig_escape_filter($this->env, $context["smsProvider"], "html", null, true);
                echo "'>
                        ";
                // line 22
                echo twig_escape_filter($this->env, $context["smsProvider"], "html", null, true);
                echo "
                    </option>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['smsProvider'], $context['description'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "            </select>

            ";
            // line 27
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_APIKey")), "html", null, true);
            echo "
            <input size='25' id='apiKey'/>

            <input type='submit' value='";
            // line 30
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Save")), "html", null, true);
            echo "' id='apiAccountSubmit' class='submit'/>

            ";
            // line 32
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["smsProviders"]) ? $context["smsProviders"] : $this->getContext($context, "smsProviders")));
            foreach ($context['_seq'] as $context["smsProvider"] => $context["description"]) {
                // line 33
                echo "                <div class='providerDescription' id='";
                echo twig_escape_filter($this->env, $context["smsProvider"], "html", null, true);
                echo "'>
                    ";
                // line 34
                echo $context["description"];
                echo "
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['smsProvider'], $context['description'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "
        </div>
    ";
        }
        // line 40
        echo "
    ";
        // line 41
        $context["ajax"] = $this->env->loadTemplate("ajaxMacros.twig");
        // line 42
        echo "
    <div style=\"margin-top:10px\">
        ";
        // line 44
        echo $context["ajax"]->geterrorDiv("ajaxErrorMobileMessagingSettings");
        echo "
    </div>

    <h2>";
        // line 47
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_PhoneNumbers")), "html", null, true);
        echo "</h2>
    ";
        // line 48
        if ((!(isset($context["credentialSupplied"]) ? $context["credentialSupplied"] : $this->getContext($context, "credentialSupplied")))) {
            // line 49
            echo "        ";
            if ((isset($context["accountManagedByCurrentUser"]) ? $context["accountManagedByCurrentUser"] : $this->getContext($context, "accountManagedByCurrentUser"))) {
                // line 50
                echo "            ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_CredentialNotProvided")), "html", null, true);
                echo "
        ";
            } else {
                // line 52
                echo "            ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_CredentialNotProvidedByAdmin")), "html", null, true);
                echo "
        ";
            }
            // line 54
            echo "    ";
        } else {
            // line 55
            echo "        ";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_PhoneNumbers_Help")), "html", null, true);
            echo "
        <br/>
        <br/>
        <table style=\"width:900px;\" class=\"adminTable\">
            <tbody>
            <tr>
                <td style=\"width:480px;\">
                    <strong>";
            // line 62
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_PhoneNumbers_Add")), "html", null, true);
            echo "</strong>
                    <br/><br/>

                <span id=\"suspiciousPhoneNumber\" style=\"display:none;\">
                    ";
            // line 66
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_SuspiciousPhoneNumber", "54184032")), "html", null, true);
            echo "
                    <br/><br/>
                </span>

                + <input id=\"countryCallingCode\" size=\"4\" maxlength=\"4\"/>&nbsp;
                <input id=\"newPhoneNumber\"/>
                <input type=\"submit\" value='";
            // line 72
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Add")), "html", null, true);
            echo "'
                       id=\"addPhoneNumberSubmit\"/>
                <br/>

\t\t<span style=' font-size: 11px;'><span
                    class=\"form-description\">";
            // line 77
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_CountryCode")), "html", null, true);
            echo "</span>
\t\t\t<span class=\"form-description\"
                  style=\"margin-left:50px;\">";
            // line 79
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_PhoneNumber")), "html", null, true);
            echo "</span></span>
                    <br/><br/>

                    ";
            // line 82
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_PhoneNumbers_CountryCode_Help")), "html", null, true);
            echo "

                    <select id=\"countries\">
                        ";
            // line 86
            echo "                        <option value=\"\">&nbsp;</option>
                        ";
            // line 87
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["countries"]) ? $context["countries"] : $this->getContext($context, "countries")));
            foreach ($context['_seq'] as $context["countryCode"] => $context["country"]) {
                // line 88
                echo "                            <option value='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["country"], "countryCallingCode", array()), "html", null, true);
                echo "'
                                    ";
                // line 89
                if (((isset($context["defaultCountry"]) ? $context["defaultCountry"] : $this->getContext($context, "defaultCountry")) == $context["countryCode"])) {
                    echo " selected=\"selected\" ";
                }
                // line 90
                echo "                                    >
                                ";
                // line 91
                echo twig_escape_filter($this->env, $this->getAttribute($context["country"], "countryName", array()), "html", null, true);
                echo "
                            </option>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['countryCode'], $context['country'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 94
            echo "                    </select>

                </td>
                <td style=\"width:220px;\">
                    ";
            // line 98
            $context["piwik"] = $this->env->loadTemplate("macros.twig");
            // line 99
            echo "                    ";
            echo $context["piwik"]->getinlineHelp((isset($context["strHelpAddPhone"]) ? $context["strHelpAddPhone"] : $this->getContext($context, "strHelpAddPhone")));
            echo "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\">

                    ";
            // line 105
            if ((twig_length_filter($this->env, (isset($context["phoneNumbers"]) ? $context["phoneNumbers"] : $this->getContext($context, "phoneNumbers"))) > 0)) {
                // line 106
                echo "                        <br/>
                        <br/>
                        <strong>";
                // line 108
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_ManagePhoneNumbers")), "html", null, true);
                echo "</strong>
                        <br/>
                        <br/>
                    ";
            }
            // line 112
            echo "
                    ";
            // line 113
            echo $context["ajax"]->geterrorDiv("invalidVerificationCodeAjaxError");
            echo "

                    <div id='phoneNumberActivated' style=\"display:none;\">
                        ";
            // line 116
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_PhoneActivated")), "html", null, true);
            echo "
                    </div>

                    <div id='invalidActivationCode' style=\"display:none;\">
                        ";
            // line 120
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_InvalidActivationCode")), "html", null, true);
            echo "
                    </div>

                    <ul>
                        ";
            // line 124
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["phoneNumbers"]) ? $context["phoneNumbers"] : $this->getContext($context, "phoneNumbers")));
            foreach ($context['_seq'] as $context["phoneNumber"] => $context["validated"]) {
                // line 125
                echo "                            <li>
                                <span class='phoneNumber'>";
                // line 126
                echo twig_escape_filter($this->env, $context["phoneNumber"], "html", null, true);
                echo "</span>
                                ";
                // line 127
                if ((!$context["validated"])) {
                    // line 128
                    echo "                                    <input class='verificationCode'/>
                                    <input
                                            type='submit'
                                            value='";
                    // line 131
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_ValidatePhoneNumber")), "html", null, true);
                    echo "'
                                            class='validatePhoneNumberSubmit'
                                            />
                                ";
                }
                // line 135
                echo "                                <input
                                        type='submit'
                                        value='";
                // line 137
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Remove")), "html", null, true);
                echo "'
                                        class='removePhoneNumberSubmit'
                                        />
                                ";
                // line 140
                if ((!$context["validated"])) {
                    // line 141
                    echo "                                    <br/>
                                    <span class='form-description'>";
                    // line 142
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_VerificationCodeJustSent")), "html", null, true);
                    echo "</span>
                                ";
                }
                // line 144
                echo "                                <br/>
                                <br/>
                            </li>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['phoneNumber'], $context['validated'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 148
            echo "                    </ul>

                </td>
            </tr>
            </tbody>
        </table>
    ";
        }
        // line 155
        echo "
    ";
        // line 156
        if ((isset($context["isSuperUser"]) ? $context["isSuperUser"] : $this->getContext($context, "isSuperUser"))) {
            // line 157
            echo "        <h2>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_SuperAdmin")), "html", null, true);
            echo "</h2>
        <table class='adminTable' style='width:650px;'>
            <tr>
                <td style=\"width:400px;\">";
            // line 160
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_LetUsersManageAPICredential")), "html", null, true);
            echo "</td>
                <td style=\"width:250px;\">
                    <fieldset>
                        <input  type='radio'
                                value='false'
                                name='delegatedManagement' ";
            // line 165
            if ((!(isset($context["delegatedManagement"]) ? $context["delegatedManagement"] : $this->getContext($context, "delegatedManagement")))) {
                echo " checked='checked'";
            }
            // line 166
            echo "                                id=\"delegatedManagement\" />
                        <label for=\"delegatedManagement\">";
            // line 167
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_No")), "html", null, true);
            echo "</label><br/>
                        <span class='form-description'>
                            (";
            // line 169
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Default")), "html", null, true);
            echo ") ";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_LetUsersManageAPICredential_No_Help")), "html", null, true);
            echo "
                        </span>
                        <br/>
                        <br/>
                        <input
                                type='radio'
                                value='true'
                                name='delegatedManagement' ";
            // line 176
            if ((isset($context["delegatedManagement"]) ? $context["delegatedManagement"] : $this->getContext($context, "delegatedManagement"))) {
                echo " checked='checked'";
            }
            // line 177
            echo "                                id=\"delegatedManagement\" />
                        <label for=\"delegatedManagement\">";
            // line 178
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Yes")), "html", null, true);
            echo "</label><br/>
                        <span class='form-description'>";
            // line 179
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_LetUsersManageAPICredential_Yes_Help")), "html", null, true);
            echo "</span>

                    </fieldset>
            </tr>
        </table>
    ";
        }
        // line 185
        echo "
    ";
        // line 186
        echo $context["ajax"]->getloadingDiv("ajaxLoadingMobileMessagingSettings");
        echo "

    <div class='ui-confirm' id='confirmDeleteAccount'>
        <h2>";
        // line 189
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("MobileMessaging_Settings_DeleteAccountConfirm")), "html", null, true);
        echo "</h2>
        <input role='yes' type='button' value='";
        // line 190
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Yes")), "html", null, true);
        echo "'/>
        <input role='no' type='button' value='";
        // line 191
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_No")), "html", null, true);
        echo "'/>
    </div>

";
    }

    public function getTemplateName()
    {
        return "@MobileMessaging/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  454 => 191,  450 => 190,  446 => 189,  440 => 186,  437 => 185,  428 => 179,  424 => 178,  421 => 177,  417 => 176,  405 => 169,  400 => 167,  397 => 166,  393 => 165,  385 => 160,  378 => 157,  376 => 156,  373 => 155,  364 => 148,  355 => 144,  350 => 142,  347 => 141,  345 => 140,  339 => 137,  335 => 135,  328 => 131,  323 => 128,  321 => 127,  317 => 126,  314 => 125,  310 => 124,  303 => 120,  296 => 116,  290 => 113,  287 => 112,  280 => 108,  276 => 106,  274 => 105,  264 => 99,  262 => 98,  256 => 94,  247 => 91,  244 => 90,  240 => 89,  235 => 88,  231 => 87,  228 => 86,  222 => 82,  216 => 79,  211 => 77,  203 => 72,  194 => 66,  187 => 62,  176 => 55,  173 => 54,  167 => 52,  161 => 50,  158 => 49,  156 => 48,  152 => 47,  146 => 44,  142 => 42,  140 => 41,  137 => 40,  132 => 37,  123 => 34,  118 => 33,  114 => 32,  109 => 30,  103 => 27,  99 => 25,  90 => 22,  85 => 21,  81 => 20,  76 => 18,  68 => 16,  62 => 14,  57 => 12,  52 => 10,  47 => 9,  45 => 8,  41 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
