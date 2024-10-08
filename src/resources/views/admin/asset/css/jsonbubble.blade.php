<style>
    /*body, html {*/
    /*    background: #444;*/
    /*    font-family: verdana, arial, sans-serif;*/
    /*    font-size: 12px;*/
    /*    color: #444;*/
    /*    background: #333;*/
    /*    padding: 0px;*/
    /*    margin: 0px;*/
    /*}*/

    .rounded {
        -moz-border-radius: 5px;
        border-radius: 5px;
        padding: 5px;
    }
    div#toparea {
        height: 70px;
        background: #FFC77D;
        margin: 10px;
    }
    #inputarea {
        width: 200px;
        float:left;
        background: #DEC2FC;
        margin: 5px 10px;
    }
    #inputarea textarea {
        font-size: 12px;
        border: 1px solid #706280;
        background: #F0E3FF;
        padding: 3px;
        width: 198px;
    }
    #toolarea {
        background: #555;
        width: 50px;
        height: 200px;
        float:left;
        margin: 5px 10px 0px 0px;
        bottom: 10px;
    }
    /*#editarea {*/
    /*    margin: 5px;*/
    /*    bottom: 10px;*/
    /*    left: 300px;*/
    /*    position: absolute;*/
    /*    right: 10px;*/
    /*    top: 100px;*/
    /*    width: auto;*/
    /*    background: #fff;*/
    /*    padding: 5px 40px 10px 5px;*/
    /*    overflow: auto;*/
    /*}*/
    /*#editarea div {*/
    /*    margin-right: 20px;*/
    /*    font-family: courier;*/
    /*}*/
    /*#toparea h1 {*/
    /*    color: #333333;*/
    /*    float: right;*/
    /*    font-size: 50pt;*/
    /*    position: absolute;*/
    /*    top: 26px;*/
    /*    right: 8px;*/
    /*    margin: 0px;*/
    /*}*/
    /*div {*/
    /*    padding: 1px;*/
    /*    margin: 2px 2px 2px 2px;*/
    /*    border-radius: 5px;*/
    /*}*/
    #json_editor {
        background: #fff;
    }
    #json_editor span {
        margin: 2px;
        padding:1px;
    }
    div[data-type="object"] {
        border: 1px solid #fcc;
        padding-bottom: 8px;
    }
    div[data-type="array"] {
        border: 1px solid #ccf;
        padding-bottom: 8px;
    }
    div[data-role="arrayitem"] > div  {
        margin: 2px;
    }
    [data-type="string"] {
        color: #4AA150;
    }
    pre {
        display: inline;
        margin: 2px;
        font-family: courier;
        white-space: pre-wrap;
    }
    [data-type="number"] {
        color: #D67B13;
    }
    [data-type="null"] {
        color: #919191;
    }
    [data-type="boolean"] {
        color: #FA6B8F;
    }
    div[data-role="value"] {
        margin-left: 20px;
    }
    div[data-role="prop"], div[data-role="arrayitem"] {
    //border: 0px solid #ccf;
        margin: 1px;
        padding: 1px;
        color: #4155A6;
    }
    span[data-role="key"] {
        min-width:100px;
    }
    .edit_box {
        display: inline-block;
        padding: 0px;
        margin: 0px;
    }
    .collapse_box {
        font-size: 6pt;
        color: #999;
        padding: 0px;
        margin: 0px;
        cursor: pointer;
    }
    .dimmed {
        opacity:0.4;filter:alpha(opacity=40);
        background; #999;
    }
    #toolarea a {
        color: #EDAF42;
        text-decoration: none;
        border: 1px solid #333;
        width: 20px;
        padding: 2px 10px;
        margin: 2px 0px;
        display: inline-block;
        border-radius: 3px;
        background: #666;
    }
    #toolarea a:hover {
        background: A37931;
        color: #444;
    }


    /* all context menus have this class */
    .context-menu {
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;

        background-color: #f2f2f2;
        border: 1px solid #999;

        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .context-menu a {
        display: block;
        padding: 3px;
        text-decoration: none;
        color: #333;
    }
    .context-menu a:hover {
        background-color: #666;
        color: white;
    }
    /* Z-index of #mask must lower than #boxes .window */
    #mask {
        position:absolute;
        z-index:9000;
        background-color:#000;
        display:none;
        top: 0px;
        bottom: 0px;
        right: 0px;
        left:0px;
    }
    #boxes .window {
        position:absolute;
        width:440px;
        height:200px;
        display:none;
        z-index:9999;
        padding:20px;
    }
    #dialog a.close {
        color: #EDAF42;
        text-decoration: none;
        border: 1px solid #333;
        padding: 2px 10px;
        margin: 2px 0px;
        display: inline-block;
        border-radius: 3px;
        background: #666;
        float:right
    }
    #dialog a.close:hover {
        background: A37931;
        color: #444;
    }

    #past_ws {
        height: 168px;
        overflow: auto;
    }
    /* Customize your modal window here, you can add background image too */
    #boxes #dialog {
        width:375px;
        height:203px;
        background: #fff;
    }
    div[data-type="object"] > div.inline_add_box {
        border: 1px solid #fcc;
    }
    div[data-type="array"] > div.inline_add_box {
        border: 1px solid #ccf;
    }
    div.inline_add_box {
        margin: 5px 0px 0px -2px;
        border-radius: 3px;
        background: white;
        min-width: 20px;
        color: #AAA;
        text-align: center;
        padding: 0px;
        font-family: Verdana !important;
        font-size: 9px;
        float: right;
        position: absolute;
        border: 1px solid;
        min-height: 4px;
        max-height: 16px;
        overflow: hidden;
    }
    div.inline_add_box a {
        color: #7aa;
        font-size: 10px;
        cursor: pointer;
        text-decoration: none;
    }
    div.inline_add_box a:hover {
        color: #366;
    }
    div.add_box_content {
        display: none;
        padding: 0px;
        margin: 2px;
        padding-left: 5px;
        text-align: center;
        cursor: default;
    }

</style>

