/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

bgcolorClasses = ["bg-primary", "bg-secondary", "bg-success", "bg-danger", "bg-warning", "bg-info", "bg-light", "bg-dark", "bg-white"]

bgcolorSelectOptions =
    [{
        value: "Default",
        text: ""
    },
        {
            value: "bg-primary",
            text: "اصلی"
        }, {
        value: "bg-secondary",
        text: "جانبی"
    }, {
        value: "bg-success",
        text: "موفق"
    }, {
        value: "bg-danger",
        text: "خطر"
    }, {
        value: "bg-warning",
        text: "اخطار"
    }, {
        value: "bg-info",
        text: "اطلاعات"
    }, {
        value: "bg-light",
        text: "روشن"
    }, {
        value: "bg-dark",
        text: "تاریک"
    }, {
        value: "bg-white",
        text: "سفید"
    }];



function changeNodeName(node, newNodeName) {
    var newNode;
    newNode = document.createElement(newNodeName);
    attributes = node.get(0).attributes;

    for (i = 0, len = attributes.length; i < len; i++) {
        newNode.setAttribute(attributes[i].nodeName, attributes[i].nodeValue);
    }

    $(newNode).append($(node).contents());
    $(node).replaceWith(newNode);

    return newNode;
}

Vvveb.ComponentsGroup['بوت استرپ 4'] =
    [
        "html/container",
        "html/gridrow",
        "html/button",
        "html/buttongroup",
        "html/buttontoolbar",
        "html/heading",
        "html/image",
        "html/jumbotron",
        "html/alert",
        "html/card",
        "html/listgroup",
        "html/hr",
        "html/taglabel",
        "html/badge",
        "html/progress",
        "html/navbar",
        "html/breadcrumbs",
        "html/pagination",
        "html/form",
        "html/textinput",
        "html/textareainput",
        "html/selectinput",
        "html/fileinput",
        "html/checkbox",
        "html/radiobutton",
        "html/table",
        "html/paragraph",
        "html/link",
        "html/video",
        "html/button",
        "html/session"
    ];


var base_sort = 100;//start sorting for base component from 100 to allow extended properties to be first
var style_section = 'style';

Vvveb.Components.add("_base", {
    name: "Element",
    properties: [{
        key: "element_header",
        inputtype: SectionInput,
        name: false,
        sort: base_sort++,
        data: {header: "المنت اصلی"},
    }, {
        name: "Id",
        key: "id",
        htmlAttr: "id",
        sort: base_sort++,
        inline: true,
        col: 6,
        inputtype: TextInput
    }, {
        name: "Class",
        key: "class",
        htmlAttr: "class",
        sort: base_sort++,
        inline: true,
        col: 6,
        inputtype: TextInput
    }
    ]
});

//display
Vvveb.Components.extend("_base", "_base", {
    properties: [
        {
            key: "display_header",
            inputtype: SectionInput,
            name: false,
            sort: base_sort++,
            section: style_section,
            data: {header: "نمایش"},
        }, {
            name: "Display",
            key: "display",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            inputtype: SelectInput,
            validValues: ["block", "inline", "inline-block", "none"],
            data: {
                options: [{
                    value: "block",
                    text: "Block"
                }, {
                    value: "inline",
                    text: "Inline"
                }, {
                    value: "inline-block",
                    text: "Inline Block"
                }, {
                    value: "none",
                    text: "none"
                }]
            }
        }, {
            name: "موقعیت",
            key: "position",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            inputtype: SelectInput,
            validValues: ["static", "fixed", "relative", "absolute"],
            data: {
                options: [{
                    value: "static",
                    text: "Static"
                }, {
                    value: "fixed",
                    text: "Fixed"
                }, {
                    value: "relative",
                    text: "Relative"
                }, {
                    value: "absolute",
                    text: "Absolute"
                }]
            }
        }, {
            name: "بالا",
            key: "top",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            parent: "",
            inputtype: CssUnitInput
        }, {
            name: "چپ",
            key: "left",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            parent: "",
            inputtype: CssUnitInput
        }, {
            name: "پایین",
            key: "bottom",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            parent: "",
            inputtype: CssUnitInput
        }, {
            name: "راست",
            key: "right",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            parent: "",
            inputtype: CssUnitInput
        }, {
            name: "Float",
            key: "float",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 12,
            inline: true,
            inputtype: RadioButtonInput,
            data: {
                extraclass: "btn-group-sm btn-group-fullwidth",
                options: [{
                    value: "none",
                    icon: "la la-close",
                    //text: "None",
                    title: "None",
                    checked: true,
                }, {
                    value: "left",
                    //text: "Left",
                    title: "چپ",
                    icon: "la la-align-left",
                    checked: false,
                }, {
                    value: "right",
                    //text: "Right",
                    title: "راست",
                    icon: "la la-align-right",
                    checked: false,
                }],
            }
        }, {
            name: "شفافیت",
            key: "opacity",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 12,
            inline: true,
            parent: "",
            inputtype: RangeInput,
            data: {
                max: 1, //max zoom level
                min: 0,
                step: 0.1
            },
        }, {
            name: "رنگ پس زمینه",
            key: "background-color",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            htmlAttr: "style",
            inputtype: ColorInput,
        }, {
            name: "رنگ متن",
            key: "color",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            htmlAttr: "style",
            inputtype: ColorInput,
        }]
});

