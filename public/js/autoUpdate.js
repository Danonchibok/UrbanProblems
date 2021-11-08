


setInterval( async() => {
    let userCount = document.querySelector('#userCount');
    let problemsCount = document.querySelector('#problemsCount');
    let response = await fetch('http://urbanproblems/getCounters');
    let result = await response.json();
    if (userCount.dataset.count !=  result['countUsers']) {
        userCount.dataset.count = result['countUsers'];
        userCount.querySelector('#counter').animate([
            {
                top: `${0}px`,
            },
            {
                top: `${-35}px`,
            }
        ],800).onfinish = () =>{
            userCount.querySelector('#counter').style.top = `${-35}px`;
            userCount.querySelector('#counter').remove();
        };
        animNumber(userCount, result['countUsers']);
    }

    if (problemsCount.dataset.count !=  result['countProblems']) {
        problemsCount.dataset.count =  result['countProblems'];

        problemsCount.querySelector('#counter').animate([
            {
                top: `${0}px`,
            },
            {
                top: `${-35}px`,
            }
        ],800).onfinish = () =>{
            problemsCount.querySelector('#counter').style.top = `${-35}px`;
            problemsCount.querySelector('#counter').remove();
        };
        animNumber(problemsCount, result['countProblems']);
    }

}, 5000);

function animNumber(div, num) {
    let newUser = document.createElement('div');
    div.append(newUser);
    newUser.textContent = num;
    newUser.id = 'counter';
    newUser.animate([
        {
            top: `${35}px`,
        },
        {
            top: `${0}px`,
        }
    ], 800);


}
