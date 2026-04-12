// ===== Scroll animations (IntersectionObserver) =====
(function(){
  var observer=new IntersectionObserver(function(entries){
    entries.forEach(function(e){if(e.isIntersecting)e.target.classList.add('visible')});
  },{threshold:0.05});
  document.querySelectorAll('.fade-up,.fade-in,.slide-left,.slide-right,.scale-in').forEach(function(el){
    observer.observe(el);
  });
})();
