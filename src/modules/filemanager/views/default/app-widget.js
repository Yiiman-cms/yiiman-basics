angular.module('FileManagerApp').config(['fileManagerConfigProvider', function (config) {
    // var defaults = config.$get();
    config.set({
        appName: 'angular-filemanager',
        defaultLang: 'fa',
        multiLang: !0,
        listUrl: '../ajax',
        uploadUrl: '../ajax',
        renameUrl: '../ajax',
        copyUrl: '../ajax',
        moveUrl: '../ajax',
        removeUrl: '../ajax',
        editUrl: '../ajax',
        getContentUrl: '../ajax',
        createFolderUrl: '../ajax',
        downloadFileUrl: '../ajax',
        downloadMultipleUrl: '../ajax',
        compressUrl: '../ajax',
        extractUrl: '../ajax',
        permissionsUrl: '../ajax',
        basePath: '/',
        searchForm: !1,
        sidebar: !1,
        breadcrumb: !1,
        allowedActions: {
            upload: !0,
            rename: !0,
            move: !0,
            copy: !0,
            edit: !0,
            changePermissions: !0,
            compress: !0,
            compressChooseName: !0,
            extract: !0,
            download: !0,
            downloadMultiple: !0,
            preview: !0,
            remove: !0,
            createFolder: !0,
            pickFiles: !0,
            pickFolders: !0
        },
        multipleDownloadFileName: 'filemanager.zip',
        filterFileExtensions: [],
        showExtensionIcons: !0,
        showSizeForDirectories: !0,
        useBinarySizePrefixes: !1,
        downloadFilesByAjax: !0,
        previewImagesInModal: !0,
        enablePermissionsRecursive: !0,
        compressAsync: !1,
        extractAsync: !1,
        pickCallback: function (item) {
            var msg = 'Picked %s "%s" for external use';
                 console.log(item.fullPath());
        },
        isEditableFilePattern: /\.(txt|diff?|patch|svg|asc|cnf|cfg|conf|html?|.html|cfm|cgi|aspx?|ini|pl|py|md|css|cs|js|jsp|log|htaccess|htpasswd|gitignore|gitattributes|env|json|atom|eml|rss|markdown|sql|xml|xslt?|sh|rb|as|bat|cmd|cob|for|ftn|frm|frx|inc|lisp|scm|coffee|php[3-6]?|java|c|cbl|go|h|scala|vb|tmpl|lock|go|yml|yaml|tsv|lst|dir)$/i,
        isImageFilePattern: /\.(jpe?g|gif|bmp|png|svg|tiff?)$/i,
        isExtractableFilePattern: /\.(gz|tar|rar|g?zip)$/i,
        tplPath: 'src/templates',

    });
}]);

$(document).ready(function(){
    $('body').on('itemSelected',function (e,i) {
        var value='';
        $.each(i,function (index,data) {

            value +=data.model.fullPath()+' ';
        });
        window.parent.postMessage(['mediaValue', value], '*');
        console.log(value);

    });
});

