let appbutton = document.querySelectorAll(".but");
const buttons = Array.from(appbutton);

const submit = document.querySelector(".submit");


let showDetails = (evt) => {
    evt.preventDefault();
    let element = evt.target.parentElement.nextElementSibling;
    if (element.classList.contains("d-none")) {
        element.classList.remove("d-none");
        evt.target.textContent = "Close Details";
    } else {
        element.classList.add("d-none");
        evt.target.textContent = "Show Details";
    }

}

for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', showDetails);
}


const API_publicKey = "FLWPUBK_TEST-ca1bae79045ee105ab06ca5a6f808f7b-X";



let payWithRave = (evt) => {
    evt.preventDefault();
    console.log("hello");
    let email = document.querySelector("#email").value
    let amount = document.querySelector("#amount").value
    let number = document.querySelector("#number").value
    let currency = document.querySelector("#currency").value
    let txref = document.querySelector("#txref").value
    const x = getpaidSetup({
        PBFPubKey: API_publicKey,
        customer_email: email,
        amount: amount,
        customer_phone: number,
        currency: currency,
        txref: txref,
        meta: [{
            metaname: "flightID",
            metavalue: "AP1234"
        }],
        onclose: function (response) {
            var txref = response.tx.txRef;
            if (
                response.tx.chargeResponseCode == "00" ||
                response.tx.chargeResponseCode == "0"
            ) {
                // redirect to a success page
                console.log("success")
                let link = "http://localhost:81/startnghospital/verify.php?txref=" + txref
                window.location = link;
            }
        },
        callback: function (response) {
            var txref = response.tx.txRef; // collect txRef returned and pass to a server page to complete status check.
            console.log("This is the response returned after a charge", response);
            if (
                response.tx.chargeResponseCode == "00" ||
                response.tx.chargeResponseCode == "0"
            ) {
                // redirect to a success page
                console.log("success")
                let link = "http://localhost:81/startnghospital/verify.php?txref=" + txref
                window.location = link;
            } else {
                // redirect to a failure page.
            }

            x.close(); // use this to close the modal immediately after payment.
        }
    });
}

submit.addEventListener("click", payWithRave)