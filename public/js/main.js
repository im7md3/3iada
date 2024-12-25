// Click tog-show
if (document.querySelector(".tog-show")) {
    let togglesShow = document.querySelectorAll(".tog-show");
    togglesShow.forEach((e) => {
        let togg = true;
        e.addEventListener("click", (evt) => {
            let listItem = document.querySelector(e.getAttribute("data-show"));
            if (togg == true) {
                listItem.style.display = "flex";
                togg = false;
            } else {
                listItem.style.display = "none";
                togg = true;
            }
        });
    });
}

// scroll top effect
const upBtn = document.querySelector(".up-btn");

if (upBtn) {
    window.addEventListener("scroll", () =>
        this.scrollY >= 160
            ? upBtn.classList.add("show")
            : upBtn.classList.remove("show")
    );

    upBtn.addEventListener("click", () =>
        this.scrollTo({
            top: 0,
            behavior: "smooth",
        })
    );
}

// print
// if (document.getElementById("prt-content") && document.getElementById("btn-prt-content") ) {
//     var btnPrtContent = document.getElementById("btn-prt-content");
//     btnPrtContent.addEventListener("click", printDiv);
//     function printDiv() {
//         var prtContent = document.getElementById("prt-content");
//         newWin = window.open("");
//         newWin.document.head.replaceWith(document.head.cloneNode(true));
//         newWin.document.body.appendChild(prtContent.cloneNode(true));
//         setTimeout(() => {
//             newWin.print();
//             newWin.close();
//         }, 600);
//     }
// }

// loader window
// if (document.querySelector(".loader-container")) {
//     document.body.classList.add("overflow-hidden");
//     const loaderContainer = document.querySelector(".loader-container");
//     window.addEventListener("load", () => {
//         setTimeout(() => {
//             loaderContainer.classList.add("hidden-loader");
//             document.body.classList.remove("overflow-hidden");
//         }, 200);
//     });
// }
if(document.querySelector('.myButton')) {

    // print
    $('.myButton').on('click',function(){
        console.log($(this).data('id'))
        var  myId = $(this).data('id')
    })
    $('.print-btn').on('click',function(){
        var id = $(this).data('id');
        console.log(id);
        if (document.getElementById("prt-content")) {
        var btnPrtContent = document.querySelector("#btn-prt-content");
        var btnPrtContent = document.querySelector(`#btn-prt-content1${id}`);
        printDiv();
        function printDiv() {
            var prtContent = document.querySelector("#prt-content");
            var prtContent = document.querySelector(`#prt-content1${id}`);
            newWin = window.open("");
            newWin.document.head.replaceWith(document.head.cloneNode(true));
            newWin.document.body.appendChild(prtContent.cloneNode(true));
            setTimeout(() => {
                newWin.print();
                newWin.close();
            }, 600);
        }
        }
    });
}

// loader window
if (document.querySelector(".loader-container")) {
    document.body.classList.add("overflow-hidden");
    const loaderContainer = document.querySelector(".loader-container");
    window.addEventListener("load", () => {
        setTimeout(() => {
            loaderContainer.classList.add("hidden-loader");
            document.body.classList.remove("overflow-hidden");
        }, 200);
    });
}

// print
if (document.getElementById("prt-content")) {
    var btnPrtContent = document.getElementById("btn-prt-content");
    btnPrtContent.addEventListener("click", printDiv);
    function printDiv() {
        var prtContent = document.getElementById("prt-content");
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(prtContent.cloneNode(true));
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
}
if (document.querySelector(".gender") && document.querySelector("#my-input")) {
    //disabled input
    const select = document.querySelector(".gender");
    const input = document.querySelector("#my-input");
    input.disabled = true;
    select.addEventListener("change", (event) => {
        if (event.target.value === "custom") {
            input.disabled = false;
            input.value = "";
            // console.log('false')
        } else {
            input.disabled = true;
            input.value = "";
            // console.log('true')
        }
    });
}
