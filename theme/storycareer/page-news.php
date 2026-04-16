<?php /* Template Name: お知らせ */ ?>
<?php get_header(); ?>

<style>
html{scroll-behavior:smooth}
body{background:#f5f4f0;overflow-x:hidden;font-family:'Noto Sans JP','Helvetica Neue',Arial,sans-serif;color:rgba(10,10,10,0.75);min-height:100vh;display:flex;flex-direction:column}

/* ===== Hero ===== */
.page-hero{padding:180px 0 80px;text-align:center}
.page-hero-label{font-family:'Noto Sans JP',sans-serif;font-size:0.75rem;letter-spacing:0.3em;text-transform:uppercase;color:rgba(10,10,10,0.4);margin-bottom:1rem;font-weight:400}
.page-hero-title{font-family:'Noto Serif JP',serif;font-weight:300;font-size:clamp(1.5rem,3vw,2.2rem);color:rgba(10,10,10,1);letter-spacing:0.15em;line-height:1.8}
.page-hero-sub{font-family:'Noto Sans JP',sans-serif;font-weight:300;font-size:clamp(0.8rem,1vw,0.9rem);color:rgba(10,10,10,0.5);letter-spacing:0.06em;margin-top:1.5rem;line-height:1.9}
.page-hero-line{width:40px;height:1px;background:linear-gradient(90deg,transparent,rgba(210,100,30,0.4),transparent);margin:2.5rem auto 0}

/* ===== Articles ===== */
.articles-section{padding:40px 0 120px;flex:1}
.articles-inner{max-width:900px;margin:0 auto;padding:0 40px}
.article-list{list-style:none}
.article-item{border-bottom:1px solid rgba(10,10,10,0.06);padding:28px 0;transition:background 0.3s}
.article-item-link{display:flex;gap:24px;align-items:flex-start;text-decoration:none;color:inherit}
.article-item:hover{background:rgba(255,255,255,0.5);margin:0 -16px;padding-left:16px;padding-right:16px;border-radius:8px}
.article-thumb{width:160px;height:100px;border-radius:8px;background:rgba(10,10,10,0.04);flex-shrink:0;overflow:hidden;display:flex;align-items:center;justify-content:center}
.article-thumb-placeholder{font-family:'Noto Sans JP',sans-serif;font-size:0.65rem;color:rgba(10,10,10,0.2);letter-spacing:0.1em}
.article-content{flex:1;min-width:0}
.article-meta{display:flex;gap:1rem;align-items:center;margin-bottom:0.5rem}
.article-date{font-family:'Noto Sans JP',sans-serif;font-weight:300;font-size:0.75rem;color:rgba(10,10,10,0.4);letter-spacing:0.05em}
.article-tag{font-family:'Noto Sans JP',sans-serif;font-weight:400;font-size:0.65rem;color:rgba(212,85,42,0.8);letter-spacing:0.08em;background:rgba(212,85,42,0.08);padding:2px 10px;border-radius:10px}
.article-title{font-family:'Noto Serif JP',serif;font-weight:300;font-size:clamp(0.95rem,1.2vw,1.1rem);color:rgba(10,10,10,0.9);letter-spacing:0.06em;line-height:1.7;margin-bottom:0.4rem}
.article-title a{color:inherit;text-decoration:none;transition:color 0.3s}
.article-title a:hover{color:rgba(212,85,42,0.9)}
.article-excerpt{font-family:'Noto Sans JP',sans-serif;font-weight:300;font-size:clamp(0.78rem,0.9vw,0.85rem);color:rgba(10,10,10,0.5);line-height:1.8;letter-spacing:0.03em;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}

/* ===== WordPress note ===== */
.wp-note{max-width:900px;margin:0 auto;padding:0 40px 60px;text-align:center}
.wp-note p{font-family:'Noto Sans JP',sans-serif;font-weight:300;font-size:0.8rem;color:rgba(10,10,10,0.3);letter-spacing:0.05em;line-height:1.8;background:rgba(10,10,10,0.02);padding:20px;border-radius:8px;border:1px dashed rgba(10,10,10,0.08)}

/* ===== Responsive ===== */
@media(max-width:768px){
  .page-hero{padding:140px 0 60px}
  .articles-section{padding:20px 0 80px}
  .articles-inner{padding:0 24px}
  .article-item{flex-direction:column;gap:12px}
  .article-item-link{flex-direction:column;gap:12px}
  .article-thumb{width:100%;height:160px}
}
/* ===== Category filter ===== */
.category-filter{max-width:900px;margin:0 auto;padding:0 40px;display:flex;flex-wrap:wrap;gap:0.6rem;margin-bottom:2rem}
.category-filter-btn{font-family:'Noto Sans JP',sans-serif;font-weight:400;font-size:0.75rem;letter-spacing:0.08em;color:rgba(10,10,10,0.45);background:transparent;border:1px solid rgba(10,10,10,0.1);padding:6px 18px;border-radius:20px;cursor:pointer;transition:all 0.3s}
.category-filter-btn:hover{border-color:rgba(10,10,10,0.2);color:rgba(10,10,10,0.7)}
.category-filter-btn.active{background:rgba(212,85,42,0.9);color:#fff;border-color:rgba(212,85,42,0.9)}
@media(max-width:768px){
  .category-filter{padding:0 24px}
}
</style>

<div class="page-hero">
  <p class="page-hero-label fade-up">News</p>
  <h1 class="page-hero-title fade-up" style="transition-delay:0.1s">お知らせ</h1>
  <p class="page-hero-sub fade-up" style="transition-delay:0.2s">STORY CAREERの最新情報をお届けします。</p>
  <div class="page-hero-line fade-up" style="transition-delay:0.3s"></div>
</div>

<div class="category-filter fade-up" id="categoryFilter" style="transition-delay:0.35s"></div>

<section class="articles-section">
  <div class="articles-inner">
    <ul class="article-list" id="articleList">
      <li class="article-item" style="text-align:center;padding:60px 0;color:rgba(10,10,10,0.3)">読み込み中...</li>
    </ul>
  </div>
</section>

<?php get_footer(); ?>

<script>
(function(){
  var API='<?php echo home_url('/wp-json/wp/v2/posts?per_page=100&_embed'); ?>';
  var list=document.getElementById('articleList');
  var filterWrap=document.getElementById('categoryFilter');
  var allPosts=[];
  var currentCat='all';

  function renderPosts(posts){
    list.innerHTML='';
    if(!posts.length){list.innerHTML='<li class="article-item" style="text-align:center;padding:60px 0;color:rgba(10,10,10,0.3)">記事はまだありません。</li>';return}
    posts.forEach(function(post,i){
      var date=new Date(post.date);
      var dateStr=date.getFullYear()+'.'+('0'+(date.getMonth()+1)).slice(-2)+'.'+('0'+date.getDate()).slice(-2);
      var thumb='';
      if(post._embedded&&post._embedded['wp:featuredmedia']&&post._embedded['wp:featuredmedia'][0]){
        var media=post._embedded['wp:featuredmedia'][0];
        var src=media.source_url;
        thumb='<img src="'+src+'" alt="" style="width:100%;height:100%;object-fit:cover">';
      }else{thumb='<span class="article-thumb-placeholder">IMAGE</span>'}
      var cats='';
      if(post._embedded&&post._embedded['wp:term']&&post._embedded['wp:term'][0]&&post._embedded['wp:term'][0][0]){cats=post._embedded['wp:term'][0][0].name}
      var excerpt=post.excerpt.rendered.replace(/<[^>]+>/g,'').substring(0,100);
      var link=post.link;
      var li=document.createElement('li');
      li.className='article-item fade-up';
      li.style.transitionDelay=(i*0.05)+'s';
      li.innerHTML='<a href="'+link+'" class="article-item-link">'
        +'<div class="article-thumb">'+thumb+'</div>'
        +'<div class="article-content">'
        +'<div class="article-meta"><span class="article-date">'+dateStr+'</span>'
        +(cats?'<span class="article-tag">'+cats+'</span>':'')
        +'</div>'
        +'<h2 class="article-title">'+post.title.rendered+'</h2>'
        +'<p class="article-excerpt">'+excerpt+'</p>'
        +'</div></a>';
      list.appendChild(li);
      setTimeout(function(){li.classList.add('visible')},50+i*50);
    });
  }

  function filterByCategory(catName){
    currentCat=catName;
    // Update active button
    var btns=filterWrap.querySelectorAll('.category-filter-btn');
    btns.forEach(function(b){b.classList.toggle('active',b.getAttribute('data-cat')===catName)});
    // Filter posts
    if(catName==='all'){renderPosts(allPosts);return}
    var filtered=allPosts.filter(function(post){
      if(!post._embedded||!post._embedded['wp:term']||!post._embedded['wp:term'][0])return false;
      return post._embedded['wp:term'][0].some(function(t){return t.name===catName});
    });
    renderPosts(filtered);
  }

  fetch(API).then(function(r){return r.json()}).then(function(posts){
    allPosts=posts;
    // Build category filter buttons
    var cats={};
    posts.forEach(function(post){
      if(post._embedded&&post._embedded['wp:term']&&post._embedded['wp:term'][0]){
        post._embedded['wp:term'][0].forEach(function(t){cats[t.name]=true});
      }
    });
    var catNames=Object.keys(cats);
    if(catNames.length>1){
      var allBtn=document.createElement('button');
      allBtn.className='category-filter-btn active';
      allBtn.setAttribute('data-cat','all');
      allBtn.textContent='すべて';
      allBtn.onclick=function(){filterByCategory('all')};
      filterWrap.appendChild(allBtn);
      catNames.forEach(function(name){
        var btn=document.createElement('button');
        btn.className='category-filter-btn';
        btn.setAttribute('data-cat',name);
        btn.textContent=name;
        btn.onclick=function(){filterByCategory(name)};
        filterWrap.appendChild(btn);
      });
    }
    renderPosts(posts);
  }).catch(function(){
    list.innerHTML='<li class="article-item" style="text-align:center;padding:60px 0;color:rgba(10,10,10,0.3)">記事の読み込みに失敗しました。</li>';
  });
})();
</script>