//Typography
Vvveb.Components.extend("_base", "_base", {
    properties: [
        {
            key: "typography_header",
            inputtype: SectionInput,
            name: false,
            sort: base_sort++,
            section: style_section,
            data: {header: "نوشتار"},
        }, {
            name: "نوع فونت",
            key: "font-family",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            inputtype: SelectInput,
            data: {
                options:
                themeFonts
            }
        }, {
            name: "زخامت فونت",
            key: "font-weight",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            inputtype: SelectInput,
            data: {
                options: [{
                    value: "",
                    text: "پیش فرض"
                }, {
                    value: "100",
                    text: "نازک"
                }, {
                    value: "200",
                    text: "خیلی سبک"
                }, {
                    value: "300",
                    text: "سبک"
                }, {
                    value: "400",
                    text: "طبیعی"
                }, {
                    value: "500",
                    text: "متوسط"
                }, {
                    value: "600",
                    text: "کمی برجسته"
                }, {
                    value: "700",
                    text: "برجسته"
                }, {
                    value: "800",
                    text: "بزجسته تر"
                }, {
                    value: "900",
                    text: "خیلی برجسته"
                }],
            }
        }, {
            name: "ترتیب متن",
            key: "text-align",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 12,
            inline: true,
            inputtype: RadioButtonInput,
            data: {
                extraclass: "btn-group-sm btn-group-fullwidth",
                options: [{
                    value: "none",
                    icon: "la la-close",
                    //text: "None",
                    title: "None",
                    checked: true,
                }, {
                    value: "left",
                    //text: "Left",
                    title: "چپ",
                    icon: "la la-align-left",
                    checked: false,
                }, {
                    value: "center",
                    //text: "Center",
                    title: "وسط",
                    icon: "la la-align-center",
                    checked: false,
                }, {
                    value: "right",
                    //text: "Right",
                    title: "راست",
                    icon: "la la-align-right",
                    checked: false,
                }, {
                    value: "justify",
                    //text: "justify",
                    title: "مرتب",
                    icon: "la la-align-justify",
                    checked: false,
                }],
            },
        }, {
            name: "ارتفاع خط",
            key: "line-height",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            inputtype: CssUnitInput
        }, {
            name: "فاصله ی کلمات",
            key: "letter-spacing",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            inputtype: CssUnitInput
        }, {
            name: "سبک متن",
            key: "text-decoration-line",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 12,
            inline: true,
            inputtype: RadioButtonInput,
            data: {
                extraclass: "btn-group-sm btn-group-fullwidth",
                options: [{
                    value: "none",
                    icon: "la la-close",
                    //text: "None",
                    title: "بدون سبک",
                    checked: true,
                }, {
                    value: "underline",
                    //text: "Left",
                    title: "خط زیر",
                    icon: "la la-long-arrow-down",
                    checked: false,
                }, {
                    value: "overline",
                    //text: "Right",
                    title: "خط روی متن",
                    icon: "la la-long-arrow-up",
                    checked: false,
                }, {
                    value: "line-through",
                    //text: "Right",
                    title: "Line Through",
                    icon: "la la-strikethrough",
                    checked: false,
                }, {
                    value: "underline overline",
                    //text: "justify",
                    title: "خط زیر و خط روی متن",
                    icon: "la la-arrows-v",
                    checked: false,
                }],
            },
        }, {
            name: "سبک رنگ",
            key: "text-decoration-color",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            htmlAttr: "style",
            inputtype: ColorInput,
        }, {
            name: "سبک ظاهر",
            key: "text-decoration-style",
            htmlAttr: "style",
            sort: base_sort++,
            section: style_section,
            col: 6,
            inline: true,
            inputtype: SelectInput,
            data: {
                options: [{
                    value: "",
                    text: "پیش فرض"
                }, {
                    value: "solid",
                    text: "خط"
                }, {
                    value: "wavy",
                    text: "مواج"
                }, {
                    value: "dotted",
                    text: "نقطه دار"
                }, {
                    value: "dashed",
                    text: "خط دار"
                }, {
                    value: "double",
                    text: "Double"
                }],
            }
        }]
})

//Size
Vvveb.Components.extend("_base", "_base", {
    properties: [{
        key: "size_header",
        inputtype: SectionInput,
        name: false,
        sort: base_sort++,
        section: style_section,
        data: {header: "اندازه", expanded: false},
    }, {
        name: "عرض",
        key: "width",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "طول",
        key: "height",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "حداقل عرض",
        key: "min-width",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "حداقل ارتفاع",
        key: "min-height",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "حداکثر عرض",
        key: "max-width",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "حداکثر ارتفاع",
        key: "max-height",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }]
});

//Margin
Vvveb.Components.extend("_base", "_base", {
    properties: [{
        key: "margins_header",
        inputtype: SectionInput,
        name: false,
        sort: base_sort++,
        section: style_section,
        data: {header: "فاصله ی اطراف(margin)", expanded: false},
    }, {
        name: "بالا",
        key: "margin-top",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "راست",
        key: "margin-right",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "پایین",
        key: "margin-bottom",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "چپ",
        key: "margin-left",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }]
});

//Padding
Vvveb.Components.extend("_base", "_base", {
    properties: [{
        key: "paddings_header",
        inputtype: SectionInput,
        name: false,
        sort: base_sort++,
        section: style_section,
        data: {header: "فاصله از داخل(padding)", expanded: false},
    }, {
        name: "بالا",
        key: "padding-top",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "راست",
        key: "padding-right",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "پایین",
        key: "padding-bottom",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "چپ",
        key: "padding-left",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }]
});


//Border
Vvveb.Components.extend("_base", "_base", {
    properties: [{
        key: "border_header",
        inputtype: SectionInput,
        name: false,
        sort: base_sort++,
        section: style_section,
        data: {header: "خط دور(Border)", expanded: false},
    }, {
        name: "سبک خط دور",
        key: "border-style",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 12,
        inline: true,
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "solid",
                text: "خط"
            }, {
                value: "dotted",
                text: "نقطه دار"
            }, {
                value: "dashed",
                text: "خط دار"
            }],
        }
    }, {
        name: "زخامت",
        key: "border-width",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "رنگ",
        key: "border-color",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        htmlAttr: "style",
        inputtype: ColorInput,
    }]
});


//Border radius
Vvveb.Components.extend("_base", "_base", {
    properties: [{
        key: "border_radius_header",
        inputtype: SectionInput,
        name: false,
        sort: base_sort++,
        section: style_section,
        data: {header: "خمیدگی دور(Border)", expanded: false},
    }, {
        name: "بالا چپ",
        key: "border-top-left-radius",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "بالا راست",
        key: "border-top-right-radius",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "پایین چپ",
        key: "border-bottom-left-radius",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }, {
        name: "پایین راست",
        key: "border-bottom-right-radius",
        htmlAttr: "style",
        sort: base_sort++,
        section: style_section,
        col: 6,
        inline: true,
        inputtype: CssUnitInput
    }]
});

