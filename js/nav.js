// ===== Hamburger menu =====
(function(){
  var hamburger=document.getElementById('hamburger');
  var overlay=document.getElementById('navOverlay');
  if(!hamburger||!overlay)return;
  hamburger.addEventListener('click',function(){
    hamburger.classList.toggle('open');
    overlay.classList.toggle('open');
    document.body.style.overflow=overlay.classList.contains('open')?'hidden':'';
  });
  overlay.querySelectorAll('a').forEach(function(a){
    a.addEventListener('click',function(){
      hamburger.classList.remove('open');
      overlay.classList.remove('open');
      document.body.style.overflow='';
    });
  });
})();
