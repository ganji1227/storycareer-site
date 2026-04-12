// ===== Custom cursor: particle glow =====
// Initializes immediately to minimize flash of default cursor
// Inline style already hides cursor via *{cursor:none!important} in <head>
(function(){
  // Ensure cursor is hidden even before CSS fully loads
  document.documentElement.style.cursor='none';
  var cursorCanvas=document.createElement('canvas');
  cursorCanvas.style.cssText='position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:9999;pointer-events:none';
  document.body.appendChild(cursorCanvas);
  var cctx=cursorCanvas.getContext('2d');
  var mx=-100,my=-100;
  var trail=[];
  var clickPulse=0;
  var clickPulseTarget=0,pendingClick=null;

  document.addEventListener('click',function(e){
    var link=e.target.closest('a[href]');
    if(link){
      e.preventDefault();
      clickPulseTarget=1;
      pendingClick=link;
    }else{
      clickPulseTarget=1;
      pendingClick=null;
    }
  });

  function cursorResize(){cursorCanvas.width=window.innerWidth;cursorCanvas.height=window.innerHeight}
  window.addEventListener('resize',cursorResize);
  cursorResize();
  document.addEventListener('mousemove',function(e){mx=e.clientX;my=e.clientY});
  document.addEventListener('mouseleave',function(){mx=-100;my=-100});

  var bc=[255,170,68];

  function drawCursor(){
    requestAnimationFrame(drawCursor);
    cctx.clearRect(0,0,cursorCanvas.width,cursorCanvas.height);
    if(mx<0)return;

    // Click pulse: slow rise to peak, then slow decay
    if(clickPulseTarget>0){
      clickPulse+=(clickPulseTarget-clickPulse)*0.1;
      if(clickPulse>0.93){
        clickPulseTarget=0;
        if(pendingClick){location.href=pendingClick.href;pendingClick=null}
      }
    }else{
      clickPulse*=0.985;
    }
    if(clickPulse<0.01)clickPulse=0;
    var pulseSize=1+clickPulse*2.5;
    var pulseAlpha=1+clickPulse*1.5;

    // Trail
    trail.push({x:mx,y:my,alpha:1,size:4+Math.random()*2});
    if(trail.length>12)trail.shift();
    for(var i=0;i<trail.length;i++){
      var p=trail[i];
      p.alpha*=0.85;
      p.size*=0.97;
      var gr=cctx.createRadialGradient(p.x,p.y,0,p.x,p.y,p.size*4);
      gr.addColorStop(0,'rgba('+bc[0]+','+bc[1]+','+bc[2]+','+p.alpha*0.4+')');
      gr.addColorStop(1,'rgba('+bc[0]+','+bc[1]+','+bc[2]+',0)');
      cctx.fillStyle=gr;
      cctx.beginPath();cctx.arc(p.x,p.y,p.size*4,0,Math.PI*2);cctx.fill();
      cctx.beginPath();
      cctx.arc(p.x,p.y,p.size*0.5,0,Math.PI*2);
      cctx.fillStyle='rgba('+bc[0]+','+bc[1]+','+bc[2]+','+p.alpha*0.9+')';
      cctx.fill();
    }

    // Main glow
    var glowR=20*pulseSize;
    var gr2=cctx.createRadialGradient(mx,my,0,mx,my,glowR);
    gr2.addColorStop(0,'rgba('+bc[0]+','+bc[1]+','+bc[2]+','+Math.min(1,0.6*pulseAlpha)+')');
    gr2.addColorStop(0.4,'rgba('+bc[0]+','+bc[1]+','+bc[2]+','+Math.min(0.5,0.15*pulseAlpha)+')');
    gr2.addColorStop(1,'rgba('+bc[0]+','+bc[1]+','+bc[2]+',0)');
    cctx.fillStyle=gr2;
    cctx.beginPath();cctx.arc(mx,my,glowR,0,Math.PI*2);cctx.fill();

    // Core dot
    cctx.beginPath();
    cctx.arc(mx,my,3*pulseSize,0,Math.PI*2);
    cctx.fillStyle='rgba(255,255,255,'+Math.min(1,0.9*pulseAlpha)+')';
    cctx.fill();
  }
  drawCursor();
})();