//Background image
Vvveb.Components.extend("_base", "_base", {
    properties: [{
        key: "background_image_header",
        inputtype: SectionInput,
        name: false,
        sort: base_sort++,
        section: style_section,
        data: {header: "تصویر زمینه(Background Image)", expanded: false},
    }, {
        name: "تصویر",
        key: "Image",
        sort: base_sort++,
        section: style_section,
        //htmlAttr: "style",
        inputtype: ImageInput,

        init: function (node) {
            var image = $(node).css("background-image").replace(/^url\(['"]?(.+)['"]?\)/, '$1');
            return image;
        },

        onChange: function (node, value) {

            $(node).css('background-image', 'url(' + value + ')');

            return node;
        }

    }, {
        name: "تکرار",
        key: "background-repeat",
        sort: base_sort++,
        section: style_section,
        htmlAttr: "style",
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "repeat-x",
                text: "تکرار افقی"
            }, {
                value: "repeat-y",
                text: "تکرار عمودی"
            }, {
                value: "no-repeat",
                text: "بدون تکرار"
            }],
        }
    }, {
        name: "اندازه",
        key: "background-size",
        sort: base_sort++,
        section: style_section,
        htmlAttr: "style",
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "contain",
                text: "شامل تصویر"
            }, {
                value: "cover",
                text: "تصویر کاور شود"
            }],
        }
    }, {
        name: "موقعیت محور X",
        key: "background-position-x",
        sort: base_sort++,
        section: style_section,
        htmlAttr: "style",
        col: 6,
        inline: true,
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پش فرض"
            }, {
                value: "center",
                text: "وسط"
            }, {
                value: "right",
                text: "راست"
            }, {
                value: "left",
                text: "چپ"
            }],
        }
    }, {
        name: "موقعیت محور Y",
        key: "background-position-y",
        sort: base_sort++,
        section: style_section,
        htmlAttr: "style",
        col: 6,
        inline: true,
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "center",
                text: "وسط"
            }, {
                value: "top",
                text: "بالا"
            }, {
                value: "bottom",
                text: "پایین"
            }],
        }
    }]
});

Vvveb.Components.extend("_base", "html/container", {
    classes: ["container", "container-fluid"],
    image: asseturlt + "libs/builder/" + "icons/container.svg",
    html: '<div class="container" style="min-height:150px;"><div class="m-5">Container</div></div>',
    name: "چهارچوب",
    properties: [
        {
            name: "نوع",
            key: "type",
            htmlAttr: "class",
            inputtype: SelectInput,
            validValues: ["container", "container-fluid"],
            data: {
                options: [{
                    value: "container",
                    text: "پیش فرض"
                }, {
                    value: "container-fluid",
                    text: "بدون فاصله از اطراف"
                }]
            }
        },
        {
            name: "پشت زمینه",
            key: "background",
            htmlAttr: "class",
            validValues: bgcolorClasses,
            inputtype: SelectInput,
            data: {
                options: bgcolorSelectOptions
            }
        },
        {
            name: "زنگ پشت زمینه",
            key: "background-color",
            htmlAttr: "style",
            inputtype: ColorInput,
        },
        {
            name: "زنگ متون",
            key: "color",
            htmlAttr: "style",
            inputtype: ColorInput,
        }],
});

