!function(){"use strict";var t=window.wp.element;function e(){let e=function(t,e){const i=[];return function t(e){"ocean-typography"===e.type&&i.push(e);for(const i in e)e[i]&&"object"==typeof e[i]&&t(e[i])}(t),i}(oceanCustomizePreview.options);return(0,t.useEffect)((()=>{e.forEach((t=>{const e={fontFamily:"",fontSize:"",fontSizeTablet:"",fontSizeMobile:"",fontSizeUnit:"px",fontWeight:"",fontWeightTablet:"",fontWeightMobile:"",lineHeight:"",lineHeightTablet:"",lineHeightMobile:"",lineHeightUnit:"",letterSpacing:"",letterSpacingTablet:"",letterSpacingMobile:"",letterSpacingUnit:"",textTransform:"",textTransformTablet:"",textTransformMobile:"",textColor:"",textColorHover:""};for(const n in t.setting_args)wp.customize(t.setting_args[n].id,(o=>{o.bind((o=>{"fontFamily"===n?e.fontFamily=o:"fontSize"===n?e.fontSize=o:"fontSizeTablet"===n?e.fontSizeTablet=o:"fontSizeMobile"===n?e.fontSizeMobile=o:"fontSizeUnit"===n?e.fontSizeUnit=o:"fontWeight"===n?e.fontWeight=o:"fontWeightTablet"===n?e.fontWeightTablet=o:"fontWeightMobile"===n?e.fontWeightMobile=o:"lineHeight"===n?e.lineHeight=o:"lineHeightTablet"===n?e.lineHeightTablet=o:"lineHeightMobile"===n?e.lineHeightMobile=o:"lineHeightUnit"===n?e.lineHeightUnit=o:"letterSpacing"===n?e.letterSpacing=o:"letterSpacingTablet"===n?e.letterSpacingTablet=o:"letterSpacingMobile"===n?e.letterSpacingMobile=o:"letterSpacingUnit"===n?e.letterSpacingUnit=o:"textTransform"===n?e.textTransform=o:"textTransformTablet"===n?e.textTransformTablet=o:"textTransformMobile"===n?e.textTransformMobile=o:"textColor"===n?e.textColor=o:"textColorHover"===n&&(e.textColorHover=o),i(t.selector,e,t.id)}))}))}))}),[]),(0,t.useEffect)((()=>()=>{e.forEach((t=>{const e=document.getElementById(`ocean-preview-typography-${t.id}`);e&&document.head.removeChild(e)}))}),[e]),null}function i(t,e,i){const n=[],o=[],l=[];e.fontFamily&&n.push(`font-family: ${e.fontFamily};`),e.fontSize&&e.fontSizeUnit&&n.push(`font-size: ${e.fontSize}${e.fontSizeUnit};`),e.fontSizeTablet&&e.fontSizeUnit&&o.push(`font-size: ${e.fontSizeTablet}${e.fontSizeUnit};`),e.fontSizeMobile&&e.fontSizeUnit&&l.push(`font-size: ${e.fontSizeMobile}${e.fontSizeUnit};`),e.fontWeight&&n.push(`font-weight: ${e.fontWeight};`),e.fontWeightTablet&&o.push(`font-weight: ${e.fontWeightTablet};`),e.fontWeightMobile&&l.push(`font-weight: ${e.fontWeightMobile};`),e.lineHeight&&e.lineHeightUnit&&n.push(`line-height: ${e.lineHeight}${e.lineHeightUnit};`),e.lineHeightTablet&&e.lineHeightUnit&&o.push(`line-height: ${e.lineHeightTablet}${e.lineHeightUnit};`),e.lineHeightMobile&&e.lineHeightUnit&&l.push(`line-height: ${e.lineHeightMobile}${e.lineHeightUnit};`),e.letterSpacing&&e.letterSpacingUnit&&n.push(`letter-spacing: ${e.letterSpacing}${e.letterSpacingUnit};`),e.letterSpacingTablet&&e.letterSpacingUnit&&o.push(`letter-spacing: ${e.letterSpacingTablet}${e.letterSpacingUnit};`),e.letterSpacingMobile&&e.letterSpacingUnit&&l.push(`letter-spacing: ${e.letterSpacingMobile}${e.letterSpacingUnit};`),e.textTransform&&n.push(`font-weight: ${e.textTransform};`),e.textTransformTablet&&o.push(`font-weight: ${e.textTransformTablet};`),e.textTransformMobile&&l.push(`font-weight: ${e.textTransformMobile};`),e.textColor&&n.push(`color: ${e.textColor};`);const r=n.join(" "),a=o.join(" "),f=l.join(" "),g=document.createElement("style");g.id=`ocean-preview-typography-${i}`,g.textContent=`${t} { ${r} }`,a&&(g.textContent+=`@media (max-width: 768px) { ${t} { ${a} }}`),f&&(g.textContent+=`@media (max-width: 480px) { ${t} { ${f} }}`),e.textColorHover&&(g.textContent+=`${t}:hover { color: ${e.textColorHover}; }`);const h=document.getElementById(g.id);h?document.head.replaceChild(g,h):document.head.appendChild(g)}window.addEventListener("DOMContentLoaded",(()=>{const i=document.createElement("style");"function"==typeof t.createRoot?(0,t.createRoot)(i).render((0,t.createElement)(e,null)):(0,t.render)((0,t.createElement)(e,null),i)}))}();