
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="noindex, nofollow" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <link rel="icon" type="image/png" href="/pimcore/static6/img/favicon/favicon-32x32.png" />

    <title>pimcore-coreshop :: pimcore</title>
</head>

<body>

<script type="text/javascript">
    var pimcore = {}; // namespace
</script>

<div id="page">
    <div id="settings_form" class="exForm"></div>


</div>


<!-- stylesheets -->
<style type="text/css">
    @import url(/admin/misc/admin-css?extjs6=true?_dc=3708);
    @import url(/pimcore/static6/css/icons.css?_dc=3708);
    @import url(/pimcore/static6/js/lib/ext/classic/theme-triton/resources/theme-triton-all.css?_dc=3708);
    @import url(/pimcore/static6/js/lib/ext/classic/theme-triton/resources/charts-all.css?_dc=3708);
    @import url(/pimcore/static6/css/admin.css?_dc=3708);
</style>


<!-- some javascript -->
<script type="text/javascript">
    pimcore.settings = {
        upload_max_filesize: 2097152,
        sessionId: "1ctk1durqdgsflcalvpd2j0q92",
        csrfToken: "b5d251e5e7f44773a6390fcb21d5099e6a9268ea",
        version: "4.0.0-RC2",
        build: "3708",
        maintenance_active: true,
        maintenance_mode: false,
        mail: true,
        debug: true,
        devmode: false,
        google_analytics_enabled: false,
        google_webmastertools_enabled: false,
        customviews: [],
        language: 'en',
        websiteLanguages: ["en"],
        google_maps_api_key: "",
        showCloseConfirmation: true,
        debug_admin_translations: false,
        document_generatepreviews: true,
        htmltoimage: true,
        videoconverter: false,
        asset_hide_edit: false    };
</script>

<script type="text/javascript" src="/admin/misc/json-translations-system/language/en/?_dc=3708"></script>
<script type="text/javascript" src="/admin/misc/json-translations-admin/language/en/?_dc=3708"></script>
<script type="text/javascript" src="/admin/user/get-current-user/?_dc=3708"></script>
<script type="text/javascript" src="/admin/misc/available-languages?_dc=3708"></script>


<!-- library scripts -->
<script type="text/javascript" src="/pimcore/static6/js/lib/prototype-light.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/jquery.min.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ext/ext-all.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ext/classic/theme-triton/theme-triton.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ext/packages/charts/classic/charts.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ext-plugins/portlet/PortalDropZone.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ext-plugins/portlet/Portlet.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ext-plugins/portlet/PortalColumn.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ext-plugins/portlet/PortalPanel.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ckeditor/ckeditor.js?_dc=3708"></script>
<script type="text/javascript" src="/pimcore/static6/js/lib/ext/classic/locale/locale-en.js?_dc=3708"></script>


<!-- internal scripts -->

<script type="text/javascript" src="/website/var/tmp/minified_javascript_core_f5757da9fa29d5bf13e6aa5058eff9f7.js?_dc=3708"></script>

<script type="text/javascript" src="/plugins/Formbuilder/static/js/plugin.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/settings.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/apiwindow.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/importer.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/elem.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/base.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/displayGroup.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/button.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/captcha.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/checkbox.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/file.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/hash.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/hidden.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/multiCheckbox.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/multiselect.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/password.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/radio.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/reset.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/select.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/submit.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/image.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/text.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/type/textarea.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/base.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/alnum.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/alpha.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/baseName.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/boolean.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/callback.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/digits.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/dir.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/htmlEntities.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/int.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/pregReplace.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/stringToLower.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/stringToUpper.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/stringTrim.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/stripNewlines.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/filter/stripTags.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/base.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/alnum.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/alpha.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/between.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/callback.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/creditCard.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/date.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/digits.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/emailAddress.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/extension.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/float.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/greaterThan.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/hex.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/hostname.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/iban.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/identical.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/inArray.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/int.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/ip.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/isbn.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/lessThan.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/postCode.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/regex.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/comp/validator/stringLength.js?_dc=1459268461"></script>
<script type="text/javascript" src="/plugins/Formbuilder/static/js/composite/SuperBoxSelectSpe.js?_dc=1459268461"></script>
<link rel="stylesheet" type="text/css" href="/plugins/Formbuilder/static/css/admin.css?_dc=1459268461"/>

<script>

    var dings = new pimcore.plugin.Formbuilder();
    dings.getLanguages();

    var gestion = new Formbuilder.settings;
</script>
</body>
</html>
