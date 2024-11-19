!function(e){const t=e.en=e.en||{};t.dictionary=Object.assign(t.dictionary||{},{"Could not insert image at the current position.":"Could not insert image at the current position.","Could not obtain resized image URL.":"Could not obtain resized image URL.","Insert image or file":"Insert image or file","Inserting image failed":"Inserting image failed","Selecting resized image failed":"Selecting resized image failed"})}(window.CKEDITOR_TRANSLATIONS||(window.CKEDITOR_TRANSLATIONS={})),
/*!
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md.
 */(()=>{var e={782:(e,t,i)=>{e.exports=i(237)("./src/core.js")},311:(e,t,i)=>{e.exports=i(237)("./src/ui.js")},584:(e,t,i)=>{e.exports=i(237)("./src/utils.js")},237:e=>{"use strict";e.exports=CKEditor5.dll}},t={};function i(n){var o=t[n];if(void 0!==o)return o.exports;var r=t[n]={exports:{}};return e[n](r,r.exports,i),r.exports}i.d=(e,t)=>{for(var n in t)i.o(t,n)&&!i.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},i.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),i.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})};var n={};(()=>{"use strict";i.r(n),i.d(n,{CKFinder:()=>l,CKFinderEditing:()=>c,CKFinderUI:()=>o});var e=i(782),t=i(311);class o extends e.Plugin{static get pluginName(){return"CKFinderUI"}init(){const e=this.editor;e.ui.componentFactory.add("ckfinder",(()=>this._createFileToolbarButton())),e.ui.componentFactory.add("menuBar:ckfinder",(()=>this._createFileMenuBarButton())),e.plugins.has("ImageInsertUI")&&e.plugins.get("ImageInsertUI").registerIntegration({name:"assetManager",observable:()=>e.commands.get("ckfinder"),buttonViewCreator:()=>this._createImageToolbarButton(),formViewCreator:()=>this._createImageDropdownButton(),menuBarButtonViewCreator:e=>this._createImageMenuBarButton(e?"insertOnly":"insertNested")})}_createButton(e){const t=this.editor,i=new e(t.locale),n=t.commands.get("ckfinder");return i.bind("isEnabled").to(n),i.on("execute",(()=>{t.execute("ckfinder"),t.editing.view.focus()})),i}_createFileToolbarButton(){const i=this.editor.locale.t,n=this._createButton(t.ButtonView);return n.icon=e.icons.browseFiles,n.label=i("Insert image or file"),n.tooltip=!0,n}_createImageToolbarButton(){const i=this.editor.locale.t,n=this.editor.plugins.get("ImageInsertUI"),o=this._createButton(t.ButtonView);return o.icon=e.icons.imageAssetManager,o.bind("label").to(n,"isImageSelected",(e=>i(e?"Replace image with file manager":"Insert image with file manager"))),o.tooltip=!0,o}_createImageDropdownButton(){const i=this.editor.locale.t,n=this.editor.plugins.get("ImageInsertUI"),o=this._createButton(t.ButtonView);return o.icon=e.icons.imageAssetManager,o.withText=!0,o.bind("label").to(n,"isImageSelected",(e=>i(e?"Replace with file manager":"Insert with file manager"))),o.on("execute",(()=>{n.dropdownView.isOpen=!1})),o}_createFileMenuBarButton(){const i=this.editor.locale.t,n=this._createButton(t.MenuBarMenuListItemButtonView);return n.icon=e.icons.browseFiles,n.withText=!0,n.label=i("File"),n}_createImageMenuBarButton(i){const n=this.editor.locale.t,o=this._createButton(t.MenuBarMenuListItemButtonView);switch(o.icon=e.icons.imageAssetManager,o.withText=!0,i){case"insertOnly":o.label=n("Image");break;case"insertNested":o.label=n("With file manager")}return o}}var r=i(584);class s extends e.Command{constructor(e){super(e),this.affectsData=!1,this.stopListening(this.editor.model.document,"change"),this.listenTo(this.editor.model.document,"change",(()=>this.refresh()),{priority:"low"})}refresh(){const e=this.editor.commands.get("insertImage"),t=this.editor.commands.get("link");this.isEnabled=e.isEnabled||t.isEnabled}execute(){const e=this.editor,t=this.editor.config.get("ckfinder.openerMethod")||"modal";if("popup"!=t&&"modal"!=t)throw new r.CKEditorError("ckfinder-unknown-openermethod",e);const i=this.editor.config.get("ckfinder.options")||{};i.chooseFiles=!0;const n=i.onInit;i.language||(i.language=e.locale.uiLanguage),i.onInit=t=>{n&&n(t),t.on("files:choose",(i=>{const n=i.data.files.toArray(),o=n.filter((e=>!e.isImage())),r=n.filter((e=>e.isImage()));for(const t of o)e.execute("link",t.getUrl());const s=[];for(const e of r){const i=e.getUrl();s.push(i||t.request("file:getProxyUrl",{file:e}))}s.length&&a(e,s)})),t.on("file:choose:resizedImage",(t=>{const i=t.data.resizedUrl;if(i)a(e,[i]);else{const t=e.plugins.get("Notification"),i=e.locale.t;t.showWarning(i("Could not obtain resized image URL."),{title:i("Selecting resized image failed"),namespace:"ckfinder"})}}))},window.CKFinder[t](i)}}function a(e,t){if(e.commands.get("insertImage").isEnabled)e.execute("insertImage",{source:t});else{const t=e.plugins.get("Notification"),i=e.locale.t;t.showWarning(i("Could not insert image at the current position."),{title:i("Inserting image failed"),namespace:"ckfinder"})}}class c extends e.Plugin{static get pluginName(){return"CKFinderEditing"}static get requires(){return[t.Notification,"LinkEditing"]}init(){const e=this.editor;if(!e.plugins.has("ImageBlockEditing")&&!e.plugins.has("ImageInlineEditing"))throw new r.CKEditorError("ckfinder-missing-image-plugin",e);e.commands.add("ckfinder",new s(e))}}class l extends e.Plugin{static get pluginName(){return"CKFinder"}static get requires(){return["Link","CKFinderUploadAdapter",c,o]}}})(),(window.CKEditor5=window.CKEditor5||{}).ckfinder=n})();