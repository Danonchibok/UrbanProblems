    /*
    document.addEventListener('DOMContentLoaded', ()=>{
        let allSliders = document.querySelector('.slider');
        let allBeforeimg = document.querySelectorAll('.slide-before');
        let widthAll = allSliders.offsetWidth;
        allBeforeimg.forEach(element => {
            element.style.width = `${widthAll}px`;

        });
    });
    */
    document.addEventListener('mousedown', (event)=>{

        const slider = event.target.closest('.slider');
        const before = slider.querySelector('.slide-before');
        const beforeImg = slider.querySelector('.image-slide-before');
        const change = slider.querySelector('.change');

        let isActive = true;
        let width = slider.offsetWidth;
        beforeImg.style.width = `${width}px`;


        const BeforeAfter = (x) => {
            let shift = Math.max(0, Math.min(x, slider.offsetWidth));
            before.style.width = `${shift}px`;
            change.style.left = `${shift}px`;
        };

        const pause = (e) =>{
            e.stopPropagation();
            e.preventDefault();
            return false;
        };

        slider.addEventListener('mouseup', ()=>{
            isActive = false;
        });

        slider.addEventListener('mousedown', ()=>{
            isActive = true;
        });

        slider.addEventListener('mouseleave', ()=>{
            isActive = false;
        });

        slider.addEventListener('mousemove', (e)=>{

            if (!isActive) {
                return;
            }

            let x = e.pageX;
            x -= slider.getBoundingClientRect().left;
            BeforeAfter(x);
            pause(e);
        });
    });


