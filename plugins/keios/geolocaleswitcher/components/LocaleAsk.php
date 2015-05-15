<?php namespace Keios\Geolocaleswitcher\Components;

use RainLab\Translate\Models\Locale as LocaleModel;
use RainLab\Translate\Classes\Translator;
use RainLab\Translate\Models\Locale;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use App;
use Session;

class LocaleAsk extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'keios.geolocaleswitcher::lang.localecomponent.title', //GeoLocaleSwitcher
            'description' => 'keios.geolocaleswitcher::lang.localecomponent.description' //Displays locale switcher with current geoIP country
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function getLocaleChangePageOptions()
    {
        return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'url');
    }

    public function localeChangePage()
    {
        $localeChangePage = $this->property('localeChangePage');
        return ($localeChangePage ?: null);
    }

    public function detectedCountry()
    {
        $geoIP = App::make('geoip');
        $location = $geoIP->getLocation();
        return $location['country'];
    }

    public function currentLocale()
    {
        $currentLocale = Translator::instance()->getLocale();
        $allAvailableLocale = Locale::listAvailable();
        return $allAvailableLocale[$currentLocale];
    }

    public function displayedLocales()
    {
        $availableLocales = LocaleModel::listAvailable();
        //var_dump($availableLocales);
        $localeAll = Session::get('geolocaleswitcher.localeArray');
        $availableLocaleIds = [];
        $displayedLocales = [];
        foreach ($availableLocales as $localeId=>$locale)
        {
               array_push($availableLocaleIds,$localeId);
        }
        foreach ($localeAll as $locale) {
            foreach ($locale as $singleLocale) {
                if (in_array($singleLocale, $availableLocaleIds))
                {
                    $localeName = $availableLocales[$singleLocale];
                    array_push($displayedLocales, [$singleLocale => $localeName]);
                }
            }
        }
        //return array_slice($displayedLocales, 0, count($displayedLocales) / 2);
        if (is_array($displayedLocales)) {
            return $displayedLocales;
        }
        else
        {
            return [$displayedLocales => $displayedLocales];
        }
    }

}