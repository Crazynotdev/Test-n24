const bg = document.createElement('div');
bg.style.position='fixed';
bg.style.top=0;
bg.style.left=0;
bg.style.width='100%';
bg.style.height='100%';
bg.style.zIndex=0;
document.body.appendChild(bg);

for(let i=0;i<80;i++){
    let p=document.createElement('div');
    p.className='particle';
    p.style.position='absolute';
    p.style.width=(1+Math.random()*3)+'px';
    p.style.height=p.style.width;
    p.style.background='rgba(255,'+(155+Math.random()*100)+',0,'+(0.2+Math.random()*0.3)+')';
    p.style.left=Math.random()*100+'%';
    p.style.top=Math.random()*100+'%';
    p.style.borderRadius='50%';
    p.style.boxShadow='0 0 10px gold';
    bg.appendChild(p);
}

for(let i=0;i<15;i++){
    let l=document.createElement('div');
    l.className='connection-line';
    l.style.position='absolute';
    l.style.height='1px';
    l.style.background='linear-gradient(90deg, transparent, rgba(255,215,0,0.2), transparent)';
    l.style.left=Math.random()*100+'%';
    l.style.top=Math.random()*100+'%';
    l.style.width=(50+Math.random()*150)+'px';
    l.style.transform='rotate('+Math.random()*360+'deg)';
    bg.appendChild(l);
}

document.addEventListener('mousemove', e=>{
    let mouseX=e.clientX/window.innerWidth-0.5;
    let mouseY=e.clientY/window.innerHeight-0.5;
    document.querySelectorAll('.particle').forEach((p,i)=>{
        let speed=(i%5)/10+0.1;
        p.style.transform=`translate(${mouseX*speed*30}px,${mouseY*speed*30}px)`;
    });
});
