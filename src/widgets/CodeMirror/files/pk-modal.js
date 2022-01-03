// Make the DIV element draggable:

new class {
    loadMode;
    full_html;
    widget_html;
    isfullscreen = false;

    constructor() {
        this.loadMode = 'widget';
        this.init_html_contents();

    }

    init_html_contents() {
        var app = this;
        $.ajax(
            {
                url: layoutUrl,
                cache: false,
                success: function (response) {
                    console.log('ok1');
                    app.full_html = response.full;
                    app.widget_html = response.widget;
                    app.create_modal();
                    app.init_drag();
                    app.init_triggers();
                    console.log('ok2');
                    return false;
                }
            }
        );
    }


    init_drag() {
        dragElement(document.getElementById('rendercontent'));
    }


    init_triggers() {
        var app=this;
        setTimeout(function(){

            app.trigger_resize();
            app.trigger_fullscreen();
            app.trigger_content_widget();
            app.trigger_content_full();
            app.triggerCodeChanged();
        },1000);
    }

    triggerCodeChanged(){
        var app=this;
        editorMirror.on('change',function(){
            app.code_changed();
        });
    }

    trigger_content_widget(){
        var app=this;
        $('#justWidget').off();
        $('#justWidget').click(function(){
            switch (app.loadMode) {
                case 'full':
                    $('#justWidget').addClass('mbactive');
                    $('#justAllSite').removeClass('mbactive');
                    app.loadMode='widget';
                    app.loadiframe();
                    break;
            }
        });
    }

    trigger_content_full(){
            var app=this;
            $('#justAllSite').off();
            $('#justAllSite').click(function(){
                switch (app.loadMode) {
                    case 'widget':
                        $('#justWidget').removeClass('mbactive');
                        $('#justAllSite').addClass('mbactive');
                        app.loadMode='full';
                        app.loadiframe();
                        break;
                }
            });
        }

    trigger_fullscreen() {
        var app = this;
        $('#mdragFullscreen').off();
        $('#mdragFullscreen').click(function (e) {
            switch (app.isfullscreen) {
                case true:
                    $('#rendercontent').removeClass('fullscreen');
                    $('#rendercontent').css('resize','both');
                    $('#mdragFullscreen').removeClass('mbactive');
                    app.isfullscreen = false;
                    break;
                case false:
                    $('#rendercontent').addClass('fullscreen');
                    $('#rendercontent').css('resize','none');
                    $('#mdragFullscreen').addClass('mbactive');
                    app.isfullscreen = true;
                    break;
            }
        });

    }

    trigger_resize() {
        $("#rendercontent").resize(function () {
            console.log('resized');
        });
    }

    create_modal() {
        var html = `
        <div id="rendercontent">
                        <dragClickMe id="rendercontentheader">
                            <span class="material-icons move-icon">open_with</span>
                            این پنجره را جابجا کنید
                            
                            <div class="mbdraggBtnBox">
                                <div data-toggle="tooltip" data-tippy-content="فقط نمایش ویجت" id="justWidget"  class="mdragbtn mbactive">
                                    <span class="material-icons">picture_in_picture</span>
                                </div>
                                <div data-toggle="tooltip" data-tippy-content="نمایش ویجت در کل سایت" id="justAllSite" class="mdragbtn">
                                    <span class="material-icons">launch</span>
                                </div>
                                <div data-toggle="tooltip" data-tippy-content="نمایش تمام صفحه" id="mdragFullscreen" class="mdragbtn">
                                    <span class="material-icons">aspect_ratio</span>
                                </div>
                            </div>
                            
                        </dragClickMe>
                        <iframe id="iframeRendered" src="" frameborder="0"></iframe>
<!--                    <resisable>-->
<!--                        <span class="material-icons">tab_unselected</span>-->
<!--                    </resisable>-->
                    </div>
        `;
        $('body').prepend(html);
        this.loadiframe();
        $(document).ready(function () {
            tippy('[data-toggle="tooltip"]');
        });
    }

    loadiframe() {

        switch (this.loadMode) {
            case 'widget':
                this.widgetHTML();
                break;
            case 'full':
                this.fullHTML();
                break;
        }
    }


    fullHTML() {
        let html = this.full_html;
        html = html.replace('<MMODELwidget><content></content></MMODELwidget>', '<MMODELwidget><content>'+ editorMirror.doc.getValue()+'</content></MMODELwidget>')


        var dstFrame = document.getElementById('iframeRendered');
        var dstDoc = dstFrame.contentDocument || dstFrame.contentWindow.document;
        dstDoc.write(html);
        dstDoc.close()
    }

    widgetHTML() {
        let html = this.widget_html;
        html = html.replace('<MMODELwidget><content></content></MMODELwidget>', '<MMODELwidget><content>'+ editorMirror.doc.getValue()+'</content></MMODELwidget>');


        var dstFrame = document.getElementById('iframeRendered');
        var dstDoc = dstFrame.contentDocument || dstFrame.contentWindow.document;
        dstDoc.write(html);
        dstDoc.close()


    }

    code_changed(){

        $('#iframeRendered').contents().find('MMODELwidget>content').html(editorMirror.doc.getValue());
    }
}

function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById(elmnt.id + "header")) {
        // if present, the header is where you move the DIV from:
        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;


    } else {
        // otherwise, move the DIV from anywhere inside the DIV:
        elmnt.onmousedown = dragMouseDown;
    }


    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;


        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        // stop moving when mouse button is released:
        document.onmouseup = null;
        document.onmousemove = null;
    }
}
