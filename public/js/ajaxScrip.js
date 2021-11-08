async function getView(fetchPath){
    let response = await fetch(fetchPath);
    let result = await response.text();
    document.body.innerHTML = result;
}

async function getinputs(fetchPath, div){
    let response = await fetch(fetchPath);
    let result = await response.text();
    document.querySelector(div).innerHTML = result;
}

function GetProblems(fetchPath, form) {
    form.addEventListener('submit', async(e)=>{

        e.preventDefault();
        let response = await fetch(fetchPath , {
            method: 'POST',
            body: new FormData(form)

        });
        let result = await response.text();

        document.querySelector('.works').innerHTML = result;
    });
}

function LoginOrRegister(fetchPath, form) {
    form.onsubmit = async (e) =>{
        e.preventDefault();
        let response = await fetch(fetchPath, {
            method: 'POST',
            body: new FormData(form)
        });
        let result = await response.text();

        document.body.innerHTML = result;
    };
}

function Addcategory(fetchPath, form, div) {
    form.onsubmit = async (e) =>{
        e.preventDefault();
        let response = await fetch(fetchPath, {
            method: 'POST',
            body: new FormData(form)
        });
        let result = await response.text();

        document.querySelector(div).innerHTML = result;
    };
}
let flag;
document.addEventListener('click', ()=>{

    let formElem = document.querySelector('#form');
    let backForm = document.querySelector('#form-back');
    let registerForm = document.querySelector('#RegisterForm');
    let feedbackForm = document.querySelector('#FeedbackForm');
    let loginForm = document.querySelector('#loginForm');
    let addCategory = document.querySelector('#addCat');




    if (formElem) {
        GetProblems("http://urbanproblems/privateAcc", formElem);

    }
    if (backForm) {
        GetProblems("http://urbanproblems/privateAcc/back", backForm);
    }

    if (registerForm) {
        LoginOrRegister("http://urbanproblems/register", registerForm);
    }

    if (loginForm) {
        LoginOrRegister("http://urbanproblems/login", loginForm);
    }

    if (feedbackForm) {
        LoginOrRegister("http://urbanproblems/feedback", feedbackForm);
    }

    if (addCategory) {
        Addcategory("http://urbanproblems/admin/addCategory", addCategory, '.addCategory');
    }
/*
    document.addEventListener('click' , (e)=>{
        console.log('pyk');
        const target = e.target.closest('#del-form');
        if (target) {
            e.preventDefault();
            let delBtn = document.querySelector('#confirm-delete');
            delBtn.addEventListener('click', async ()=>{
                let response = await fetch("http://urbanproblems/privateAcc/del" , {
                method: 'POST',
                body: new FormData(target)

                });
                let result = await response.text();
                document.querySelector('.works').innerHTML = result;
            });
        }

    });
*/


    document.onclick = async (e) => {
        const targetSolve = e.target.closest('#solveProblem');
        const targetReject = e.target.closest('#rejectProblem');

        let targetCard = e.target.closest('.card');
        if (targetSolve) {
            flag = 'solve';
            e.preventDefault();
            let response = await fetch("http://urbanproblems/admin/solveProblemInputs");
            let result = await response.text();
            let div = targetCard.querySelector('.inResponse');
            div.innerHTML = result;
            console.log(result);
        };

        if (targetReject) {
            flag = 'reject';
            e.preventDefault();
            let response = await fetch("http://urbanproblems/admin/rejectInputs");
            let result = await response.text();
            let div = targetCard.querySelector('.inResponse');
            div.innerHTML = result;
            console.log(result);
        };

    }
/*
    document.onclick = async (e) => {
        const target = e.target.closest('#rejectProblem');
        let targetCard = e.target.closest('.card');
        if (target) {
            e.preventDefault();
            let response = await fetch("http://urbanproblems/admin/rejectInputs");
            let result = await response.text();
            let div = targetCard.querySelector('.inResponse');
            div.innerHTML = result;
            console.log(result);
        };

    }
    */
});

deleteWithModalWindow('#del-Category', '#confirm-delete', "http://urbanproblems/admin/DeleteCategory", '.mes');
deleteWithModalWindow('#del-form', '#confirm-delete', "http://urbanproblems/privateAcc/del", '.works');


function deleteWithModalWindow(form, confirmBtn, fetchPath, div) {
    document.addEventListener('click', (e)=>{

        const target = e.target.closest(form);
        if (target) {
            console.log('gdf');
            e.preventDefault();
            let delBtn = document.querySelector(confirmBtn);
            delBtn.addEventListener('click', async ()=> {
                let response = await fetch(fetchPath , {
                method: 'POST',
                body: new FormData(target)

                });
                let result = await response.text();
                e.target.closest(div).innerHTML = result;
            });
        }

    });
}







document.onsubmit = async (e) => {
    const target = e.target.closest('#sub');
    let targetCard = e.target.closest('.card');
    if (target) {
        e.preventDefault();
        let response;
        if (flag == 'solve') {
            response = await fetch("http://urbanproblems/admin/solveProblem" , {
                method: 'POST',
                body: new FormData(target)
            });
        }
        if (flag == 'reject') {
            response = await fetch("http://urbanproblems/admin/rejectProblem" , {
            method: 'POST',
            body: new FormData(target)
        });
        }
        let result = await response.text();
        let div = targetCard.querySelector('.inResponse');
        div.innerHTML = result;
    }
};
/*
document.onsubmit = async (e) => {
    const target = e.target.closest('#reject');
    let targetCard = e.target.closest('.card');
    if (target) {
        e.preventDefault();
        let response = await fetch("http://urbanproblems/admin/rejectProblem" , {
            method: 'POST',
            body: new FormData(target)
        });
        let result = await response.text();
        let div = targetCard.querySelector('.inResponse');
        div.innerHTML = result;
    }
};
*/
