// fetch(url)
// .then((response) => response.json())
// .then((data) => console.log(data));

const btLogin = document.querySelector('#btLogin');

let url = 'https://localhost:5001/accounts/';


btLogin.addEventListener("click", () =>
{
    const tbUserName = document.querySelector('#tbUserName');
    const tbPassword = document.querySelector('#tbPassword');

    let check = false;

    var userName = tbUserName.value;
    var password = tbPassword.value;


    console.log(userName);
    console.log(password);

    fetch(url)
        .then((response) => response.json())
        .then((data) =>
        {
            //console.log(data);
            Object.entries(data).forEach(([key, val]) =>
            {
                // console.log(key);
                console.log(val.userName.toString());
                console.log(val.password);
                if (val.userName == userName)
                    check = true;
            });
        }).then(() =>
        {
            if (check)
            {
                console.log("Passsssss");
            } else 
            {
                console.log("Failllll");
            }
        })
})