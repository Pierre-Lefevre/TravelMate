;document.addEventListener('DOMContentLoaded',function(){var t=document.querySelectorAll('.form-add-edit .second-column select:nth-of-type(2) option');for(var e=0;e<t.length;e++){var o=document.createElement('div');o.classList.add('flag');o.classList.add('flag-'+t[e].value.toLowerCase());t[e].insertBefore(o,t[e].firstChild)}});
(function(e){if(typeof define==="function"&&define.amd){define(["../widgets/datepicker"],e)}
else{e(jQuery.datepicker)}}(function(e){e.regional.fr={closeText:"Fermer",prevText:"Précédent",nextText:"Suivant",currentText:"Aujourd'hui",monthNames:["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"],monthNamesShort:["janv.","févr.","mars","avr.","mai","juin","juil.","août","sept.","oct.","nov.","déc."],dayNames:["dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi"],dayNamesShort:["dim.","lun.","mar.","mer.","jeu.","ven.","sam."],dayNamesMin:["D","L","M","M","J","V","S"],weekHeader:"Sem.",dateFormat:"dd/mm/yy",firstDay:1,isRTL:!1,showMonthAfterYear:!1,yearSuffix:""};e.setDefaults(e.regional.fr);return e.regional.fr}));
;document.addEventListener("DOMContentLoaded",function(){var e=document.querySelectorAll(".open-modal-button");for(var t=0;t<e.length;t++){(function(){var n=document.querySelector(".modal[data-modal='"+e[t].getAttribute("data-modal")+"']"),o=document.querySelector(".close-modal-button[data-modal='"+e[t].getAttribute("data-modal")+"']");e[t].addEventListener("click",function(){n.style.display="flex"});o.addEventListener("click",function(){n.style.display="none"});window.addEventListener("click",function(t){if(t.target===n){n.style.display="none"}})}())}});
;document.addEventListener('DOMContentLoaded',function(){var t=document.querySelectorAll('.form-search select');for(var e=0;e<t.length;e++){if(t[e].value===''){t[e].style.color='#919191'};t[e].addEventListener('change',function(){if(this.value!==''){this.style.color='#000000'}
else{this.style.color='#919191'}})}});