Vvveb.Components.extend("_base", "html/heading", {
    image: asseturlt + "libs/builder/" + "icons/heading.svg",
    name: "تیتر",
    nodes: ["h1", "h2", "h3", "h4", "h5", "h6"],
    html: "<h1>Heading</h1>",

    properties: [
        {
            name: "سایز",
            key: "size",
            inputtype: SelectInput,

            onChange: function (node, value) {

                return changeNodeName(node, "h" + value);
            },

            init: function (node) {
                var regex;
                regex = /H(\d)/.exec(node.nodeName);
                if (regex && regex[1]) {
                    return regex[1]
                }
                return 1
            },

            data: {
                options: [{
                    value: "1",
                    text: "1"
                }, {
                    value: "2",
                    text: "2"
                }, {
                    value: "3",
                    text: "3"
                }, {
                    value: "4",
                    text: "4"
                }, {
                    value: "5",
                    text: "5"
                }, {
                    value: "6",
                    text: "6"
                }]
            },
        }]
});
Vvveb.Components.extend("_base", "html/link", {
    nodes: ["a"],
    name: "لینک",
    html: '<a href="#" class="d-inline-block"><span>Link</span></a>',
    image: asseturlt + "libs/builder/" + "icons/link.svg",
    properties: [{
        name: "آدرس URL",
        key: "href",
        htmlAttr: "href",
        inputtype: LinkInput
    }, {
        name: "رفتار",
        key: "target",
        htmlAttr: "target",
        inputtype: TextInput
    }]
});
Vvveb.Components.extend("_base", "html/image", {
    nodes: ["img"],
    name: "تصویر",
    html: '<img src="' + Vvveb.baseUrl + 'icons/image.svg" height="128" width="128">',
    /*
    afterDrop: function (node)
	{
		node.attr("src", '');
		return node;
	},*/
    image: asseturlt + "libs/builder/" + "icons/image.svg",
    properties: [{
        name: "منبع تصویر",
        key: "src",
        htmlAttr: "src",
        inputtype: ImageInput
    }, {
        name: "عرض",
        key: "width",
        htmlAttr: "width",
        inputtype: TextInput
    }, {
        name: "طول",
        key: "height",
        htmlAttr: "height",
        inputtype: TextInput
    }, {
        name: "نام عکس(برای سئو)",
        key: "alt",
        htmlAttr: "alt",
        inputtype: TextInput
    }]
});
Vvveb.Components.add("html/hr", {
    image: asseturlt + "libs/builder/" + "icons/hr.svg",
    nodes: ["hr"],
    name: "خط افقی جدا کننده",
    html: "<hr>"
});
Vvveb.Components.extend("_base", "html/label", {
    name: "برچسب",
    nodes: ["label"],
    html: '<label for="">Label</label>',
    properties: [{
        name: "For id",
        htmlAttr: "for",
        key: "for",
        inputtype: TextInput
    }]
});
Vvveb.Components.extend("_base", "html/button", {
    classes: ["btn", "btn-link"],
    name: "کلید",
    image: asseturlt + "libs/builder/" + "icons/button.svg",
    html: '<button type="button" class="btn btn-primary">Primary</button>',
    properties: [{
        name: "لینک به",
        key: "href",
        htmlAttr: "href",
        inputtype: LinkInput
    }, {
        name: "نوع کلید",
        key: "type",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-default", "btn-primary", "btn-info", "btn-success", "btn-warning", "btn-info", "btn-light", "btn-dark", "btn-outline-primary", "btn-outline-info", "btn-outline-success", "btn-outline-warning", "btn-outline-info", "btn-outline-light", "btn-outline-dark", "btn-link"],
        data: {
            options: [
                {
                    value: "btn-default",
                    text: "پیش فرض"
                }, {
                    value: "btn-primary",
                    text: "اصلی"
                }, {
                    value: "btn btn-info",
                    text: "اطلاعات"
                }, {
                    value: "btn-success",
                    text: "موفق"
                }, {
                    value: "btn-warning",
                    text: "اخطار"
                }, {
                    value: "btn-info",
                    text: "اطلاعات"
                }, {
                    value: "btn-light",
                    text: "روشن"
                }, {
                    value: "btn-dark",
                    text: "تاریک"
                }, {
                    value: "btn-outline-primary",
                    text: "اصلی بدون خط"
                }, {
                    value: "btn btn-outline-info",
                    text: "اطلاعات بدون خط"
                }, {
                    value: "btn-outline-success",
                    text: "موفق بدون خط"
                }, {
                    value: "btn-outline-warning",
                    text: "اخطار بودن خط"
                },
            ]
        }
    }, {
        name: "اندازه",
        key: "size",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-lg", "btn-sm"],
        data: {
            options: [{
                value: "",
                text: "پش فرض"
            }, {
                value: "btn-lg",
                text: "بزرگ"
            }, {
                value: "btn-sm",
                text: "گوچک"
            }]
        }
    }, {
        name: "Target",
        key: "target",
        htmlAttr: "target",
        inputtype: TextInput
    }, {
        name: "خاموش شده",
        key: "disabled",
        htmlAttr: "class",
        inputtype: ToggleInput,
        validValues: ["disabled"],
        data: {
            on: "disabled",
            off: ""
        }
    }]
});
Vvveb.Components.extend("_base", "html/buttongroup", {
    classes: ["btn-group"],
    name: "گروه کیدها",
    image: asseturlt + "libs/builder/" + "icons/button_group.svg",
    html: '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-secondary">Left</button><button type="button" class="btn btn-secondary">Middle</button> <button type="button" class="btn btn-secondary">Right</button></div>',
    properties: [{
        name: "اندازه",
        key: "size",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-group-lg", "btn-group-sm"],
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "btn-group-lg",
                text: "بزرگ"
            }, {
                value: "btn-group-sm",
                text: "کوچک"
            }]
        }
    }, {
        name: "محوریت",
        key: "alignment",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-group", "btn-group-vertical"],
        data: {
            options: [{
                value: "",
                text: "Default"
            }, {
                value: "btn-group",
                text: "افقی"
            }, {
                value: "btn-group-vertical",
                text: "عمودی"
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/buttontoolbar", {
    classes: ["btn-toolbar"],
    name: "کلید نوار ابزار",
    image: asseturlt + "libs/builder/" + "icons/button_toolbar.svg",
    html: '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">\
		  <div class="btn-group mr-2" role="group" aria-label="First group">\
			<button type="button" class="btn btn-secondary">1</button>\
			<button type="button" class="btn btn-secondary">2</button>\
			<button type="button" class="btn btn-secondary">3</button>\
			<button type="button" class="btn btn-secondary">4</button>\
		  </div>\
		  <div class="btn-group mr-2" role="group" aria-label="Second group">\
			<button type="button" class="btn btn-secondary">5</button>\
			<button type="button" class="btn btn-secondary">6</button>\
			<button type="button" class="btn btn-secondary">7</button>\
		  </div>\
		  <div class="btn-group" role="group" aria-label="Third group">\
			<button type="button" class="btn btn-secondary">8</button>\
		  </div>\
		</div>'
});
Vvveb.Components.extend("_base", "html/alert", {
    classes: ["alert"],
    name: "هشدار",
    image: asseturlt + "libs/builder/" + "icons/alert.svg",
    html: '<div class="alert alert-warning alert-dismissible fade show" role="alert">\
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
			<span aria-hidden="true">&times;</span>\
		  </button>\
		  <strong>Holy guacamole!</strong> You should check in on some of those fields below.\
		</div>',
    properties: [{
        name: "نوع",
        key: "type",
        htmlAttr: "class",
        validValues: ["alert-primary", "alert-secondary", "alert-success", "alert-danger", "alert-warning", "alert-info", "alert-light", "alert-dark"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "alert-primary",
                text: "پش فرض"
            }, {
                value: "alert-secondary",
                text: "جانبی"
            }, {
                value: "alert-success",
                text: "موفق"
            }, {
                value: "alert-danger",
                text: "خطر"
            }, {
                value: "alert-warning",
                text: "اخطار"
            }, {
                value: "alert-info",
                text: "اطلاعات"
            }, {
                value: "alert-light",
                text: "روشن"
            }, {
                value: "alert-dark",
                text: "تاریک"
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/badge", {
    classes: ["badge"],
    image: asseturlt + "libs/builder/" + "icons/badge.svg",
    name: "پرچم",
    html: '<span class="badge badge-primary">Primary badge</span>',
    properties: [{
        name: "رنگ",
        key: "color",
        htmlAttr: "class",
        validValues: ["badge-primary", "badge-secondary", "badge-success", "badge-danger", "badge-warning", "badge-info", "badge-light", "badge-dark"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "badge-primary",
                text: "اصلی"
            }, {
                value: "badge-secondary",
                text: "فرعی"
            }, {
                value: "badge-success",
                text: "موفق"
            }, {
                value: "badge-warning",
                text: "اخطار"
            }, {
                value: "badge-danger",
                text: "خطر"
            }, {
                value: "badge-info",
                text: "اطلاعات"
            }, {
                value: "badge-light",
                text: "روشن"
            }, {
                value: "badge-dark",
                text: "تاریک"
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/card", {
    classes: ["card"],
    image: asseturlt + "libs/builder/" + "icons/panel.svg",
    name: "کارت",
    html: '<div class="card">\
		  <img class="card-img-top" src="../libs/builder/icons/image.svg" alt="Card image cap" width="128" height="128">\
		  <div class="card-body">\
			<h4 class="card-title">Card title</h4>\
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>\
			<a href="#" class="btn btn-primary">Go somewhere</a>\
		  </div>\
		</div>'
});
Vvveb.Components.extend("_base", "html/listgroup", {
    name: "لیست گروهی",
    image: asseturlt + "libs/builder/" + "icons/list_group.svg",
    classes: ["list-group"],
    html: '<ul class="list-group">\n  <li class="list-group-item">\n    <span class="badge">14</span>\n    Cras justo odio\n  </li>\n  <li class="list-group-item">\n    <span class="badge">2</span>\n    Dapibus ac facilisis in\n  </li>\n  <li class="list-group-item">\n    <span class="badge">1</span>\n    Morbi leo risus\n  </li>\n</ul>'
});
Vvveb.Components.extend("_base", "html/listitem", {
    name: "لیست تکی(یک آیتم از لیست)",
    classes: ["list-group-item"],
    html: '<li class="list-group-item"><span class="badge">14</span> Cras justo odio</li>'
});
Vvveb.Components.extend("_base", "html/breadcrumbs", {
    classes: ["breadcrumb"],
    name: "موقعیت نما(Breadcrumbs)",
    image: asseturlt + "libs/builder/" + "icons/breadcrumbs.svg",
    html: '<ol class="breadcrumb">\
		  <li class="breadcrumb-item active"><a href="#">Home</a></li>\
		  <li class="breadcrumb-item active"><a href="#">Library</a></li>\
		  <li class="breadcrumb-item active">Data 3</li>\
		</ol>'
});
Vvveb.Components.extend("_base", "html/breadcrumbitem", {
    classes: ["breadcrumb-item"],
    name: "یک آیتم از موقعیت نما(Breadcrumb)",
    html: '<li class="breadcrumb-item"><a href="#">Library</a></li>',
    properties: [{
        name: "Active",
        key: "active",
        htmlAttr: "class",
        validValues: ["", "active"],
        inputtype: ToggleInput,
        data: {
            on: "active",
            off: ""
        }
    }]
});
Vvveb.Components.extend("_base", "html/pagination", {
    classes: ["pagination"],
    name: "صفحه بندی",
    image: asseturlt + "libs/builder/" + "icons/pagination.svg",
    html: '<nav aria-label="Page navigation example">\
	  <ul class="pagination">\
		<li class="page-item"><a class="page-link" href="#">Previous</a></li>\
		<li class="page-item"><a class="page-link" href="#">1</a></li>\
		<li class="page-item"><a class="page-link" href="#">2</a></li>\
		<li class="page-item"><a class="page-link" href="#">3</a></li>\
		<li class="page-item"><a class="page-link" href="#">Next</a></li>\
	  </ul>\
	</nav>',

    properties: [{
        name: "سایز",
        key: "size",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-lg", "btn-sm"],
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "btn-lg",
                text: "بزرگ"
            }, {
                value: "btn-sm",
                text: "گوچک"
            }]
        }
    }, {
        name: "ترتیب بندی",
        key: "alignment",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["justify-content-center", "justify-content-end"],
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "justify-content-center",
                text: "وسط"
            }, {
                value: "justify-content-end",
                text: "راست"
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/pageitem", {
    classes: ["page-item"],
    html: '<li class="page-item"><a class="page-link" href="#">1</a></li>',
    name: "آیتم صفحه بندی",
    properties: [{
        name: "لینک به",
        key: "href",
        htmlAttr: "href",
        child: ".page-link",
        inputtype: TextInput
    }, {
        name: "خاموش شده",
        key: "disabled",
        htmlAttr: "class",
        validValues: ["disabled"],
        inputtype: ToggleInput,
        data: {
            on: "disabled",
            off: ""
        }
    }]
});
Vvveb.Components.extend("_base", "html/progress", {
    classes: ["progress"],
    name: "نوار پردازش(Progress Bar)",
    image: asseturlt + "libs/builder/" + "icons/progressbar.svg",
    html: '<div class="progress"><div class="progress-bar w-25"></div></div>',
    properties: [{
        name: "پس زمینه",
        key: "background",
        htmlAttr: "class",
        validValues: bgcolorClasses,
        inputtype: SelectInput,
        data: {
            options: bgcolorSelectOptions
        }
    },
        {
            name: "میزان پردازش",
            key: "background",
            child: ".progress-bar",
            htmlAttr: "class",
            validValues: ["", "w-25", "w-50", "w-75", "w-100"],
            inputtype: SelectInput,
            data: {
                options: [{
                    value: "",
                    text: "خالی"
                }, {
                    value: "w-25",
                    text: "25%"
                }, {
                    value: "w-50",
                    text: "50%"
                }, {
                    value: "w-75",
                    text: "75%"
                }, {
                    value: "w-100",
                    text: "100%"
                }]
            }
        },
        {
            name: "پس زمینه ی پردازشگر",
            key: "background",
            child: ".progress-bar",
            htmlAttr: "class",
            validValues: bgcolorClasses,
            inputtype: SelectInput,
            data: {
                options: bgcolorSelectOptions
            }
        }, {
            name: "Striped",
            key: "striped",
            child: ".progress-bar",
            htmlAttr: "class",
            validValues: ["", "progress-bar-striped"],
            inputtype: ToggleInput,
            data: {
                on: "progress-bar-striped",
                off: "",
            }
        }, {
            name: "دارای انیمیشن",
            key: "animated",
            child: ".progress-bar",
            htmlAttr: "class",
            validValues: ["", "progress-bar-animated"],
            inputtype: ToggleInput,
            data: {
                on: "progress-bar-animated",
                off: "",
            }
        }]
});
Vvveb.Components.extend("_base", "html/jumbotron", {
    classes: ["jumbotron"],
    image: asseturlt + "libs/builder/" + "icons/jumbotron.svg",
    name: "Jumbotron",
    html: '<div class="jumbotron">\
		  <h1 class="display-3">Hello, world!</h1>\
		  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>\
		  <hr class="my-4">\
		  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>\
		  <p class="lead">\
			<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>\
		  </p>\
		</div>'
});
Vvveb.Components.extend("_base", "html/navbar", {
    classes: ["navbar"],
    image: asseturlt + "libs/builder/" + "icons/navbar.svg",
    name: "نوار ناوبری(navbar)",
    html: '<nav class="navbar navbar-expand-lg navbar-light bg-light">\
		  <a class="navbar-brand" href="#">نوار ناوبری</a>\
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">\
			<span class="navbar-toggler-icon"></span>\
		  </button>\
		\
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">\
			<ul class="navbar-nav mr-auto">\
			  <li class="nav-item active">\
				<a class="nav-link" href="#">خانه <span class="sr-only">(فعلی)</span></a>\
			  </li>\
			  <li class="nav-item">\
				<a class="nav-link" href="#">لینک</a>\
			  </li>\
			  <li class="nav-item">\
				<a class="nav-link disabled" href="#">خاموش شده</a>\
			  </li>\
			</ul>\
			<form class="form-inline my-2 my-lg-0">\
			  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">\
			  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">جستار</button>\
			</form>\
		  </div>\
		</nav>',

    properties: [{
        name: "رنگ قالب",
        key: "color",
        htmlAttr: "class",
        validValues: ["navbar-light", "navbar-dark"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "navbar-light",
                text: "روشن"
            }, {
                value: "navbar-dark",
                text: "تاریک"
            }]
        }
    }, {
        name: "رنگ زمینه",
        key: "background",
        htmlAttr: "class",
        validValues: bgcolorClasses,
        inputtype: SelectInput,
        data: {
            options: bgcolorSelectOptions
        }
    }, {
        name: "موقعیت",
        key: "placement",
        htmlAttr: "class",
        validValues: ["fixed-top", "fixed-bottom", "sticky-top"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "fixed-top",
                text: "ثابت بالا"
            }, {
                value: "fixed-bottom",
                text: "ثابت پایین"
            }, {
                value: "sticky-top",
                text: "چسبنده به بالا"
            }]
        }
    }]
});

Vvveb.Components.extend("_base", "html/accordionItem", {
    name: "لیست آیتم آکاردئونی",
    image: asseturlt + "libs/builder/" + "icons/accordion.png",
    activeCode: `jQuery.accordion(".accordion > a")`,
    id: "accordion-item",
    enginCode: `
    jQuery.accordion = function (e) {
        jQuery("body").on("click", e, function (e) {
            var i = jQuery(this), o = i.closest(".card").find(i.attr("href")), n = i.closest(".accordion");
            e.preventDefault(), 0 === n.find(".collapsing").length && 0 === n.find(".expanding").length && (o.hasClass("expanded") ? n.hasClass("radio-type") || a(o) : o.hasClass("collapsed") && (n.find(".expanded").length > 0 ? Wolmart.isIE ? a(n.find(".expanded"), function () {
                a(o)
            }) : (a(n.find(".expanded")), a(o)) : a(o)))
        });
        var a = function (t, a) {
            var i = t.closest(".card").find(e);
            t.hasClass("expanded") ? (i.removeClass("collapse").addClass("expand"), t.addClass("collapsing").slideUp(300, function () {
                t.removeClass("expanded collapsing").addClass("collapsed"), a && a()
            })) : t.hasClass("collapsed") && (i.removeClass("expand").addClass("collapse"), t.addClass("expanding").slideDown(300, function () {
                t.removeClass("collapsed expanding").addClass("expanded"), a && a()
            }))
        }
    }
    `,
    classes: [ "card"],
    html: `
<div class="card">
    <div class="card-header">
        <a href="#collapse1-1" class="collapse">عنوان آکاردئون</a>
    </div>
    <div id="collapse1-1" class="card-body expanded">
        <p class="mb-0"> متن بدنه</p>
    </div>
</div>
    `
});

Vvveb.Components.extend("_base", "html/form", {
    nodes: ["form"],
    image: asseturlt + "libs/builder/" + "icons/form.svg",
    name: "فرم",
    html: '<form><div class="form-group"><label>Text</label><input type="text" class="form-control"></div></div></form>',
    properties: [{
        name: "سبک",
        key: "style",
        htmlAttr: "class",
        validValues: ["", "form-search", "form-inline", "form-horizontal"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "form-search",
                text: "جست و جو"
            }, {
                value: "form-inline",
                text: "خطی"
            }, {
                value: "form-horizontal",
                text: "افقی"
            }]
        }
    }, {
        name: "Action",
        key: "action",
        htmlAttr: "action",
        inputtype: TextInput
    }, {
        name: "Method",
        key: "method",
        htmlAttr: "method",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "html/textinput", {
    name: "ورودی متن",
    attributes: {"type": "text"},
    image: asseturlt + "libs/builder/" + "icons/text_input.svg",
    html: '<div class="form-group"><label>Text</label><input type="text" class="form-control"></div></div>',
    properties: [{
        name: "Value",
        key: "value",
        htmlAttr: "value",
        inputtype: TextInput
    }, {
        name: "Placeholder",
        key: "placeholder",
        htmlAttr: "placeholder",
        inputtype: TextInput
    }]
});
Vvveb.Components.extend("_base", "html/session", {
    name: "بخش (section)",
    classes: ["section"],
    html: `<section class="section"></section>`,
    image: asseturlt + "libs/builder/" + "icons/sections.png"
})

Vvveb.Components.extend("_base", "html/selectinput", {
    nodes: ["select"],
    name: "سلکت باکس",
    image: asseturlt + "libs/builder/" + "icons/select_input.svg",
    html: '<div class="form-group"><label>Choose an option </label><select class="form-control"><option value="value1">Text 1</option><option value="value2">Text 2</option><option value="value3">Text 3</option></select></div>',

    beforeInit: function (node) {
        properties = [];
        var i = 0;

        $(node).find('option').each(function () {

            data = {"value": this.value, "text": this.text};

            i++;
            properties.push({
                name: "Option " + i,
                key: "option" + i,
                //index: i - 1,
                optionNode: this,
                inputtype: TextValueInput,
                data: data,
                onChange: function (node, value, input) {

                    option = $(this.optionNode);

                    //if remove button is clicked remove option and render row properties
                    if (input.nodeName == 'BUTTON') {
                        option.remove();
                        Vvveb.Components.render("html/selectinput");
                        return node;
                    }

                    if (input.name == "value") option.attr("value", value);
                    else if (input.name == "text") option.text(value);

                    return node;
                },
            });
        });

        //remove all option properties
        this.properties = this.properties.filter(function (item) {
            return item.key.indexOf("option") === -1;
        });

        //add remaining properties to generated column properties
        properties.push(this.properties[0]);

        this.properties = properties;
        return node;
    },

    properties: [{
        name: "Option",
        key: "option1",
        inputtype: TextValueInput
    }, {
        name: "Option",
        key: "option2",
        inputtype: TextValueInput
    }, {
        name: "",
        key: "addChild",
        inputtype: ButtonInput,
        data: {text: "Add option", icon: "la-plus"},
        onChange: function (node) {
            $(node).append('<option value="value">Text</option>');

            //render component properties again to include the new column inputs
            Vvveb.Components.render("html/selectinput");

            return node;
        }
    }]
});
Vvveb.Components.extend("_base", "html/textareainput", {
    name: "Text Area",
    image: asseturlt + "libs/builder/" + "icons/text_area.svg",
    html: '<div class="form-group"><label>Your response:</label><textarea class="form-control"></textarea></div>'
});
Vvveb.Components.extend("_base", "html/radiobutton", {
    name: "Radio Button",
    attributes: {"type": "radio"},
    image: asseturlt + "libs/builder/" + "icons/radio.svg",
    html: '<label class="radio"><input type="radio"> Radio</label>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});
Vvveb.Components.extend("_base", "html/checkbox", {
    name: "Checkbox",
    attributes: {"type": "checkbox"},
    image: asseturlt + "libs/builder/" + "icons/checkbox.svg",
    html: '<label class="checkbox"><input type="checkbox"> Checkbox</label>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});
Vvveb.Components.extend("_base", "html/fileinput", {
    name: "Input group",
    attributes: {"type": "file"},
    image: asseturlt + "libs/builder/" + "icons/text_input.svg",
    html: '<div class="form-group">\
			  <input type="file" class="form-control">\
			</div>'
});
Vvveb.Components.extend("_base", "html/table", {
    nodes: ["table"],
    classes: ["table"],
    image: asseturlt + "libs/builder/" + "icons/table.svg",
    name: "جدول",
    html: '<table class="table">\
		  <thead>\
			<tr>\
			  <th>#</th>\
			  <th>نام</th>\
			  <th>نام خانوادگی</th>\
			  <th>نام کاربری</th>\
			</tr>\
		  </thead>\
		  <tbody>\
			<tr>\
			  <th scope="row">1</th>\
			  <td>امین</td>\
			  <td>شکیبایی</td>\
			  <td>@ash</td>\
			</tr>\
			<tr>\
			  <th scope="row">2</th>\
			  <td>احمد</td>\
			  <td>سیروسی</td>\
			  <td>@a-siroos</td>\
			</tr>\
			<tr>\
			  <th scope="row">3</th>\
			  <td>هانیه</td>\
			  <td>توسلی</td>\
			  <td>@haniye-t</td>\
			</tr>\
		  </tbody>\
		</table>',
    properties: [
        {
            name: "نوع",
            key: "type",
            htmlAttr: "class",
            validValues: ["table-primary", "table-secondary", "table-success", "table-danger", "table-warning", "table-info", "table-light", "table-dark", "table-white"],
            inputtype: SelectInput,
            data: {
                options: [{
                    value: "Default",
                    text: ""
                }, {
                    value: "table-primary",
                    text: "اصلی"
                }, {
                    value: "table-secondary",
                    text: "جانبی"
                }, {
                    value: "table-success",
                    text: "موفق"
                }, {
                    value: "table-danger",
                    text: "خطر"
                }, {
                    value: "table-warning",
                    text: "اخطار"
                }, {
                    value: "table-info",
                    text: "اطلاعات"
                }, {
                    value: "table-light",
                    text: "روشن"
                }, {
                    value: "table-dark",
                    text: "تاریک"
                }, {
                    value: "table-white",
                    text: "سفید"
                }]
            }
        },
        {
            name: "واکنش گرایی(Responsive)",
            key: "responsive",
            htmlAttr: "class",
            validValues: ["table-responsive"],
            inputtype: ToggleInput,
            data: {
                on: "table-responsive",
                off: ""
            }
        },
        {
            name: "کوچک",
            key: "small",
            htmlAttr: "class",
            validValues: ["table-sm"],
            inputtype: ToggleInput,
            data: {
                on: "table-sm",
                off: ""
            }
        },
        {
            name: "Hover",
            key: "hover",
            htmlAttr: "class",
            validValues: ["table-hover"],
            inputtype: ToggleInput,
            data: {
                on: "table-hover",
                off: ""
            }
        },
        {
            name: "Bordered",
            key: "bordered",
            htmlAttr: "class",
            validValues: ["table-bordered"],
            inputtype: ToggleInput,
            data: {
                on: "table-bordered",
                off: ""
            }
        },
        {
            name: "Striped",
            key: "striped",
            htmlAttr: "class",
            validValues: ["table-striped"],
            inputtype: ToggleInput,
            data: {
                on: "table-striped",
                off: ""
            }
        },
        {
            name: "Inverse",
            key: "inverse",
            htmlAttr: "class",
            validValues: ["table-inverse"],
            inputtype: ToggleInput,
            data: {
                on: "table-inverse",
                off: ""
            }
        },
        {
            name: "Head options",
            key: "head",
            htmlAttr: "class",
            child: "thead",
            inputtype: SelectInput,
            validValues: ["", "thead-inverse", "thead-default"],
            data: {
                options: [{
                    value: "",
                    text: "None"
                }, {
                    value: "thead-default",
                    text: "Default"
                }, {
                    value: "thead-inverse",
                    text: "Inverse"
                }]
            }
        }]
});
Vvveb.Components.extend("_base", "html/tablerow", {
    nodes: ["tr"],
    name: "ردیف جدول",
    html: "<tr><td>Cell 1</td><td>Cell 2</td><td>Cell 3</td></tr>",
    properties: [{
        name: "نوع",
        key: "type",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["", "success", "danger", "warning", "active"],
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "success",
                text: "موفق"
            }, {
                value: "error",
                text: "خطا"
            }, {
                value: "warning",
                text: "اخطار"
            }, {
                value: "active",
                text: "فعال"
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/tablecell", {
    nodes: ["td"],
    name: "سلول جدول",
    html: "<td>Cell</td>"
});
Vvveb.Components.extend("_base", "html/tableheadercell", {
    nodes: ["th"],
    name: "سلول تیتر جدول",
    html: "<th>Head</th>"
});
Vvveb.Components.extend("_base", "html/tablehead", {
    nodes: ["thead"],
    name: "تیتر جدول",
    html: "<thead><tr><th>Head 1</th><th>Head 2</th><th>Head 3</th></tr></thead>",
    properties: [{
        name: "نوع",
        key: "type",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["", "success", "danger", "warning", "info"],
        data: {
            options: [{
                value: "",
                text: "پیش فرض"
            }, {
                value: "success",
                text: "موفق"
            }, {
                value: "anger",
                text: "خطار"
            }, {
                value: "warning",
                text: "اخطار"
            }, {
                value: "info",
                text: "اطلاعات"
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/tablebody", {
    nodes: ["tbody"],
    name: "بدنه ی جدول",
    html: "<tbody><tr><td>Cell 1</td><td>Cell 2</td><td>Cell 3</td></tr></tbody>"
});

Vvveb.Components.add("html/gridcolumn", {
    name: "ستون شبکه (Grid Column)",
    image: asseturlt + "libs/builder/" + "icons/grid_row.svg",
    classesRegex: ["col-"],
    html: '<div class="col-sm-4"><h3>col-sm-4</h3></div>',
    properties: [{
        name: "ستون",
        key: "column",
        inputtype: GridInput,
        data: {hide_remove: true},

        beforeInit: function (node) {
            _class = $(node).attr("class");

            var reg = /col-([^-\$ ]*)?-?(\d+)/g;
            var match;

            while ((match = reg.exec(_class)) != null) {
                this.data["col" + ((match[1] != undefined) ? "_" + match[1] : "")] = match[2];
            }
        },

        onChange: function (node, value, input) {
            var _class = node.attr("class");

            //remove previous breakpoint column size
            _class = _class.replace(new RegExp(input.name + '-\\d+?'), '');
            //add new column size
            if (value) _class += ' ' + input.name + '-' + value;
            node.attr("class", _class);

            return node;
        },
    }]
});
Vvveb.Components.add("html/gridrow", {
    name: "ردیف شبکه(GridRow)",
    image: asseturlt + "libs/builder/" + "icons/grid_row.svg",
    classes: ["row"],
    html: '<div class="row"><div class="col-sm-4"><h3>col-sm-4</h3></div><div class="col-sm-4 col-5"><h3>col-sm-4</h3></div><div class="col-sm-4"><h3>col-sm-4</h3></div></div>',
    children: [{
        name: "html/gridcolumn",
        classesRegex: ["col-"],
    }],
    beforeInit: function (node) {
        properties = [];
        var i = 0;
        var j = 0;

        $(node).find('[class*="col-"]').each(function () {
            _class = $(this).attr("class");

            var reg = /col-([^-\$ ]*)?-?(\d+)/g;
            var match;
            var data = {};

            while ((match = reg.exec(_class)) != null) {
                data["col" + ((match[1] != undefined) ? "_" + match[1] : "")] = match[2];
            }

            i++;
            properties.push({
                name: "Column " + i,
                key: "column" + i,
                //index: i - 1,
                columnNode: this,
                col: 12,
                inline: true,
                inputtype: GridInput,
                data: data,
                onChange: function (node, value, input) {

                    //column = $('[class*="col-"]:eq(' + this.index + ')', node);
                    var column = $(this.columnNode);

                    //if remove button is clicked remove column and render row properties
                    if (input.nodeName == 'BUTTON') {
                        column.remove();
                        Vvveb.Components.render("html/gridrow");
                        return node;
                    }

                    //if select input then change column class
                    _class = column.attr("class");

                    //remove previous breakpoint column size
                    _class = _class.replace(new RegExp(input.name + '-\\d+?'), '');
                    //add new column size
                    if (value) _class += ' ' + input.name + '-' + value;
                    column.attr("class", _class);

                    //console.log(this, node, value, input, input.name);

                    return node;
                },
            });
        });

        //remove all column properties
        this.properties = this.properties.filter(function (item) {
            return item.key.indexOf("column") === -1;
        });

        //add remaining properties to generated column properties
        properties.push(this.properties[0]);

        this.properties = properties;
        return node;
    },

    properties: [{
        name: "ستون",
        key: "column1",
        inputtype: GridInput
    }, {
        name: "ستون",
        key: "column1",
        inline: true,
        col: 12,
        inputtype: GridInput
    }, {
        name: "",
        key: "addChild",
        inputtype: ButtonInput,
        data: {text: "Add column", icon: "la la-plus"},
        onChange: function (node) {
            $(node).append('<div class="col-3">Col-3</div>');

            //render component properties again to include the new column inputs
            Vvveb.Components.render("html/gridrow");

            return node;
        }
    }]
});


Vvveb.Components.extend("_base", "html/paragraph", {
    nodes: ["p"],
    name: "پاراگراف",
    image: asseturlt + "libs/builder/" + "icons/paragraph.svg",
    html: '<p>Lorem ipsum</p>',
    properties: [{
        name: "ترتیب متن",
        key: "text-align",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["", "text-left", "text-center", "text-right"],
        inputtype: RadioButtonInput,
        data: {
            extraclass: "btn-group-sm btn-group-fullwidth",
            options: [{
                value: "",
                icon: "la la-close",
                //text: "None",
                title: "پیش فرض",
                checked: true,
            }, {
                value: "left",
                //text: "Left",
                title: "چپ",
                icon: "la la-align-left",
                checked: false,
            }, {
                value: "text-center",
                //text: "Center",
                title: "وسط",
                icon: "la la-align-center",
                checked: false,
            }, {
                value: "text-right",
                //text: "Right",
                title: "راست",
                icon: "la la-align-right",
                checked: false,
            }],
        },
    }]
});

Vvveb.Components.extend("_base", "html/video", {
    nodes: ["video"],
    name: "ویدیو",
    html: '<video width="320" height="240" playsinline loop autoplay><source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4"><video>',
    dragHtml: '<img  width="320" height="240" src="' + Vvveb.baseUrl + 'icons/video.svg">',
    image: asseturlt + "libs/builder/" + "icons/video.svg",
    properties: [{
        name: "لینک منبع",
        child: "source",
        key: "src",
        htmlAttr: "src",
        inputtype: LinkInput
    }, {
        name: "عرض",
        key: "width",
        htmlAttr: "width",
        inputtype: TextInput
    }, {
        name: "طول",
        key: "height",
        htmlAttr: "height",
        inputtype: TextInput
    }, {
        name: "بدون صدا",
        key: "muted",
        htmlAttr: "muted",
        inputtype: CheckboxInput
    }, {
        name: "تکرار",
        key: "loop",
        htmlAttr: "loop",
        inputtype: CheckboxInput
    }, {
        name: "پخض خودکار",
        key: "autoplay",
        htmlAttr: "autoplay",
        inputtype: CheckboxInput
    }, {
        name: "Plays inline",
        key: "playsinline",
        htmlAttr: "playsinline",
        inputtype: CheckboxInput
    }, {
        name: "کنترلر ها",
        key: "controls",
        htmlAttr: "controls",
        inputtype: CheckboxInput
    }]
});


Vvveb.Components.extend("_base", "html/button", {
    nodes: ["button"],
    name: "Html Button",
    image: asseturlt + "libs/builder/" + "icons/button.svg",
    html: '<button>Button</button>',
    properties: [{
        name: "Text",
        key: "text",
        htmlAttr: "innerHTML",
        inputtype: TextInput
    }, {
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }, {
        name: "Type",
        key: "type",
        htmlAttr: "type",
        inputtype: SelectInput,
        data: {
            options: [{
                value: "button",
                text: "button"
            }, {
                value: "reset",
                text: "reset"
            }, {
                value: "submit",
                text: "submit"
            }],
        }
    }, {
        name: "Autofocus",
        key: "autofocus",
        htmlAttr: "autofocus",
        inputtype: CheckboxInput
    }, {
        name: "Disabled",
        key: "disabled",
        htmlAttr: "disabled",
        inputtype: CheckboxInput
    }]
});

Vvveb.Components.extend("_base", "_base", {
    properties: [
        {
            name: "خانواده ی فونت",
            key: "font-family",
            htmlAttr: "style",
            sort: base_sort++,
            col: 6,
            inline: true,
            inputtype: SelectInput,
            data: {
                options: [{
                    value: "",
                    text: "extended"
                }, {
                    value: "Ggoogle ",
                    text: "google"
                }]
            }
        }]
});
