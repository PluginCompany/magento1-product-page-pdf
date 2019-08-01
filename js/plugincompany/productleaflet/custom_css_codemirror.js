
function initCEditor(emID, mode, width, height)
{
    var cEditor = CodeMirror.fromTextArea(document.getElementById(emID), {
        lineNumbers: true,
        styleActiveLine: true,
        lineWrapping: true,
        matchBrackets: true,
        mode: mode
    });
    cEditor.setSize(width, height);
}
document.addEventListener('DOMContentLoaded', function() {
    initCEditor('plugincompany_productleaflet_custom_css_css', 'css', 600, 400);
    initCEditor('plugincompany_productleaflet_frontend_icon_css', 'css', 300, 200);
    initCEditor('plugincompany_productleaflet_frontend_link_css', 'css', 300, 200);
}, false);
