function activateSubmenu(event){
    let activeClicket = event.target.classList.contains("navlink-active");
    if (document.getElementsByClassName("navlink-active").length > 0){
        document.getElementsByClassName("navlink-active")[0].classList.remove("navlink-active");
    }
    console.log(event.target);
    if (!activeClicket){
        event.target.classList.add("navlink-active");
    }
}

function changeUrlName(event){
    let newUrlName = event.target.value.replace(/ /g, "-");
    document.getElementById("input-article-name").setAttribute("value", newUrlName);
    console.log(newUrlName);
}

function calculateHp(event){
    let encounterId = event.target.id.split("-")[1];
    let ammount = event.target.value;
    let hpElement = document.getElementById("hp-"+encounterId);
    console.log(ammount)
    hpElement.value = Number(hpElement.value) + Number(ammount);
}

function toggleNavbar(event){
    if (event.target.parentNode.parentNode.classList.contains("active-nav")){
        event.target.parentNode.parentNode.classList.remove("active-nav");
        event.target.parentNode.parentNode.classList.add("inactive-nav");
    }
    else if (event.target.parentNode.parentNode.classList.contains("inactive-nav")){
        event.target.parentNode.parentNode.classList.remove("inactive-nav");
        event.target.parentNode.parentNode.classList.add("active-nav");
    }
}