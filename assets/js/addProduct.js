

const addColorButton = document.querySelector('#addColorButton');
const addColorInput = document.querySelector('#addColorInput');
const listColor = document.querySelector('#listColor')
const indexColor = document.querySelector('#indexColor')

addColorButton.addEventListener('click', () => {
    document.querySelector('#typeButton').value = "add";
    if (addColorInput.value != "") {
        const li = document.createElement('div');
        const p = document.createElement('p');
        const buttonDelete = document.createElement('button');
        const i = document.createElement('i');
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';

        p.innerHTML = addColorInput.value;
        p.className = "add__type-name";
        li.appendChild(p);


        buttonDelete.className = "add__type-delete";
        buttonDelete.addEventListener('click', () => {
            listColor.removeChild(li);
            indexColor.value--;
        })
        i.className = "fa-solid fa-xmark";
        buttonDelete.appendChild(i);

        li.appendChild(buttonDelete);


        li.className = "add__type-item";
        indexColor.value++;
        hiddenInput.setAttribute('name', "color" + indexColor.value);
        hiddenInput.value = addColorInput.value;
        li.appendChild(hiddenInput);
        listColor.appendChild(li);
        addColorInput.value = "";
        addColorInput.style.border = "1px solid black";
    }
})

const listImage = document.querySelector('#listImage');
const indexImage = document.querySelector('#indexImage')

const image_input = document.querySelector("#image-input");
image_input.addEventListener("change", function () {
    console.log(listImage);
    for (i = 1; i <= indexImage.value; i++) {
        let str = "#image" + i;
        console.log(str);
        const child = listImage.querySelector(str);
        listImage.removeChild(child);
    }

    indexImage.value = 0;
    for (i = 0; i < this.files.length; i++) {
        if (!this.files[i].type.match("image")) {
            continue;
        }
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            const uploaded_image = reader.result;
            const image = document.createElement('img');
            const buttonDelete = document.createElement('button');
            const i = document.createElement('i');
            const div = document.createElement('div');

            image.src = uploaded_image;
            image.className = "add__img-image";

            buttonDelete.className = "add__img-delete";
            buttonDelete.addEventListener('click', () => {
                listImage.removeChild(div);
                indexImage.value--;
            })
            i.className = "fa-solid fa-xmark";
            buttonDelete.appendChild(i);


            div.appendChild(image);
            //div.appendChild(buttonDelete);

            div.className = "add__img-item";
            indexImage.value++;
            div.setAttribute('id', 'image' + indexImage.value);
            console.log(div.getAttribute('id'));
            document.querySelector('#listImage').appendChild(div);
        });
        reader.readAsDataURL(this.files[i]);

    }
});

function IsSubmit() {
    const typeButton = document.querySelector('#typeButton').value;
    let kt = true;
    if (typeButton != "submit")
        return false;
    let nameProduct = document.forms["form"]["nameProduct"].value;
    let price = document.forms["form"]["price"].value;
    let detail = document.forms["form"]["decribe"].value;
    if (nameProduct === "") {
        kt = false;
        alert("Please enter");
        document.forms["form"]["nameProduct"].style.border = "1px solid red";
    }
    if (price === "") {
        kt = false;
        document.forms["form"]["price"].style.border = "1px solid red";
    }
    if (detail === "") {
        kt = false;
        document.forms["form"]["decribe"].style.border = "1px solid red";
    }
    if (!kt) {
        scroll(0, 100);
    }
    if (indexColor.value==0)
    {
        kt=false;
        scroll(0, 800);
        addColorInput.style.border = "1px solid red";
        
    }
    return kt;
}

const submitButton = document.querySelector('#submitButton');

submitButton.onclick = function () {
    document.querySelector('#typeButton').value = "submit";
}


const cancelButton = document.querySelector('#cancelButton');

cancelButton.addEventListener("click", () => {
    alert("cal");
    window.location = "./yourStore.php";
    document.querySelector('#typeButton').value = "cancel";
})
